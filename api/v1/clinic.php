<?php
	/* /api/v1/clinic		listClinicIDs()
	 * /api/v1/clinic/all	listClinicsByID()
	 * /api/v1/clinic/[id]	getClinic()
	 *
	*/

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/clinic.php';

	$globalAPIContext['methods']['/api/v1/clinic'] = function($subURI, $context, $method, $getVars, $postVars) {
		$explodedURI = explodeURI($subURI);
		$response = array();

		if(array_key_exists(0, $explodedURI)) {
			if($explodedURI[0] == '') {
				$response = listClinicIDs();
			} elseif($explodedURI[0] == 'all') {
				$response = listClinicsByID();
			} else {
				$response = getClinic($explodedURI[0]);
			}
		} else {
			$response = listClinicIDs();
		}

		$context['response'] = $response;
		return $context;
	};
?>
