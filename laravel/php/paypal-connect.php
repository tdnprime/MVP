<?php


function getcurl( $data = null, $endpoint, $media ) {
  $config = parse_ini_file( dirname(__DIR__, 1) . "/config/app.ini", true );
  $PAYPAL_CLIENT_ID = $config[ 'paypal' ][ 'clientID' ];
  $PAYPAL_SECRET = $config[ 'paypal' ][ 'clientSecret' ];

  $curl = curl_init();
  curl_setopt_array( $curl, array(
    CURLOPT_URL => $endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_USERPWD => $PAYPAL_CLIENT_ID . ":" . $PAYPAL_SECRET,
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      $media,
      "Accept-Language: en_US" ), ) );
  $result = curl_exec( $curl );
  return json_decode( $result, true );

}

function sendcurl( $data = null, $endpoint, $media ) {
  $config = parse_ini_file( dirname(__DIR__, 1) . "/config/app.ini", true );
  $PAYPAL_CLIENT_ID = $config[ 'paypal' ][ 'clientID' ];
  $PAYPAL_SECRET = $config[ 'paypal' ][ 'clientSecret' ];

  $curl = curl_init();
  curl_setopt_array( $curl, array(
    CURLOPT_URL => $endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_USERPWD => $PAYPAL_CLIENT_ID . ":" . $PAYPAL_SECRET,
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      $media,
      "Accept-Language: en_US" ), ) );
  $result = curl_exec( $curl );
  return json_decode( $result, true );

}

$data = "grant_type=client_credentials";
$config = parse_ini_file( dirname(__DIR__, 1) . "/config/app.ini", true );
$endpoint = $config[ 'paypal' ][ 'tokenEndpoint' ];
$media = 'Accept:application/json';
$array = sendcurl( $data, $endpoint, $media );
$token = $array[ 'access_token' ];

?>