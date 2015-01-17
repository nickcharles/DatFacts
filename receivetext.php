<?php
require "twilio/Services/Twilio.php";

function processPhoneNumberAndSubject($number,$subject){

	// set your AccountSid and AuthToken from www.twilio.com/user/account
	$AccountSid = "ACcbaaff60ee6acbc930d6912fbaa2456a";
	$AuthToken = "8b4a4f3b93a61ed471f05aed4c9b962f";
	$client = new Services_Twilio($AccountSid, $AuthToken);

	$connection = new MongoClient();
	$collection = $connection->datfacts->numbers;
	$factsCollection = $connection->datfacts->facts;
	
	$resultNumber = $number;
	if(preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $number,  $matches )){
	    $resultNumber = $matches[1] . $matches[2] . $matches[3];
	}
	$query = array("number" => $resultNumber);
	
	if ($collection->find($query)->count() == 1){
		echo "You are already in the database";
		exit();
	} 
	$facts = $connection->datfacts->facts;
	$subjectQuery = array("subject" => $subject);
	if($facts->find($subjectQuery)->count() == 0){
		//echo "finding facts";
		$result = getFacts($subject);
		//echo "facts done";
		if(count($result) > 5){
			//echo "facts found";
			$docFact = array("subject" => $subject, "factArray" => $result);
			$facts->insert($docFact);
		} else {
			$subject = "cat";
		}
	}
	$doc = array(
		"number" => $number,
		"subject" => $subject,
		"count" => 0
	);
	$message = "Thank you subscribing to " . $subject . " facts! Go to tinyurl.com/DatFacts for more fun facts!";
	$sms = $client->account->messages->sendMessage(
                        "734-393-4311", // From this number
                        $number, // To this number
                        $message
                );
	$collection->insert($doc);


		$query = array("subject" => $subject);
                $factCursor = $factsCollection->find($query);
                $factDocument = $factCursor->getNext();

                $factArray = $factDocument["factArray"];
                $randomFact = $factArray[array_rand($factArray)];
                $message = "Your " . $subject . " fact: " . $randomFact;
                $sms = $client->account->messages->sendMessage(
                        "734-393-4311", // From this number
                        $number, // To this number
                        $message
                );


}

function getFacts ($topic){
	$url = 'http://en.wikipedia.org/w/api.php?action=parse&page=' . urlencode($topic) . '&format=json&prop=text';
	$ch = curl_init($url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_USERAGENT, "TestScript"); // required by wikipedia.org server; use YOUR user agent with YOUR contact information. (otherwise your IP might get blocked)
	$c = curl_exec($ch);

	$json = json_decode($c);

	$content = $json->{'parse'}->{'text'}->{'*'}; // get the main text content of the query (it's parsed HTML)
	$facts = array();
	
	if(!$content){
		print "error \n";
		return $facts;
	}

	// pattern for first match of a paragraph
	$pattern = '#<p>(.*)</p>#U'; // http://www.phpbuilder.com/board/showthread.php?t=10352690
	if(preg_match_all($pattern, $content, $matches))
	{
	    //print $matches[0]; // content of the first paragraph (including wrapping <p> tag)
		foreach($matches[1] as $submatch){
		    $substring = strip_tags($submatch); // Content of the first paragraph without the HTML tags.
			$substring = substr($substring, 0, strpos($substring,".")+1);
			$substring = preg_replace('/\[.*?\]\s*/', '', $substring);
			if (strpos($substring,$topic)!==false || strpos($substring, pluralize($topic)!==false)) {
				array_push($facts, $substring);
			}

		}
	}
	return $facts;
}


function pluralize($word)
    {
        $plural = array(
        '/(quiz)$/i' => '\1zes',
        '/^(ox)$/i' => '\1en',
        '/([m|l])ouse$/i' => '\1ice',
        '/(matr|vert|ind)ix|ex$/i' => '\1ices',
        '/(x|ch|ss|sh)$/i' => '\1es',
        '/([^aeiouy]|qu)ies$/i' => '\1y',
        '/([^aeiouy]|qu)y$/i' => '\1ies',
        '/(hive)$/i' => '\1s',
        '/(?:([^f])fe|([lr])f)$/i' => '\1\2ves',
        '/sis$/i' => 'ses',
        '/([ti])um$/i' => '\1a',
        '/(buffal|tomat|her)o$/i' => '\1oes',
        '/(bu)s$/i' => '\1ses',
        '/(alias|status)/i'=> '\1es',
        '/(octop|vir)us$/i'=> '\1i',
        '/(ax|test)is$/i'=> '\1es',
        '/s$/i'=> 's',
        '/$/'=> 's');

        $uncountable = array('equipment', 'information', 'rice', 'money', 'species', 'series', 'fish', 'sheep');

        $irregular = array(
        'person' => 'people',
        'man' => 'men',
        'child' => 'children',
        'sex' => 'sexes',
        'move' => 'moves',
	'leaf' => 'leaves');

        $lowercased_word = strtolower($word);

        foreach ($uncountable as $_uncountable){
            if(substr($lowercased_word,(-1*strlen($_uncountable))) == $_uncountable){
                return $word;
            }
        }

        foreach ($irregular as $_plural=> $_singular){
            if (preg_match('/('.$_plural.')$/i', $word, $arr)) {
                return preg_replace('/('.$_plural.')$/i', substr($arr[0],0,1).substr($_singular,1), $word);
            }
        }

        foreach ($plural as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                return preg_replace($rule, $replacement, $word);
            }
        }
        return false;

    }
?>
