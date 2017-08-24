<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/include/dagger.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php';

	$methods["/assessment/all"] = function() {
		global $response, $jsonAssessments;
		$response = $jsonAssessments;
	};

?>
