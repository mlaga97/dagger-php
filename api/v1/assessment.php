<?php
	/*
	 * /api/v1/assessment
	 * /api/v1/assessment/all
	 * /api/v1/assessment/short
	 * /api/v1/assessment/[class]
	 */

	$router->map('GET', '/assessment', function() {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php';

		$response = array();
		foreach($jsonAssessments as $jsonAssessment) {
			array_push($response, $jsonAssessment['metadata']['class']);
		}
		
		jsonResponse($response);
	});

	$router->map('GET', '/assessment/short', function() {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php';

		$response = array();
		foreach($jsonAssessments as $jsonAssessment) {
			$response[$jsonAssessment['metadata']['class']] = $jsonAssessment['metadata'];
		}
		
		jsonResponse($response);
	});

	$router->map('GET', '/assessment/all', function() {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php';

		$response = array();
		foreach($jsonAssessments as $jsonAssessment) {
			$response[$jsonAssessment['metadata']['class']] = $jsonAssessment;
		}
		
		jsonResponse($response);
	});

	$router->map('GET', '/assessment/[:class]', function($class) {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php';

		$response = array();
		foreach($jsonAssessments as $jsonAssessment) {
			if($class == $jsonAssessment['metadata']['class']) {
				$response = $jsonAssessment;
			}
		}
		
		jsonResponse($response);
	});

?>
