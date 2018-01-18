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
	$title = $metadata["title"];

	// Local variables
	$absoluteQuestionNumber = 1;

	// Only render when assessment has been selected
	// TODO: Add the key as 'false' if not doing it?
	if(array_key_exists($id, $_SESSION) && $_SESSION[$id]) {

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
			$relativeQuestionNumber = 0;
			foreach($questions as $questionIndex=>$question) {

				// Question related variables
				$id = $question["id"];
				$text = $question["text"];

				// Type related variables
				if(is_array($question['type'])) {
					// Anonymous type
					$type = $question['type'];
				} else {
					// Referenced type
					$typeName = $question['type'];
					$type = $types[$typeName];
				}
				
				// Type class
				$class = $type["class"];

				// Check showOnly
				// TODO: There _HAS_ to be a better way.
				if(
					!array_key_exists("showOnly", $question) || (
						array_key_exists("showOnly", $question) && (
							($_SESSION['assessment_type'] == 'Adult' && $question["showOnly"] == "adult")
							||
							($_SESSION['assessment_type'] == 'Child' && $question["showOnly"] == "child")
						)
					)
				) {
					// Set empty value, if appropriate
					if(array_key_exists("emptyValue", $type)) {
						$_SESSION[$id] = $type["emptyValue"];
					}

					// Only display header if we are starting a new block of questions
					if($relativeQuestionNumber == 0 || !areFriends($types, $question, $questions[$questionIndex-1])) {

						// Check if current class has a header to display
						if(array_key_exists("header", $questionClasses[$class])) {
							$questionClasses[$class]["header"]($type);
						}

					}

					// Render question
					$questionClasses[$class]["render"]($question, $questionIndex, $absoluteQuestionNumber, $type);

					// Update absolute question number
					$relativeQuestionNumber = $relativeQuestionNumber + 1;
					$absoluteQuestionNumber = $absoluteQuestionNumber + 1;

					echo "</tr>";
				}
			}

			echo "</table>";
		}

		// End container
		echo "</div><hr/><!-- END " . $assessment["metadata"]["id"] . "_assessment_container-->";

	}
}
?>
