<?php
 
require "twilio/Services/Twilio.php";
 
// set your AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = "ACcbaaff60ee6acbc930d6912fbaa2456a";
$AuthToken = "8b4a4f3b93a61ed471f05aed4c9b962f";
 
$client = new Services_Twilio($AccountSid, $AuthToken);
/* 
$sms = $client->account->sms_messages->create(
    "734-393-4311", // From this number
    "818-518-3130", // To this number
    "Test message!"
);
*/
$connection = new MongoClient();
$phoneCollection = $connection->datfacts->numbers;
$factsCollection = $connection->datfacts->facts;

$phoneCursor = $phoneCollection->find();

foreach($phoneCursor as $phoneDocument){
	$number = $phoneDocument["number"];
	$subject = $phoneDocument["subject"];

	$query = array("subject" => $subject);
	$factCursor = $factsCollection->find($query);
	$factDocument = $factCursor->getNext();
	var_dump($factDocument);
		
	$factArray = $factDocument["factArray"];
	$randomFact = $factArray[array_rand($factArray)];
	$sms = $client->account->sms_messages->create(
    		"734-393-4311", // From this number
    		$number, // To this number
   		$randomFact
	);
} 
// Display a confirmation message on the screen
echo "Sent message";
