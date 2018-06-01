<?php
	/*
	 * Description: The Symptom Checklist is an instrument consisting of the eighteen DSM-IV-TR criteria.
	 * Six of the eighteen questions were found to be the most predictive of symptoms consistent with ADHD.
	 * These six questions are the basis for the ASRS v1.1 Screener and are also Part A of the Symptom Checklist.
	 * Part B of the Symptom Checklist contains the remaining twelve questions.
	 */

	function adhd_scoring($copy, $mysqli) {
		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}

		$result = $mysqli->query('SELECT * FROM questions WHERE classification="ADHD" AND adult=1 and Sub_ID>6');

		$adhd_score = 0;

		if($copy['adhd_1'] >= 2) {
			$adhd_score++;
		}
		if($copy['adhd_2'] >= 2) {
			$adhd_score++;
		}
		if($copy['adhd_3'] >= 2) {
			$adhd_score++;
		}
		if($copy['adhd_4'] >= 3) {
			$adhd_score++;
		}
		if($copy['adhd_5'] >= 3) {
			$adhd_score++;
		}
		if($copy['adhd_6'] >= 3) {
			$adhd_score++;
		}

		if($adhd_score >= 4) {
			echo '<p style = "color: red; text-align: left">';
			echo 'According to Adult ADHD Self-Report Scale (ASRS-v1.1) Symptom Checklist, the client shows evidence of ADHD.';
			echo '</p>';

			if($result) {
				$first = 0;

				while($row = $result->fetch_assoc()) {
					if($copy['adhd_'. $row['Sub_ID']] > 0) {
						//There was an response to the question

						if($first == 0) {
							//Write header info.
							echo "<p><b>Below are the questions and frequency of the client responses to Part B questions (question 7 and above).</b></p>";
							$first++;
							echo "<table id=\"adhd_affirmative_questions\" border=\"0\">\n";
						}

						echo "<tr><td>" . $row['question'] . ": " ;

						if($copy['adhd_'. $row['Sub_ID']] == 0 ) {
							echo "Never ";
						} else if ($copy['adhd_'. $row['Sub_ID']] == 1 ) {
							echo "Rarely ";
						} else if ($copy['adhd_'. $row['Sub_ID']] == 2 ) {
							echo "Sometimes ";
						} else if ($copy['adhd_'. $row['Sub_ID']] == 3 ) {
							echo "Often ";
						} else if ($copy['adhd_'. $row['Sub_ID']] == 4 ) {
							echo "Very Often ";
						}

						echo "</td></tr>";
					}
				}
			}
		} else {
			echo "<tr>";
			echo '<td><p "text-align: left">';
			echo 'According to Adult ADHD Self-Report Scale (ASRS-v1.1) Symptom Checklist, the client shows NO evidence of ADHD.';
			echo '</p>';
			echo "</tr>";
		}
		echo "</table>";
	}

?>