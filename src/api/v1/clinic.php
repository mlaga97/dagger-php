<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/clinic.php';

$router->map('OPTIONS', '/clinic', function() {
  jsonResponse(array(
    '/' => 'Show list of valid clinic IDs',
    '/all' => 'Show all clinic data by clinic ID',
    '/[:id]' => 'Show clinic data for a particular clinic ID',
  ));
});

$router->map('GET', '/clinic', function() {
  jsonResponse(listClinicIDs());
});

$router->map('GET', '/clinic/', function() {
  jsonResponse(listClinicIDs());
});

$router->map('GET', '/clinic/all', function() {
  jsonResponse(listClinicsByID());
});

// TODO: Check the database first
$router->map('GET', '/clinic/current', function() {
  jsonResponse(getClinic($_SESSION['clinic_id']));
});

$router->map('POST', '/clinic/current', function() {
  $requestData = json_decode(file_get_contents('php://input'), true);
  jsonResponse(setClinic($requestData));
});

$router->map('GET', '/clinic/[:id]', function($id) {
  jsonResponse(getClinic($id));
});

?>
