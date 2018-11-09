<?php

	// TODO: Auth token?
	// TODO: Reload user settings?

	$router->map('OPTIONS', '/auth', function() {
		jsonResponse([
			'/' => 'Check authentication status',
			'/login' => 'Login with username and password',
			'/logout' => 'Logout',
		]);
	});

	// Present a limited feature set if the user is not logged in
	if(!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized') {

		$router->map('GET', '/auth', function() {
			jsonResponse(false);
		});

		$router->map('OPTIONS', '/auth/login', function() {});
    $router->map('OPTIONS', '/response', function() {}); // TODO: Not this.

		$router->map('POST', '/auth/login', function() {
			$postData = json_decode(file_get_contents("php://input"), true);
			$response = login($postData['username'], $postData['password']);

      if(getType($response) == 'string') {
        jsonResponse($response);
			} else {
        jsonResponse([
          'userID' => $_SESSION['user_id'],
          'message' => 'Authentication succeeded',
          'success' => true,
        ]);
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
    jsonResponse([
      'userID' => $_SESSION['id'],
      'message' => 'Already logged in!',
      'success' => false,
    ]);
	});

	$router->map('POST', '/auth/logout', function() {
		jsonResponse('Logged out!');
		session_unset();
	});
?>
