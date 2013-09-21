<?php

include "AlchemyAPI.php";

$alchemyObj = new AlchemyAPI();

$alchemyObj->loadAPIKey("api_key.txt");

$result = $alchemyObj->URLGetText("http://en.wikipedia.org/wiki/Coitus");
echo "$result<br/><br/>\n";

?>

