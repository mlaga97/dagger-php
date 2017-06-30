<?php

$pageName = "viewAssessment";

$assessments = getUnmergedConfig($filename = "assessment.json");

/******************************************************************************
*******************************************************************************
******************************************************************************/

$scoreClasses = array(
	"sumOfValues" => function($assessment, $questions) {
		$scorable = true;
		$total = 0;
		$unanswered = 0;

		foreach($questions as $question) {
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

		// Output result
		echo "<tr><td>" . $assessment["metadata"]["title"];
		if($scorable) {
			echo " Score </td><td class='score'>" . $total;
		} else {
			echo " cannot be scored due to an insufficient number of responses.";
		}
		echo "</td></tr>";
	},
	"averageValue_excludingBlank" => function($assessment, $questions) {
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
	},
	"categoricalAverages_excludingBlank" => function($assessment, $questions) {
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
	}
);

/******************************************************************************
*******************************************************************************
******************************************************************************/

$responseClasses = array(
	"human_readable" => function($question, $assessment) {
		echo "<tr><td><ol start='" . substr($question["id"], strpos($question["id"], "_") + 1) . "'><li>" . $question["text"] . "</li></ol></td><td class='score'>";

		// TODO: Is array_key_exists and check -1 redundant?
		if(array_key_exists($question["id"], $_SESSION) && $_SESSION[$question["id"]] != -1) {
			echo array_search($_SESSION[$question["id"]], $assessment["types"][$question["type"]]["options"]);
		} else {
			echo "No Response";
		}

		echo "</td></tr>";
	}
);

/******************************************************************************
*******************************************************************************
******************************************************************************/

function getQuestions($assessment) {
	$questions = array();

	if(array_key_exists("questions", $assessment)) {
		foreach($assessment["questions"] as $question) {
			array_push($questions, $question);
		}
	}

	if(array_key_exists("sections", $assessment)) {
		foreach($assessment["sections"] as $section) {
			foreach($section["questions"] as $question) {
				array_push($questions, $question);
			}
		}
	}

	return $questions;
}

/******************************************************************************
*******************************************************************************
******************************************************************************/

// TODO: Make this look less like spaghetti and more like code.
foreach($assessments as $assessment) {

	// Assessment variables
	$metadata = $assessment["metadata"];
	$questions = getQuestions($assessment);

	// Metadata variables
	$id = $metadata["id"];
	$notes = $metadata["notes"];
	$title = $metadata["title"];

	// Scoring variables
	$showScore = $assessment["scoring"][$pageName]["showScore"];
	$scoreTypes = $assessment["scoring"][$pageName]["scoreType"];
	$showResponses = $assessment["scoring"][$pageName]["showResponses"];
	$responseClass = $assessment["scoring"][$pageName]["responseFormat"];

	// Only show if the assessment was selected
	if($_SESSION[$id]) {

		// Header
		echo "<div id='" . $id . "_reviewAssessment_container' class='jsonAssessment'>";
		echo "<h3>" . $title . "</h3>";

		// Responses
		if($showResponses) {
			echo "<table><tr><th>Question</th><th>Response</th></tr>";

			// Call handler for each question
			foreach($questions as $question) {
				$responseClasses[$responseClass]($question, $assessment);
			}

			echo "</table>";
		}

		// Score
		if($showScore) {
			echo "<table>";

			// Allow assessment to use multiple scoring methods
			if(gettype($scoreTypes) == "array") {
				foreach($scoreTypes as $scoreType) {
					$scoreClasses[$scoreType]($assessment, $questions);
				}
			} else {
				$scoreClasses[$scoreTypes]($assessment, $questions);
			}

			// Print notes below score
			if(array_key_exists("notes", $metadata)) {
				echo "<tr><td colspan='2' class='notes'>" . $notes . "</td></tr>";
			}

			echo "</table>";
		}

		// Footer
		echo "</div><!-- END " . $id . "_reviewAssessment_container-->";
	}
}
?>
