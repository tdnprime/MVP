<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public $config;

    public function __construct(){
        $this->config = parse_ini_file( dirname(__DIR__, 3) . "/config/app.ini", true );
    }

    public function createplan(Request $request)
    {

        $id = auth()->user()->id;
        $user = User::find($id);
        $plan = json_decode($request["plan"]);       

        // Prep data PayPal needs to create a billing plan
        $box = DB::select('select * from boxes where user_id= ?', [$plan->creator_id]);
        if ($plan->rate > 0) {
            $total = $plan->total + $plan->rate;
        } elseif ($plan->rate == 0) {
            $total = $plan->total;
        }

    // CALL SQUARE CONTROLLER
        
        if (isset($p["id"])) {
            /*
            Save price, plan ID. and address for now.
            More info is needed to complete a subscription.
             */
            $plan->plan_id = $p["id"];
            $this->store($plan);
            // Return plan_id for buyer to continue to PayPal
            $return = [];
            $return['plan_id'] = $p['id'];
            return json_encode($return);

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
            'fullname' => $data->fullname,
            'status' => 2, // 2 = pending - the subscription is not yet paid for
            'carrier' => $data->carrier,
        );
        DB::table('subscriptions')->insert($array);
    }

    public function complete($callback)
    {

        $id = auth()->user()->id;
        $user = User::find($id);
        // Update subscription table after PayPal callback
        $add = json_decode($callback);
        // NB - Works as an unprepared update, but should be and insert statement:
        DB::unprepared("update subscriptions set status=1, sub_id='$add->sub_id', order_id='$add->order_id' WHERE user_id=$user->id AND creator_id=$add->creator_id AND plan_id='$add->plan_id'");

        //Update the in_stock column in the seller's boxes row
        $this->updateStock($add->creator_id, $add->version, $add->stock);
        return 1;
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
    public function __destruct(){

        delete($this->config);
    }

}
