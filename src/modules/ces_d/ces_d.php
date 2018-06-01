<?php
	//write_ces_d_ will get all the selected ces_d_ questions and place them and the response matrix on the page.

	function ces_d_scoring($copy, $mysqli) {
		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="CES-D" AND type = "CES-cutoff"');
		$row = $result->fetch_assoc();
		$ces_d_score = $copy['ces_d_1'] + $copy['ces_d_2'] + $copy['ces_d_3'] + $copy['ces_d_4'] + $copy['ces_d_5'] + $copy['ces_d_6'] + $copy['ces_d_7'] + $copy['ces_d_8'] + $copy['ces_d_9'] + $copy['ces_d_10'] +
		$copy['ces_d_11'] + $copy['ces_d_12'] + $copy['ces_d_13'] + $copy['ces_d_14'] + $copy['ces_d_15'] + $copy['ces_d_16'] + $copy['ces_d_17'] + $copy['ces_d_18'] + $copy['ces_d_19'] + $copy['ces_d_20'];
		if ($ces_d_score >= $row['cutoff_value']) {
			// Need to know what cut-off is. 
			echo "<tr>";
			echo '<td><p style ="color: red; text-align: left">
			As scored by the CES-D, the patient shows signs of Depression.
			</p>';
			echo "SCORE: " . $ces_d_score;
			echo "/60. <br> The cutoff score is suggested to be ".$row['cutoff_value']."<br></td></tr>";
			// possible 60, cutoff is 16.
		} else {
			echo "<tr>";
			echo '<td><p text-align: left">
			As scored by the CES-D, the patient DOES NOT show signs of Depression.
			</p>';
			echo "SCORE: " . $ces_d_score;
			echo "/60. <br> The cutoff score is suggested to be ".$row['cutoff_value']."<br></td></tr>";
		}
	};
?>