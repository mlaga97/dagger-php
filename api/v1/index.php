<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/json.php');
	header('Content-Type: application/json');

	// Only get first member of split
	$truncatedURI = explode('?', $_SERVER['REQUEST_URI'])[0];
	$uri = explode('/', $truncatedURI);

	// Get rid of blank first element
	array_shift($uri);

	// Our main arrays
	$methods = array();
	$output = array();
	$debug = array();
	$response = array();
	$error = '';

	/**************************************************************************
	***************************************************************************
	**************************************************************************/

	// Obtain an initial shortened URI for use in the lookup table
	// Do this before loading, just in case the methods need it in advance
	$shortURI = '';
	foreach(array_slice($uri, 2) as $slice)
		$shortURI = $shortURI . '/' . $slice;
	$debug['shortURI'] = $shortURI;

	// Only load the method files we actually need
	switch($uri[2]) {
		case 'auth':
			break;
		case 'test':
			break;
		case 'user':
			break;
		case 'group':
			break;
		case 'admin':
			break;
		case 'config':
			break;
		case 'clinic':
			break;
		case 'module':
			require_once 'module.php';
			break;
		case 'response':
			break;
		case 'assessment':
			require_once 'assessment.php';
			break;
		default:
			break;
	}

	// Continue shortening the URI until we get something valid, allowing
	// submethods to exist in the tree implicitly, and junk to be ignored
	$done = false;
	$cut = 0;
	do {
		$shortURI = '';

		foreach(array_slice($uri, 2, count($uri) - 2 - $cut++) as $slice)
			$shortURI = $shortURI . '/' . $slice;

		if(array_key_exists($shortURI, $methods)) {
			// Found it!
			$methods[$shortURI]();
			$done = true;
		}

	} while(!$done && $shortURI != '');

	// Either error, or show what the longest subset of the string that matches.
	if($done) {
		$debug['shortestValidURI'] = $shortURI;
	} else {
		$error = 'Method not implemented';
	}

	/**************************************************************************
	***************************************************************************
	**************************************************************************/

	// Diagnostics
	$debug['uri'] = $uri;
	$debug['get'] = $_GET;

	// Construct our output array
	if(array_key_exists('debug', $_GET) && $_GET['debug'] == 1)
		$output['debug'] = $debug;
	if(!empty($response))
		$output['response'] = $response;
	if($error != '')
		$output['error'] = $error;

	// Send the response
	echo(prettyPrint(json_encode($output, JSON_UNESCAPED_SLASHES)));
?>
