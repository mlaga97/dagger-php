<?php
	/*
	 * /user			listUserIDs
	 * /user/all		listUsersByID
	 * /user/[id]		getUser
	 */

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/user.php';
	$router->addRoutes(array(
		array('GET', '/user', function() {jsonResponse(listUserIDs());}),
		array('GET', '/user/', function() {jsonResponse(listUserIDs());}),
		array('GET', '/user/all', function() {jsonResponse(listUsersByID());}),
		array('GET', '/user/[:id]', function($id) {jsonResponse(getUser($id));}),
	));

?>
