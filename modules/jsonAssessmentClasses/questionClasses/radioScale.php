<?php

global $questionClasses;
$questionClasses["radioScale"] = array();

$questionClasses["radioScale"]["header"] = function($type) {
	echo "<table><tr><th>Question</th>";
	foreach($type["options"] as $optionText => $value) {
		echo "<th>" . $optionText . "</th>";
	}
	echo "</tr>";
};

$questionClasses["radioScale"]["render"] = function($question, $relativeQuestionNumber, $absoluteQuestionNumber, $type) {
	$options = $type['options'];

	if($relativeQuestionNumber == 0) {
		echo "<br/>";
	}
	echo "<tr><td><ol start='" . $absoluteQuestionNumber .  "'><li>" . $question["text"] . "</li></ol></td>";
	foreach($options as $optionText => $value) {
		if(array_key_exists('hideLabel', $type) && $type['hideLabel']) {
			$optionText = '';
		}
		echo "<td><center><label class='radio_caption'><br/><input type='radio' name='" . $question["id"] . "' value='" . $value . "' /><br/>" . $optionText . "</label></center></td>";
	}
};

$questionClasses["radioScale"]["parseResponse"] = function($rawAnswer, $type) {
	if($rawAnswer == $type["emptyValue"]) {
		return "No Response";
	}

	return array_search($rawAnswer, $type["options"]);
}

?>
