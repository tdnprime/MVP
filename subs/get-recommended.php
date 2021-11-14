<?php
#Get Recommended

if ( isset( $_SERVER[ "HTTP_GENERAL" ] ) ) {
  session_start();
  require_once "../mysqliclass.php";
  $db = Database::getInstance();
  $user = $_SESSION[ "name" ];
  $uid = $_SESSION[ "uid" ];
  $boxes = $db->get( "SELECT * FROM boxes WHERE uid <> $uid LIMIT 40" );
  echo json_encode( $boxes );
}
?>