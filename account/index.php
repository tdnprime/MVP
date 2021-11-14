<?php 



if(isset($_SERVER["HTTP_AUTH"])){
	session_start();
	// Check Session
	if(isset($_SESSION['uid'])){
		echo 1;
	}else{
		echo 0;
	}
}

if(isset($_SERVER["HTTP_ADDR"])){
	require_once("../mysqliclass.php");
	$db = Database::getInstance();
	session_start();
	$uid = $_SESSION['uid'];
	
	$re = $db->get("SELECT fullname, address_line_1, address_line_2, admin_area_1, admin_area_2, postal_code, country_code FROM subscriptions WHERE uid=$uid");
	if(isset($re[0])){
		$code = $re[0]['country_code'];
		$re[0]['country_code'] ="<input type='text' name='country_code' value='$code'/>";
		echo json_encode($re[0]);
	}else{
		$arr = [];
		$arr['fullname'] = 'Full name';
		$arr['address_line_1'] = 'Street address';
		$arr['address_line_2'] = 'Street address line 2 (optional)';
		$arr['admin_area_1'] = 'State/Province';
		$arr['admin_area_2'] = 'City';
		$arr['postal_code'] = 'Postal code';
		$arr['country_code'] = file_get_contents('../html/countries.html');
		echo json_encode($arr);
	}
}
?>


