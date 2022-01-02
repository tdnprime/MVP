<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Box;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    
    public function createplan(Request $request){
        
        $id = auth()->user()->id;
        $user = User::find($id);
        
      if (json_decode($_SERVER[ "HTTP_PLAN" ])  !== null) {
          $plan = json_decode($_SERVER[ "HTTP_PLAN" ]);
       
      }else{
          echo "Missing header";
      }
    require_once "../php/paypal-connect.php";
    $config = parse_ini_file( "../config/app.ini", true );

    // Prep data PayPal needs to create a billing plan
    $box = DB::select('select * from boxes where user_id= ?', [$user->id]);
    if($plan->rate > 0){
     $TOTAL = $plan->total + $plan->rate;
    }elseif($plan->rate == 0){
      $TOTAL = $plan->total;
    }
      $data = [
        "product_id" => $box[0]->product_id,
        "name" => "Boxeon",
        "description" => "Subscription box",
        "status" => "ACTIVE",
        "billing_cycles" => [
          [
            "frequency" => [
              "interval_unit" => "MONTH", 
              "interval_count" => $plan->frequency  
            ],
            "tenure_type" => "REGULAR",
            "sequence" => 1,
            "total_cycles" => 0,
            "pricing_scheme" => [
              "fixed_price" => [
                "value" => $TOTAL,
                "currency_code" => "USD"
              ]
            ]
          ]
        ],
        "payment_preferences" => [
          "auto_bill_outstanding" => true,
          "setup_fee" => [
            "value" => "3",
            "currency_code" => "USD"
          ],
          "setup_fee_failure_action" => "CONTINUE",
          "payment_failure_threshold" => 3
        ]
      ];
      #SEND REQUEST TO PAYPAL
      $endpoint = $config[ "paypal" ][ "plansEndpoint" ];
      $media = "Content-Type: application/json, Authorization: Bearer $token";
      $p = sendcurl( json_encode( $data ), $endpoint, $media );
      if ( isset( $p[ "id" ] ) ) {
        /*
        Save price, plan ID. and address for now. 
        More info is needed to complete a subscription.
        */

       $plan->plan_id =  $p[ "id" ];
       //$plan - Save in DB without calling the store function from within this function
       $return = [];
       $return[ 'plan_id' ] = $p[ 'id' ];
       print_r( json_encode( $return ) );
  
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
      $subscription = new Subscription;

        $request->validate([
            'uid' => 'required',
            'price' => 'required',
            'plan_id' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'admin_area_1' => 'required',
            'admin_area_2' => 'required',
            'postal_code' => 'required',
            'country_code' => 'required',
            'rate_id' => 'required',
            'rate' => 'required',
            'shipment' => 'required',
            'fullname' => 'required',
            'status' => 'required',
            'carrier' => 'required'
        ]);

        $array = array(
            'uid' => $user->id,
            'price' => $data->total,
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
            'status' => 'p', // p = pending - the subscription is not yet paid for
            'carrier' => $data->carrier
           );

           $subscription->save($array);
    }
    public function add(){
      /* Update subscription table after PayPal callback 
      then update the in_stock column in the boxes tables by subtracting 1.*/
    }

}
