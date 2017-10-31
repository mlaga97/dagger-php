<?php

global $scoreClasses;

$scoreClasses['gad'] = function($assessment, $questions, &$absoluteQuestionNumber) {
	$total = 0;
	$count = 0;

	foreach($questions as $question) {
		if($_SESSION[$question['id']] != -1) {
			$total = $total + $_SESSION[$question['id']];
			$count = $count + 1;
		}
	}

	// Set scoring threshold
	$scoringThreshold = 5;

	// Output result
	echo '<tr><td>' . $assessment['metadata']['title'] . ' Score </td><td class="score">' . $total . '</td></tr>';
	echo '<tr><td colspan="2">The patient ' . ($total >= $scoringThreshold ? 'shows' : 'DOES NOT show') . ' signs of Anxiety. The cutoff is suggested to be 5 for mild anxiety, 10 for moderate anxiety, and 21 for severe anxiety.' . '</td></tr>';
};

?>
