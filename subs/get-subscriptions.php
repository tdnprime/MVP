<?php
#Get Subscriptions

if ( isset( $_SERVER[ "HTTP_CURRENT" ] ) ) {
  session_start();
  require_once "../mysqliclass.php";
  $db = Database::getInstance();
  $user = $_SESSION[ "name" ];
  $uid = $_SESSION[ "uid" ];
  $subs = $db->get( "SELECT * FROM subscriptions WHERE uid=$uid" );
  echo json_encode( $subs );
}
?>