<?php

global $questionClasses;
$questionClasses["radioScale"] = array();

$questionClasses["radioScale"]["header"] = function($options) {
	echo "<table><tr><th>Question</th>";
	foreach($options as $optionText => $value) {
		echo "<th>" . $optionText . "</th>";
	}
	echo "</tr>";
};

$questionClasses["radioScale"]["render"] = function($question, $relativeQuestionNumber, $absoluteQuestionNumber, $options) {
	if($relativeQuestionNumber == 0) {
		echo "<br/>";
	}
	echo "<tr><td><ol start='" . $absoluteQuestionNumber .  "'><li>" . $question["text"] . "</li></ol></td>";
	foreach($options as $optionText => $value) {
		echo "<td><center><label class='radio_caption'><br/><input type='radio' name='" . $question["id"] . "' value='" . $value . "' /><br/>" . $optionText . "</label></center></td>";
	}
};