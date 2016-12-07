<?php
/*
* Maximum score = none.
* Scoring is as follows:
* 
* Two (2) or more affirmative responses indicates the client is a problem drinker.
*/
	function write_dast($type, $mysqli){
	global $i;

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	
	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="DAST-10" AND ' . $type . '=1';
		}	
	else{
		exit();
		}	
	if($result = $mysqli->query($query))
	{
		if ($i == 0) {$i=1;
			};

		if($result->num_rows > 0 ) { //If there are questions to write, write them. Otherwise don't.
			echo "<br><hr>";
			echo "<div id=\"dast_section\"><p>These questions pertain to the past 12 months. (DAST-10)</p>\n";
			echo "<table class = \dast\" id=\"dast_questions\" border=\"1\">\n";
			echo "<tr><td class=\"dast_scale_pad\"></td><td class=\"dast_scale\"><center>Yes</center></td>\n";
			echo "<td class=\"dast_scale\" ><center>No</center></td></tr>\n";

			if ($result){ //we got a result from the query  
				while($row = $result->fetch_assoc()) {
					echo "<tr class=\"dast_row\"";
					if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
					echo ">";
					//write_gad_question($i, $row['question']);
					echo "<td class=\"dast_question\">" . $i . ". "; 
					echo $row['question'] . "</td>\n"; 
					if ($row['Sub_ID'] === '3')
					{          
					echo "<td class=\"dast_response\" id=\"dast_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"dast_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
					echo "<td class=\"dast_response\" id=\"dast_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"dast_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
					}
					else
					{
					echo "<td class=\"dast_response\" id=\"dast_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"dast_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
					echo "<td class=\"dast_response\" id=\"dast_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"dast_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";	
					}	
					$_SESSION["dast_" . $row['Sub_ID']] = "-1";
					$i++;               

		}// end while
			echo "</tr>\n"; //close table row.
		}
		else{
			echo "Dast Query error!";
		}
		echo "</table></div><!--end div dast_section -->\n";
		
	}
}
};

function dast_scoring($copy, $mysqli)
{
	/*dast scoring
	0 = no problems
	1-2 = low level, re-assess at later date
	3-5 = moderate level, investigate further
	6-8 = substaintial level, intensive investigation
	9-10 = severe level, intensive investigation
	*/

	$dast_score = 	$copy['dast_1']+$copy['dast_2']+$copy['dast_3']+$copy['dast_4']+$copy['dast_5']+
					$copy['dast_6']+$copy['dast_7']+$copy['dast_8']+$copy['dast_9']+$copy['dast_10'];

	if ($dast_score > 0){
		echo "<tr><td>";		
		echo "<p style = \"color: red; text-align: left\"> As scored by the DAST-10, the patient shows signs of Substance Abuse. </p>";		
		echo "SCORE: ";
		echo $dast_score;
		echo "/10.<br> The cutoff is suggested to be 0-1 for no problems, 1-2 for low level, 3-5 for moderate level, 6-8 for substaintial level and 9-10 for severe level.";
		echo '<br><br>If an applicant/recipient meets the criteria for a positive screen (a score of 8 or more) on the AUDIT and/or
		the moderate level for the DAST-10, refer to the Qualified Substance Abuse Professional.';
		echo "</td></tr>";
	}
	else 
	{
		echo "<tr><td>";		
		echo "<p> As scored by the DAST-10, the patient shows NO signs of Substance Abuse. </p>'";		
		echo "SCORE: ";
		echo $dast_score;
		echo "/10.<br> The cutoff is suggested to be 0-1 for no problems, 1-2 for low level, 3-5 for moderate level, 6-8 for substaintial level and 9-10 for severe level.";
		echo '<br><br>If an applicant/recipient meets the criteria for a positive screen (a score of 8 or more) on the AUDIT and/or
		the moderate level for the DAST-10, refer to the Qualified Substance Abuse Professional.';
		echo "</td></tr>";
	}
};
?>