

{{-- WARNING #1 of 3
    
    THE URLS MUST BE CHANGED FOR PRODUCTION.  SEE WARNING #2 IN THE FOOTER --}}


<title>Boxeon</title>
<meta name="description" content="Start and grow a subscription box business and secure monthly income It's the wave of the future."/>
<meta name="keywords" content="Boxeon, Patreon alternative, monitize content, Subscription box platform, make more money on Youtube">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="icon" type="image/svg+xml" href="{{ asset('../assets/images/favicon.svg') }}">
<link rel="alternate icon" href="{{ asset('../assets/images/favicon.svg') }}">
<link rel="mask-icon" href="https://boxeon.com/images/favicon.svg" color="#fff">
<link rel="stylesheet" href="{{ asset('../assets/css/style.css?v=2') }}">
<link rel="stylesheet" media="screen and (min-width: 200px) and (max-width: 1810px)" href="{{ asset('../assets/css/mobile.css?v=1.2') }}"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open%20Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Concert%20One">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('../assets/js/global.js?v=1') }}"></script>
<meta name="google-signin-client_id" content="227887284273-k2b81lp0r79e25vg57vf5kjbnglff49p.apps.googleusercontent.com">
<?php
$config = parse_ini_file( "../config/app.ini", true );

// FOR SUBSCRIPTIONS
echo "<script src=https://www.paypal.com/sdk/js?client-id=" . $config[ 'paypal' ][ 'clientID' ] . "&vault=true&intent=subscription></script>";


?>
<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>

