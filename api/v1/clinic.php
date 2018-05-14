<?php
	/*
	 * /clinic			listClinicIDs
	 * /clinic/all		listClinicsByID
	 * /clinic/[id]		getClinic
	 */

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/clinic.php';
	$router->addRoutes(array(
		array('GET', '/clinic', function() {jsonResponse(listClinicIDs());}),
		array('GET', '/clinic/', function() {jsonResponse(listClinicIDs());}),
		array('GET', '/clinic/all', function() {jsonResponse(listClinicsByID());}),
		array('GET', '/clinic/[:id]', function($id) {jsonResponse(getClinic($id));}),
	));

?>
