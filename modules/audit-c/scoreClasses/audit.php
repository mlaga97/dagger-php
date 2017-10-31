<?php

global $scoreClasses;

$scoreClasses['audit-c'] = function($assessment, $questions, &$absoluteQuestionNumber) {
	$total = 0;
	$count = 0;

	foreach($questions as $question) {
		if($_SESSION[$question['id']] != -1) {
			$total = $total + $_SESSION[$question['id']];
			$count = $count + 1;
		}
	}

	// TODO: This is an unreliable way of finding this, find a better way
	$scoringThreshold = $_SESSION['demographics_gender'] == 'Male' ? 4 : 3;

	// Output result
	echo '<tr><td>' . $assessment['metadata']['title'] . ' Score </td><td class="score">' . $total . '</td></tr>';
	echo '<tr><td colspan="2">The patient ' . ($total > $scoringThreshold ? 'shows' : 'DOES NOT show') . ' signs of Substance Abuse. The cutoff is suggested to be be 4 for men and 3 for women.' . '</td></tr>';
};

?>