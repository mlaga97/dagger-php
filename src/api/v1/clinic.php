<?php

	$router->map('OPTIONS', '/clinic', function() {
		jsonResponse(array(
			'/' => 'Show list of valid clinic IDs',
			'/all' => 'Show all clinic data by clinic ID',
			'/[:id]' => 'Show clinic data for a particular clinic ID',
		));
	});

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/clinic.php';
	$router->addRoutes([
		['GET', '/clinic', function() {jsonResponse(listClinicIDs());}],
		['GET', '/clinic/', function() {jsonResponse(listClinicIDs());}],
		['GET', '/clinic/all', function() {jsonResponse(listClinicsByID());}],
    ['GET', '/clinic/current', function() {jsonResponse(getClinic($_SESSION['clinic_id']));}], // TODO: Check the database first
    ['POST', '/clinic/current', function() {
      $requestData = json_decode(file_get_contents('php://input'), true);
      jsonResponse(setClinic($requestData));
    }],
		['GET', '/clinic/[:id]', function($id) {jsonResponse(getClinic($id));}],
	]);

?>
