<?php

$pageName = "reviewAssessment";

$assessments = getUnmergedConfig($filename = "assessment.json");

function showScore($assessment, $scoreType) {
	switch($scoreType) {
		case "sumOfValues":
			$scorable = true;
			$total = 0;
			$unanswered = 0;

			if(array_key_exists("questions", $assessment)) {
				foreach($assessment["questions"] as $question) {
					// TODO: Is array_key_exists and check -1 redundant?
					if(array_key_exists($question["id"], $_SESSION)) {
						if($_SESSION[$question["id"]] != -1) {
							$total = $total + $_SESSION[$question["id"]];
						} else {
							$unanswered = $unanswered + 1;
						}
					} else {
						$unanswered = $unanswered + 1;
					}
				}
			}

			if(array_key_exists("sections", $assessment)) {
				foreach($assessment["sections"] as $section) {
					foreach($section["questions"] as $question) {
						// TODO: Is array_key_exists and check -1 redundant?
						if(array_key_exists($question["id"], $_SESSION)) {
							if($_SESSION[$question["id"]] != -1) {
								$total = $total + $_SESSION[$question["id"]];
							} else {
								$unanswered = $unanswered + 1;
							}
						} else {
							$unanswered = $unanswered + 1;
						}
					}
				}
			}

			if(array_key_exists("unscorableTriggers", $assessment["scoring"])) {
				foreach($assessment["scoring"]["unscorableTriggers"] as $trigger) {
					switch($trigger["type"]) {
						case "maxUnanswered":
							if($unanswered > $trigger["value"]) {
								$scorable = false;
							}
							break;
					}
				}
			}


			if(array_key_exists("maxUnanswered", $assessment["scoring"]) && $assessment["scoring"]["maxUnanswered"] <= $unanswered) {
				$scorable = false;
			}

			if($scorable) {
				echo "Score: " . $total . "<hr/>";
			} else {
				echo "Could not score assessment!<hr/>";
			}

			break;
		case "averageValue_excludingBlank":
			$total = 0;
			$count = 0;

			if(array_key_exists("questions", $assessment)) {
				foreach($assessment["questions"] as $question) {
					if($_SESSION[$question["id"]] != -1) {
						echo $question["id"] . ": " . $_SESSION[$question["id"]] . "<br/>";
						$total = $total + $_SESSION[$question["id"]];
						$count = $count + 1;
					}
				}
			}

			if(array_key_exists("sections", $assessment)) {
				foreach($assessment["sections"] as $section) {
					foreach($section["questions"] as $question) {
						if($_SESSION[$question["id"]] != -1) {
							$total = $total + $_SESSION[$question["id"]];
							$count = $count + 1;
						}
					}
				}
			}

			echo "Score: " . $total/$count . "<hr/>";
			break;
		case "categoricalAverages_excludingBlank":
			foreach($assessment["scoring"]["categoricalAverages"] as $category => $keys) {
				$total = 0;
				$count = 0;

				foreach($keys as $key) {
					if($_SESSION[$key] != -1) {
						$total = $total + $_SESSION[$key];
						$count = $count + 1;
					}
				}

				echo $category . " subscore: " . $total/$count . "<br/>";
			}
			echo "<hr/>";
			break;
	}
}

// TODO: Make this look less like spaghetti and more like code.
foreach($assessments as $assessment) {
	if($_SESSION[$assessment["metadata"]["id"]]) {
		echo "<h3>" . $assessment["metadata"]["title"] . "</h3>";

		// TODO: Determine precedence of "questions" vs "sections"
		if(array_key_exists("questions", $assessment) && array_key_exists("sections", $assessment)) {
			echo "Error: an assessment.json file has both 'questions' and 'sections'";
		}

		// Show Responses
		if($assessment["scoring"][$pageName]["showResponses"]) {
			switch($assessment["scoring"][$pageName]["responseFormat"]) {
				case "human_readable":
					if(array_key_exists("questions", $assessment)) {
						echo "<table><tr><th>Question</th><th>Response</th></tr>";
						foreach($assessment["questions"] as $question) {
							// TODO: Is array_key_exists and check -1 redundant?
							if(array_key_exists($question["id"], $_SESSION)) {
								if($_SESSION[$question["id"]] == -1) {
									echo "<tr><td>" . $question["text"] . "</td><td>" . "No Response" . "</td></tr>";
								} else {
									echo "<tr><td>" . $question["text"] . "</td><td>" . array_search($_SESSION[$question["id"]], $assessment["types"][$question["type"]]["options"]) . "</td></tr>";
								}
							} else {
								echo "<tr><td>" . $question["text"] . "</td><td>" . "No Response" . "</td></tr>";
							}
						}
						echo "</table><hr/>";
					}

					if(array_key_exists("sections", $assessment)) {
						echo "<table><tr><th>Question</th><th>Response</th></tr>";
						foreach($assessment["sections"] as $section) {
							foreach($section["questions"] as $question) {
								// TODO: Is array_key_exists and check -1 redundant?
								if(array_key_exists($question["id"], $_SESSION)) {
									if($_SESSION[$question["id"]] == -1) {
										echo "<tr><td><ol start='" . substr($question["id"], strpos($question["id"], "_") + 1) . "'><li>" . $question["text"] . "</li></ol></td><td>" . "No Response" . "</td></tr>";
									} else {
										echo "<tr><td><ol start='" . substr($question["id"], strpos($question["id"], "_") + 1) . "'><li>" . $question["text"] . "</li></ol></td><td>" . array_search($_SESSION[$question["id"]], $assessment["types"][$question["type"]]["options"]) . "</td></tr>";
									}
								} else {
									echo "<tr><td><ol start='" . substr($question["id"], strpos($question["id"], "_") + 1) . "'><li>" . $question["text"] . "</li></ol></td><td>" . "No Response" . "</td></tr>";
								}
							}
						}
						echo "</table><hr/>";
					}
					break;
			}
		}

		// Show Score
		if($assessment["scoring"][$pageName]["showScore"]) {
			if(gettype($assessment["scoring"][$pageName]["scoreType"]) == "array") {
				foreach($assessment["scoring"][$pageName]["scoreType"] as $scoreType) {
					showScore($assessment, $scoreType);
				}
			} else {
				showScore($assessment, $assessment["scoring"][$pageName]["scoreType"]);
			}
		}
	}
}
?>
