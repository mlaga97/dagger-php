<?php

	$router->map('OPTIONS', '/user', function() {
		jsonResponse(array(
			'/' => 'Show list of valid user IDs',
			'/all' => 'Shows all user data by user ID',
			'/[:id]' => 'Shows user data for a particular user ID',
		));
	});

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/user.php';
	$router->addRoutes(array(
		array('GET', '/user', function() {jsonResponse(listUserIDs());}),
		array('GET', '/user/', function() {jsonResponse(listUserIDs());}),
		array('GET', '/user/all', function() {jsonResponse(listUsersByID());}),
		array('GET', '/user/current', function() {jsonResponse(getUser($_SESSION['user_id']));}),
		array('GET', '/user/[:id]', function($id) {jsonResponse(getUser($id));}),
	));

?>
