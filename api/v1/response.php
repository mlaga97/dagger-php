<?php
	/*
	 * /response		listResponseIDs
	 * /response/all	listResponsesByID
	 * /response/[id]	getResponse
	 */

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/response.php';
	$router->addRoutes(array(
		array('GET', '/response', function() {jsonResponse(listResponseIDs());}),
		array('GET', '/response/', function() {jsonResponse(listResponseIDs());}),
		array('GET', '/response/all', function() {jsonResponse(listResponsesByID());}),
		array('GET', '/response/[:id]', function($id) {jsonResponse(getResponse($id));}),
	));

?>
