<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/uri.php');

function recursiveParser($localURI, $context, $method, $getVars, $postVars) {

	// Explode context
	$trace = $context['trace'];
	$debug = $context['debug'];
	$error = $context['error'];
	$output = $context['output'];
	$methods = $context['methods'];
	$response = $context['response'];

	/***********************************************************************
	************************************************************************
	***********************************************************************/

	$uriString = getURIPath($localURI);

	// Find longest valid match.
	if($uriString != '') {
		if(array_key_exists($uriString, $methods)) {
			$trace = $methods[$uriString]('', $context, $method, $getVars, $postVars);
		} else {
			$explodedURI = explodeURI($uriString);

			$cut = 1;
			$done = false;

			while(!$done && $cut < count($explodedURI)) {
				$matchingURI = '/' . join('/', array_slice($explodedURI, 0, -$cut));
				$subURI = '/' . join('/', array_slice($explodedURI, -$cut++));

				if(array_key_exists($matchingURI, $methods)) {
					$done = true;
					$trace = $methods[$matchingURI]($subURI, $context, $method, $getVars, $postVars);
				}
			}

			if(!$done)
				$error = 'Invalid option! No match!';
				// Print valid options
				foreach($methods as $methodID => $method) {
					array_push($response, str_replace('/api/v1', '', $methodID));
				}
		}
	} else {
		$error = 'Invalid option!';
		// Print valid options
		foreach($methods as $methodID => $method) {
			array_push($response, $methodID);
		}
	}

	/***********************************************************************
	************************************************************************
	***********************************************************************/

	// Diagnostics
	$debug['fullRequest'] = $localURI;
	$debug['uriString'] = $uriString;
	$debug['get'] = $_GET;

	// Construct our output array
	if(!empty($trace)) {
		if(array_key_exists('response', $trace))
			$response = $trace['response'];
		if(array_key_exists('error', $trace))
			$error = $trace['error'];
	}
	if(array_key_exists('debug', $getVars) && $getVars['debug'] == 1)
		$output['debug'] = $debug;
	if(!empty($response))
		$output['response'] = $response;
	if(array_key_exists('trace', $getVars) && $getVars['trace'] == 1 && !empty($trace))
		$output['trace'] = $trace;
	if($error != '')
		$output['error'] = $error;

	return $output;
}

function newAPIContext() {
	return array(
		'error' => '',
		'trace' => array(),
		'debug' => array(),
		'output' => array(),
		'methods' => array(),
		'response' => array()
	);
}

/*******************************************************************************
********************************************************************************
*******************************************************************************/
// Set up our global context

$globalAPIContext = newAPIContext();

$globalAPIContext['methods']['/api/v1/module'] = function($localURI, $context, $method, $getVars, $postVars) {
	$methods = array();
	require_once 'module.php';
	$context['methods'] = $methods;

	return recursiveParser($localURI, $context, $method, $getVars, $postVars);
};

require_once 'user.php';
require_once 'clinic.php';
require_once 'session.php';
require_once 'response.php';
require_once 'assessment.php';

?>
