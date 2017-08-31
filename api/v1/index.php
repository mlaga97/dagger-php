<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/json.php');
	require_once('parser.php');
	header('Content-Type: application/json');

	// Send the response
	// TODO: Replace with JSON_UNESCAPED_SLASHES when server is upgraded
	echo(prettyPrint(str_replace('\\/', '/', json_encode(recursiveParser($_SERVER['REQUEST_URI'], $globalAPIContext, $_GET)))));
?>
