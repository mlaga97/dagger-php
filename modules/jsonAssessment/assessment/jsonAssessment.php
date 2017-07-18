<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php');

foreach($jsonAssessments as $assessment) {

	// Assessment variables
	$types = $assessment["types"];
	$scoring = $assessment["scoring"];
	$metadata = $assessment["metadata"];
	$sections = $assessment["sections"];

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

		// Render sections
		foreach($sections as $section) {
			$questions = $section["questions"];

			// TODO: Remove array accesses from of conditionals
			// TODO: Are header and description duplicate functionality?

			// Show header if it exists
			if(array_key_exists("header", $section) || array_key_exists("preface", $section) ) {
				echo "<center>";

				if(array_key_exists("header", $section)) {
					echo "<br/><br/><strong>" . $section["header"] . "</strong><br/><br/>";
				}

				if(array_key_exists("preface", $section)) {

					// Ask Luc what he thinks about PHP requiring parentheses in the line below.
					echo "<br/><br/><br/>Questions " . $absoluteQuestionNumber . " - " . ($absoluteQuestionNumber + count($section["questions"]) - 1) . " should be prefaced with<br/><br/><br/>";
					echo "<div class='question_criteria'>" . $section["preface"] . "</div>";
				}

				echo "</center>";
			}

			// Show description if it exists
			if(array_key_exists("description", $section)) {
				echo "<br/>" . $section["description"] . "<br/>";
			}

			// Render Questions
			foreach($questions as $relativeQuestionNumber=>$question) {

				// Question related variables
				$id = $question["id"];
				$text = $question["text"];
				$typeName = $question["type"];

				// Type related variables
				$type = $types[$typeName];
				$class = $type["class"];
				$options = $type["options"];

				// Set empty value, if appropriate
				if(array_key_exists("emptyValue", $type)) {
					$_SESSION[$id] = $type["emptyValue"];
				}

				// Only display header if we are starting a new block of questions
				if($relativeQuestionNumber == 0 || !areFriends($types, $question, $questions[$relativeQuestionNumber-1])) {

					// Check if current class has a header to display
					if(array_key_exists("header", $questionClasses[$class])) {
						$questionClasses[$class]["header"]($options);
					}

				}

				// Render question
				$questionClasses[$class]["render"]($question, $relativeQuestionNumber, $absoluteQuestionNumber, $options);

				// Update absolute question number
				$absoluteQuestionNumber = $absoluteQuestionNumber + 1;

				echo "</tr>";
			}

			echo "</table>";
		}

		// End container
		echo "</div><!-- END " . $assessment["metadata"]["id"] . "_assessment_container-->";

	}
}
?>
