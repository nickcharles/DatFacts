<?php

$connection = new MongoClient();
$collection = $connection->datfacts->facts;

$cursor = $collection->find();

while($cursor->hasNext()){
	var_dump($cursor->getNext());
}

?>
