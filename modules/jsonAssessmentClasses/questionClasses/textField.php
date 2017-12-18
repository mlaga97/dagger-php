<?php

global $questionClasses;
$questionClasses["textField"] = array();

$questionClasses["textField"]["render"] = function($question, $relativeQuestionNumber, $absoluteQuestionNumber, $type) {
	echo "<table><tr><td><ol start='" . $absoluteQuestionNumber . "'><li>" . $question["text"] . "</li></ol>";
	echo "<input type='input' name='" . $question["id"] . "' />";
	echo "</td></tr></table>";
};

?>
