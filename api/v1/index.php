<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/json.php');
	require_once('parser.php');
	header('Content-Type: application/json');

	switch($_SERVER['REQUEST_METHOD']) {
		case 'GET':
			// Retrieve information. GET requests must be safe and idempotent,
			// meaning regardless of how many times it repeats with the same
			// parameters, the results are the same. They can have side effects,
			// but the user doesn't expect them, so they cannot be critical to
			// the operation of the system. Requests can also be partial or
			// conditional.
			break;
		case 'POST':
			// Request that the resource at the URI do something with the
			// provided entity. Often POST is used to create a new entity,
			// but it can also be used to update an entity.
			break;
		case 'PUT':
			// Store an entity at a URI. PUT can create a new entity or update
			// an existing one. A PUT request is idempotent. Idempotency is the
			// main difference between the expectations of PUT versus a POST
			// request.
			break;
		case 'PATCH':
			// Update only the specified fields of an entity at a URI. A PATCH
			// request is idempotent. Idempotency is the main difference between
			// the expectations of PUT versus a POST request.
		case 'DELETE':
			// Request that a resource be removed; however, the resource does
			// not have to be removed immediately. It could be an asynchronous
			// or long-running request.
			break;
		case 'OPTIONS':
			// For documentation
			break;
		default:
			break;
	}

	// Send the response
	// TODO: Replace with JSON_UNESCAPED_SLASHES when server is upgraded
	echo(prettyPrint(str_replace('\\/', '/', json_encode(recursiveParser($_SERVER['REQUEST_URI'], $globalAPIContext, $_SERVER['REQUEST_METHOD'], $_GET, $_POST)))));
?>
