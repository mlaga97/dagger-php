<?php

global $questionClasses, $responseClasses;

$responseClasses["human_readable"] = function($question, $assessment, $absoluteQuestionNumber) {

	// Show question
	echo "<tr><td><ol start='" . $absoluteQuestionNumber . "'><li>" . $text . "</li></ol></td><td class='score'>" . $answer . "</td></tr>";
};

?>