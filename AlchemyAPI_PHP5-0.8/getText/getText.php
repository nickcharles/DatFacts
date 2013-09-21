<?php

include "AlchemyAPI.php";

$alchemyObj = new AlchemyAPI();
$alchemyObj->loadAPIKey("api_key.txt");
$subject = "cat";

$file = fopen("$subject.xml", 'a');
$title = $alchemyObj->URLGetTitle("http://en.wikipedia.org/wiki/$subject");
$text = $alchemyObj->URLGetText("http://en.wikipedia.org/wiki/$subject");
fwrite($file, $title);
fwrite($file, $text);
fclose($file);

?>

