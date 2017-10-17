<?php
	/* /api/v1/response
	 * /api/v1/response/all
	 * /api/v1/response/[id]
	 *
	 */

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/response.php';

	$globalAPIContext['methods']['/api/v1/response'] = function($subURI, $context, $method, $getVars, $postVars) {
		$explodedURI = explodeURI($subURI);
		$response = array();

		if(array_key_exists(0, $explodedURI)) {
			if($explodedURI[0] == '') {
				$response = listResponseIDs();
			} elseif($explodedURI[0] == 'all') {
				$response = listResponsesByID();
			} else {
				$response = getResponse($explodedURI[0]);
			}
		} else {
			$response = listResponseIDs();
		}

		$context['response'] = $response;
		return $context;
	};
?>
