<?php

$router->map('OPTIONS', '/session', function() {
  jsonResponse(array(
    '/' => 'Show all session data',
  ));
});

$router->map('GET', '/session', function() {
  jsonResponse($_SESSION);
});

?>
