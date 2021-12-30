<?php

#CONTENT SECURITY POLICIES 
## Sets content security policies for entire website. DO NOT REMOVE.

$config = parse_ini_file( "../config/app.ini", true );
$paypal = $config["paypal"]["csp"];
#POLICIES
header("Content-Security-Policy: default-src 'self' $paypal; img-src 'self' $paypal http://img.youtube.com https://shippo-static.s3.amazonaws.com; frame-ancestors 'self'; child-src 'self' $paypal https://accounts.google.com/ https://www.youtube.com; object-src 'self' https://youtube.com; media-src 'self' https://youtube.com https://www.youtube.com; base-uri https://boxeon.com; form-action 'self'; font-src 'self' https://fonts.gstatic.com; style-src 'self' 'unsafe-inline' https://www.paypal.com https://fonts.googleapis.com; script-src 'self' https://apis.google.com/ $paypal https://www.paypal.com https://ajax.googleapis.com");
?>