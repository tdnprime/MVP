<title>Boxeon</title>
<meta name="description" content="Start and grow a subscription box business and secure monthly income. It's the wave of the future."/>
<meta name="keywords" content="Boxeon, Patreon alternative, monitize content, Subscription box platform, make more money on Youtube">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="icon" type="image/svg+xml" href="{{ asset('../assets/images/favicon.svg') }}">
<link rel="alternate icon" href="{{ asset('../assets/images/favicon.svg') }}">
<link rel="mask-icon" href="https://boxeon.com/images/favicon.svg" color="#fff">
<link rel="stylesheet" href="{{ asset('../assets/css/style.css?v=4.1') }}">
<link rel="stylesheet" media="screen and (min-width: 200px) and (max-width: 1810px)" href="{{ asset('../assets/css/mobile.css?v=3.6') }}"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open%20Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Concert%20One">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('../assets/js/global.js?v=2.1') }}"></script>
<?php
$config = parse_ini_file( "../laravel/config/app.ini", true );
$clientID = $config['paypal']['clientID'];
$nonce = base64_encode("Content-Security-Policy: def");
session_start();
$_SESSION ["nonce"] = $nonce;
echo "<script type='text/javascript' data-csp-nonce='$nonce' src=https://www.paypal.com/sdk/js?client-id=" . $clientID  . "&locale=en_US&vault=true&intent=subscription&commit=true></script>";
?>
<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>

