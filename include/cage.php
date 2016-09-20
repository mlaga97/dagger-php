<?php
/*
* Maximum score = none.
* Scoring is as follows:
* 
* Two (2) or more affirmative responses indicates the client is a problem drinker.
*/
	function write_cage($type, $mysqli)
	{
		global $i;

		if ($mysqli->connect_errno)
		{
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		
		if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="CAGE" AND '. $type .'=1';
		}	
		else{
			exit();
		}
		if($result = $mysqli->query($query))
		{
			if ($i == 0)
			{
				$i=1;
			};

			if($result->num_rows > 0 )
				{ //If there are questions to write, write them. Otherwise don't.
					echo "<br><hr>\n";
					echo "<div id=\"cage_section\"><p>Please answer yes or no for the following questions. (Cage)</p>\n";
					echo "<table id=\"cage_questions\" border=\"1\">\n";
					echo "<tr><td class=\"cage_scale_pad\"></td><td class=\"cage_scale\"><center>Yes</center></td>\n";
					echo "<td class=\"cage_scale\" ><center>No</center></td></tr>\n";
	if ($result)
		{ //we got a result from the query  
			while($row = $result->fetch_assoc())  
			{
				echo "<tr class=\"cage_row\"";
				if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">";
				echo "<td class=\"cage_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"cage_response\" id=\"cage_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"cage_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"cage_response\" id=\"cage_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"cage_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
				$_SESSION["cage_" . $row['Sub_ID']] = -1;
				$i++;              
			}// end while
				echo "</tr>\n"; //close table row.
			}
			else
			{
				echo "CAGE Query error!";
			}
			echo "</table></div><!--end div cage_section -->\n";
		}
	}
};

function cage_scoring($copy, $mysqli)
{
	if ($mysqli->connect_errno)
	{
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}	
	$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="CAGE" AND type = "CAGE-cutoff"');
	$row = $result->fetch_assoc(); 
	$cage_score = $copy['cage_1']+$copy['cage_2']+$copy['cage_3']+$copy['cage_4'];
	if ($cage_score >= $row['cutoff_value'] )
	{ 
		echo "<tr>";
		echo '<td><p style = "color: red; text-align: left">
		As scored by the CAGE, the patient shows signs of substance abuse.
		</p>';
		echo "SCORE: " . $cage_score;
		echo "/4. <br>The cutoff score is suggested to be greater than 2.<br>
		Source: The CAGE questionnaire was developed by Dr. John Ewing, founding director of the Bowles Center for Alcohol Studies,
		 University of North Carolina at Chapel Hill.</td>";
		echo "</tr>";	
		// possible 4, cutoff is suggested at greater than 2.
	}
	else
	{
		echo "<tr>";
		echo '<td><p text-align: left">
		As scored by the CAGE, the patient DOES NOT show signs of substance abuse.
		</p>';
		echo "SCORE: " . $cage_score;
		echo "/4. <br>The cutoff score is suggested to be greater than 2.<br>
		Source: The CAGE questionnaire was developed by Dr. John Ewing, founding director of the Bowles Center for Alcohol Studies,
		 University of North Carolina at Chapel Hill.</td>";
		echo "</tr>";	
	}
	


};

?>