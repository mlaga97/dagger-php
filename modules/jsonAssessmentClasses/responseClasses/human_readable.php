<?php

global $responseClasses;

$responseClasses["human_readable"] = function($question, $assessment, $absoluteQuestionNumber) {

	// Show question
	echo "<tr><td><ol start='" . $absoluteQuestionNumber . "'><li>" . $question["text"] . "</li></ol></td><td class='score'>";

	// TODO: Is array_key_exists and check -1 redundant?
	if(array_key_exists($question["id"], $_SESSION) && $_SESSION[$question["id"]] != -1) {
		echo array_search($_SESSION[$question["id"]], $assessment["types"][$question["type"]]["options"]);

		// Show suffix
		if(array_key_exists("responseSuffix", $assessment["types"][$question["type"]])) {
			echo " " . $assessment["types"][$question["type"]]["responseSuffix"];
		}
	} else {
		echo "No Response";
	}

	echo "</td></tr>";
};

?>