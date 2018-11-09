<?php

$router->map('OPTIONS', '/session', function() {
  jsonResponse([
    '/' => 'Show all session data',
  ]);
});

$router->map('GET', '/session', function() {
  jsonResponse($_SESSION);
});

?>
