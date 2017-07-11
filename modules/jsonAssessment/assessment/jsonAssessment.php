<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php');

$assessments = getUnmergedConfig($filename = "assessment.json");

foreach($assessments as $assessment) {
	// Assessment variables
	$types = $assessment["types"];
	$scoring = $assessment["scoring"];
	$metadata = $assessment["metadata"];

	// Metadata variables
	$id = $metadata["id"];
	$text = $metadata["text"];
	$class = $metadata["class"];
	$notes = $metadata["notes"];
	$title = $metadata["title"];

	// Local variables
	$absoluteQuestionNumber = 1;

	// Only render when assessment has been selected
	if($_SESSION[$id]) {

		// Begin container
		echo "<div class='jsonAssessment " . $class . "'>";

		// Show assessment title
		echo "<h3>" . $title . "</h3>";

		// TODO: Determine precedence of "questions" vs "sections"
		if(array_key_exists("questions", $assessment) && array_key_exists("sections", $assessment)) {
			echo "Error: an assessment.json file has both 'questions' and 'sections'";
		}

		// Render questions
		if(array_key_exists("questions", $assessment)) {
			renderQuestionSection($assessment["questions"], $types, $questionClasses, $absoluteQuestionNumber);
		}

		// Render sections
		if(array_key_exists("sections", $assessment)) {
			foreach($assessment["sections"] as $section) {

				// Render questions
				renderQuestionSection($section["questions"], $types, $questionClasses, $absoluteQuestionNumber);

			}
		}

		// End container
		echo "</div><!-- END " . $assessment["metadata"]["id"] . "_assessment_container-->";

	}
}
?>
