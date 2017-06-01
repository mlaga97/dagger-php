<?php

$assessments = getUnmergedConfig($filename = "assessment.json");

// TODO: Make this look less like spaghetti and more like code.
foreach($assessments as $assessment) {
	if($_SESSION[$assessment["metadata"]["id"]]) {
		echo "<h3>" . $assessment["metadata"]["title"] . "</h3>";

		// TODO: Determine precedence of "questions" vs "sections"
		if(array_key_exists("questions", $assessment) && array_key_exists("sections", $assessment)) {
			echo "Error: an assessment.json file has both 'questions' and 'sections'";
		}

		// Show Responses
		if($assessment["metadata"]["scoring"]["viewAssessment"]["showResponses"]) {
			switch($assessment["metadata"]["scoring"]["reviewAssessment"]["responseFormat"]) {
				case "human_readable":
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
					break;
			}
		}

		// Show Score
		if($assessment["metadata"]["scoring"]["viewAssessment"]["showScore"]) {
			switch($assessment["metadata"]["scoring"]["reviewAssessment"]["scoreType"]) {
				case "sumOfValues":
					$total = 0;

					if(array_key_exists("questions", $assessment)) {
						foreach($assessment["questions"] as $question) {
							$total = $total + $_SESSION[$question["id"]];
						}
					}

					if(array_key_exists("sections", $assessment)) {
						foreach($assessment["sections"] as $section) {
							foreach($section["questions"] as $question) {
								$total = $total + $_SESSION[$question["id"]];
							}
						}
					}

					echo "Score: " . $total . "<hr/>";

					break;
				case "averageValue_excludingBlank":
					// TODO: Actually check if value is blank

					$total = 0;
					$count = 0;

					if(array_key_exists("questions", $assessment)) {
						foreach($assessment["questions"] as $question) {
							$total = $total + $_SESSION[$question["id"]];
							$count = $count + 1;
						}
					}

					if(array_key_exists("sections", $assessment)) {
						foreach($assessment["sections"] as $section) {
							foreach($section["questions"] as $question) {
								$total = $total + $_SESSION[$question["id"]];
								$count = $count + 1;
							}
						}
					}

					echo "Score: " . $total/$count . "<hr/>";
					break;
			}
		}
	}
}
?>
