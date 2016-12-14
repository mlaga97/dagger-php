<?php
// write audit() will write the audit-c questions and the response matrix on the page. There are only 3 audit-c questions so 
// we'll extract the questions from the database but the responses are different for each question. So, we'll use the question_id 
// to determine the output.

/*
* Maximum score = 12.
* Scoring is as follows:
* 
* 1. For men, a score of 4 or more is considered positive, optimal for identifying hazardous drinking or active alcohol use disorders.
* 2. For women, a score of 3 or more is considered positive (same as above).
* 3. However, when the points are all from Question #1 alone (#2 & #3 are zero), it can be
*	 assumed that the patient is drinking below recommended limits and it is suggested that the
*	 provider review the patient’s alcohol intake over the past few months to confirm accuracy.
* 4. Generally, the higher the score, the more likely it is that the patient’s drinking is affecting his or her safety.
*/

function write_audit($type, $mysqli)
{
	global $i;

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	
	
	if($result = $mysqli->query('SELECT * FROM questions WHERE classification="AUDIT-C" AND '.$type.'=1'))
	{
	if ($i == 0) {$i=1;
		};

	if($result->num_rows > 0 ) { //If there are questions to write, write them. Otherwise don't.
			echo "<br><hr>\n";
			echo "<div id=\"audit_section\"><p>For the following questions, consider a \"drink\" 
				to be a can or bottle of beer, a glass of wine, a wine cooler, or one cocktail or shot of hard liquor (like scotch, gin, or vodka). (Audit-C)</p>\n";

	if ($result){ //we got a result from the query 
		echo "<table id=\"audit_questions\" border=\"1\">\n"; 
		while($row = $result->fetch_assoc())  {
			
			if ($row['id'] == 17){
			echo "<tr ";
			if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
			echo "><td class=\"audit_scale_pad\"></td><td class=\"audit_scale\"><center>Never</center></td>\n";
			echo "<td class=\"audit_scale\" ><center>Monthly or less</center></td><td class=\"audit_scale\" ><center>2-4 times per month</center></td>\n";
			echo "<td class=\"audit_scale\" ><center>2-3 times per week</center></td>";
			echo "<td class=\"audit_scale\" ><center>4 or more times a week</center></td></tr>\n";
		} else if($row['id']== 18){
			echo "<tr ";
			if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
			echo "><td class=\"audit_scale_pad\"></td><td class=\"audit_scale\"><center>0 to 2</center></td>\n";
			echo "<td class=\"audit_scale\" ><center>3 to 4</center></td><td class=\"audit_scale\" ><center>5 or 6</center></td>\n";
			echo "<td class=\"audit_scale\" ><center>7 to 9</center></td>";
			echo "<td class=\"audit_scale\" ><center>10 or more</center></td></tr>\n";
		} else { // there are only 3 options so no test
			echo "<tr ";
			if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
			echo "><td class=\"audit_scale_pad\"></td><td class=\"audit_scale\"><center>Never</center></td>\n";
			echo "<td class=\"audit_scale\" ><center>Monthly or less</center></td><td class=\"audit_scale\" ><center>Monthly</center></td>\n";
			echo "<td class=\"audit_scale\" ><center>Weekly</center></td>";
			echo "<td class=\"audit_scale\" ><center>Daily or almost daily</center></td></tr>\n";
		};
				echo "<tr class=\"audit_row\"";
				if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">";
				echo "<td class=\"audit_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"audit_response\" id=\"audit_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"audit_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
				echo "<td class=\"audit_response\" id=\"audit_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"audit_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"audit_response\" id=\"audit_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"audit_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				echo "<td class=\"audit_response\" id=\"audit_" . $row['Sub_ID'] . "-" . "4\"><center><input type=\"radio\" name=\"audit_" . $row['Sub_ID'] . "\" value=\"3\" /></center></td>\n";
				echo "<td class=\"audit_response\" id=\"audit_" . $row['Sub_ID'] . "-" . "5\"><center><input type=\"radio\" name=\"audit_" . $row['Sub_ID'] . "\" value=\"4\" /></center></td>\n";
				
				$_SESSION["audit_" . $row['Sub_ID']] = "-1";
				$i++;              

	}// end while
		echo "</tr>\n"; //close table row.
	}
	else{
		echo "AUDIT Query error!";
	}
	echo "</table></div><!--end div audit_section -->\n";
}
}
};

function audit_scoring($copy, $sex, $mysqli)
{
	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	
	

	$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="AUDIT-C" AND type = "AUDIT-cutoff-male"');
	$result2 = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="AUDIT-C" AND type = "AUDIT-cutoff-female"');
    $row = $result->fetch_assoc(); 
    $row2 = $result2->fetch_assoc(); 

	$audit_score = $copy['audit_1'] + $copy['audit_2'] + $copy['audit_3'];

	if((($sex == 'Data unspecified.')||($sex === '')) && ($audit_score >= 4))
	{		
		echo "<tr>";
		echo '<td><p style = "color: red; text-align: left">
		As scored by the Audit, the patient shows signs of Substance Abuse.
		</p>';
		echo "SCORE: " . $audit_score;
		echo "/12. The cutoff is suggested to be be 4 for men and 3 for women.<br></td>";
		echo "</tr>";		
	}
	else if(($sex == 'male') && ($audit_score >= 4))
	{
		echo "<tr>";
		echo '<td><p style = "color: red; text-align: left">
		As scored by the Audit, the patient shows signs of Substance Abuse.
		</p>';
		echo "SCORE: " . $audit_score;
		echo "/12. The cutoff is suggested to be be 4 for men and 3 for women.<br></td>"; 
		echo "</tr>";
	}
	else if (($sex == 'female') && ($audit_score >= 3))
	{ 	
		echo "<tr>";
		echo '<td><p style = "color: red; text-align: left">
		As scored by the Audit, the patient shows signs of Substance Abuse.
		</p>';
		echo $audit_score;
		echo "/12. The cutoff is suggested to be be 4 for men and 3 for women.<br></td>";
		echo "</tr>";		
	}
	else
	{
		echo "<tr>";
		echo '<td><p text-align: left">
		As scored by the Audit, the patient DOES NOT show signs of Substance Abuse.
		</p>';
		echo $audit_score;
		echo "/12. The cutoff is suggested to be be 4 for men and 3 for women.<br></td>";
		echo "</tr>";	
	}
};
?>