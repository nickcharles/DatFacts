<?php
	//TODO: change this function to interact with incoming message
	function getPhoneSubjectArray(){
		return array(
			"number" => "8185183130",
			"subject" => "cats"
		);
	}

	$connection = new MongoClient();
	$db = $connection->dbname;
	
	$collection = $db->foobar;

	$doc = getPhoneSubjectArray();

	//$collection->insert($doc);
	$collection->remove(array( "number" => "8185183130"));
	$cursor = $collection->find();
	while ($cursor->hasNext()){
		var_dump($cursor->getNext());
	}
?>
