<?php

	$router->map('OPTIONS', '/response', function() {
		jsonResponse(array(
			'/' => 'Show list of valid response IDs',
			'/all' => 'Show all response data by response ID',
			'/[:id]' => 'Show response data for a particular response id',
		));
	});

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/response.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/search.php';

	$router->addRoutes(array(
		array('GET', '/response', function() {jsonResponse(listResponseIDs(getSearch($_GET)));}),
    array('POST', '/response', function() {
      $requestData = json_decode(file_get_contents('php://input'), true);
      jsonResponse(postResponse($requestData));
    }),
    array('OPTIONS', '/response', function() {}),
		array('GET', '/response/', function() {jsonResponse(listResponseIDs(getSearch($_GET)));}),
		array('GET', '/response/all', function() {jsonResponse(listResponsesByID(getSearch($_GET)));}),
		array('GET', '/response/[:id]', function($id) {jsonResponse(getResponse($id));}),
	));

?>
