<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SquareController;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public $config;

    public function __construct()
    {

        $this->config = parse_ini_file(dirname(__DIR__, 3) .
            "/config/app.ini", true);
    }

    public function checkout()
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        $price = self::amount();
        $creator = self::creator();
        $per_cycle = self::frequency();

        $subscription = array(
            'total' => $price['amount'],
            'description' => 'complete your subscription to ' .
            $creator . '\'s' . ' subscription box at $' .
            $price['amount'] . ' ' . $per_cycle,
            'route' => '/checkout/subscription/create/?upsert=',
        );

        return view('checkout.subscription', compact('user', $user))
            ->with('subscription', $subscription);

    }

    private function frequency()
    {

        $id = auth()->user()->id;

        $frequency = Subscription::where('user_id', '=', $id)
        ->orderByDesc('created_at')
        ->limit(1)
        ->get();

        if ($frequency[0]['frequency'] == 1) {

            return "per month";

        } elseif ($frequency[0]['frequency'] == 2) {

            return "every two months";

        } elseif ($frequency[0]['frequency'] == 3) {

            return "every ninety days";
        }

    }

    private function creator()
    {

        $id = auth()->user()->id;

        $subscription = Subscription::where('user_id', '=', $id)
        ->orderByDesc('created_at')
        ->limit(1)
        ->get();

        $creator = User::where('id', '=', $subscription[0]['creator_id'])
            ->get();

        return $creator[0]['given_name'] . " " . $creator[0]['family_name'];

    }

    public function amount()
    {

        $id = auth()->user()->id;

        $plan = Subscription::where('user_id', '=', $id)
        ->orderByDesc('created_at')
        ->limit(1)
        ->get();

        if ($plan[0]['rate'] > 0) {

            return array(

                "amount" => $plan[0]['price'] + $plan[0]['rate'],

            );

        } elseif ($plan[0]['rate'] == 0) {

            return array(

                "amount" => $plan[0]['price'],

            );
        }

    }
    /**
     * Create a subscription plan
     *
     * @param  Request  $request
     * @return Response
     */

    public function createplan(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        $id = auth()->user()->id;
        $user = User::find($id);
        $plan = json_decode($request["plan"]);

        // Sets the subscription price
        if ($plan->rate > 0) {
            $plan->amount = $plan->total + $plan->rate;
        } elseif ($plan->rate == 0) {
            $plan->amount = $plan->total;
        }

        // Preparation for Square API
        if ($plan->frequency == 1) {
            $plan->cadence = "MONTHLY";
        } elseif ($plan->frequency == 2) {
            $plan->cadence = "EVERY_TWO_MONTHS";
        } elseif ($plan->frequency == 3) {
            $plan->cadence = "NINETY_DAYS";
        }
        $processor = new SquareController();
        $response = json_decode($processor->createPlan($plan));

        if (isset($response->catalog_object->id)) {
            $plan->plan_id = $response->catalog_object->id;
            $this->store($plan);
            // Return plan_id for buyer to continue
            return response()->json([
                'plan_id' => $response->catalog_object->id,
            ]);

        } else {

            return json_encode($response);
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        $array = array(
            'creator_id' => $data->creator_id,
            'user_id' => $user->id,
            'version' => $data->version,
            'frequency' => $data->frequency,
            'price' => $data->total,
            'cpf' => $data->cpf, // Cadastro de Pessoas Físicas.
            'plan_id' => $data->plan_id,
            'address_line_1' => $data->address_line_1,
            'address_line_2' => $data->address_line_2,
            'admin_area_1' => $data->admin_area_1,
            'admin_area_2' => $data->admin_area_2,
            'postal_code' => $data->postal_code,
            'country_code' => $data->country_code,
            'rate_id' => $data->rate_id,
            'rate' => $data->rate,
            'shipment' => $data->shipment,
            'given_name' => $data->given_name,
            'family_name' => $data->family_name,
            'status' => 2, // 2 = pending - the subscription is not yet paid for
            'carrier' => $data->carrier
        );
        DB::table('subscriptions')->insert($array);
    }

    protected function updateStock($creator_id, $version, $stock)
    {
        $new = $stock - 1;
        DB::table('boxes')
            ->where('user_id', '=', $creator_id)
            ->where('vid', '=', $version)
            ->update(['in_stock' => $new]);
    }

    protected function addStock($box)
    {
        $add = json_decode($box);
        $stock = DB::table('boxes')
            ->where('user_id', '=', $add->creator_id)
            ->where('vid', '=', $add->version)
            ->select('in_stock')
            ->get();

        $new = $stock[0]->in_stock + 1;

        DB::table('boxes')
            ->where('user_id', '=', $add->creator_id)
            ->where('vid', '=', $add->version)
            ->update(['in_stock' => $new]);

    }
    protected function boxeonRemove($box)
    {

        $id = auth()->user()->id;
        $user = User::find($id);
        $remove = json_decode($box);
        DB::table('subscriptions')
            ->where('creator_id', '=', $remove->creator_id)
            ->where('version', '=', $remove->version)
            ->where('user_id', '=', $user->id)
            ->delete();
        // Update in_stock
        $this->addStock($box);
    }

    protected function remove($box)
    {
        require_once dirname(__DIR__, 3) . "/php/paypal-connect.php";

        $remove = json_decode($box);

        $id = auth()->user()->id;
        $user = User::find($id);

        // Get subscription ID
        $subscription = DB::table('subscriptions')
            ->where('user_id', '=', $user->id)
            ->where('creator_id', '=', $remove->creator_id)
            ->select('sub_id')
            ->get();
        // Cancell billing on PayPal
        $endpoint = $this->config["paypal"]["billinsEndpoint"] . "/" . $subscription[0]->sub_id . "/cancel";
        $media = 'Content-Type: application/json, Authorization: Bearer $token';
        $data = '{ "reason": "No reason" }';
        $a = sendcurl($data, $endpoint, $media);
        if (isset($a["debug_id"])) {

            return false;

        } else {
            // Remove from Boxeon
            $this->boxeonRemove($box);
            return true;
        }
    }
    public function __destruct()
    {

        unset($this->config);
    }

}
