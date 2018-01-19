<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php');

// Render different content depending on whether we are reviewing or viewing
$pageNames = array(
	"/viewAssessment.php" => "viewAssessment",
	"/reviewAssessment.php" => "reviewAssessment"
);
$pageName = $pageNames[$_SESSION["previous"]];

// TODO: Document
foreach($jsonAssessments as $assessment) {

	// Assessment variables
	$metadata = $assessment["metadata"];
	$sections = $assessment["sections"];
	$questions = getQuestions($assessment);

	// Metadata variables
	$id = $metadata["id"];
	$title = $metadata["title"];

	// Scoring variables
	$showScore = $assessment["scoring"][$pageName]["showScore"];
	if($showScore) {
		$scoreTypes = $assessment["scoring"][$pageName]["scoreType"];
	}
	$showResponses = $assessment["scoring"][$pageName]["showResponses"];
	if($showResponses) {
		$responseClass = $assessment["scoring"][$pageName]["responseFormat"];
	}

	// Local variables
	$absoluteQuestionNumber = 1;

	// Only show if the assessment was selected
	if(array_key_exists($id, $_SESSION) && $_SESSION[$id]) {

		// Begin container
		echo "<div id='" . $id . "_reviewAssessment_container' class='jsonAssessment'>";

		// Show assessment title
		echo "<h3>" . $title . "</h3>";

		// Responses
		if($showResponses) {
			echo "<table><tr><th>Question</th><th>Response</th></tr>";

			// Render sections
			foreach($sections as $section) {

				// Show preface
				if(array_key_exists("preface", $section)) {
					echo "<tr><td colspan=2>" . $section["preface"] . "</td><tr>";
				}

				// Render questions
				foreach($section["questions"] as $question) {

					// Question variables
					$id = $question["id"];
					$text = $question["text"];
					$type = $question["type"];

					// Type variables
					$questionType = $assessment["types"][$type];
					$class = $questionType["class"];
					$options = $questionType["options"];
					$emptyValue = $questionType["emptyValue"];
					if(array_key_exists("responseSuffix", $questionType)) {
						$responseSuffix = $questionType["responseSuffix"];
					}

					// Other variables
					$rawAnswer = $_SESSION[$id];

					// Calculate answer
					// TODO: Add suffixes back
					if(array_key_exists($id, $_SESSION)) {
						if(array_key_exists("parseResponse", $questionClasses[$class])) {
							$answer = $questionClasses[$class]["parseResponse"]($rawAnswer, $questionType);
						} else {
							$answer = $rawAnswer;
						}
					} else {
						$answer = "No Response";
					}

					// Show question
					echo "<tr><td><ol start='" . $absoluteQuestionNumber . "'><li>" . $text . "</li></ol></td><td class='score'>" . $answer . "</td></tr>";

					// Increment counter
					$absoluteQuestionNumber = $absoluteQuestionNumber + 1;

				}
			}

			echo "</table>";
		}

		// Score
		if($showScore) {
			echo "<table>";

			// Allow assessment to use multiple scoring methods
			if(gettype($scoreTypes) == "array") {
				foreach($scoreTypes as $scoreType) {
					$scoreClasses[$scoreType]($assessment, $questions, $absoluteQuestionNumber);
					$absoluteQuestionNumber = $absoluteQuestionNumber + 1;
				}
			} else {
				$scoreClasses[$scoreTypes]($assessment, $questions, $absoluteQuestionNumber);
				$absoluteQuestionNumber = $absoluteQuestionNumber + 1;
			}

			// Print notes below score
			if(array_key_exists("notes", $metadata)) {
				echo "<tr><td colspan='2' class='notes'>" . $metadata["notes"] . "</td></tr>";
			}

			echo "</table>";
		}

		// End container
		echo "</div><hr/><!-- END " . $id . "_reviewAssessment_container-->";
	}
}

?>
