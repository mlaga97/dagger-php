<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/response.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/search.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/paginate.php';

$router->map('OPTIONS', '/response', function() {
  jsonResponse([
    '/' => [
      'GET' => 'Show list of valid response IDs',
      'POST' => 'Submit a new response, and return a new response ID',
    ],
    '/all' => 'Show all response data by response ID',
    '/[:id]' => 'Show response data for a particular response id',
  ]);
});

$router->map('GET', '/response', function() {
  queryMetadata($_GET, listResponseIDs(getSearch($_GET) . paginate($_GET)));
});

$router->map('GET', '/response/', function() {
  queryMetadata($_GET, listResponseIDs(getSearch($_GET) . paginate($_GET)));
});

$router->map('POST', '/response', function() {
  $requestData = json_decode(file_get_contents('php://input'), true);
  jsonResponse(postResponse($requestData));
});

$router->map('GET', '/response/all', function() {
  queryMetadata($_GET, listResponsesByID(getSearch($_GET) . paginate($_GET)));
});

$router->map('GET', '/response/[:id]', function($id) {
  jsonResponse(getResponse($id));
});

?>
