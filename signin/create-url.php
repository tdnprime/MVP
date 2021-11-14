<?php

// SIGNIN/CREATE-URL (Creates Google signin URL)
error_reporting(E_ERROR | E_PARSE | E_NOTICE);
if ( !parse_ini_file( "config/app.ini", true ) ) {
  $config = parse_ini_file( "../config/app.ini", true );
} else {
  $config = parse_ini_file( "config/app.ini", true );
}

require_once 'google-api/vendor/autoload.php';
$client = new Google_Client();
$client->setClientId( $config[ "google" ][ "clientID" ] );
$client->setClientSecret( $config[ "google" ][ "clientSecret" ] );
$client->setRedirectUri( $config[ "google" ][ "redirectURI" ] );
$client = new Google_Client();
$client->setClientId( $config[ "google" ][ "clientID" ] );
$client->setClientSecret( $config[ "google" ][ "clientSecret" ] );
$client->setRedirectUri( $config[ "google" ][ "redirectURI" ] );
$client->addScope( "email" );
$client->addScope( "profile" );
$url = $client->createAuthUrl();
?>