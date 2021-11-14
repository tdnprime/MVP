<?php



$appKey = "trevor@boxeon.com";

$appSecret = "227887284273-d78nlrb";

// PLACE CONVERSATIONS IN A FOLDERR?

// CREATE A CONTACT FOR CREATORS AND FANS AND USE CONTACTID's TO TRANSMIT 

$creatorNumber‬ = 6464504671;

$data = array(

  'User'        => $appKey,

  'Password'    => $appSecret,

  'PhoneNumber' => $creatorNumber‬,

  'FirstName'   => 'Janet',

  'LastName'    => 'Doe',

  'Email'       => 'trevorprimenyc@gmail.com',

  'Note'        => 'Creator',

  'Groups'      => array('Creators')

  );

 

$curl = curl_init('https://app.eztexting.com/contacts?format=json');

curl_setopt($curl, CURLOPT_POST, 1);

curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// If you experience SSL issues, perhaps due to an outdated SSL cert

// on your own server, try uncommenting the line below

// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);

curl_close($curl);

 

$json = json_decode($response);

$json = $json->Response;

 

if ( 'Failure' == $json->Status ) {

  $errors = array();

  if ( !empty($json->Errors) ) {

    $errors = $json->Errors;

  }

 

  echo 'Status: ' . $json->Status . "\n" .

  'Errors: ' . implode(', ' , $errors) . "\n";

} else {

  $groups = array();

  if ( !empty($json->Entry->Groups) ) {

    $groups = $json->Entry->Groups;

  }

 

 // SAVE CONTACT ID IN DATABASE

  echo 'Status: ' . $json->Status . "\n" .

  'Contact ID : ' . $json->Entry->ID . "\n" .

  'Phone Number: ' . $json->Entry->PhoneNumber . "\n" .

  'First Name: ' . $json->Entry->FirstName . "\n" .

  'Last Name: ' . $json->Entry->LastName . "\n" .

  'Email: ' . $json->Entry->Email . "\n" .

  'Note: ' . $json->Entry->Note . "\n" .

  'Source: ' . $json->Entry->Source . "\n" .

  'Groups: ' . implode(', ' , $groups) . "\n" .

  'CreatedAt: ' . $json->Entry->CreatedAt . "\n";

}



// INTERCEPT AND TRANSMIT, SEND FIRST MESSAGE



if (!empty($_POST)) {

	// GRAB MESSAGE FROM POST

	$subject = "TESTING";

	$message = "TEST";

	$message_type = 1;

	$phone_number = 6464504671;

    /* prepare data for sending */

    $data = array(

        "User"          => $appKey, /* change to your EZ Texting username */

        "Password"      => $appSecret, /* change to your EZ Texting password */

        "PhoneNumbers"  => $phone_number, // Going to

        "Subject"       => $subject,

        "Message"       => $message,

	    'StampToSend'   => '1305582245', // ConversationID

        "MessageTypeID" => $message_type

    );



    /* send message */

    $curl = curl_init("https://app.eztexting.com/sending/messages?format=json");

    curl_setopt($curl, CURLOPT_POST, 1);

    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($curl);

    curl_close($curl);



    /* parse result of API call */

    $json = json_decode($response);



    switch ($json->Response->Code) {

        case 201:

            exit("Message Sent");

        case 401:

            exit("Invalid user or password");

        case 403:

            $errors = $json->Response->Errors;

            exit("The following errors occurred: " . implode('; ', $errors));

        case 500:

            exit("Service Temporarily Unavailable");

    }

}



// GET MESSAGES

 if(!empty($_POST)){

$data = array(

  'User'          => $appKey,

  'Password'      => $appSecret,

  'sortBy'        => 'PhoneNumber',

  'sortDir'       => 'asc',

  'itemsPerPage'  => '10',

  'page'          => '1',

  );

 

$curl = curl_init('https://app.eztexting.com/incoming-messages?format=json&' . http_build_query($data));

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($curl);

curl_close($curl);

 

$json = json_decode($response);

$json = $json->Response;

 

if ( 'Failure' == $json->Status ) {

  $errors = array();

  if ( !empty($json->Errors) ) {

    $errors = $json->Errors;

  }

 

  echo 'Status: ' . $json->Status . "\n" .

  'Errors: ' . implode(', ' , $errors) . "\n";

} elseif ( empty($json->Entries) ) {

  echo 'Status: ' . $json->Status . "\n" .

  'Search has returned no results' . "\n";

} else {

  echo 'Status: ' . $json->Status . "\n" .

  'Total results: ' . count($json->Entries) . "\n\n";

 

  foreach ( $json->Entries as $message ) {

    echo 'Message ID : ' . $message->ID . "\n" .

    'Phone Number: ' . $message->PhoneNumber . "\n" .

    'Subject: ' . $message->Subject . "\n" .

    'Message: ' . $message->Message . "\n" .

    'New: ' . $message->New . "\n" .

    'Folder ID: ' . $message->FolderID . "\n" .

    'Contact ID: ' . $message->ContactID . "\n" .

    'Received On: ' . $message->ReceivedOn . "\n\n";

  }

}



 }







// BUY CREDITS AFTER PAYPAL PAYMENT VERIFICATION

$ch = curl_init('https://app.eztexting.com/api/credits/buy');

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch,CURLOPT_POST,1);

curl_setopt($ch,CURLOPT_POSTFIELDS,"user=username&pass=userpassword&credits=100&firstname=firstname&lastname=lastname&address=address&city=newyork&state=ny&zip=08902&country=usa&type=visa&ccnumber=rIhLJUiXl8M0JIcrelxH9A&cccode=111&expm=11&expy=12");

curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

$data = curl_exec($ch);

print($data);