<?php

	// Set noRedirect to allow importing dagger.php without redirecting
	// TODO: Find a more elegant solution
	$noRedirect = true;

	// Load libraries
	require_once '../../include/dagger.php';
	require_once '../../include/json.php';
	require_once '../../include/AltoRouter/AltoRouter.php';

	// Configure altorouter
	// TODO: Configure basePath automatically
	$router = new AltoRouter();
	$router->setBasePath('/api/v2');

	// Verify user authentication first!
	require_once './auth.php';

	// Base routes
	$router->map('GET', '/', function() {
		jsonResponse('Welcome to the dagger api!');
	});

	// Add assorted routes
	// TODO: Modularize?
	require_once './assessment.php';
	require_once './clinic.php';
	require_once './module.php';
	require_once './response.php';
	require_once './session.php';
	require_once './user.php';

	// Documentation route
	// TODO: Load from modules?
	$router->map('OPTIONS', '/', function() {
		jsonResponse(array(
			'assessment' => '',
			'auth' => '',
			'clinic' => '',
			'module' => '',
			'response' => '',
			'session' => '',
			'user' => '',
		));
	});

	// Perform routing
	$match = $router->match();

	// Either call the function (if it exists) or throw a 404 (Not Found) error
	if( $match && is_callable($match['target'])) {
		call_user_func_array($match['target'], $match['params']); 
	} else {
		header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
	}

?>
