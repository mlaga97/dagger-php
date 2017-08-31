<?php
	// TODO: Avoid this by having two different loaders?
	$noRedirect = true;

	include $_SERVER['DOCUMENT_ROOT'] . '/include/dagger.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php';

	$methods["/all"] = function($subURI, $context, $getVars) {
		global $jsonAssessments;
		$context['response'] = $jsonAssessments;
		return $context;
	};
?>
