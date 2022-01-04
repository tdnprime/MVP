<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Box;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
<<<<<<< HEAD

    public function createplan()
    {

=======
    
    public function createplan(Request $request){
        
        $id = auth()->user()->id;
        $user = User::find($id);
        
>>>>>>> 9f23fdd5d2461de3c5a0e403851ed9f73634a56c
      if (json_decode($_SERVER[ "HTTP_PLAN" ])  !== null) {
          $plan = json_decode($_SERVER[ "HTTP_PLAN" ]);

      }else{
          echo "Missing header";
      }


    require_once "../php/paypal-connect.php";
    $config = parse_ini_file( "../config/app.ini", true );

    // Prep data PayPal needs to create a billing plan
<<<<<<< HEAD
    $id = auth()->user()->id;
    $user = User::find($id);
    $box = $user->boxes()->first();
=======
    $box = DB::select('select * from boxes where user_id= ?', [$plan->creator_id]);
    if($plan->rate > 0){
>>>>>>> 9f23fdd5d2461de3c5a0e403851ed9f73634a56c
    $TOTAL = $plan->total + $plan->rate;
    }elseif($plan->rate == 0){
      $TOTAL = $plan->total;
    }
      $data = [
<<<<<<< HEAD
        "product_id" => $box->product_id,
        "name" => "Boxeon",
        "description" => "Subscription box",
=======
        "product_id" => $box[0]->product_id,
        "name" => $user->given_name . " " . $user->family_name . " " . "Plan" . " " . $plan->frequency,
        "description" => $user->given_name . " " . $user->family_name . " " . "Subscription box",
>>>>>>> 9f23fdd5d2461de3c5a0e403851ed9f73634a56c
        "status" => "ACTIVE",
        "billing_cycles" => [
          [
            "frequency" => [
<<<<<<< HEAD
              "interval_unit" => "MONTH", // this may need to be dynamic as buyers can also do single purchases
              "interval_count" => $plan->frequency  // Set this to "1" if the json has a value of "0" for frequency
=======
              "interval_unit" => "MONTH", 
              "interval_count" => $plan->frequency  
>>>>>>> 9f23fdd5d2461de3c5a0e403851ed9f73634a56c
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
      // Create billing plan on PayPal and get the returned ID
      $endpoint = $config[ "paypal" ][ "plansEndpoint" ];
      $media = "Content-Type: application/json, Authorization: Bearer $token";
      $p = sendcurl( json_encode( $data ), $endpoint, $media );
      if ( isset( $p[ "id" ] ) ) {
        /*
        Save price, plan ID. and address for now.
        More info is needed to complete a subscription.
        */
       $plan->plan_id =  $p[ "id" ];
<<<<<<< HEAD
       $this->update($plan);

        // Return plan ID to browser for the off-site PayPal checkout flow
        $return = [];
        $return[ 'plan_id' ] = $p[ 'id' ];
        print_r( json_encode( $return ) );

=======
       $this->store($plan);
       // Return plan_id for buyer to continue to PayPal 
       $return = [];
       $return[ 'plan_id' ] = $p[ 'id' ];
       print_r( json_encode( $return ) );
  
>>>>>>> 9f23fdd5d2461de3c5a0e403851ed9f73634a56c
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
            'carrier' => $data->carrier
           );
           DB::table('subscriptions')->insert($array);
    }

    public function complete($callback){
      
      $id = auth()->user()->id;
      $user = User::find($id);
      // Update subscription table after PayPal callback 
      $add = json_decode($callback);
      DB::unprepared("update subscriptions set status=1, sub_id='$add->sub_id', order_id='$add->order_id' WHERE user_id=$user->id AND creator_id=$add->creator_id AND plan_id='$add->plan_id'");
      //Update the in_stock column in the seller's boxes row
      $this->updateStock($add->creator_id, $add->version, $add->stock);
      return 1;
    }

    protected function updateStock($creator_id, $version, $stock){
      $available = $stock - 1;
      DB::unprepared("update boxes set in_stock=$available where user_id=$creator_id AND vid=$version");
    }

}
