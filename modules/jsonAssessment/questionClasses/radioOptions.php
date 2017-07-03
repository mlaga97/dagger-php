<?php

global $questionClasses;
$questionClasses["radioOptions"] = array();

$questionClasses["radioOptions"]["render"] = function($question, $questionNumber, $options) {
	echo "<table><tr><td><ol start='" . substr($question["id"], strpos($question["id"], "_") + 1) . "'><li>" . $question["text"] . "</li></ol>";
	foreach($options as $optionText => $value) {
		echo "<label><input type='radio' name='" . $question["id"] . "' value='" . $value . "' />" . $optionText . "</label><br/>";
	}
	echo "</td></tr></table>";
};

?>