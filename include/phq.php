<?php
//write_phq will get all the selected phq questions and place them and the response matrix on the page.
/*
* Maximum score = 27.
* Scoring is as follows:
* score: Depression/Serverity: 	Plan
* 0-4: 		none: 				nothing.
* 5-9: 		mild: 				watchful waiting.
* 10-14: 	moderate: 			Treatment plan, considering counseling, follow-up and/or pharmacotherapy. 
* 15-19:	moderately severe	Active treatment with pharmacotherapy and/or psychotherapy.
* 20-27:	severe				Immediate initiation of pharmacotherapy and, if severe impairment or 
*								poor response to therapy, expedited referral to a mental health 
*								specialist for psychotherapy and/or collaborative management. 
*/
function write_phq($type, $mysqli)
{
	global $i;

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	
	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="PHQ-9" AND '.$type.'=1';
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

	if($result->num_rows > 0 ) { //If there are questions to write, write them. Otherwise don't.
		echo "<br><hr>\n";
	echo "<div id=\"phq_section\"><p>During the <b>last 2 weeks,</b> how often have you ";
	echo "been bothered by any of the following problems? (PHQ-9)</p>\n";
	echo "<table id=\"phq_questions\" border=\"1\">\n";
	echo "<tr><td class=\"phq_scale_pad\"></td><td class=\"phq_scale\"><center>Not at all</center></td>\n";
	echo "<td class=\"phq_scale\" ><center>Several days</center></td><td class=\"phq_scale\" ><center>Over half the days</center></td>\n";
	echo "<td class=\"phq_scale\" ><center>Nearly everyday</center></td></tr>\n";

	if ($result){ //we got a result from the query  
		while($row = $result->fetch_assoc())  {
				echo "<tr class=\"phq_row\"";
				if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">";
				//write_gad_question($i, $row['question']);
				echo "<td class=\"phq_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"phq_response\" id=\"phq_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"phq_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
				echo "<td class=\"phq_response\" id=\"phq_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"phq_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"phq_response\" id=\"phq_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"phq_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				echo "<td class=\"phq_response\" id=\"phq_" . $row['Sub_ID'] . "-" . "4\"><center><input type=\"radio\" name=\"phq_" . $row['Sub_ID'] . "\" value=\"3\" /></center></td>\n";
				$_SESSION["phq_" . $row['Sub_ID']] = "-1";
				$i++;             

	}// end while
		echo "</tr>\n"; //close table row.
	}
	else{
		echo "Query error!";
	}
	echo "</table></div><!--end div phq_section -->\n";
}
}
};

