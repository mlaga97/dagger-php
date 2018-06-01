<?php
/*
* Maximum score = none.
* Scoring is as follows:
* 
* Two (2) or more affirmative responses indicates the client is a problem drinker.
*/

function dast_scoring($copy, $mysqli) {
	/*dast scoring
	0 = no problems
	1-2 = low level, re-assess at later date
	3-5 = moderate level, investigate further
	6-8 = substaintial level, intensive investigation
	9-10 = severe level, intensive investigation
	*/

	$dast_score = 	$copy['dast_1']+$copy['dast_2']+$copy['dast_3']+$copy['dast_4']+$copy['dast_5']+
					$copy['dast_6']+$copy['dast_7']+$copy['dast_8']+$copy['dast_9']+$copy['dast_10'];

	if ($dast_score > 0) {
		echo "<tr><td>";
		echo "<p style = \"color: red; text-align: left\"> As scored by the DAST-10, the patient shows signs of Substance Abuse. </p>";		
		echo "SCORE: ";
		echo $dast_score;
		echo "/10.<br> The cutoff is suggested to be 0-1 for no problems, 1-2 for low level, 3-5 for moderate level, 6-8 for substaintial level and 9-10 for severe level.";
		echo '<br><br>If an applicant/recipient meets the criteria for a positive screen (a score of 8 or more) on the AUDIT and/or
		the moderate level for the DAST-10, refer to the Qualified Substance Abuse Professional.';
		echo "</td></tr>";
	} else {
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
