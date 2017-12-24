<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/bitwise/bitwise.php');

global $questionClasses;
$questionClasses["bitwiseTable"] = array();

$questionClasses["bitwiseTable"]["header"] = function($type) {
	echo "<table><tr><th>Question</th>";
	foreach($type["options"] as $number => $option) {
		echo "<th>" . $option . "</th>";
	}
	echo "</tr>";
};

$questionClasses["bitwiseTable"]["render"] = function($question, $relativeQuestionNumber, $absoluteQuestionNumber, $type) {
	$options = $type["options"];

	if($relativeQuestionNumber == 0) {
		echo "<br/>";
	}
	echo "<tr><td><ol start='" . $absoluteQuestionNumber .  "'><li>" . $question["text"] . "</li></ol></td>";
	foreach($options as $number => $option) {
		echo "<td><center><label class='radio_caption'><br/><input type='checkbox' name='" . $question["id"] . "-" . ($number + 1) . "' value='" . ($number + 1) . "' /><br/>" . $option . "</label></center></td>";
	}
};

$questionClasses["bitwiseTable"]["parseResponse"] = function($rawAnswer, $type) {
	return unmaskValuesToString($rawAnswer, $type["options"]);
}

?>
