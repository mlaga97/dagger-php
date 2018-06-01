<?php
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
