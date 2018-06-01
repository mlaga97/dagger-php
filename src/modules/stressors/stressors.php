<?php
//This scores the continum scale of stress level. There is no cut-off for the individual stressors.
function stressors_scoring($copy, $mysqli) {
	$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="stressor" AND type = "stressor-cutoff"');
	$row = $result->fetch_assoc();
	// If there is no stress in the array, set the value == -1.
	if (!array_key_exists('stress', $copy)) {
		$copy['stress'] = -1;
	}

	if($copy['stress'] >= $row['cutoff_value']) {
		echo "<tr>";
		echo '<td><p style = "color: red; text-align: left">
		The patient shows signs of stress.
		</p>';
		echo "SCORE: " . $copy['stress'];
		echo "/10. The cutoff is suggested to be at 6 for high stress.<br></td>";
		echo "</tr>";
	} else {
		echo "<tr>";
		echo '<td><p style = "text-align: left">
		The patient stress level is below cutoff value.
		</p>';
		echo "SCORE: " . $copy['stress'];
		echo "/10. The cutoff is suggested to be at 6 for high stress.<br></td>";
		echo "</tr>";
	}
};
?>
