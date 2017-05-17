<?php

$assessments = getUnmergedConfig($filename = "assessment.json");

foreach($assessments as $assessment) {
	echo "<h3>" . $assessment["metadata"]["title"] . "</h3>";

	// TODO: Determine precedence of "questions" vs "sections"
	if(array_key_exists("questions", $assessment) && array_key_exists("sections", $assessment)) {
		echo "Error: an assessment.json file has both 'questions' and 'sections'";
	}

	if(array_key_exists("questions", $assessment)) {
		echo "<table><tr><th>Question</th><th>Response</th></tr>";
		foreach($assessment["questions"] as $question) {
			echo "<tr><td>" . $question["text"] . "</td><td>" . array_search($_SESSION[$question["id"]], $assessment["types"][$question["type"]]["options"]) . "</td></tr>";
		}
		echo "</table><hr/>";
	}

	if(array_key_exists("sections", $assessment)) {
		echo "<table><tr><th>Question</th><th>Response</th></tr>";
		foreach($assessment["sections"] as $section) {
			foreach($section["questions"] as $question) {
				echo "<tr><td>" . $question["text"] . "</td><td>" . array_search($_SESSION[$question["id"]], $assessment["types"][$question["type"]]["options"]) . "</td></tr>";
			}
		}
		echo "</table><hr/>";
	}
}
?>
