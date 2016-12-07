<?php
//write_ces_d_ will get all the selected ces_d_ questions and place them and the response matrix on the page.
/*
*/
function write_ces_d($type, $mysqli)
{
	global $i;

	if ($mysqli->connect_errno)
	{
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="CES-D" AND '. $type .'=1';
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
	echo "<div id=\"CES-D\"><p>Below is a list of the ways you might have felt of behaved. Please tell me how often you have felt this way during the<B> past week. </B> (CES-D)</p>\n";
	echo "<table id=\"ces_d_questions\" border=\"1\">\n";
	echo "<tr><td class=\"ces_d_scale_pad\"></td><td class=\"ces_d_scale\"><center>Rarely or none of \n the time (less than \n 1 day)</center></td>\n";
	echo "<td class=\"ces_d_scale\" ><center>Some of a \n little of the \n time (1-2 \n days)</center></td><td class=\"ces_d_scale\" ><center>Occasionally or a \n moderate amount of time \n (3-4 days)</center></td>\n";
	echo "<td class=\"ces_d_scale\" ><center>Most or all of \n the time (5-7 \n days)</center></td></tr>\n";
	if ($result){ //we got a result from the query  
		while($row = $result->fetch_assoc()) 
		{
			echo "<tr class=\"ces_d_row\"";
			if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
			echo ">";
				//write_gad_question($i, $row['question']);
			echo "<td class=\"ces_d_question\">" . $i . ". "; 
			echo $row['question'] . "</td>\n";   
			if($row['Sub_ID'] != 4 && $row['Sub_ID'] != 8 && $row['Sub_ID'] != 12 && $row['Sub_ID'] != 16)
			{
				echo "<td class=\"ces_d_response\" id=\"ces_d_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"ces_d_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
				echo "<td class=\"ces_d_response\" id=\"ces_d_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"ces_d_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"ces_d_response\" id=\"ces_d_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"ces_d_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				echo "<td class=\"ces_d_response\" id=\"ces_d_" . $row['Sub_ID'] . "-" . "4\"><center><input type=\"radio\" name=\"ces_d_" . $row['Sub_ID'] . "\" value=\"3\" /></center></td>\n";
			}
			else
			{   
				echo "<td class=\"ces_d_response\" id=\"ces_d_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"ces_d_" . $row['Sub_ID'] . "\" value=\"3\" /></center></td>\n";
				echo "<td class=\"ces_d_response\" id=\"ces_d_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"ces_d_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				echo "<td class=\"ces_d_response\" id=\"ces_d_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"ces_d_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"ces_d_response\" id=\"ces_d_" . $row['Sub_ID'] . "-" . "4\"><center><input type=\"radio\" name=\"ces_d_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
			}
			$_SESSION["ces_d_" . $row['Sub_ID']] = "-1";
			$i++;  
	}// end while
		echo "</tr>\n"; //close table row.
	}
	else
	{
		echo "CESD Query error!";
	}
	echo "</table></div><!--end div ces_d_section -->\n";
	}
	}
};

function ces_d_scoring($copy, $mysqli)
{
	if ($mysqli->connect_errno)
	{
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}	
	$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="CES-D" AND type = "CES-cutoff"');
    $row = $result->fetch_assoc();
	$ces_d_score = $copy['ces_d_1'] + $copy['ces_d_2'] + $copy['ces_d_3'] + $copy['ces_d_4'] + $copy['ces_d_5'] + $copy['ces_d_6'] + $copy['ces_d_7'] + $copy['ces_d_8'] + $copy['ces_d_9'] + $copy['ces_d_10'] + 
		           $copy['ces_d_11'] + $copy['ces_d_12'] + $copy['ces_d_13'] + $copy['ces_d_14'] + $copy['ces_d_15'] + $copy['ces_d_16'] + $copy['ces_d_17'] + $copy['ces_d_18'] + $copy['ces_d_19'] + $copy['ces_d_20'];
	if ($ces_d_score >= $row['cutoff_value']) // Need to know what cut-off is.
	{
		echo "<tr>";
		echo '<td><p style ="color: red; text-align: left">
		As scored by the CES-D, the patient shows signs of Depression.
		</p>';
		echo "SCORE: " . $ces_d_score;
		echo "/60. <br> The cutoff score is suggested to be ".$row['cutoff_value']."<br></td></tr>";
		// possible 60, cutoff is 16. 
	}
	else 
	{
		echo "<tr>";
		echo '<td><p text-align: left">
		As scored by the CES-D, the patient DOES NOT show signs of Depression.
		</p>';
		echo "SCORE: " . $ces_d_score;
		echo "/60. <br> The cutoff score is suggested to be ".$row['cutoff_value']."<br></td></tr>";
	}
};
?>