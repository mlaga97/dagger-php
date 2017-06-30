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
			if(array_key_exists("header", $classes[$class])) {
				$classes[$class]["header"]($options);
			}

		}

		// Render question
		$classes[$class]["render"]($question, $questionNumber, $options);

		echo "</tr>";

	}

	echo "</table>";

}

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