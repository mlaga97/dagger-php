<?php

global $scoreClasses;

$scoreClasses["sumOfValues"] = function($assessment, $questions) {
	$scorable = true;
	$total = 0;
	$unanswered = 0;

	foreach($questions as $question) {
		// TODO: Is array_key_exists and check -1 redundant?
		if(array_key_exists($question["id"], $_SESSION)) {
			if($_SESSION[$question["id"]] != -1) {
				$total = $total + $_SESSION[$question["id"]];
			} else {
				$unanswered = $unanswered + 1;
			}
		} else {
			$unanswered = $unanswered + 1;
		}
	}

	if(array_key_exists("unscorableTriggers", $assessment["scoring"])) {
		foreach($assessment["scoring"]["unscorableTriggers"] as $trigger) {
			switch($trigger["type"]) {
				case "maxUnanswered":
					if($unanswered > $trigger["value"]) {
						$scorable = false;
					}
					break;
			}
		}
	}

	if(array_key_exists("maxUnanswered", $assessment["scoring"]) && $assessment["scoring"]["maxUnanswered"] <= $unanswered) {
		$scorable = false;
	}

	// Output result
	echo "<tr><td>" . $assessment["metadata"]["title"];
	if($scorable) {
		echo " Score </td><td class='score'>" . $total;
	} else {
		echo " cannot be scored due to an insufficient number of responses.";
	}
	echo "</td></tr>";
};

?>