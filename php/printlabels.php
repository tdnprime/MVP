<?php 



class PrintLabels{

	

	private static $instance = null;

	private static $endpoint = "https://api.goshippo.com/batches/";

	//private static $header = null;

	private static $token = "shippo_test_3e31a3588d7da21c4e4fc5b12e778f66868f92f6";

	// private static $token = "shippo_live_cf04b9b71da7096022c72798926812ca585e2689";

	

	private function __construct(){

		

		// Expensive Shippo code

		require_once "../shippo/master/lib/Shippo.php";

		Shippo::setApiKey(self::$token);

		echo self::sendcURL();

	}

	public static function getInstance(){

		

	if (self::$instance == null)

    {

      self::$instance = new PrintLabels();

    }

 

    return self::$instance;

	}

	private function __destruct(){}

	

	private function sendcURL(){

		$ch = curl_init(self::$endpoint);

		curl_setopt($ch, CURLOPT_HEADER, self::$header);

		curl_setopt($ch, CURLOPT_POST, 1);

		curl_setopt($ch, CURLOPT_POSTFIELDS, self::shipmentObjects());

		curl_exec($ch);

		if(curl_error($ch)) {

			echo curl_error($ch);

		}

		curl_close($ch);

	}

	private function shipmentObjects(){

	$objects = '{

    "batch_shipments": [

        {

            "servicelevel_token": "usps_priority_express",

            "shipment": {

                "address_from": "d2ce085dd3734a22b20c6df36a63aa07",

                "address_to": "8172f0a35d6d4ff6a37e7a082e4da7a6",

                "parcels": [

                    "f93c159892f54402bf14a50488ca2c36"

                ]

            }

        },

        {

            "carrier_account": "a4391cd4ab974f478f55dc08b5c8e3b3",

            "servicelevel_token": "fedex_2_day",

            "shipment": {

                "address_from": "d2ce085dd3734a22b20c6df36a63bb07",

                "address_to": "8172f0a35d6d4ff6a37e7a082e4da7b6",

                "parcels": [

                    "f93c159892f54402bf14a50488ca2c38"

                ]

            }

        }

    ],

    "default_carrier_account": "33391cd4ab974f478f55dc08b5c8e3b3",

    "default_servicelevel_token": "usps_priority",

    "label_filetype": "PDF_4x6",

    "metadata": "BATCH #170"

}';

return $objects;

	}

}



?>