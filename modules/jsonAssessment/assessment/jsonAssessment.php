<?php

// Handlers for various question classes
$questionClasses = array(
	"radioOptions" => array(
		"render" => function($question, $questionNumber, $options) {
			echo "<table><tr><td><ol start='" . substr($question["id"], strpos($question["id"], "_") + 1) . "'><li>" . $question["text"] . "</li></ol>";
			foreach($options as $optionText => $value) {
				echo "<label><input type='radio' name='" . $question["id"] . "' value='" . $value . "' />" . $optionText . "</label><br/>";
			}
			echo "</td></tr></table>";
		}
	),
	"radioScale" => array(
		"header" => function($options) {
			echo "<table><tr><th>Question</th>";
			foreach($options as $optionText => $value) {
				echo "<th>" . $optionText . "</th>";
			}
			echo "</tr>";
		},
		"render" => function($question, $questionNumber, $options) {
			if($questionNumber == 0) {
				echo "<br/>";
			}
			echo "<tr><td><ol start='" . substr($question["id"], strpos($question["id"], "_") + 1) . "'><li>" . $question["text"] . "</li></ol></td>";
			foreach($options as $optionText => $value) {
				echo "<td><center><label class='radio_caption'><br/><input type='radio' name='" . $question["id"] . "' value='" . $value . "' /><br/>" . $optionText . "</label></center></td>";
			}
		}
	)
);

/******************************************************************************
*******************************************************************************
******************************************************************************/


function areFriends($types, $question1, $question2) {

	// Check if questions have same type
	if($question1["type"] == $question2["type"]) {
		return true;
	}

	// Check if question 1 has question 2 as a friend
	if(array_key_exists("friends", $types[$question1["type"]])) {
		if(in_array($question2["type"], $types[$question1["type"]]["friends"])) {
			return true;
		}
	}

	// Check if question 2 has question 1 as a friend
	if(array_key_exists("friends", $types[$question2["type"]])) {
		if(in_array($question1["type"], $types[$question2["type"]]["friends"])) {
			return true;
		}
	}

	// They aren't friends! (;_;)
	return false;

}

function renderQuestionSection($questions, $types, $classes) {

	foreach($questions as $questionNumber=>$question) {

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
		if($questionNumber == 0 || !areFriends($types, $question, $questions[$questionNumber-1])) {

			// Check if current class has a header to display
			if(array_key_exists("header", $questionTypeHandlers[$class])) {
				$questionTypeHandlers[$class]["header"]($options);
			}

		}

		// Render question
		$questionTypeHandlers[$class]["render"]($question, $questionNumber, $options);

		echo "</tr>";

	}

	echo "</table>";

}

/******************************************************************************
*******************************************************************************
******************************************************************************/

$assessments = getUnmergedConfig($filename = "assessment.json");

foreach($assessments as $assessment) {
	# Assessment variables
	$types = $assessment["types"];
	$scoring = $assessment["scoring"];
	$metadata = $assessment["metadata"];

	# Metadata variables
	$id = $metadata["id"];
	$text = $metadata["text"];
	$class = $metadata["class"];
	$notes = $metadata["notes"];
	$title = $metadata["title"];

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
			renderQuestionSection($assessment["questions"], $types, $questionClasses);
		}

		// Render sections
		if(array_key_exists("sections", $assessment)) {
			foreach($assessment["sections"] as $section) {

				// Show description if it exists
				if(array_key_exists("description", $section)) {
					echo "<br/>" . $section["description"] . "<br/>";
				}

				// Render questions
				renderQuestionSection($section["questions"], $types, $questionClasses);

			}
		}

		// End container
		echo "</div><!-- END " . $assessment["metadata"]["id"] . "_assessment_container-->";

	}
}
?>
