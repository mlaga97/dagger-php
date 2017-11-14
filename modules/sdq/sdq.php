<?php
//write_symptoms will get all the selected symptoms and place them and the response matrix on the page.
function write_sdq($type, $mysqli)
{
	global $i;

	//print_r($_SESSION);

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}

	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
		$query = 'SELECT * FROM questions WHERE classification="sdq" AND '.$type.'=1';
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
		if ($type=="Child"){
			echo "<div id=\"sdq_section\"><p>Please make the selection that best fits your child: (SDQ)</p>\n";
		}
		else{
			echo "<div id=\"sdq_section\"><p>Please make the selection that best fits you: (SDQ)</p>\n";
		}
	echo "<table id=\"sdq_questions\" border=\"1\">\n";
	echo "<tr class=\"sdq_row\"";
	echo ">";
	echo "<td class=\"sdq_scale_pad\"></td><td class=\"sdq_scale\"><center>Not True</center></td>\n";
	echo "<td class=\"sdq_scale\" ><center>Somewhat True</center></td>\n";
	echo "<td class=\"sdq_scale\" ><center>Certianly True</center></td>";
	echo "</tr>\n";

	if ($result){ //we got a result from the query
		while($row = $result->fetch_assoc()) {
                    echo "<tr class=\"sdq_row\"";
                    if ($i%2 == 0)
                            echo " style=\"background-color: #EFFBFB;\"";
                    echo ">";
                    echo "<td class=\"sdq_question\">" . $i . ". ";
                    echo $row['question'] . "</td>\n";
                    if ($row['Sub_ID'] == 7 or $row['Sub_ID'] == 21 or $row['Sub_ID'] == 25 or $row['Sub_ID'] == 11 or $row['Sub_ID'] == 14){ //There are a few questions with reverse scoring.
                        echo "<td class=\"gad_response\" id=\"sdq_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"sdq_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
                        echo "<td class=\"gad_response\" id=\"sdq_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"sdq_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
                        echo "<td class=\"gad_response\" id=\"sdq_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"sdq_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
                    } else {
                        echo "<td class=\"gad_response\" id=\"sdq_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"sdq_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
                        echo "<td class=\"gad_response\" id=\"sdq_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"sdq_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
                        echo "<td class=\"gad_response\" id=\"sdq_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"sdq_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
                    }
                    $_SESSION["sdq_" . $row['Sub_ID']] = "-1";
                    $i++;

                }// end while
		echo "</tr></table><br>\n"; //close table row.

                echo "<table id=\"sdq_fu_questions\" border=\"1\">\n";
                echo "<tr><td class=\"gad_scale_pad\"></td><td class=\"gad_scale\"><center>No</center></td>";
                echo "<td class=\"gad_scale\" ><center>Yes- minor difficulties</center></td><td class=\"gad_scale\" ><center>Yes- definite difficulties</center></td>";
                echo "<td class=\"gad_scale\" ><center>Yes- severe difficulties</center></td></tr>\n";
                echo "<tr class=\"gad_row\"" ;
                        if ($i%2 == 0)
                                echo "style=\"background-color: #EFFBFB;\"";
                echo ">\n";

                echo "<td class=\"gad_question\">" . $i . ". \n";
                echo "Overall, do you think your child has difficaulties in one or more of the following areas: emotions, concentration, behavior or being able to get along with other people?"  . "</td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_26-1\"><center><input type=\"radio\" name=\"sdq_26\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_26-2\"><center><input type=\"radio\" name=\"sdq_26\" value=\"1\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_26-3\"><center><input type=\"radio\" name=\"sdq_26\" value=\"2\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_26-4\"><center><input type=\"radio\" name=\"sdq_26\" value=\"3\" /></center></td>\n";
                $_SESSION['sdq_26'] = -1;
                $i++;


                echo "<tr class=\"gad_row\">" ;
                echo "<td class=\"gad_question\">\n";
                echo "If you answered yes to the previous question, please answer the following questions about these difficulties:</td>\n";
                echo "<td class=\"gad_scale\"><center>Less than a month</center></td>";
                echo "<td class=\"gad_scale\" ><center>1-5 months</center></td><td class=\"gad_scale\" ><center>6-12 months</center></td>";
                echo "<td class=\"gad_scale\" ><center>Over a year</center></td></tr>\n";


                echo "<tr class=\"gad_row\"" ;
                        if ($i%2 == 0)
                                echo "style=\"background-color: #EFFBFB;\"";
                echo ">\n";
                echo "<td class=\"gad_question\">" . $i . ". \n";
                echo "How long have these difficulties been present?</td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_27-1\"><center><input type=\"radio\" name=\"sdq_27\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_27-2\"><center><input type=\"radio\" name=\"sdq_27\"value=\"1\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_27-3\"><center><input type=\"radio\" name=\"sdq_27\"value=\"2\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_27-4\"><center><input type=\"radio\" name=\"sdq_27\"value=\"3\" /></center></td></tr>\n";
                $_SESSION['sdq_27'] = -1;
                $i++;

                echo "<tr class=\"gad_row\">" ;
                echo "<td class=\"gad_question\">\n";
                echo "</td>\n";
                echo "<td class=\"gad_scale\"><center>Not at all</center></td>";
                echo "<td class=\"gad_scale\" ><center>Only a little</center></td><td class=\"gad_scale\" ><center>Quite a lot</center></td>";
                echo "<td class=\"gad_scale\" ><center>A great deal</center></td></tr>\n";


                echo "<tr class=\"gad_row\"" ;
                        if ($i%2 == 0)
                                echo "style=\"background-color: #EFFBFB;\"";
                echo ">\n";
                echo "<td class=\"gad_question\">" . $i . ". \n";
                echo "Do the difficulties upset or distress your child?"  . "</td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_28-1\"><center><input type=\"radio\" name=\"sdq_28\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_28-2\"><center><input type=\"radio\" name=\"sdq_28\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_28-3\"><center><input type=\"radio\" name=\"sdq_28\" value=\"1\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_28-4\"><center><input type=\"radio\" name=\"sdq_28\" value=\"2\" /></center></td></tr>\n";
                $_SESSION['sdq_28'] = -1;
                $i++;

                echo "<tr class=\"gad_row\">" ;
                echo "<td class=\"gad_question\">\n";
                echo "Do the difficulties interfere with your child's everyday life in the following areas?"  . "</td>\n";
                echo "<td class=\"gad_scale\"><center>Not at all</center></td>";
                echo "<td class=\"gad_scale\" ><center>Only a little</center></td><td class=\"gad_scale\" ><center>Quite a lot</center></td>";
                echo "<td class=\"gad_scale\" ><center>A great deal</center></td></tr>\n";


                echo "<tr class=\"gad_row\"" ;
                        if ($i%2 == 0)
                                echo "style=\"background-color: #EFFBFB;\"";
                echo ">\n";
                echo "<td class=\"gad_question\">" . $i . ". \n";
                echo "HOME LIFE"  . "</td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_29-1\"><center><input type=\"radio\" name=\"sdq_29\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_29-2\"><center><input type=\"radio\" name=\"sdq_29\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_29-3\"><center><input type=\"radio\" name=\"sdq_29\" value=\"1\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_29-4\"><center><input type=\"radio\" name=\"sdq_29\" value=\"2\" /></center></td></tr>\n";
                $_SESSION['sdq_29'] = -1;
                $i++;

                echo "<tr class=\"gad_row\"" ;
                        if ($i%2 == 0)
                                echo "style=\"background-color: #EFFBFB;\"";
                echo ">\n";
                echo "<td class=\"gad_question\">" . $i . ". \n";
                echo "FRIENDSHIPS"  . "</td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_30-1\"><center><input type=\"radio\" name=\"sdq_30\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_30-2\"><center><input type=\"radio\" name=\"sdq_30\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_30-3\"><center><input type=\"radio\" name=\"sdq_30\" value=\"1\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_30-4\"><center><input type=\"radio\" name=\"sdq_30\" value=\"2\" /></center></td></tr>\n";
                $_SESSION['sdq_30'] = -1;
                $i++;

                echo "<tr class=\"gad_row\"" ;
                        if ($i%2 == 0)
                                echo "style=\"background-color: #EFFBFB;\"";
                echo ">\n";
                echo "<td class=\"gad_question\">" . $i . ". \n";
                echo "CLASSROOM LEARNING"  . "</td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_31-1\"><center><input type=\"radio\" name=\"sdq_31\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_31-2\"><center><input type=\"radio\" name=\"sdq_31\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_31-3\"><center><input type=\"radio\" name=\"sdq_31\" value=\"1\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_31-4\"><center><input type=\"radio\" name=\"sdq_31\" value=\"2\" /></center></td></tr>\n";
                $_SESSION['sdq_31'] = -1;
                $i++;

                echo "<tr class=\"gad_row\"" ;
                        if ($i%2 == 0)
                                echo "style=\"background-color: #EFFBFB;\"";
                echo ">\n";
                echo "<td class=\"gad_question\">" . $i . ". \n";
                echo "LEISURE ACTIVITIES"  . "</td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_32-1\"><center><input type=\"radio\" name=\"sdq_32\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_32-2\"><center><input type=\"radio\" name=\"sdq_32\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_32-3\"><center><input type=\"radio\" name=\"sdq_32\" value=\"1\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_32-4\"><center><input type=\"radio\" name=\"sdq_32\" value=\"2\" /></center></td></tr>\n";
                $_SESSION['sdq_32'] = -1;
                $i++;

                echo "<tr class=\"gad_row\"" ;
                        if ($i%2 == 0)
                                echo "style=\"background-color: #EFFBFB;\"";
                echo ">\n";
                echo "<td class=\"gad_question\">" . $i . ". \n";
                echo "Do the difficulties put a burden on you or the famliy as a whole?"  . "</td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_33-1\"><center><input type=\"radio\" name=\"sdq_33\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_33-2\"><center><input type=\"radio\" name=\"sdq_33\" value=\"0\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_33-3\"><center><input type=\"radio\" name=\"sdq_33\" value=\"1\" /></center></td>\n";
                echo "<td class=\"gad_response\" id=\"sdq_33-4\"><center><input type=\"radio\" name=\"sdq_33\" value=\"2\" /></center></td></tr>\n";
                $_SESSION['sdq_32'] = -1;
                $i++;
                echo "</table><br>\n";
	}
	else{
		echo "SDQ Query error!";
	}
	echo "</div><!--end div sdq_section -->\n";
    }
}
};

