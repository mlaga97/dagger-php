<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/assessment.php';

$router->map('OPTIONS', '/assessment', function() {
  jsonResponse([
    '/' => 'Show list of valid assessment classes',
    '/all' => 'Show data for all assessment classes',
    '/short' => 'Show metadata for all assessment classes',
    '/[:class]' => 'Show data for a particular assessment class',
  ]);
});

$router->map('GET', '/assessment', function() {
  jsonResponse(getAssessmentList());
});

$router->map('GET', '/assessment/all', function() {
  jsonResponse(getAssessments());
});

$router->map('GET', '/assessment/short', function() {
  jsonResponse(getAssessmentMetadata());
});

$router->map('GET', '/assessment/[:id]', function($id) {
  jsonResponse(getAssessmentByID($id));
});

?>
