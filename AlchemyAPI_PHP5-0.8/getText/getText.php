<?php

include "AlchemyAPI.php";

$alchemyObj = new AlchemyAPI();
$alchemyObj->loadAPIKey("api_key.txt");
$subject = "Adolf_Hitler";

$file = fopen("$subject.xml", 'a');
//$title = $alchemyObj->URLGetTitle("http://en.wikipedia.org/wiki/$subject");
//fwrite($file, $title);
$text = $alchemyObj->URLGetText("http://en.wikipedia.org/wiki/$subject");
fwrite($file, $text);
fclose($file);

?>

