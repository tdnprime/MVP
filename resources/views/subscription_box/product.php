<?php 

// CREATE PRODUCT ON PAYPAL 
require_once "paypal-token.php";
$config = parse_ini_file("../config/app.ini", true);
$endpoint = $config["paypal"]["productsEndpoint"];   
$data = [
  "name"=> "A subscription box",
  "description"=> $result["description"],
  "type"=> "PHYSICAL",
  "category"=> "ENTERTAINMENT",
  "home_url"=> "https://boxeon.com/box/index" // Update
  ];
$media = "Content-Type: application/json, Authorization: Bearer $token";
$cp = sendcurl(json_encode($data), $endpoint, $media); print_r($cp);
$product_id = $cp["id"];
$array = array('product_id' => $product_id);
$box = DB::table( 'boxes' )->where( 'user_id', $user->id )->limit( 1 );
$box->update( $array );

?>