<?php

#CONTENT SECURITY POLICIES 
## Sets content security policies for entire website.

// Turn off WARNINGS
error_reporting(E_ERROR | E_PARSE | E_NOTICE);

/*If the configuration file is NOT being reguested
from the root directory, 
write the URI like this:
*/
if(!parse_ini_file("../config/app.ini", true)){
	$cfg = parse_ini_file("config/app.ini", true);
} else{
	/*If config file is being reguested from sub directory,
	write the URI like this:
	*/
	$cfg = parse_ini_file("../config/app.ini", true);
}

#POLICIES

$paypal = $cfg['paypal']['csp'];
header("Content-Security-Policy: default-src 'self' https://googletagmanager.com https://www.google-analytics.com https://lh3.googleusercontent.com $paypal; img-src 'self' http://img.youtube.com https://shippo-static.s3.amazonaws.com https://www.google-analytics.com https://lh3.googleusercontent.com; frame-ancestors 'self'; child-src 'self' https://secure.livechatinc.com https://www.youtube.com; object-src 'self' https://youtube.com; media-src 'self' https://youtube.com https://www.youtube.com; base-uri https://boxeon.com; form-action 'self'; font-src 'self' https://fonts.gstatic.com; style-src 'self' https://fonts.googleapis.com; script-src 'self' https://cdn.livechatinc.com https://api.livechatinc.com https://www.paypal.com https://ajax.googleapis.com https://www.googletagmanager.com https://www.google-analytics.com");
?>