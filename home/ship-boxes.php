<?php


function getToken() {
  $config = parse_ini_file( "../config/app.ini", true );
  $data = [];
  $data[ 'client_id' ] = $config[ 'adobe' ][ 'clientID' ];
  $data[ 'client_secret' ] = $config[ 'adobe' ][ 'clientSecret' ];
  $data[ 'jwt_token' ] = $config[ 'adobe' ][ 'jwt' ];
  $curl = curl_init();
  curl_setopt_array( $curl, array(
    CURLOPT_URL => "https://ims-na1.adobelogin.com/ims/exchange/jwt/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      "Cache-Control: no-cache",
      "Content-Type: multipart/form-data",
      "Accept-Language: en_US"
    ),

  ) );

  $result = curl_exec( $curl );
  return json_decode( $result, true );

}

function combinePDF( $token, $data ) {
  $config = parse_ini_file( "../config/app.ini", true );
  $clientID = $config[ 'adobe' ][ 'clientID' ];
  $headers = [];
  $curl = curl_init();
  curl_setopt_array( $curl, array(
    CURLOPT_URL => 'https://cpf-ue1.adobe.io/ops/:create?respondWith=%7B%22reltype%22%3A%20%22http%3A%2F%2Fns.adobe.com%2Frel%2Fprimary%22%7D',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADERFUNCTION =>
    function ( $curl, $header )use( & $headers ) {
      $len = strlen( $header );
      $header = explode( ':', $header, 2 );
      if ( count( $header ) < 2 ) // ignore invalid headers
        return $len;

      $headers[ strtolower( trim( $header[ 0 ] ) ) ][] = trim( $header[ 1 ] );

      return $len;
    },
    CURLOPT_ENCODING => "",
    CURLOPT_HEADER => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer $token",
      "x-api-key:  $clientID",
      "Content-Type' => 'multipart/form-data",
      "Prefer: respond-async,wait=0"
    ),

  ) );

  $response = curl_exec( $curl );
  return $headers;

}

function getPDFStatus( $token, $ID ) {
  $config = parse_ini_file( "../config/app.ini", true );
  $clientID = $config[ 'adobe' ][ 'clientID' ];
  $curl = curl_init();
  curl_setopt_array( $curl, array(
    CURLOPT_URL => "https://cpf-ue1.adobe.io/ops/id/" . $ID,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer $token",
      "x-api-key: $clientID"
    ),

  ) );

  $result = curl_exec( $curl );
  return json_decode( $result, true );

}

// PREVENT ACCESS TO THIS FILE
session_start();
$uid = $_SESSION[ 'uid' ];
require_once "../mysqliclass.php";
$config = parse_ini_file( "../config/app.ini", true );
$db = Database::getInstance();

