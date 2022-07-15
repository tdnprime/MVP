<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SquareController;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    public function convertCadence($frequency)
    {

        if ($frequency == 'MONTHLY') {
            return 1;
        } elseif ($frequency == 'EVERY_TWO_MONTHS') {
            return 2;
        } elseif ($frequency == 'NINETY_DAYS') {
            return 3;
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
        if (empty($data->cpf)) {$data->cpf = 0;}

        $id = auth()->user()->id;
        $user = User::find($id);
        $subscription = new Subscription();
        $subscription->creator_id = $data->creator_id;
        $subscription->user_id = $user->id;
        $subscription->version = $data->version;
        $subscription->frequency = $data->frequency;
        $subscription->price = $data->total;
        $subscription->cpf = $data->cpf; // Cadastro de Pessoas Físicas.
        $subscription->plan_id = $data->plan_id;
        $subscription->address_line_1 = $data->address_line_1;
        $subscription->address_line_2 = $data->address_line_2 ?? null;
        $subscription->admin_area_1 = $data->admin_area_1;
        $subscription->admin_area_2 = $data->admin_area_2;
        $subscription->postal_code = $data->postal_code;
        $subscription->country_code = $data->country_code;
        $subscription->rate_id = $data->rate_id;
        $subscription->rate = $data->rate;
        $subscription->shipment = $data->shipment;
        $subscription->given_name = $data->given_name;
        $subscription->family_name = $data->family_name;
        $subscription->status = 2; // 2 = pending - the subscription is not yet paid for
        $subscription->carrier = $data->carrier;
        $subscription->billing_given_name = $data->billing_given_name ?? null;
        $subscription->billing_family_name = $data->billing_family_name ?? null;
        $subscription->billing_address_line_1 = $data->billing_address_line_1 ?? null;
        $subscription->billing_address_line_2 = $data->billing_address_line_2 ?? null;
        $subscription->billing_admin_area_1 = $data->billing_admin_area_1 ?? null;
        $subscription->billing_admin_area_2 = $data->billing_admin_area_2 ?? null;
        $subscription->billing_postal_code = $data->billing_postal_code ?? null;
        $subscription->billing_country_code = $data->billing_country_code ?? null;
        $user->subscription()->save($subscription);
    }

    public function updateStock($creator_id, $version, $stock)
    {
        if ($stock == 1) {
            $new = 0;
        } else {
            $new = $stock - 1;
        }
        DB::table('boxes')
            ->where('user_id', '=', $creator_id)
            ->where('vid', '=', $version)
            ->update(['in_stock' => $new]);
    }

    public function addStock($box)
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

    public function boxeonRemove($box)
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
        //self::addStock($box);
    }

    protected function remove($box)
    {

        $remove = json_decode($box);
        $id = auth()->user()->id;

        // Get subscription ID
        $subscription = Subscription::where('user_id', '=', $id)
            ->where('creator_id', '=', $remove->creator_id)
            ->where('version', '=', $remove->version)
            ->get();

        // Delete on Square
        $square = new SquareController();

        $result = $square->deleteSubscription([

            'sub_id' => $subscription[0]['sub_id'],
            'action_id' => 'creator-id-' . $remove->creator_id,

        ]);

        $result = json_decode($result);

        if (isset($result->errors)) {

            return $result;

        } else {

            // Remove from Boxeon
            $this->boxeonRemove($box);
            return 1;
        }
    }

    public function pause($sub)
    {

        // Pause on Square

        // Pause on Boxeon


    }

    public function updateSquare($sub)
    {
        # Update on Square

        // Get subscription details
        $subscription = Subscription::where('user_id', '=', $id)
            ->where('product_id', '=', $sub->product_id)
            ->get();

        $square = new SquareController();
        $response = $square->updateSubscription([
            'cadence' => $request->input("cadence"),
            'square_vid' => (int) $subscription[0]['square_vid'],
            'sub_id' => $subscription[0]['sub_id'],
        ]);

        if (!isset($response->subscription->id)) {
            return $response;
        } else {
            // update on Boxeon
            Subscription::where('user_id', '=', $id)
                ->update([

                    'frequency' => self::convertCadence($request->input("cadence")),
                ]);
            Session::flash('message', 'Subscription updated.');
            return redirect()->route('home.subscriptions', $user);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return true;

        $sub = json_decode($request["order"]);

        $id = auth()->user()->id;
        $user = User::find($id);

        // Decide the update type
        if ($sub->plan == -1) {
            // Pause
            //self::pause($sub);

        } elseif ($sub->plan == -2) {
            // Remove
            //self::remove($sub);

        } else {

            // Update
           // self::updateSquare($sub);
         

        }
        return;

    }

    public function billingAddress()
    {

        $id = auth()->user()->id;
        $user = User::find($id);

        $address = Subscription::where('user_id', '=', $id)
            ->get();
        return json_encode($address);
    }

    public function __destruct()
    {

        unset($this->config);
    }

}
