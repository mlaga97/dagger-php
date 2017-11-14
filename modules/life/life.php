<?php
/*
* Maximum score = none.
* Scoring is as follows:
*
* Two (2) or more affirmative responses indicates the client is a problem drinker.
*/
	function write_life($type, $mysqli){
	global $i;

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}

	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="LIFE" AND '.$type.'=1';
		}
	else{
		exit();
		}

	if($result = $mysqli->query($query))
	{
		if ($i == 0) {
			$i=1;
		} //removed ; after }

		echo "<!-- life - num rows is " . $result->num_rows . " -->";

		if($result->num_rows > 0 ) { //If there are questions to write, write them. Otherwise don't.
			echo "<div id=\"life_section\"><p>Please answer the following questions: (Life Attitudes Schedule: Short Form)</p>\n";


			if ($result){ //we got a result from the query
				while($row = $result->fetch_assoc()) {
                                        echo "<table class = \life\" id=\"life_questions\" border=\"0\">\n";
                                        echo "<tr><td class=\"life_scale_pad\"></td><td class=\"life_scale\"><center>Yes</center></td>\n";
                                        echo "<td class=\"life_scale\" ><center>No</center></td></tr>\n";
					echo "<tr class=\"life_row\" style=\"background-color: #FFFFCC;\">";
					//write_gad_question($i, $row['question']);
					echo "<td class=\"life_question\">" . $i . ". ";
					echo $row['question'] . "</td>\n";
					echo "<td class=\"life_response\" id=\"life_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"life_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
					echo "<td class=\"life_response\" id=\"life_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"life_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
					$_SESSION["life_" . $row['Sub_ID']] = "-1";
                                        echo "</tr>\n";
                                        echo "</table>";
                                        if ($row['Sub_ID']>1){
                                        echo "<table class = \life\" id=\"life_questions\" border=\"0\">\n";
                                        echo "</tr><tr><td> If yes, please explain:</td>";
                                        echo "<td class=\"self_response\" id=\"life_". ($row['Sub_ID']+2) ."\"><center><input type=\"input\" name=\"life_". ($row['Sub_ID']+2) ."\" size=\"75\"/></center></td>\n";
                                        //echo "<td id=\"life_". ($row['Sub_ID']+2) ."\><input type=\"input\" name=\"life_". ($row['Sub_ID']+2) ."\" /></td> ";
                                        $_SESSION["life_" . $row['Sub_ID']+2] = "";
                                        echo "</tr>\n";
                                        echo "</table>";
                                        }
                                        $i++;

		}// end while

		}
		else{
			echo "Life Query error!";
		}
		echo "</div><!--end div life_section -->\n";

	}
}
}

function life_scoring($copy, $mysqli){

    if (($copy['life_1'] ==1)||($copy['life_2'] ==1)||($copy['life_3'] ==1)){ //if there was a positive response to any of the yes/no questions
            echo "<div>As documented in the Life Attitudes Schedule, note the following issues:</div>";
            echo "<span style=\"color:red\">";
        if ($copy['life_1'] ==1){

            echo "<p>The client noted a desire to kill him or herself.</p>";
        }
        if ($copy['life_2'] ==1){
            echo "<p>The client noted a desire to kill him or herself.</p>";
            if ($copy['life_4'] !=""){
                echo " The client documented the following explaination: ".$copy['life_4'];
            }
        }
        if ($copy['life_3'] ==1){
            echo "<p>The client noted a desire to hurt him or herself.</p>";
            if ($copy['life_5'] !=""){
                echo " The client documented the following explaination: ".$copy['life_5'];
            }
        }
    }
    echo "</span>";
}
?>
