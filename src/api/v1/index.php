<?php

	// Set noRedirect to allow importing dagger.php without redirecting
	// TODO: Find a more elegant solution
	$noRedirect = true;

	// Ensure that the api can be used externally
	// TODO: Figure out what the proper thing to do here is, as opposed to just adding things until it works.
	if(array_key_exists('HTTP_ORIGIN', $_SERVER)) {
		$http_origin = $_SERVER['HTTP_ORIGIN'];

		// TODO: Whitelist
		//if($http_origin == "http://www.domain1.com" || $http_origin == "http://www.domain2.com") {  
			header("Access-Control-Allow-Origin: $http_origin");
		//}

		header('Access-Control-Allow-Credentials: true');
	}
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

	// Load libraries
	require_once '../../include/dagger.php';
	require_once '../../include/json.php';
	require_once '../../include/AltoRouter/AltoRouter.php';

  // TODO: Move somewhere else
  function queryMetadata($parameters, $data) {
    $queryID = $_GET['queryID'];

    if ($queryID) {
      jsonResponse([
        queryID => $queryID,
        params => $_GET,
        data => $data,
      ]);
    } else {
      // TODO: Deprecate
      jsonResponse($data);
    }
  }

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
	require_once './statistics.php';

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
      'info' => '',
      'statistics' => '',
		));
  });

  // Version
  $router->map('GET', '/info', function() {
    jsonResponse([
      versionString => $_SESSION['versionString'],
      revisionDate => $_SESSION['revisionDate'],
    ]);
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
