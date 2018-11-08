<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/user.php';

$router->map('OPTIONS', '/user', function() {
  jsonResponse(array(
    '/' => 'Show list of valid user IDs',
    '/all' => 'Shows all user data by user ID',
    '/[:id]' => 'Shows user data for a particular user ID',
  ));
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

$router->map('GET', '/user/[:id]', function($id) {
  jsonResponse(getUser($id));
});

?>
