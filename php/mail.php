<?php



// CLIENT ID -- 910702257659-a1ma8dj4l7f8536ho2eqt5i07gbm1ums.apps.googleusercontent.com

// SECRET -- -jA9j99Y-jJ-dnBCBY-jFfNP

// CLOUD SETTINGS https://console.cloud.google.com/apis/api/gmail.googleapis.com/overview?project=boxeon

// READ https://blog.timekit.io/google-oauth-invalid-grant-nightmare-and-how-to-fix-it-9f4efaf1da35

// PRE LOAD EMAIL

if(isset($_POST['sendTo'])){

	

	session_start();



	$code = $_SESSION['code'];

	$scope = $_SESSION['mscope']; // double check scope

	// Creating new google client instance

	require_once 'login/google-api/vendor/autoload.php';

	$client = new Google_Client();

 	// Enter your Client ID

	$client->setClientId('227887284273-k2b81lp0r79e25vg57vf5kjbnglff49p.apps.googleusercontent.com');

	// Enter your Client Secrect

	$client->setClientSecret('T2ggGrFi3hJBePAJm-TIqTm6');

	// Enter the Redirect URL

	$client->setRedirectUri('https://boxeon.com/find/?find=1'); 



if(!isset($_COOKIE["user"])) {

    $token = $client->fetchAccessTokenWithAuthCode($code); 

	// SAVE TOKEN FOR LATER USE

	$cookie_name = "user";

	$cookie_value = $token['access_token'];

	setcookie($cookie_name, $cookie_value, time() + 3600, "/");

}



// AB OLD TOKEN

if(isset($_COOKIE["user"])) {

	$token = array();

	$token['access_token'] = $_COOKIE["user"];

	}

	try{	

		$client->setAccessToken($token['access_token']);

		// getting profile info

		$google_oauth = new Google_Service_Oauth2($client);

	// CREATE MESSAGE 

	$from = $_POST['sendFrom'];

	$to = $_POST['sendTo'];

	$subject = $_POST['subject'];

	$msg = $_POST['msg'];	



	$user = 'me';

	$name = $_SESSION['name'];

	$strSubject = $subject;

	$strRawMessage = "From: $name <$from>\r\n";

	$strRawMessage .= "To: <$to>\r\n";

	$strRawMessage .= 'Subject: =?utf-8?B?' . base64_encode($strSubject) . "?=\r\n";

	$strRawMessage .= "MIME-Version: 1.0\r\n";

	$strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";

	$strRawMessage .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";

	$strRawMessage .= "$msg\r\n";

	// The message needs to be encoded in Base64URL

	$mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');

	$msg = new Google_Service_Gmail_Message();

	$msg->setRaw($mime);

	//The special value **me** can be used to indicate the authenticated user.	

	$service = new Google_Service_Gmail($client);

	$service->users_messages->send("me", $msg);

	header('location:https://boxeon.com/find/?sent=1');

	}catch(Exception $e){

	echo 'Caught exception: ', $e->getMessage();

}



}

?>