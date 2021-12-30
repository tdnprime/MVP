<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubcriptionController extends Controller
{
    
    public function createPlan(){
        /* 

        NOTE:
        Ajax will send json data that is needed here. But there is
        more data in this json that needs to be later saved after 
        the buyer has paid on PayPal and is redirected to the
        site. Preferably, the extra data in the json will be saved 
        NOT in the DB, but must persist
        for retrieval even after the redirect from PayPal.

        */
      if (json_decode($_SERVER[ "HTTP_PLAN" ])  !== null) {
          $to = json_decode($_SERVER[ "HTTP_PLAN" ]);
       
      }else{
          echo "Missing header";
      }
    require_once "../../php/paypal-connect.php";
    $config = parse_ini_file( "../../config/app.ini", true );
    // Prep data PayPal needs to create a billing plan
      $data = [
        "product_id" => $product_id,
        "name" => "Boxeon",
        "description" => $description,
        "status" => "ACTIVE",
        "billing_cycles" => [
          [
            "frequency" => [
              "interval_unit" => "MONTH", // this may need to be dynamic as buyers can also do single purchases
              "interval_count" => $frequency  // Set this to "1" if the json has a value of "0" for frequency 
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
          "payment_failure_threshold" => 3
        ]
      ];
      #SEND REQUEST TO PAYPAL
      $endpoint = $config[ "paypal" ][ "plansEndpoint" ];
      $media = "Content-Type: application/json, Authorization: Bearer $token";
      $plan = sendcurl( json_encode( $data ), $endpoint, $media );
      if ( isset( $plan[ "id" ] ) ) {
        /*
        Save price, plan ID. and address for now. 
        More info is needed to complete a subscription.
        */
        $b[ 'uid' ] = $uid;
        $b[ 'price' ] = $result[ "price" ];
        $b ['plan_id'] =  $plan[ "id" ];
       // $r = $db->insert( "subscriptions", $b );
    
        // Return plan ID to browser for the off-site PayPal checkout flow
        $return = [];
        $return[ 'plan_id' ] = $p[ 'id' ];
        print_r( json_encode( $return ) );
  
    }
}
}
