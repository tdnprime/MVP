<?php

// CREATE PRODUCTS AND PLANS FOR SMS SERVICE



require_once "../mysqliclass.php";

$db = Database::getInstance();

$sql = "SELECT product_id, plan_id, frequency, price FROM user WHERE uid=" . $uid;

if($db->get($sql)){

	

	$result = $db->get($sql)[0]; 

}

// CREATE PRODUCT

if(empty($result["plan_id"])){

	

require_once "paypal-token.php";

$endpoint = "https://api.sandbox.paypal.com/v1/catalogs/products";

$data = [

  "name"=> $name . " SMS Subscription",

  "description"=> "For text message conversations with merchant",

  "type"=> "SERVICE",

  "category"=> "ENTERTAINMENT_AND_MEDIA",

  "home_url"=> "https://boxeon.com/user/?u=" . $uid

  ];

   

$media = "Content-Type: application/json, Authorization: Bearer $token";

$cp = sendcurl(json_encode($data), $endpoint, $media);

$product_id = $cp["id"];

$array = array('product_id' => $product_id);

$clause = "where uid=" . $uid;

$db->update("user", $array, $clause);

// CHECK FOR BILLING PLAN



//CREATE   THREE  BILLING PLANS

if(isset($product_id)){

$endpoint = "https://api.sandbox.paypal.com/v1/billing/plans";

$price = $result["price"];

//$fee = $price  / 100 * 14; // GET FROM DB, CHARGE IT TO SELLER WHEN THEY ARE DOING SHIPPING

$TOTAL = 175;

$frequency_count = 1



$d = [

  "product_id"=> $product_id,

  "name"=> "Boxeon",

  "description" => $name ." subscription box",

  "status"=> "ACTIVE",

  "billing_cycles"=> [

    [

      "frequency"=> [

        "interval_unit"=> "DAY",

        "interval_count"=> $frequency_count

      ],

      "tenure_type"=> "REGULAR",

      "sequence"=> 1,

      "total_cycles"=> 0,

      "pricing_scheme"=> [

        "fixed_price"=> [

          "value"=> $TOTAL, 

          "currency_code"=> "USD"

        ]

      ]

    ]

  ],

 

  "payment_preferences"=> [

    "auto_bill_outstanding"=> true,

    "payment_failure_threshold"=> 3

  ]

];

// INFORM USER UPON SUCCESS

$media = "Content-Type: application/json, Authorization: Bearer $token";

$p = sendcurl(json_encode($d), $endpoint, $media);  var_dump($p);

if(isset($p["id"])){

	$plan_id = $p["id"];

	$array = array('plan_id' => $plan_id);

	$clause = "where uid=" . $uid;

	$db->update("user", $array, $clause);

	echo "<div class='alert'><h1 class='centerText'>Success! Your Paypal is connected.</h1><a href='/user/?u=$uid'><button>Finish box</button></a></div>";



}



}else{

 echo "<div class='alert'><h1 class='centerText'>OOPS! Something went wrong. Please try again. If the problem persists contact customer support.</h1></div>";



}

}else{

	echo "<div class='alert'><h1 class='centerText'>Your Paypal has been connected.</h1><a href='/user/?u=$uid'><button>Finish box</button></a></div>";



}



?>