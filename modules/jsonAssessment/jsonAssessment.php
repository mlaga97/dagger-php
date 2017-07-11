<?php

// TODO: DOCUMENT!

/******************************************************************************
 *******************************************************************************
 ******************************************************************************/

global $questionClasses, $responseClasses, $scoreClasses;

$questionClasses = array();
moduleLoad("questionClasses");

$responseClasses = array();
moduleLoad("responseClasses");

$scoreClasses = array();
moduleLoad("scoreClasses");

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

function renderQuestionSection($questions, $types, $classes, &$absoluteQuestionNumber) {
	// TODO: Pick one

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
			if(array_key_exists("header", $classes[$class])) {
				$classes[$class]["header"]($options);
			}

		}

		// Render question
		$classes[$class]["render"]($question, $relativeQuestionNumber, $absoluteQuestionNumber, $options);

		// Update absolute question number
		$absoluteQuestionNumber = $absoluteQuestionNumber + 1;

		echo "</tr>";
	}

	echo "</table>";

}

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