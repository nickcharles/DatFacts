<?php

include "AlchemyAPI.php";

$alchemyObj = new AlchemyAPI();

$alchemyObj->loadAPIKey("api_key.txt");

$subject = "lynx";

$file = fopen("$subject.xml", 'a');

$title= $alchemyObj->URLGetTitle("http://en.wikipedia.org/wiki/$subject");
$text = $alchemyObj->URLGetText("http://en.wikipedia.org/wiki/$subject");
fwrite($file, "$title<br/><br/>\n");
fwrite($file, "$text<br/><br/>\n");
fclose($file);

?>

