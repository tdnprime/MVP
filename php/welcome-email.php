<?php

// Tell them a brand story

function sendWelcome($from, $to, $name){


$subject = "Welcome to Boxeon!";
$logo = "https://boxeon.com/images/logo.png";
$headers = "From:Boxeon<" . $from . ">\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<img src="' . $logo . '"height="20" title="" alt="" border="0" style="display:block;width:111px;max-width:111px" class="CToWUd"/>';
	$message .= "<br><p>Hi " .  $name . ",</p>";
	$message .= "<p>Thank you for joining Boxeon.</p>";
	$message .= "<p>This is the start of something great!</p>";
	$message .= "<p>You have sucessfully created an account on Boxeon. We are here to answer your questions if you have any.</p>";
	$message .= "<br><p>Sincerely,</p>";
	$message .= "<p>Customer Service</p>";
	$message .= "<p>Boxeon.com</p>";
$message .= '</body></html>';
mail($to,$subject,$message,$headers);

}




?>
