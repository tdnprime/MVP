<?php

/* CREATE A BILLING PLAN */
if ( isset( $_SERVER[ 'HTTP_PLAN' ] ) ) {
  session_start();
  $uid = $_SESSION[ 'uid' ];
  $b = json_decode( $_SERVER[ 'HTTP_PLAN' ], true );
  require_once "../mysqliclass.php";
  require_once "../home/paypal-token.php";
  $config = parse_ini_file( "../config/app.ini", true );
  $db = Database::getInstance();
  // SET DELIVERY FREQUENCY
  $plans = $db->get( "SELECT * FROM subscriptions WHERE uid=$uid" );
  if ( isset( $plans[ 0 ] ) && count( $plans[ 0 ] ) > 0 ) {
    $b[ 'frequency' ] = $plans[ 0 ][ 'frequency' ] + 1;
  }

  // CREATE THE PLAN
  $cid = $b[ 'creator_id' ];
  $sql = "SELECT product_id, category, description, price FROM boxes WHERE uid=$cid ORDER BY vid DESC LIMIT 1";
  $result = $db->get( $sql );
  if ( $db->get( $sql ) ) {


    $result = $db->get( $sql )[ 0 ];

  }

  if ( isset( $result[ 'product_id' ] ) ) {

    $endpoint = $config[ "paypal" ][ "plansEndpoint" ];
    $TOTAL = $result[ "price" ] + $b[ 'rate' ];

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

    $media = "Content-Type: application/json, Authorization: Bearer $token";
    $p = sendcurl( json_encode( $d ), $endpoint, $media );
    if ( isset( $p[ "id" ] ) ) {
      // SAVE PARTIAL  SUBSCRIPTION INFO
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