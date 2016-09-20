<?php
//write_CD will get all the selected gad questions and place them and the response matrix on the page.
function write_pcl($type, $mysqli)
{
	global $i;

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	

	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="PCL-C" AND '.$type.'=1';
		}	
	else{
		exit();
	}

	if($result = $mysqli->query($query))
	{
	if ($i == 0) {$i=1;
		};

	if($result->num_rows > 0 ) { //If there are questions to write, write them. Otherwise don't.
			echo "<br><hr>\n";
	echo "<div id=\"pcl_section\"><p>In the <b>last 30 days</b>, how much have you been bothered by the following? (PCL-C)</p>\n";
	echo "<table id=\"pcl_questions\" border=\"1\">\n";
	echo "<tr><td class=\"pcl_scale_pad\"></td><td class=\"pcl_scale\"><center>Not at all</center></td>\n";
	echo "<td class=\"pcl_scale\" ><center>A little bit</center></td><td class=\"pcl_scale\" ><center>Moderately</center></td>\n";
	echo "<td class=\"pcl_scale\" ><center>Quite a bit</center></td>";
	echo "<td class=\"pcl_scale\" ><center>Extremely</center></td></tr>\n";

	if ($result){ //we got a result from the query  
		while($row = $result->fetch_assoc()) {
				echo "<tr class=\"pcl_row\"";
				if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">";
				echo "<td class=\"pcl_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"pcl_response\" id=\"pcl_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"pcl_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"pcl_response\" id=\"pcl_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"pcl_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				echo "<td class=\"pcl_response\" id=\"pcl_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"pcl_" . $row['Sub_ID'] . "\" value=\"3\" /></center></td>\n";
				echo "<td class=\"pcl_response\" id=\"pcl_" . $row['Sub_ID'] . "-" . "4\"><center><input type=\"radio\" name=\"pcl_" . $row['Sub_ID'] . "\" value=\"4\" /></center></td>\n";
				echo "<td class=\"pcl_response\" id=\"pcl_" . $row['Sub_ID'] . "-" . "5\"><center><input type=\"radio\" name=\"pcl_" . $row['Sub_ID'] . "\" value=\"5\" /></center></td>\n";
				$_SESSION["pcl_" . $row['Sub_ID']] = "-1";
				$i++;               

	}// end while
		echo "</tr>\n"; //close table row.
	}
	else{
		echo "Query error!";
	}
	echo "</table></div><!--end div pcl_section -->\n";
	}
}
};

function pcl_scoring($copy, $mysqli)
{
	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	
	$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="PCL-C" AND type = "PCL-cutoff"');
    $row = $result->fetch_assoc(); 
	$pcl_score = $copy['pcl_1'] + $copy['pcl_2'] + $copy['pcl_3'] + $copy['pcl_4'] + $copy['pcl_5'] + $copy['pcl_6'] + $copy['pcl_7'] + $copy['pcl_8'] + $copy['pcl_9'] + $copy['pcl_10'] + 
	             $copy['pcl_11'] + $copy['pcl_12'] + $copy['pcl_13'] + $copy['pcl_14'] + $copy['pcl_15'] + $copy['pcl_16']  + $copy['pcl_17'];
	if ($pcl_score >= $row['cutoff_value'])
	{
		echo "<tr>";
		echo '<td><p style = "color: red; text-align: left">
		As scored by the PCL, the patient shows signs of Post Traumatic Stress.
		</p>';
		echo "SCORE: " . $pcl_score;
		echo "/85. <br>The cutoff score is suggested to be between 45 - 50 for civilian mental health facilities.<br>
		Source: Weathers, Litz, Huska, & Keane National Center for PTSD - Behavioral Science Division.<br> This is a Government document in the public domain.</td>";
		echo "</tr>";		
		// possible 85, cutoff is suggested at 45-50 for civilian mental health facilities. 
	} else 
	{
		echo "<tr>";
		echo '<td><p text-align: left">
		As scored by the PCL, the patient DOES NOT show signs of Post Traumatic Stress.
		</p>';
		echo "SCORE: " . $pcl_score;
		echo "/85. <br>The cutoff score is suggested to be between 45 - 50 for civilian mental health facilities.<br>
		Source: Weathers, Litz, Huska, & Keane National Center for PTSD - Behavioral Science Division.<br> This is a Government document in the public domain.</td>";
		echo "</tr>";		
		// possible 85, cutoff is suggested at 45-50 for civilian mental health facilities. 
	}
};
?>