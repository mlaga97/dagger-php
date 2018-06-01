<?php

	// TODO: Auth token?
	// TODO: Reload user settings?

	$router->map('OPTIONS', '/auth', function() {
		jsonResponse(array(
			'/login' => 'Login with username and password',
			'/logout' => 'Logout',
		));
	});

	// Present a limited feature set if the user is not logged in
	if(!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized') {

		$router->map('GET', '/auth', function() {
			jsonResponse(false);
		});

		$router->map('OPTIONS', '/auth/login', function() {});

		$router->map('POST', '/auth/login', function() {
			$postData = json_decode(file_get_contents("php://input"), true);
			$response = login($postData['username'], $postData['password']);

			if(getType($response) == 'string') {
				jsonResponse('Authentication failed!');
			} else {
				jsonResponse('Authentication succeeded!');
			}
		});

		$match = $router->match();

		// Either call the function (if it exists) or throw a 401 (Authorization Required) error
		if($match && is_callable($match['target'])) {
			call_user_func_array($match['target'], $match['params']);
		} else {
			header($_SERVER['SERVER_PROTOCOL'] . ' 401');
		}

		// Don't do anything after this
		die();
	}

	$router->map('GET', '/auth', function() {
		jsonResponse(true);
	});

	$router->map('POST', '/auth/login', function() {
		jsonResponse('Already logged in!');
	});

	$router->map('POST', '/auth/logout', function() {
		jsonResponse('Logged out!');
		session_unset();
	});
?>
