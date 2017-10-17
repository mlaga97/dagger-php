<?php
	/* /api/v1/assessment
	 * /api/v1/assessment/all
	 * /api/v1/assessment/short
	 * /api/v1/assessment/[class]
	 *
	*/

	// TODO: Avoid this by having two different loaders?
	$noRedirect = true;
	session_start();

	require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php';

	$globalAPIContext['methods']['/api/v1/assessment'] = function($subURI, $context, $method, $getVars, $postVars) {
		global $jsonAssessments;

		$explodedURI = explodeURI($subURI);
		$response = array();

		if(array_key_exists(0, $explodedURI)) {
			if($explodedURI[0] == '') {
				foreach($jsonAssessments as $jsonAssessment) {
					array_push($response, $jsonAssessment['metadata']['class']);
				}
			} elseif($explodedURI[0] == 'short') {
				foreach($jsonAssessments as $jsonAssessment) {
					$response[$jsonAssessment['metadata']['class']] = $jsonAssessment['metadata'];
				}
			} elseif($explodedURI[0] == 'all') {
				foreach($jsonAssessments as $jsonAssessment) {
					$response[$jsonAssessment['metadata']['class']] = $jsonAssessment;
				}
			} else {
				foreach($jsonAssessments as $jsonAssessment) {
					if($explodedURI[0] == $jsonAssessment['metadata']['class']) {
						$response = $jsonAssessment;
					}
				}
			}
		} else {
			foreach($jsonAssessments as $jsonAssessment) {
				array_push($response, $jsonAssessment['metadata']['class']);
			}
		}

		$context['response'] = $response;
		return $context;
	};
?>
