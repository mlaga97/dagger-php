<?php
function renderQuestionSection($questions, $types) {
	foreach($questions as $questionNumber=>$question) {
		// NOTE: This takes advantage of Short-Circuit evaluation and will break otherwise
		if($questionNumber == 0 || $question["type"] != $questions[$questionNumber-1]["type"]) {

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

		echo "<tr><td>" . $question["text"] . "</td>";

		$typeData = $types[$question["type"]];
		switch($typeData["type"]) {
			case "radioScale":
				foreach($typeData["options"] as $optionText => $value) {
					echo "<td><center><input type='checkbox' name='" . $question["id"] . "' value='" . $value . "' /></center></td>";
				}
				break;
			case "radioOptions":
				echo "<br/>";
				foreach($typeData["options"] as $optionText => $value) {
					echo "<label><input type='checkbox' name='" . $question["id"] . "' value='" . $value . "' />" . $optionText . "</label><br/>";
				}
				echo "<hr/>";
				break;
		}
		echo "</tr>";
	}
	echo "</table>";
}

$assessments = getUnmergedConfig($filename = "assessment.json");

foreach($assessments as $assessment) {
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
				echo $section["description"] . "<br/>";
			renderQuestionSection($section["questions"], $assessment["types"]);
		}
	}

	echo "<hr/>";
}
?>
