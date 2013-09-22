<?php

$connection = new MongoClient();
$factsCollection = $connection->datfacts->facts;
$numbersCollection = $connection->datfacts->numbers;

$factsCollection->remove();
$numbersCollection->remove();
?>
