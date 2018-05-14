<?php

	$router->map('OPTIONS', '/assessment', function() {
		jsonResponse(array(
			'/' => 'Show list of valid assessment classes',
			'/all' => 'Show data for all assessment classes',
			'/short' => 'Show metadata for all assessment classes',
			'/[:class]' => 'Show data for a particular assessment class',
		));
	});

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
