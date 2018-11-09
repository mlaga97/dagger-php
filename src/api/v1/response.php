<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/response.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/search.php';

$router->map('OPTIONS', '/response', function() {
  jsonResponse([
    '/' => 'Show list of valid response IDs',
    '/all' => 'Show all response data by response ID',
    '/[:id]' => 'Show response data for a particular response id',
  ]);
});

$router->map('GET', '/response', function() {
  queryMetadata($_GET, listResponseIDs(getSearch($_GET) . paginate($_GET)));
});

$router->map('POST', '/response', function() {
  $requestData = json_decode(file_get_contents('php://input'), true);
  jsonResponse(postResponse($requestData));
});

$router->map('OPTIONS', '/response', function() {
});

$router->map('GET', '/response/', function() {
  queryMetadata($_GET, listResponseIDs(getSearch($_GET) . paginate($_GET)));
});

$router->map('GET', '/response/all', function() {
  queryMetadata($_GET, listResponsesByID(getSearch($_GET) . paginate($_GET)));
});

$router->map('GET', '/response/[:id]', function($id) {
  jsonResponse(getResponse($id));
});

?>
