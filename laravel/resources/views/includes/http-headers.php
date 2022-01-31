<?php

#CONTENT SECURITY POLICIES
## Sets content security policies for entire website. DO NOT REMOVE.

$nonce = "nonce-" . $_SESSION["nonce"];
unset($_SESSION["nonce"]);
$config = parse_ini_file(dirname(__DIR__, 3) . "/config/app.ini", true);
$paypal = $config['paypal']['csp'];

#POLICIES
header("Content-Security-Policy: default-src 'self' https://www.googleanalytics.com https://www.paypal.com $paypal; img-src 'self' https://lh3.googleusercontent.com https://t.paypal.com $paypal http://img.youtube.com https://shippo-static.s3.amazonaws.com; frame-ancestors 'self'; child-src 'self' https://www.paypalobjects.com $paypal https://accounts.google.com/ https://www.youtube.com; object-src 'self' https://youtube.com; media-src 'self' https://youtube.com https://www.youtube.com; base-uri https://boxeon.com; form-action 'self'; font-src 'self' https://fonts.gstatic.com; style-src 'self' 'unsafe-inline' https://www.paypal.com https://fonts.googleapis.com; frame-src 'self' http://localhost:8000 https://www.youtube.com $paypal https://www.paypalobjects.com https://www.paypal.com; script-src 'self' '$nonce' https://www.googletagmanager.com https://sandbox.web.squarecdn.com https://www.paypalobjects.com https://apis.google.com $paypal https://www.paypal.com https://ajax.googleapis.com");
