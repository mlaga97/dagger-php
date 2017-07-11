<?php

global $scoreClasses;

$scoreClasses["averageValue_excludingBlank"] = function($assessment, $questions, &$absoluteQuestionNumber) {
	$total = 0;
	$count = 0;

	foreach($questions as $question) {
		if($_SESSION[$question["id"]] != -1) {
			echo $question["id"] . ": " . $_SESSION[$question["id"]] . "<br/>";
			$total = $total + $_SESSION[$question["id"]];
			$count = $count + 1;
		}
	}

	// Output result
	echo "<tr><td>" . $assessment["metadata"]["title"] . " Score </td><td class='score'>" . round(($total/$count), 2) . "</td></tr>";
};

?>