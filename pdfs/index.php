<?php

// SAVE MESSAGES

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_SERVER["HTTP_MSG"])){
		$data = json_decode($_SERVER["HTTP_MSG"]);
		if(empty($data->msg)){return;}
		$msg = htmlspecialchars(strip_tags($data->msg));
		require_once "../mysqliclass.php";
		require_once "getcountry.php";
		$data = [];
		$data['message'] = $msg;
		$data['country'] = getcountry($_SERVER);
		$data['date'] = time();
		// A temporary ID is used if no identity
        // has been established.
		session_start();
		if(!isset($_SESSION['uid'])){
			$rand = rand();
			$data['sender_id'] = $rand;
			$_SESSION['sender_id'] = $rand; 
		}else{
			$data['sender_id'] = $_SESSION['uid']; 
		}
		// IF MESSAGE IS FROM CUSTOMER SERVICE, SET RECIPIENT
		if(isset($_SESSION['uid']) && $_SESSION['uid'] == 000000004){
			// $data['recipient'] = $_SESSION['uid'];
		}
		$db = Database::getInstance();
		// Note to self: Make sure of prepared statements
		$db->insert('chat', $data);
		// echo json_encode($tempID);
	}
}
// GET MESSAGES
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_SERVER["HTTP_GET"])){
		require_once "../mysqliclass.php";
		// require_once "getcountry.php";
		$db = Database::getInstance();
		session_start();
		$senderID = $_SESSION['sender_id'];
		$re = $db->get("SELECT * FROM chat WHERE recipient=$senderID ORDER BY date DESC LIMIT 1");
		echo json_encode($re[0]);
	}

}
?>