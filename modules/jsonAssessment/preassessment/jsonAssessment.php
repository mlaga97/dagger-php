<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php');

$assessments = getUnmergedConfig($filename = "assessment.json");

foreach($assessments as $assessment) {

	// Assessment variables
	$metadata = $assessment["metadata"];

	// Metadata variables
	$id = $metadata["id"];
	$text = $metadata["text"];
	$class = $metadata["class"];
	$title = $metadata["title"];

	// Default to not doing assessments
	$_SESSION[$assessment["metadata"]["id"]] = 0;

	// Show selection box
	echo "<div class='" . $class . "' title='" . $title . "' >";
	echo "	<label><input id='" . $id . "' type='checkbox' name='" . $id . "' value='1' />" . $text . "</label>";
	echo "</div>";

}
?>