// BUY AND GENERATE LABELS 
if ( $_SERVER[ 'HTTP_LABELS' ] ) {
  $arr = [];
  $arr[ 0 ] = "https://deliver.goshippo.com/85c61486c9974e5ba0c8c76556cc7f01.pdf?Expires=1659384294&Signature=EfK~x0FBko9MV1~Atb6hbmYoepP~iXZm1LH2d-dVU~4bUno0Z~0zGDHD8Jzn4Fpaxyv4XYpaueDaN~RQD6-4Ma~jjn8aNy~UYB3jmJvldG4h6baSg2B1zgHblgXo9HNAcQq5stQPRJxIrecUMFTa4iQRXyszTPK9ZV8mqPjK1jpANNqdzSeFIlNe7oVJvI~qXxyetHLxyS1TN7sotZmB5cpFLUT1PiUMGZmP~06XufT8B04T1G~b1i90oFCJ6zKzl3Fwn5x15FQkvk7~GRLiBMRJN6M3wnLzKWbwXEunwXp3QIeOHz8TOSCtFgBU0cdVIRzAtD76twzZH7KCz7waJg__&Key-Pair-Id=APKAJRICFXQ2S4YUQRSQ";
  $arr[ 1 ] = "https://deliver.goshippo.com/84233a1b2a5145d5aabf97620925bde9.pdf?Expires=1659384258&Signature=QceLWh6WbWAbTEhZZ9FRTwYG9PEc7mXkW5YFqRHdsyDbIL0LzEagsttEN6lwozyjn4Lmo4u~ex9V0nJEi2IcPcpm2vjkyWLJRDFxFa8~fB0eitlsFH2DphUv5SUwE1V2URa9yVwd~9M9j7bHW30dQUPVsGN-j9imMMo1tpk4q2qg5M3E8plwPXmZg9rq0pA55I~q~7egrNMWIFfUJiL1dcWmzUCQ3fFlOzZhizfOSVNn9Ru5UmtWTBmNnbOwDvK1RqCaQppQ3vLvCIN17T2zADcRQ1wkFgiFHxwYz0Mxnni2AOlFpMxHpAK9qh0qNDZYld5DT0rjeR~oIR8mb8WWEg__&Key-Pair-Id=APKAJRICFXQ2S4YUQRSQ";
  $arr[ 2 ] = "https://deliver.goshippo.com/d67eb882bb4d4fa3905433b56aaaf446.pdf?Expires=1659384191&Signature=Uu~HvBIpdMMf~e9ZbpWk8m94E5UFNmdOV5BkHnci0Lmv2Klx7CHSgSCh~9KxB18EAFQMyUfePN3OUCNMITAUb~JYcpxyDNJv4pu4mxOVLJfHSSrTpVEx-qTVZZ1bwjh41h2J3kuS2hK2h3JvoteBag-DNu6C3isGNHDbc3nwgaseZV9LB7-fuYSCJOyFzSS9NXmzv6b3oxqgRsiOUhMAXnSdLtslbTiOYkYlA6HkQbWCCWMkNHaXYbuPVR2b7eDirzttwMMOsYlxtXGUR04HPdpHG~t7IJkCNSsFpbqGQvA4YB~y7A9X-E9pUncuhdQDKIaGr2-SSUJILBJ8544cgQ__&Key-Pair-Id=APKAJRICFXQ2S4YUQRSQ";
  $p = json_decode( $_SERVER[ 'HTTP_LABELS' ] );
  $hash = $p->one;
  if ( password_verify( "Zi!on1+2=3-A/m?ir12X", $hash ) ) {
    $sql = "SELECT * FROM subscriptions WHERE creator_id=$uid AND status=1";
    $subs = $db->get( $sql );
    if ( isset( $subs[ 0 ] ) ) {
      // SETUP Expensive Shippo code
      $token = $config[ 'shippo' ][ 'token' ];
      require_once "../shippo/master/lib/Shippo.php";
      Shippo::setApiKey( $token );

      // NB CUSTOM DECLARATION NEEDED?


      $count = count( $subs );
      for ( $i = 0; $i < $count; $i++ ) {
        // Purchase the desired rate.
        $transaction = Shippo_Transaction::create( array(
          'rate' => $subs[ $i ][ "rate_id" ],
          'label_file_type' => "PDF_4x6",
          'async' => false ) );

        // Retrieve label url and tracking number or error message
        if ( $transaction[ "status" ] == "SUCCESS" ) {

          // NB check object state for VALID
          // NB $transaction["object_state"];
$inputFile0= "https://deliver.goshippo.com/85c61486c9974e5ba0c8c76556cc7f01.pdf?Expires=1659384294&Signature=EfK~x0FBko9MV1~Atb6hbmYoepP~iXZm1LH2d-dVU~4bUno0Z~0zGDHD8Jzn4Fpaxyv4XYpaueDaN~RQD6-4Ma~jjn8aNy~UYB3jmJvldG4h6baSg2B1zgHblgXo9HNAcQq5stQPRJxIrecUMFTa4iQRXyszTPK9ZV8mqPjK1jpANNqdzSeFIlNe7oVJvI~qXxyetHLxyS1TN7sotZmB5cpFLUT1PiUMGZmP~06XufT8B04T1G~b1i90oFCJ6zKzl3Fwn5x15FQkvk7~GRLiBMRJN6M3wnLzKWbwXEunwXp3QIeOHz8TOSCtFgBU0cdVIRzAtD76twzZH7KCz7waJg__&Key-Pair-Id=APKAJRICFXQ2S4YUQRSQ";
$inputFile1= "https://deliver.goshippo.com/84233a1b2a5145d5aabf97620925bde9.pdf?Expires=1659384258&Signature=QceLWh6WbWAbTEhZZ9FRTwYG9PEc7mXkW5YFqRHdsyDbIL0LzEagsttEN6lwozyjn4Lmo4u~ex9V0nJEi2IcPcpm2vjkyWLJRDFxFa8~fB0eitlsFH2DphUv5SUwE1V2URa9yVwd~9M9j7bHW30dQUPVsGN-j9imMMo1tpk4q2qg5M3E8plwPXmZg9rq0pA55I~q~7egrNMWIFfUJiL1dcWmzUCQ3fFlOzZhizfOSVNn9Ru5UmtWTBmNnbOwDvK1RqCaQppQ3vLvCIN17T2zADcRQ1wkFgiFHxwYz0Mxnni2AOlFpMxHpAK9qh0qNDZYld5DT0rjeR~oIR8mb8WWEg__&Key-Pair-Id=APKAJRICFXQ2S4YUQRSQ";
$inputFile2= 
	"https://deliver.goshippo.com/d67eb882bb4d4fa3905433b56aaaf446.pdf?Expires=1659384191&Signature=Uu~HvBIpdMMf~e9ZbpWk8m94E5UFNmdOV5BkHnci0Lmv2Klx7CHSgSCh~9KxB18EAFQMyUfePN3OUCNMITAUb~JYcpxyDNJv4pu4mxOVLJfHSSrTpVEx-qTVZZ1bwjh41h2J3kuS2hK2h3JvoteBag-DNu6C3isGNHDbc3nwgaseZV9LB7-fuYSCJOyFzSS9NXmzv6b3oxqgRsiOUhMAXnSdLtslbTiOYkYlA6HkQbWCCWMkNHaXYbuPVR2b7eDirzttwMMOsYlxtXGUR04HPdpHG~t7IJkCNSsFpbqGQvA4YB~y7A9X-E9pUncuhdQDKIaGr2-SSUJILBJ8544cgQ__&Key-Pair-Id=APKAJRICFXQ2S4YUQRSQ";
          // MERGE LABELS 
          $token = getToken();
          $data = [];
          $data[ 'contentAnalyzerRequests' ] = '{
 "cpf:inputs": {
        "documentsIn": [{
            "pageRanges": {
                "cpf:inline": [{
                    "start": 1,
                    "end": 1
                }]
            },
            "documentIn": {
                "cpf:location":"https://deliver.goshippo.com/85c61486c9974e5ba0c8c76556cc7f01.pdf?Expires=1659384294&Signature=EfK~x0FBko9MV1~Atb6hbmYoepP~iXZm1LH2d-dVU~4bUno0Z~0zGDHD8Jzn4Fpaxyv4XYpaueDaN~RQD6-4Ma~jjn8aNy~UYB3jmJvldG4h6baSg2B1zgHblgXo9HNAcQq5stQPRJxIrecUMFTa4iQRXyszTPK9ZV8mqPjK1jpANNqdzSeFIlNe7oVJvI~qXxyetHLxyS1TN7sotZmB5cpFLUT1PiUMGZmP~06XufT8B04T1G~b1i90oFCJ6zKzl3Fwn5x15FQkvk7~GRLiBMRJN6M3wnLzKWbwXEunwXp3QIeOHz8TOSCtFgBU0cdVIRzAtD76twzZH7KCz7waJg__&Key-Pair-Id=APKAJRICFXQ2S4YUQRSQ",
			
			"dc:format": "application/pdf"

            }
        }, {
            "pageRanges": {
                "cpf:inline": [{
                    "start": 1,
                    "end": 1
                }]
            },
            "documentIn": {
                "cpf:location": "https://deliver.goshippo.com/84233a1b2a5145d5aabf97620925bde9.pdf?Expires=1659384258&Signature=QceLWh6WbWAbTEhZZ9FRTwYG9PEc7mXkW5YFqRHdsyDbIL0LzEagsttEN6lwozyjn4Lmo4u~ex9V0nJEi2IcPcpm2vjkyWLJRDFxFa8~fB0eitlsFH2DphUv5SUwE1V2URa9yVwd~9M9j7bHW30dQUPVsGN-j9imMMo1tpk4q2qg5M3E8plwPXmZg9rq0pA55I~q~7egrNMWIFfUJiL1dcWmzUCQ3fFlOzZhizfOSVNn9Ru5UmtWTBmNnbOwDvK1RqCaQppQ3vLvCIN17T2zADcRQ1wkFgiFHxwYz0Mxnni2AOlFpMxHpAK9qh0qNDZYld5DT0rjeR~oIR8mb8WWEg__&Key-Pair-Id=APKAJRICFXQ2S4YUQRSQ",
			
			"dc:format": "application/pdf"
            }
        }, {
            "pageRanges": {
                "cpf:inline": [{
                    "start": 1
                }, {
                    "end": 1
                }, {
                    "start": 1,
                    "end": 1
                }]
            },
            "documentIn": {
                "cpf:location": "https://deliver.goshippo.com/d67eb882bb4d4fa3905433b56aaaf446.pdf?Expires=1659384191&Signature=Uu~HvBIpdMMf~e9ZbpWk8m94E5UFNmdOV5BkHnci0Lmv2Klx7CHSgSCh~9KxB18EAFQMyUfePN3OUCNMITAUb~JYcpxyDNJv4pu4mxOVLJfHSSrTpVEx-qTVZZ1bwjh41h2J3kuS2hK2h3JvoteBag-DNu6C3isGNHDbc3nwgaseZV9LB7-fuYSCJOyFzSS9NXmzv6b3oxqgRsiOUhMAXnSdLtslbTiOYkYlA6HkQbWCCWMkNHaXYbuPVR2b7eDirzttwMMOsYlxtXGUR04HPdpHG~t7IJkCNSsFpbqGQvA4YB~y7A9X-E9pUncuhdQDKIaGr2-SSUJILBJ8544cgQ__&Key-Pair-Id=APKAJRICFXQ2S4YUQRSQ",
                "dc:format": "application/pdf"
            }
        }]
    },
    "cpf:engine": {
        "repo:assetId": "urn:aaid:cpf:Service-916ee91c156b42349a7847a7d564fb13"
    },
    "cpf:outputs": {
        "documentOut": {
            "cpf:location": "OutputFile",
            "dc:format": "application/pdf"
        }
    }}';
          $re = combinePDF( $token[ 'access_token' ], $data );
          $_SESSION[ 'adobe_token' ] = $token[ 'access_token' ];
		  $PDF = getPDFStatus( $_SESSION[ 'adobe_token' ], $re[ 'x-request-id' ][ 0 ] );	
          print_r( $PDF );

          //$label = $transaction[ "label_url" ];
          // array_push( $arr, $label );


          // Save in Subs table
          $subscriberID = $subs[ $i ][ 'uid' ];
          $tracking = [];
          $tracking[ 'tracking' ] = $transaction[ "tracking_number" ];
          $tracking[ 'label' ] = $transaction[ "label_url" ];
          $tracking[ 'last_shipping' ] = time();
          $db->update( 'subscriptions', $tracking, "WHERE uid=" . $subscriberID );

        } else {
          echo( $transaction[ "messages" ] );
        }
      }
      foreach ( $arr as $file ) {

        // MERGER

      }
      //$file = "";
      // Merge labels into one PDF then email the link to creator(attach password to the link)

      //echo $file;
    }

    // Save last shipping date considering late shipments
    //echo true;
  }
  return;
}

