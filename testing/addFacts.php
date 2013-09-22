<?php
        function addFactsToDatabase($subject, $factArray){
                $connection = new MongoClient();
                $collection = $connection->datfacts->facts;

                $doc = array(
                        "subject" => $subject,
                        "factArray" => $factArray
                );
                $collection->insert($doc);
        }

        $connection = new MongoClient();
        $collection = $connection->datfacts->facts;

        $subject = "dog";
        $factArray = array("Dogs are better than cats", "they are super cute",
				"they can actually play fetch");
        addFactsToDatabase($subject,$factArray);

?>
