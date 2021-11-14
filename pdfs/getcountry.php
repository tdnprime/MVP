<?php

function getcountry($SERVER){

	if (isset($SERVER['HTTP_CLIENT_IP'])){

		$real_ip_adress = $SERVER['HTTP_CLIENT_IP'];

	}

	if (isset($SERVER['HTTP_X_FORWARDED_FOR'])){

		$real_ip_adress = $SERVER['HTTP_X_FORWARDED_FOR'];

	}else{

		$real_ip_adress = $SERVER['REMOTE_ADDR'];

	}

	$cip = $real_ip_adress;

	$iptolocation = 'http://api.hostip.info/country.php?ip=' . $cip;

	return file_get_contents($iptolocation); 

}

?>