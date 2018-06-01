<?php

global $scoreClasses;

$scoreClasses['cage'] = function($assessment, $questions, &$absoluteQuestionNumber) {
	$total = 0;
	$count = 0;

	foreach($questions as $question) {
		if($_SESSION[$question['id']] != -1) {
			$total = $total + $_SESSION[$question['id']];
			$count = $count + 1;
		}
	}

	// Set scoring threshold
	$scoringThreshold = 2;

	// Output result
	echo '<tr><td>' . $assessment['metadata']['title'] . ' Score </td><td class="score">' . $total . '</td></tr>';
	echo '<tr><td colspan="2">The patient ' . ($total > $scoringThreshold ? 'shows' : 'DOES NOT show') . ' signs of Substance Abuse. The cutoff is suggested to be greater than 2.' . '</td></tr>';
};

?>
