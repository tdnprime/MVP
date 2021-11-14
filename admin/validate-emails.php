<?php
/*Usage
The VerifyEmail library is easy to use for validating the email address using PHP.

Initialize the library class using VerifyEmail().
Set the timeout, debug, and sender email address.
Call check() function and pass the email address which you want to validate.
Returns TRUE, if the given email address is valid and real. Also, it indicates that the domain of this email exists and the user is valid.
Returns FALSE, if the given email address is invalid and not exists.
If the check() function returns FALSE, you can check the email with validate() function to check if the email format is valid but the user not exists on the domain.*/

ini_set( 'max_execution_time', 0 );

// Include library file
require_once 'verifyemail.php';
$mail = new VerifyEmail();
$mail->setStreamTimeoutWait( 20 );
$mail->Debug = FALSE;
//$mail->Debugoutput= 'html'; 
$mail->setEmailFrom( 'gingluevents@gmail.com' );

//ACCESS EMAILS IN DB
require_once "../mysqliclass.php";
$db = Database::getInstance();
$results = $db->get( "SELECT email FROM mailing_list WHERE valid IS NULL" );
$list = [];
foreach ( $results as $arr => $val ) {
  array_push( $list, $val[ "email" ] );
}

// EXE VERIFICATION
foreach ( $list as $email ) {

  if ( $mail->check( $email ) ) {
    $data = [];
    $data[ "valid" ] = 1;
    $db->update( "mailing_list", $data, "WHERE email='$email'" );

  } elseif ( verifyEmail::validate( $email ) ) {
    $data = [];
    $data[ "valid" ] = 2;
    $db->update( "mailing_list", $data, "WHERE email='$email'" );
  } else {
    $data = [];
    $data[ "valid" ] = 0;
    $db->update( "mailing_list", $data, "WHERE email='$email'" );
  }
}


?>