<?php
#CREATE-URL
##Creates Google signin URL

/*Turn off WARNINGS*/
error_reporting(E_ERROR | E_PARSE | E_NOTICE);

/*Check to see if the configuration file is NOT
being reguested from the root directory 
(i.e: the main landing page is NOT reguesting it). 
If it's NOT, we write URI like this:
*/
if( !parse_ini_file( "config/app.ini", true ) ) {
  $config = parse_ini_file( "../config/app.ini", true );
} else {
	/*The configuration file is being requested from the root directory. 
	So we write the URI like so:
	*/
  $config = parse_ini_file( "config/app.ini", true );
}

#CREATE GOOGLE SIGN IN URL
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