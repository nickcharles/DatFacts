<?php
$connection = new MongoClient();
$collection = $connection->datfacts->numbers;

$inputs = $argv;
$document = array(
	"number" => $argv[1],
	"suject" => $argv[2]
);
$collection->insert($document);
?>
