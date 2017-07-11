<?php

global $scoreClasses;

$scoreClasses["categoricalAverages_excludingBlank"] = function($assessment, $questions, &$absoluteQuestionNumber) {
	echo "<tr><th>Category</th><th>Score</th></tr>";

	foreach($assessment["scoring"]["categoricalAverages"] as $category => $keys) {
		$total = 0;
		$count = 0;

		foreach($keys as $key) {
			if($_SESSION[$key] != -1) {
				$total = $total + $_SESSION[$key];
				$count = $count + 1;
			}
		}

		// Output result
		echo "<tr><td>" . $category . "</td><td class='score'>" . round(($total/$count), 2) . "</td></tr>";
	}
};

?>