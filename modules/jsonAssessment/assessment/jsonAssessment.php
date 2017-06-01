<?php
function areFriends($types, $question1, $question2) {
	if($question1["type"] == $question2["type"]) {
		return true;
	} else {
		if(array_key_exists("friends", $types[$question1["type"]])) {
			if(in_array($question2["type"], $types[$question1["type"]]["friends"])) {
				return true;
			}
		}
		if(array_key_exists("friends", $types[$question2["type"]])) {
			if(in_array($question1["type"], $types[$question2["type"]]["friends"])) {
				return true;
			}
		}
	}

	return false;
}

function renderQuestionSection($questions, $types) {
	foreach($questions as $questionNumber=>$question) {
		// NOTE: This takes advantage of Short-Circuit evaluation and will break otherwise
		if($questionNumber == 0 || !areFriends($types, $question, $questions[$questionNumber-1])) {

			$typeData = $types[$question["type"]];
			switch($typeData["type"]) {
				case "radioScale":
					echo "<table><tr><th>Question</th>";
					foreach($typeData["options"] as $optionText => $value) {
						echo "<th>" . $optionText . "</th>";
					}
					echo "</tr>";
					break;
			}

		}

		$typeData = $types[$question["type"]];
		switch($typeData["type"]) {
			case "radioScale":
				if($questionNumber == 0) {
					echo "<br/>";
				}
				echo "<tr><td>" . $question["text"] . "</td>";
				foreach($typeData["options"] as $optionText => $value) {
					echo "<td><center><input type='radio' name='" . $question["id"] . "' value='" . $value . "' /></center></td>";
				}
				break;
			case "radioOptions":
				if($questionNumber != 0) {
					echo "<hr/>";
				}
				echo "<br/>" . $question["text"] . "<br/><br/>";
				foreach($typeData["options"] as $optionText => $value) {
					echo "<label><input type='radio' name='" . $question["id"] . "' value='" . $value . "' />" . $optionText . "</label><br/>";
				}
				echo "<br/>";
				break;
		}
		echo "</tr>";
	}
	echo "</table>";
}

$assessments = getUnmergedConfig($filename = "assessment.json");

foreach($assessments as $assessment) {
	if($_SESSION[$assessment["metadata"]["id"]]) {
		echo "<h3>" . $assessment["metadata"]["title"] . "</h3>";

		// TODO: Determine precedence of "questions" vs "sections"
		if(array_key_exists("questions", $assessment) && array_key_exists("sections", $assessment)) {
			echo "Error: an assessment.json file has both 'questions' and 'sections'";
		}

		if(array_key_exists("questions", $assessment)) {
			renderQuestionSection($assessment["questions"], $assessment["types"]);
			echo "<hr/>";
		}

		if(array_key_exists("sections", $assessment)) {
			foreach($assessment["sections"] as $section) {
				if(array_key_exists("description", $section))
					echo "<br/>" . $section["description"] . "<br/>";
				renderQuestionSection($section["questions"], $assessment["types"]);
				echo "<hr/>";
			}
		}
	}
}
?>