function sdq_scoring($copy, $mysqli){

    $error_message = "Unable to score subsection";
    $need_to_print_score = false;
    $emotional_symptom_score="Not Scored";
    $conduct_problem_score="Not Scored";
    $hyperactivity_score="Not Scored";
    $peer_problems_score="Not Scored";
    $prosocial_score="Not Scored";
    $impact_score="Not Scored";

    if ($copy['sdq_1'] != '-1'  and $copy['sdq_1'] != '' and
        $copy['sdq_4'] != '-1'  and $copy['sdq_4'] != '' and
        $copy['sdq_9'] != '-1'  and $copy['sdq_9'] != '' and
        $copy['sdq_17'] != '-1' and $copy['sdq_17'] != '' and
        $copy['sdq_20'] != '-1' and $copy['sdq_20'] != '')
        {
        $prosocial_score = $copy['sdq_1'] + $copy['sdq_4'] + $copy['sdq_9'] + $copy['sdq_17'] + $copy['sdq_20'];
        $need_to_print_score = true;
    } else
        {
        $prosocial_score = $error_message;
        }

    if ($copy['sdq_2'] != '-1'  and $copy['sdq_2'] != '' and
        $copy['sdq_10'] != '-1'  and $copy['sdq_10'] != '' and
        $copy['sdq_15'] != '-1'  and $copy['sdq_15'] != '' and
        $copy['sdq_21'] != '-1' and $copy['sdq_21'] != '' and
        $copy['sdq_25'] != '-1' and $copy['sdq_25'] != '')
        {
        $hyperactivity_score = $copy['sdq_2'] + $copy['sdq_10'] + $copy['sdq_15'] + $copy['sdq_21'] + $copy['sdq_25'];
        $need_to_print_score = true;
    } else
        {
        $hyperactivity_score = $error_message;
        }

   if ($copy['sdq_3'] != '-1'  and $copy['sdq_3'] != '' and
        $copy['sdq_8'] != '-1'  and $copy['sdq_8'] != '' and
        $copy['sdq_13'] != '-1'  and $copy['sdq_13'] != '' and
        $copy['sdq_16'] != '-1' and $copy['sdq_16'] != '' and
        $copy['sdq_24'] != '-1' and $copy['sdq_24'] != '')
        {
        $emotional_symptom_score = $copy['sdq_3'] + $copy['sdq_8'] + $copy['sdq_13'] + $copy['sdq_16'] + $copy['sdq_24'];
        $need_to_print_score = true;
    } else
        {
        $emotional_symptom_score = $error_message;
        }

     if ($copy['sdq_6'] != '-1'  and $copy['sdq_6'] != '' and
        $copy['sdq_11'] != '-1'  and $copy['sdq_11'] != '' and
        $copy['sdq_14'] != '-1'  and $copy['sdq_14'] != '' and
        $copy['sdq_19'] != '-1' and $copy['sdq_19'] != '' and
        $copy['sdq_23'] != '-1' and $copy['sdq_23'] != '')
        {
        $peer_problems_score = $copy['sdq_6'] + $copy['sdq_11'] + $copy['sdq_14'] + $copy['sdq_19'] + $copy['sdq_23'];
        $need_to_print_score = true;
    } else
        {
        $peer_problems_score = $error_message;
        }

        if ($copy['sdq_5'] != '-1'  and $copy['sdq_5'] != '' and
        $copy['sdq_7'] != '-1'  and $copy['sdq_7'] != '' and
        $copy['sdq_12'] != '-1'  and $copy['sdq_12'] != '' and
        $copy['sdq_18'] != '-1' and $copy['sdq_18'] != '' and
        $copy['sdq_22'] != '-1' and $copy['sdq_22'] != '')
        {
        $conduct_problem_score = $copy['sdq_5'] + $copy['sdq_7'] + $copy['sdq_12'] + $copy['sdq_18'] + $copy['sdq_22'];
        $need_to_print_score = true;
    } else
        {
        $conduct_problem_score = $error_message;
        }

        if ($copy['sdq_28'] != '-1'  and $copy['sdq_28'] != '' and
        $copy['sdq_29'] != '-1'  and $copy['sdq_29'] != '' and
        $copy['sdq_30'] != '-1'  and $copy['sdq_30'] != '' and
        $copy['sdq_31'] != '-1' and $copy['sdq_31'] != '' and
        $copy['sdq_32'] != '-1' and $copy['sdq_32'] != '')
        {
        $impact_score = $copy['sdq_28'] + $copy['sdq_29'] + $copy['sdq_30'] + $copy['sdq_31'] + $copy['sdq_32'];
        $need_to_print_score = true;
    } else
        {
        $impact_score = $error_message;
        }

        if ($need_to_print_score) { //need_to_print_score is true if any section of the assessment is scored.
	echo '<tr><td>';
	echo "<p><center><h3>Strengths and Difficulties Scoring (SDQ)</h3></center>";
        if ($emotional_symptom_score != $error_message and $conduct_problem_score != $error_message
                and $hyperactivity_score != $error_message and $peer_problems_score != $error_message and $prosocial_score != $error_message){
            $total = $emotional_symptom_score + $conduct_problem_score + $hyperactivity_score + $peer_problems_score;
            echo 'Total Difficulties Score: ' . $total  . '.<br>';
        } else {
            echo 'Total Difficulties Score could not be calculated because one or more section sub-scores could not be calculated.<br>';
        }
	echo 'Emotional Symptoms Score: ' . $emotional_symptom_score . '<br>' ;
	echo 'Conduct Problems Score: '. $conduct_problem_score . '<br>';
	echo 'Hyperactivity Score: ' . $hyperactivity_score . '<br>';
	echo 'Peer Problems Score: ' . $peer_problems_score . '<br>';
	echo 'Prosocial Score: ' . $prosocial_score . '<br>';
        echo 'Impact Suppliment Score: ' . $impact_score .'<br><br>';
        echo 'Total Difficulties Scoring: 0-13 is normal; 14-16 is borderline; 17-40 is abnormal.<br>';
        echo 'Emotional Symptoms Scoring: 0-2 is normal; 4 is borderline; 5-10 is abnormal. <br>';
        echo 'Conduct Problems Scoring: 0-2 is normal; 3 is borderline; 4-10 is abnormal.<br>';
        echo 'Hyperactivity Scoring: 0-5 is normal; 6 is borderline; 7-10 is abnormal.<br>';
        echo 'Peer Problems Scoring: 0-2 is normal; 3 is borderline; 4-10 is abnormal.<br>';
        echo 'Prosocial Behaviour Score: 6-10 is normal; 5 is borderline; 0-4 is abnormal.<br>';
        echo 'Impact Scoring: 2 or more is abnormal; a score of 1 is borderline; and a score of 0 is normal.';
	echo '</td></tr>';
	}
	else
	{
	echo '<tr><td>';
	echo "<p><center><h1>Strengths and Difficulties Scoring (SDQ)</h1></center>";
	echo '<br><br>The assessment was not scored due to incomplete responses.<br>';
	echo '</td></tr>';
	}
};
?>
