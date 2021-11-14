<?php

 $sender = $_GET['from'];

 $message = $_GET['message'];

  if ($sender!='') {

     // Save incoming messages

     $fp = fopen("forwardlog.txt","a");

     fputs($fp,"$sender $message");

		fclose($fp);

	} 

?>