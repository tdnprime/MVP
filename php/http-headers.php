<?php
#Content Security Policies

error_reporting(E_ERROR | E_PARSE | E_NOTICE);

if(!parse_ini_file("../config/app.ini", true)){
	$cfg = parse_ini_file("config/app.ini", true);
} else{
	$cfg = parse_ini_file("../config/app.ini", true);
}
$paypal = $cfg['paypal']['csp'];
header("Content-Security-Policy: default-src 'self' https://googletagmanager.com https://www.google-analytics.com https://lh3.googleusercontent.com $paypal; img-src 'self' http://img.youtube.com https://www.google-analytics.com https://lh3.googleusercontent.com; frame-ancestors 'self'; child-src 'self' https://secure.livechatinc.com https://www.youtube.com; object-src 'self' https://youtube.com; media-src 'self' https://youtube.com; base-uri https://boxeon.com; form-action 'none'; font-src 'self' https://fonts.gstatic.com; style-src 'self' https://fonts.googleapis.com; script-src 'self' https://cdn.livechatinc.com https://api.livechatinc.com https://www.paypal.com https://ajax.googleapis.com https://www.googletagmanager.com https://www.google-analytics.com");
?>