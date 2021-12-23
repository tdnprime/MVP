<?php 

require_once "../mysqliclass.php";

$db = Database::getInstance();
$table = "boxes";
$sql = "SELECT product_id, category, description, price FROM boxes WHERE uid=$uid ORDER BY vid LIMIT 1";

if($db->get($sql)){

	

	$result = $db->get($sql)[0]; 

	
// CREATE PRODUCT 
require_once "paypal-token.php";
$config = parse_ini_file("../config/app.ini", true);
$endpoint = $config["paypal"]["productsEndpoint"];   

$data = [

  "name"=> "A subscription box",
  "description"=> $result["description"],
  "type"=> "PHYSICAL",
  "category"=> $result["category"],
  "home_url"=> "https://boxeon.com/box/?u=" . $uid

  ];

   

$media = "Content-Type: application/json, Authorization: Bearer $token";

$cp = sendcurl(json_encode($data), $endpoint, $media); 

$product_id = $cp["id"];

$array = array('product_id' => $product_id);

$db->update("boxes", $array, "WHERE uid=$uid");

}


?>