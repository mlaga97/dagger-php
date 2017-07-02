<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php');

// Render different content depending on whether we are reviewing or viewing
$pageNames = array(
	"/viewAssessment.php" => "viewAssessment",
	"/reviewAssessment.php" => "reviewAssessment"
);
$pageName = $pageNames[$_SESSION["previous"]];

// Retrieve all of our assessments
$assessments = getUnmergedConfig($filename = "assessment.json");

// TODO: Document
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
