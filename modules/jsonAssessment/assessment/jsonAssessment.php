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
		// NOTE: This takes advantage of short-circuit evaluation and will break otherwise
		if($questionNumber == 0 || !areFriends($types, $question, $questions[$questionNumber-1])) {

			$typeData = $types[$question["type"]];
			switch($typeData["type"]) {
				case "radioScale":
					echo "<table><tr><th>Question</th>";
					foreach($typeData["options"] as $optionText => $value) {
						echo "<th>" . $optionText . "</th>";
					}
					echo '<th class="hidden">Default</th>';
					echo "</tr>";
					break;
			}

		}

		// Get question type data
		$typeData = $types[$question["type"]];

		// Automatically set empty value, if appropriate
		if(array_key_exists("emptyValue", $typeData)) {
			$_SESSION[$question["id"]] = $typeData["emptyValue"];
		}

		// Render question
		switch($typeData["type"]) {
			case "radioScale":
				if($questionNumber == 0) {
					echo "<br/>";
				}
				echo "<tr><td><ol start='" . substr($question["id"], strpos($question["id"], "_") + 1) . "'><li>" . $question["text"] . "</li></ol></td>";
				foreach($typeData["options"] as $optionText => $value) {
					echo "<td><center><label class='radio_caption'><br/><input type='radio' name='" . $question["id"] . "' value='" . $value . "' /><br/>" . $optionText . "</label></center></td>";
				}
				break;
			case "radioOptions":
				if($questionNumber != 0) {
					//echo "<hr/><!--if questionNumber not 0 -->";
					// don't know that we need to keep this condition if it's just a separator - formatting will end up being some sort of css box 
				}
				echo "<table><tr><td><ol start='" . substr($question["id"], strpos($question["id"], "_") + 1) . "'><li>" . $question["text"] . "</li></ol>";
				foreach($typeData["options"] as $optionText => $value) {
					echo "<label><input type='radio' name='" . $question["id"] . "' value='" . $value . "' />" . $optionText . "</label><br/>";
				}
				echo "</td></tr></table>";
				break;
		}
		echo "</tr>";
	}
	echo "</table>";
}

$assessments = getUnmergedConfig($filename = "assessment.json");

foreach($assessments as $assessment) {
	if($_SESSION[$assessment["metadata"]["id"]]) {
		echo "<div id='" . $assessment["metadata"]["id"] . "_assessment_container' class='jsonAssessment'>";
		echo "<h3>" . $assessment["metadata"]["title"] . "</h3>";

		// TODO: Determine precedence of "questions" vs "sections"
		if(array_key_exists("questions", $assessment) && array_key_exists("sections", $assessment)) {
			echo "Error: an assessment.json file has both 'questions' and 'sections'";
		}

		if(array_key_exists("questions", $assessment)) {
			renderQuestionSection($assessment["questions"], $assessment["types"]);
		}

		if(array_key_exists("sections", $assessment)) {
			foreach($assessment["sections"] as $section) {
				if(array_key_exists("description", $section))
					echo "<br/>" . $section["description"] . "<br/>";
				renderQuestionSection($section["questions"], $assessment["types"]);
			}
		}
		echo "</div><!-- END " . $assessment["metadata"]["id"] . "_assessment_container-->";
	}
}
?>