// GET SHIPPING INSTRUCTIONS / DETAILS
$box = "box_" . $uid;
$sql = "SELECT * FROM $box";
$box = $db->get( $sql );
$sql = "SELECT * FROM subscriptions WHERE creator_id=$uid ORDER BY date_created ASC LIMIT 1";
$subs = $db->get( $sql );
if ( isset( $box[ 0 ] ) ) {

  // NEXT SHIPPING DATE
  if ( !is_null( $subs[ 0 ][ 'last_shipping' ] ) ) {
    $next = $subs[ 0 ][ 'last_shipping' ] + 2592000;
    $date = date( "F d, Y", $next );
  } else {
    $next = $subs[ 0 ][ 'date_created' ] + 2592000;
    $date = date( "F d, Y", $next );
  }
  // NUMBER OF BOXES TO SHIP
  if ( empty( $subs ) ) {
    $number = count( $subs ) . " boxes";
  }
  if ( count( $subs ) == 1 ) {
    $number = count( $subs ) . " box";
  }
  if ( count( $subs ) > 1 ) {
    $number = count( $subs ) . " boxes";
  }
}
$secret = password_hash( "Zi!on1+2=3-A/m?ir12X", PASSWORD_DEFAULT );
$msg = "You have <b>$number</b> to ship for <span class='darkblue'>$date</span>. Your shipping labels will be available to print on <span class='darkblue'>$date</span>. An email and/or text message notification will be sent to you in advance of <span class='darkblue'>$date</span>.";
echo "<div id='module'>
	
	<h2>Ship boxes</h2>
<div class='alert'>
	<p>$msg</p>

</div>

	<button data-uid='$uid' class='$secret' onclick='printLabels(this);'>Print labels</button>
	</div>";


?>