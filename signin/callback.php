<?php
#CALLBACK(GOOGLE SIGN IN)
##Picks up after sucessful Google authentication:
##Handles new users
##Redirects users if need be


#GRAB USER INFO FROM GOOGLE

if ( !isset( $_SESSION[ "uid" ] ) ) {
  $config = parse_ini_file( "../config/app.ini", true );
  require_once 'google-api/vendor/autoload.php';
  $client = new Google_Client();
  $client->setClientId( $config[ "google" ][ "clientID" ] );
  $client->setClientSecret( $config[ "google" ][ "clientSecret" ] );
  $client->setRedirectUri( $config[ "google" ][ "redirectURI" ] );
  $client->addScope( "email" );
  $client->addScope( "profile" );
  $token = $client->fetchAccessTokenWithAuthCode( $_GET[ 'code' ] );
  try {
    $client->setAccessToken( $token[ 'access_token' ] );
    $_SESSION[ 'code' ] = $token[ 'access_token' ];
    // getting profile info
    $google_oauth = new Google_Service_Oauth2( $client );
    $google_account_info = $google_oauth->userinfo->get();


    #NEW USER

    /*Handle new users, 
	save in database*/

    $data = array();
    $data[ "givenname" ] = $google_account_info[ "givenName" ];
    $data[ "familyname" ] = $google_account_info[ "familyName" ];
    $data[ "email" ] = $google_account_info[ "email" ];
    $data[ "fullname" ] = $google_account_info[ "givenName" ] . " " . $google_account_info[ "familyName" ];
    $data[ "verified" ] = $google_account_info[ "verified_email" ];
    $data[ "pic" ] = $google_account_info[ "picture" ];
    $data[ "gender" ] = $google_account_info[ "gender" ];
    $data[ "gid" ] = $google_account_info[ "id" ];
    $gid = $google_account_info[ "id" ];
    $data[ "locale" ] = $google_account_info[ "locale" ];
    require_once "../mysqliclass.php";
    $db = Database::getInstance();
    // Check DB for user using their Google ID
    $arr = $db->get( "SELECT uid, pic, givenname, familyname FROM user WHERE gid=" . "'$gid'" );
    foreach ( $arr as $iarr ) {
      $uid = $iarr[ "uid" ];
    }
    // If the user is not found, save info
    if ( !isset( $uid ) ) {
      $db->insert( "user", $data );
      $arr = $db->get( "SELECT uid, pic, email, givenname, familyname FROM user WHERE gid=" . "'$gid'" );
      foreach ( $arr as $iarr ) {
        $uid = $iarr[ "uid" ];
        $to = $iarr[ "email" ];
        $name = $iarr[ "givenname" ];
      }

      #SEND WELCOME EMAIL

      /*Incomplete.  A proper form email implementation will 
	  replace the following code, including the required_once file*/
      require_once "..php/welcome-email.php";
      $from = $config[ "boxeon" ][ "serviceEmail" ];
      sendWelcome( $from, $to, $name );
    }
  } catch ( Exception $e ) {
    error_log( $e, 0 );
  }

  // Save info in session for app cutomization
  $_SESSION[ "uid" ] = $uid;
  $_SESSION[ "pic" ] = $iarr[ "pic" ];
  $_SESSION[ "familyname" ] = $iarr[ "familyname" ];
  $_SESSION[ "givenname" ] = $iarr[ "givenname" ];
}

#REDIRECT

/*If users clicked the Get started button/link on the subscription 
box page and were asked to sign in, we want them to be taken BACK to said 
subscription box page after sign in. This way, the can continue their interaction 
(subscribing etc) with the page.*/
if ( $_SERVER[ "PHP_SELF" ] == "/box/index.php" ) {
  echo "
	<script>
	var loc = location.href;
	sessionStorage.setItem('last', loc);
	</script>";

}
?>