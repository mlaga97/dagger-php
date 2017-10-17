<?php
	/* /api/v1/user			listUserIDs()
	 * /api/v1/user/all		listUsersByID()
	 * /api/v1/user/[id]	getUser()
	 *
	 */

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/user.php';

	$globalAPIContext['methods']['/api/v1/user'] = function($subURI, $context, $method, $getVars, $postVars) {
		$explodedURI = explodeURI($subURI);
		$response = array();

		if(array_key_exists(0, $explodedURI)) {
			if($explodedURI[0] == '') {
				$response = listUserIDs();
			} elseif($explodedURI[0] == 'all') {
				$response = listUsersByID();
			} else {
				$response = getUser($explodedURI[0]);
			}
		} else {
			$response = listUserIDs();
		}

		$context['response'] = $response;
		return $context;
	};
?>
