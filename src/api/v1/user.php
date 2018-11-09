<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/user.php';

$router->map('OPTIONS', '/user', function() {
  jsonResponse([
    '/' => 'Show list of valid user IDs',
    '/all' => 'Shows all user data by user ID',
    '/[:id]' => 'Shows user data for a particular user ID',
    '/current' => 'Shows user data for the current user ID',
  ]);
});

$router->map('GET', '/user', function() {
  jsonResponse(listUserIDs());
});

$router->map('GET', '/user/', function() {
  jsonResponse(listUserIDs());
});

$router->map('GET', '/user/all', function() {
  jsonResponse(listUsersByID());
});

$router->map('GET', '/user/current', function() {
  jsonResponse(getUser($_SESSION['user_id']));
});

$router->map('POST', '/user/current/password', function() {
  $requestData = json_decode(file_get_contents('php://input'), true);
  jsonResponse(changePassword($_SESSION['user_id'], $requestData['password'], $requestData['newPassword']));
});

$router->map('GET', '/user/[:id]', function($id) {
  jsonResponse(getUser($id));
});

$router->map('POST', '/user/[:id]/password', function($id) {
  $requestData = json_decode(file_get_contents('php://input'), true);
  jsonResponse(changePassword($id, $requestData['password'], $requestData['newPassword']));
});

?>
