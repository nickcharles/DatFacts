<?php
 
require "twilio/Services/Twilio.php";
 
// set your AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = "ACcbaaff60ee6acbc930d6912fbaa2456a";
$AuthToken = "8b4a4f3b93a61ed471f05aed4c9b962f";
 
$client = new Services_Twilio($AccountSid, $AuthToken);

$connection = new MongoClient();
$phoneCollection = $connection->datfacts->numbers;
$factsCollection = $connection->datfacts->facts;

$phoneCursor = $phoneCollection->find();

while(1){
	foreach($phoneCursor as $phoneDocument){
		$number = $phoneDocument["number"];
		$subject = $phoneDocument["subject"];
		$count = $phoneDocument["count"];
		
		$query = array("subject" => $subject);
		$factCursor = $factsCollection->find($query);
		$factDocument = $factCursor->getNext();
			
		$factArray = $factDocument["factArray"];
		$randomFact = $factArray[array_rand($factArray)];
		$message = "Your " . $subject . " fact: " . $randomFact;
		try {
			$sms = $client->account->messages->sendMessage(
				"734-393-4311", // From this number
				$number, // To this number
				$message
			);
			
			$count++;
			if ($count > 3){
				$phoneCollection->remove(array("number" => $number));
			}
			$phoneCollection->update(array("number" => $number), array('$set' => array("count" => $count)));
		} catch (Exception $e){
			echo "Exception!", $e;
			$phoneCollection->remove(array("number" => $number));
		}
	}
	$randInt = rand(20,120);
	echo "Number of sleep seconds is: ", $randInt, "\n";
	sleep($randInt);
} 
