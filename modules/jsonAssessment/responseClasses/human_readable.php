<?php

global $responseClasses;

$responseClasses["human_readable"] = function($question, $assessment) {
	echo "<tr><td><ol start='" . substr($question["id"], strpos($question["id"], "_") + 1) . "'><li>" . $question["text"] . "</li></ol></td><td class='score'>";

	// TODO: Is array_key_exists and check -1 redundant?
	if(array_key_exists($question["id"], $_SESSION) && $_SESSION[$question["id"]] != -1) {
		echo array_search($_SESSION[$question["id"]], $assessment["types"][$question["type"]]["options"]);
	} else {
		echo "No Response";
	}

	echo "</td></tr>";
};

?>