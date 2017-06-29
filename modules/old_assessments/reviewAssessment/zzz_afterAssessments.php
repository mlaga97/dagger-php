<?php
	global $mysqli, $copy;

	////////////////////////////////////Checks to see first if the phq-9 was published, second to see if they are at risk for suicide////////////
	$alert=false;
	if (isset($_SESSION['phq_check']) && ($_SESSION['phq_check']>0)) {
		if ($_SESSION['phq_9']>0) {
			$alert=true;
		}
	}
	if(isset($_SESSION['life_check'])&&($_SESSION['life_check']>0)) {
		if(($_SESSION['life_1']>0)||($_SESSION['life_2']>0)) {
			$alert=true;
		}
	}
	if($alert) {
		echo '<h2><p style = "color: red; text-align: left"><b>
			Warning, suicide consultation needed.
			</b></p></h2>';
		echo "<br>";
	}
	/////////////////////////////////////Printing our stressors////////////////////////////////////////
	// Removed ||($_SESSION['assessment_type'] == 'Child') condition - displaying when assessment not selected
	// Replaced with c_stress_check
	if($_SESSION['stress_check'] == 1 || $_SESSION['c_stress_check'] == 1) {
		$n = 1;
		$first = 0;
		$count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'stressor'");
		$count_no = $count->fetch_assoc();
		echo "<!-- Begin div stress scoring -->";
		echo "<div class='scoring'>";
		echo "<h3>Stressors</h3>";
		while($n <= $count_no['num']) {
			if(isset($_SESSION['s_' .$n])) {
				// Exclude NULL values from stressors
				// changed condition from > -1 to > 0
				if(($_SESSION['s_' .$n] > 0) && ($n!=30)) { // Stressor 30 is a special case
					$first++;
					if($first == 1) {
						echo "<div>The patient has stress due to</div>";
					}
					$result = $mysqli->query("SELECT question from questions where classification = 'stressor' and Sub_ID =  $n");
					$row = $result->fetch_assoc();
					echo $row['question'];
					echo "<br/>";
				}
			}
			$n++;
		}
		echo "<br>";
		$temp = $_SESSION['s_30'];
		if(($_SESSION['assessment_type']=='Child')&&($_SESSION['s_30']!="")) {
			echo "<b>The child noted the following stressful event:</b> ".$_SESSION['s_30']."<br>";
		}
		echo "</div><!-- End div stress scoring -->";
	}
	//////////////////////////////////Print our life events////////////////////////////////////////////////
	if($_SESSION['events_check'] == 1) {
		$n = 1;
		$first = 0;
		$count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'event'");
		$count_no = $count->fetch_assoc();
		echo "<!-- Begin div events_scoring -->";
		echo "<div class='scoring'>";
		echo "<h3>Events</h3>";
		while($n <= $count_no['num']) {
			// Exclude NULL values from events
			// changed condition from > -1 to > 0
			if($_SESSION['e_' .$n] > 0) {
				$first++;
				if($first == 1) {
					echo "The patient has been through the following events. ";
					echo "<ol>";
				}
				$result = $mysqli->query("SELECT question from questions where classification = 'event' and Sub_ID =  $n");
				$row = $result->fetch_assoc();
				echo "<li>" . $row['question'] . "</li>";
			}
			$n++;
		}
		echo "</ol>";
		echo "</div>";
	}


	//////////////////////////////////Print our health////////////////////////////////////////////////
	if($_SESSION['health_check'] == 1) {
		$n = 1;
		$first = 0;
		$count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'Health'");
		$count_no = $count->fetch_assoc();
		echo "<div class='scoring'>";
		echo "<h3>Health</h3>";
		while($n <= $count_no['num']) {
			// Exclude NULL values from health
			// changed condition from > -1 to > 0
			if($_SESSION['h_' .$n] > 0) {
				$first++;
				if($first == 1) {
					echo "The patient responded <i>Yes</i> to the following questions on health.";
					echo "<ol>";
				}
				$result = $mysqli->query("SELECT question from questions where classification = 'Health' and Sub_ID =  $n");
				$row = $result->fetch_assoc();
				echo "<li>" . $row['question'] . " <i>Yes</i> </li>";
			}
			$n++;
		}
		echo "</ol>";
		echo "</div>";
	}

	if($_SESSION['diagnosis_check'] == 1) {
		$n = 1;
		$first = 0;
		$count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'Diagnosis'");
		$count_no = $count->fetch_assoc();
		echo "<div class='scoring'>";
		echo "<h3>Diagnosis</h3>";
		while($n <= $count_no['num']) {
			$first++;
			if(($first == 1)&&(($_SESSION['diagnosis_1'] >0)||($_SESSION['diagnosis_2'] >0)||($_SESSION['diagnosis_3'] >0)||($_SESSION['diagnosis_4'] >0)||
					($_SESSION['diagnosis_5'] >0)||($_SESSION['diagnosis_6'] >0)||($_SESSION['diagnosis_7'] >0)||($_SESSION['diagnosis_8'] >0)||($_SESSION['diagnosis_9'] >0)||($_SESSION['diagnosis_10'] >0))) {
						echo "<b>The patient noted the following diagnoses. If the diagnosis is red, the patient stated the diagnosis was a reason for the office visit today. Discomfort scale is 0-4 (none to overwhelming)</b> ";
						echo "<br/>";
					}
					$result = $mysqli->query("SELECT question from questions where classification = 'Diagnosis' and Sub_ID =  $n");
					$row = $result->fetch_assoc();
					echo "";
					if ($_SESSION['diagnosis_' . $n] > 0){ //affirmative
						echo ' <span style = "color: red;">';
						echo $row['question'] . "</span>";
						if ($_SESSION['diagnosis_' . $n . "_3"] != 0) {
							echo ". The patient additionally noted the following level of discomfort or stress associated with the diagnosis: " . $_SESSION['diagnosis_' . $n . "_3"];
						}
						echo "<br/>";
					}
					$n++;
		}
		echo "</div><!-- End div for Diagnosis -->";
	}
	if ($_SESSION['diag_me_check'] == 1) {
		$n = 1;
		$first = 0;
		$count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'Diag_me'");
		$count_no = $count->fetch_assoc();
		echo "<div class='scoring'>";
		echo "<h3>Mental Health Diagnosis</h3>";
		while ($n <= $count_no['num']) {
			$first++;
			if (($first == 1)&&(($_SESSION['diag_me_1'] >0)||($_SESSION['diag_me_2'] >0)||($_SESSION['diag_me_3'] >0)||($_SESSION['diag_me_4'] >0)||
					($_SESSION['diag_me_5'] >0)||($_SESSION['diag_me_6'] >0)||($_SESSION['diag_me_7'] >0)||($_SESSION['diag_me_8'] >0)||($_SESSION['diag_me_9'] >0)||($_SESSION['diag_me_10'] >0))) {
						echo "<b>The patient noted the following diagnoses. Discomfort scale is 0-4 (none to overwhelming)</b> ";
						echo "<br/>";
					}
					$result = $mysqli->query("SELECT question from questions where classification = 'Diag_me' and Sub_ID =  $n");
					$row = $result->fetch_assoc();
					echo "";
					if ($_SESSION['diag_me_' . $n] > 0) { //affirmative
						echo ' <span style = "color: red;">';
						echo $row['question'] . "</span>";
						if ($_SESSION['diag_me_' . $n . "_3"] > 0) {
							echo ". The patient additionally noted the following level of discomfort or stress associated with the diagnosis: " . $_SESSION['diag_me_' . $n . "_3"];
						}
						echo "<br/>";
					}
					$n++;
		}
		echo "</div><!-- End div for Mental Health Diagnosis -->";
	}
	if ($_SESSION['grouping'] !== 10) {
		// fxns translate new input names to old DB fields -- fxn definitions in old_assessments/health.php
		score_chronic_health_reviewAssessment($_SESSION);
		score_questions_reviewAssessment($_SESSION);
	}
?>
