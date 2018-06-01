<?php

	$router->map('OPTIONS', '/response', function() {
		jsonResponse(array(
			'/' => 'Show list of valid response IDs',
			'/all' => 'Show all response data by response ID',
			'/[:id]' => 'Show response data for a particular response id',
		));
	});

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/response.php';
	$router->addRoutes(array(
		array('GET', '/response', function() {jsonResponse(listResponseIDs());}),
		array('GET', '/response/', function() {jsonResponse(listResponseIDs());}),
		array('GET', '/response/all', function() {jsonResponse(listResponsesByID());}),
		array('GET', '/response/[:id]', function($id) {jsonResponse(getResponse($id));}),
	));

?>