function phq_scoring($copy, $mysqli)
{

	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	
        
       // print_r($copy);

	$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="PHQ-9" AND type = "PHQ-cutoff"');
    $row = $result->fetch_assoc(); 
	$phq_score = $copy['phq_1'] + $copy['phq_2'] + $copy['phq_3'] + $copy['phq_4'] + $copy['phq_5'] + $copy['phq_6'] + $copy['phq_7'] + $copy['phq_8'] + $copy['phq_9'];
        if ($copy['phq_1'] <0|| $copy['phq_2'] <0|| $copy['phq_3'] <0|| $copy['phq_4'] <0 || $copy['phq_5'] <0 || $copy['phq_6'] <0 || $copy['phq_7'] <0 || $copy['phq_8'] <0 || $copy['phq_9']<0){
           
       
            echo "<tr>";
		echo '<td><p style = "text-align: left">
		The PHQ was unable to be scored due to incomplete responses.
		</p>';
        }
            else{
            if ($phq_score >= $row['cutoff_value'])
            { 
                    echo "<tr>";
                    echo '<td><p style = "color: red; text-align: left">
                    As scored by the PHQ, the patient shows signs of Depression.
                    </p>';
                    echo "SCORE: " . $phq_score; 
                    echo "/27. <br> <table id=\"phq_scoring_guide\" border=\"1\">
                    <tr><td>PHQ-9 Score</td><td>Severity</td><td>Treatment Recomendation<br>Patient preferences should be considered.</td></tr>
                    <tr><td>1-4</td><td>Minimal Symptoms<sup>*</sup></td><td>Support, educate to call if worse, <br> return in one month.</td></tr>
                    <tr><td>5-9</td><td>Mild Symptoms<sup>*</sup></td><td>Support, educate to call if worse, <br> return in one month.</td></tr>
                    <tr><td>10-14</td><td>Moderate Depression<sup>++</sup><br>Dysthymia<sup>*</sup><br>Major Depression, mild</td><td>Support, watchful waiting<br>Antidepressant or psychotherapy<br>Antidepressant or psychotherapy</td></tr>
                    <tr><td>15-19</td><td>Moderately severe</td><td>Antidepressant and psychotherapy</td></tr>
                    <tr><td>Greater than 20</td><td>Severe Depression</td><td>Antidepressant and psychotherapy<br>(especially if not improved on monotherapy)</td></tr>
                    </table>
                    <sup>*</sup> If symptoms present &ge; two years, then probable chronic depression which warrants antidepressants or psychotherapy (ask \"In the past 2 years have you felt
                            depressed or sad most days, even if you felt okay sometimes?\").<br>
                    <sup>++</sup> If symptoms present &ge; one month or severe functional impairment, consider active treatment.<br>
                    Source: Kroenke, K., & Spitzer, R. L. (2002). The PHQ-9: a new depression diagnostic and severity measure. Psychiatr Ann, 32(9), 1-7<br>
                    https://www.cqaimh.org/pdf/tool_phq9.pdf</td></tr>";
                    // Cutoff score recommended to be between 8 - 11.
                    // Total possible score is 27. 
            } else 
            {
                    echo "<tr>";
                    echo '<td><p style = "text-align: left">
                    As scored by the PHQ, the patient DOES NOT show signs of Depression.
                    </p>';
                    echo "SCORE: " . $phq_score; 
                    echo "/27. <br> <table id=\"phq_scoring_guide\" border=\"1\">
                    <tr><td>PHQ-9 Score</td><td>Severity</td><td>Treatment Recomendation<br>Patient preferences should be considered.</td></tr>
                    <tr><td>1-4</td><td>Minimal Symptoms<sup>*</sup></td><td>Support, educate to call if worse, <br> return in one month.</td></tr>
                    <tr><td>5-9</td><td>Mild Symptoms<sup>*</sup></td><td>Support, educate to call if worse, <br> return in one month.</td></tr>
                    <tr><td>10-14</td><td>Moderate Depression<sup>++</sup><br>Dysthymia<sup>*</sup><br>Major Depression, mild</td><td>Support, watchful waiting<br>Antidepressant or psychotherapy<br>Antidepressant or psychotherapy</td></tr>
                    <tr><td>15-19</td><td>Moderately severe</td><td>Antidepressant and psychotherapy</td></tr>
                    <tr><td>Greater than 20</td><td>Severe Depression</td><td>Antidepressant and psychotherapy<br>(especially if not improved on monotherapy)</td></tr>
                    </table>
                    <sup>*</sup> If symptoms present &ge; two years, then probable chronic depression which warrants antidepressants or psychotherapy (ask \"In the past 2 years have you felt
                            depressed or sad most days, even if you felt okay sometimes?\").<br>
                    <sup>++</sup> If symptoms present &ge; one month or severe functional impairment, consider active treatment.<br>
                    Source: Kroenke, K., & Spitzer, R. L. (2002). The PHQ-9: a new depression diagnostic and severity measure. Psychiatr Ann, 32(9), 1-7<br>
                    https://www.cqaimh.org/pdf/tool_phq9.pdf</td></tr>";
                    // Cutoff score recommended to be between 8 - 11.
                    // Total possible score is 27. 
            }
        
            }
};

function trend_phq($pt_id, $user_id)
{
	//1. Get the clinics that are in the user's group
	//2. Get the phq data for the pt where the patient id = $pt_id and $clinic_id in user's group.
	//3. Present the data over time.
	
}
?>
