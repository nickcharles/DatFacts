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
        $factArray = array("In 1969, Lassie the famous Collie dog was the very first animal inducted into the animal hall of fame",
				 "Him and Her were the names Lyndon Johnson' gave to his two beagles",
				"Grapes and raisins even in small amounts can cause kidney failure in dogs",
"A typical dog has a mouthful of 42 permanent teeth, while the average human has 32",
"Some stray russian dogs have figured out how to use the subway system in order to travel to more populated areas in search of food",
"Dogs don't enjoy being hugged as much as humans and other primates",
"One of Michael Vick's former fighting dogs, Leo, went on to be therapy dog wo comforted dying children"
);

        addFactsToDatabase($subject,$factArray);

?>
