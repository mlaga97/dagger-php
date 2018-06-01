<?php

global $questionClasses;
$questionClasses["checkboxScale"] = array();

$questionClasses["checkboxScale"]["header"] = function($type) {
	echo "<table><tr><th>Question</th>";
	echo "<th></th>";
	echo "</tr>";
};

$questionClasses["checkboxScale"]["render"] = function($question, $relativeQuestionNumber, $absoluteQuestionNumber, $type) {
	if($relativeQuestionNumber == 0) {
		echo "<br/>";
	}
	echo "<tr><td><ol start='" . $absoluteQuestionNumber .  "'><li>" . $question["text"] . "</li></ol></td>";
	echo "<td><center><label class='checkbox_caption'><br/><input type='checkbox' name='" . $question["id"] . "' value='1' /><br/></label></center></td>";
};

$questionClasses["checkboxScale"]["parseResponse"] = function($rawAnswer, $type) {
	if($rawAnswer == $type["emptyValue"]) {
		return "No Response";
	}

	return array_search($rawAnswer, $type["options"]);
}

?>
