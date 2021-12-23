 <?php

# sub and unsub a user and updates existing plans

$config = parse_ini_file("../config/app.ini", true);
require_once "../mysqliclass.php";
$db = Database::getInstance();
session_start();

// SUBSCRIBE

if(isset($_SERVER["HTTP_SUB"])){
	$uid = $_SESSION["uid"];
	$sub = json_decode($_SERVER["HTTP_SUB"]); 
	// GET SHIPPING ADDRESS FROM SESSION
	$data['fullname'] = $_SESSION['fullname'];
    $data['address_line_1'] = $_SESSION['address_line_1'];
	if(isset($_SESSION['address_line_2'])){ $data['address_line_2'] = $_SESSION['address_line_2'];}
    $data['admin_area_2'] = $_SESSION['admin_area_2'];
    $data['admin_area_1'] = $_SESSION['admin_area_1'];
    $data['postal_code'] = $_SESSION['postal_code'];
    $data['country_code'] = $_SESSION['country_code'];
	$data['plan_id'] = $_SESSION['plan_id'];

		$data["sub_id"] = $sub->sub_id;
		$data["date_created"] = time();	
		$data["status"] = 1;
		$data["version"] = 1; // GET FROM HTML
		$table = "subscriptions";
			
		if($re = $db->update($table, $data, "WHERE uid=$uid")){

			echo true;

		}else{
			echo false;
			
		}
}



// UNSUBSCRIBE

	if(isset($_SERVER["HTTP_UNSUB"])){
		require_once "../home/paypal-token.php";
	    $ownerID = $_SERVER["HTTP_UNSUB"];	// Creator 
		$uid = $_SESSION['uid']; // Unsubscriber
		// Get subscription ID 
		$re = $db->get("SELECT sub_id FROM subscriptions WHERE uid=$uid AND creator_id=$ownerID");
		$subID = $re[0]["sub_id"];
		$endpoint = $config["paypal"]["billinsEndpoint"] . "/" . $subID . "/cancel";
		//$endpoint = "https://api.sandbox.paypal.com/v1/billing/subscriptions/$subID/cancel";
		$media = 'Content-Type: application/json, Authorization: Bearer $token';
		$data ='{

		  "reason": "No reason"

		}';

		// Unsubscribe on Paypal

	    $a = sendcurl($data, $endpoint, $media); 

		if(isset($a["debug_id"])){

			echo false;

		}else{
			// UPDATE DATABASE
			$db->delete('subscriptions', " WHERE uid=$uid AND creator_id=$ownerID");
			echo true;
		}


	}



?>