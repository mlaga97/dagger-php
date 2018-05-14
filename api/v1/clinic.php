<?php

	$router->map('OPTIONS', '/clinic', function() {
		jsonResponse(array(
			'/' => 'Show list of valid clinic IDs',
			'/all' => 'Show all clinic data by clinic ID',
			'/[:id]' => 'Show clinic data for a particular clinic ID',
		));
	});

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/clinic.php';
	$router->addRoutes(array(
		array('GET', '/clinic', function() {jsonResponse(listClinicIDs());}),
		array('GET', '/clinic/', function() {jsonResponse(listClinicIDs());}),
		array('GET', '/clinic/all', function() {jsonResponse(listClinicsByID());}),
		array('GET', '/clinic/[:id]', function($id) {jsonResponse(getClinic($id));}),
	));

?>
