<?php
#CREATE A BILLING PLAN (PAYPAL)
/*This comes second in the PayPal subscription flow.
For a user to subscribe to a box, they must first check the cost
of shipping to them. A list of prices is returned to them. 
Once they "choose" the price they wish to pay,
that info along with other requisite info are saved 
in the subscriptions table. In other words, we're placing
info in the subscriptions table before we have a 
subscription payment. Choosing a shipping cost
also calls this script because the plan info that 
PayPal will return in this script is needed for the next step, which 
is step to proceed to further in the PayPal payment flow - offsite.*/

if ( isset( $_SERVER[ 'HTTP_PLAN' ] ) ) {
  session_start();
  $uid = $_SESSION[ 'uid' ];
  $b = json_decode( $_SERVER[ 'HTTP_PLAN' ], true );
  require_once "../mysqliclass.php";
  require_once "../home/paypal-token.php";
  $config = parse_ini_file( "../config/app.ini", true );
  $db = Database::getInstance();

  //Get delivery frequency for subscription
  $plans = $db->get( "SELECT * FROM subscriptions WHERE uid=$uid" );
  if ( isset( $plans[ 0 ] ) && count( $plans[ 0 ] ) > 0 ) {
    $b[ 'frequency' ] = $plans[ 0 ][ 'frequency' ] + 1;
  }

  #CREATING THE PLAN...
  $cid = $b[ 'creator_id' ];
  $sql = "SELECT product_id, category, description, 
  price FROM boxes WHERE uid=$cid ORDER BY vid DESC LIMIT 1";
  $result = $db->get( $sql );
  if ( $db->get( $sql ) ) {
    $result = $db->get( $sql )[ 0 ];
  }
  /*A Product must be created on PayPal before 
  a Billing Plan can be created. This checks to see if we 
  have a Product ID from PayPal in our database.
  It is needed to create this plan.*/
  if ( isset( $result[ 'product_id' ] ) ) {
    //Adding price of box with cost of shipping to buyer
    $TOTAL = $result[ "price" ] + $b[ 'rate' ];
    //Data required by PayPal to create Billing Plan:
    $d = [
      "product_id" => $result[ 'product_id' ],
      "name" => "Boxeon",
      "description" => $result[ 'description' ],
      "status" => "ACTIVE",
      "billing_cycles" => [
        [
          "frequency" => [
            "interval_unit" => "MONTH",
            "interval_count" => $b[ 'frequency' ]
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
    $p = sendcurl( json_encode( $d ), $endpoint, $media );
    if ( isset( $p[ "id" ] ) ) {
      /*Saving price, plan ID for now. 
	  More info is needed to complete a subscription...
	  */
      #SAVE PLAN ID IN DATABASE
      $b[ 'uid' ] = $uid;
      $b[ 'price' ] = $result[ "price" ];
      $r = $db->insert( "subscriptions", $b );
      $e = [];
      $e[ 'plan_id' ] = $p[ 'id' ];
      $_SESSION[ 'plan_id' ] = $p[ 'id' ];
      print_r( json_encode( $e ) );
    }
  }
}

?>