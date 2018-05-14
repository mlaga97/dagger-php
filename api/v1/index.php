<?php
	/*
		case 'GET':
			// Retrieve information. GET requests must be safe and idempotent,
			// meaning regardless of how many times it repeats with the same
			// parameters, the results are the same. They can have side effects,
			// but the user doesn't expect them, so they cannot be critical to
			// the operation of the system. Requests can also be partial or
			// conditional.
		case 'POST':
			// Request that the resource at the URI do something with the
			// provided entity. Often POST is used to create a new entity,
			// but it can also be used to update an entity.
		case 'PUT':
			// Store an entity at a URI. PUT can create a new entity or update
			// an existing one. A PUT request is idempotent. Idempotency is the
			// main difference between the expectations of PUT versus a POST
			// request.
		case 'PATCH':
			// Update only the specified fields of an entity at a URI. A PATCH
			// request is idempotent. Idempotency is the main difference between
			// the expectations of PUT versus a POST request.
		case 'DELETE':
			// Request that a resource be removed; however, the resource does
			// not have to be removed immediately. It could be an asynchronous
			// or long-running request.
		case 'OPTIONS':
			// For documentation
	*/


	require_once '../../include/AltoRouter/AltoRouter.php';

	$router = new AltoRouter();
	$router->setBasePath('/api/v2');

	/***************************************************************************
	****************************************************************************
	***************************************************************************/

	// Handler
	require_once '../../include/json.php';
	function jsonResponse($input) {
		header('Content-Type: application/json');
		echo(prettyPrint(str_replace('\\/', '/', json_encode($input))));
	}

	// Add Assorted Routes
	// TODO: Modules?
	require_once './assessment.php';
	require_once './clinic.php';
	require_once './module.php';
	require_once './response.php';
	require_once './session.php';
	require_once './user.php';

	// Base Routes
	$router->addRoutes(array(
		array('GET', '/', function() {jsonResponse('Welcome to the dagger api!');}),
	));

	/***************************************************************************
	****************************************************************************
	***************************************************************************/

	$match = $router->match();

	// Either call the function (if it exists) or throw a 404 error
	if( $match && is_callable( $match['target'] ) ) {
		call_user_func_array( $match['target'], $match['params'] ); 
	} else {
		header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
	}
?>
