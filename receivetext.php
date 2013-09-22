<?php
function processPhoneNumberAndSubject($number,$subject){

	$connection = new MongoClient();
	$collection = $connection->datfacts->numbers;
	//add in error checking
	$doc = array(
		"number" => $number,
		"subject" => $subject
	);
	$collection->insert($doc);
}
?>
