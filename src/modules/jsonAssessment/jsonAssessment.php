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

global $jsonAssessments;

// Go ahead and load all the assessments now
$jsonAssessments = getUnmergedConfig($filename = "assessment.json");

// TODO: explain better
foreach($jsonAssessments as $index => $assessment) {

	// Convert "questions" field to "sections" field
	if(array_key_exists("questions", $assessment)) {
		$section = array(
			"questions" => $assessment["questions"]
		);

		// Make the "questions" section appear as a "section"
		if(array_key_exists("sections", $assessment)) {
			array_push($assessment["sections"], $section);
		} else {
			$assessment["sections"] = array($section);
		}

		// TODO: Why is it this way?
		$jsonAssessments[$index] = $assessment;
	}

	// Determine visibility
	// TODO: The following code may or may not work.
	$visibility = true;
	if(array_key_exists("visibilityRules", $assessment)) {
		foreach($assessment["visibilityRules"] as $rule) {
			switch($rule["type"]) {
				case "default":
					$visibility = $rule["show"];
					break;
				case "ifKeyMatches":
					$key = $rule["key"];
					$show = $rule["show"];

					if(gettype($rule["matches"]) == "array") {
						$matches = $rule["matches"];
					} else {
						$matches = array($rule["matches"]);
					}

					if(array_key_exists($key, $_SESSION)) {
						if(in_array($_SESSION[$key], $matches)) {
							$visibility = true;
							break 3;
						} else {
							break 2;
						}
					}
			}
		}
	}
	$jsonAssessments[$index]["visibility"] = $visibility;
}


/*

"visibility": [
{ "type": "default", "show": false },
{ "type": "ifKeyMatches", "key": "assessmentType", "matches": "Child", "show": true }
],

*/
/******************************************************************************
*******************************************************************************
******************************************************************************/

// TODO: This, but automatically.
function areFriends($types, $question1, $question2) {

	// TODO: Maybe somehow allow being friends with an anonymous type?
	if(!is_string($question1["type"]) && !is_string($question2["type"]))
		return false;

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

function getQuestions($assessment) {
	$questions = array();

	foreach($assessment["sections"] as $section) {
		foreach($section["questions"] as $question) {
			array_push($questions, $question);
		}
	}

	return $questions;
}
