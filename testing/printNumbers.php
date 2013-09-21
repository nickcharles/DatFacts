<?php
$connection = new MongoClient();
$collection = $connection->datfacts->numbers;

$cursor = $collection->find();

while($cursor->hasNext()){
        var_dump($cursor->getNext());
}

?>
