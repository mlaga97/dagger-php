<?php

	// TODO: A lot

	$router->map('OPTIONS', '/module', function() {
		jsonResponse(array(
			'/key' => '',
			'/provider' => '',
		));
	});

	/***************************************************************************
	****************************************************************************
	***************************************************************************/
	// By Key

	$router->map('OPTIONS', '/module/key', function() {
		jsonResponse(array(
			'/key' => '',
			'/all' => '',
			'/list' => '',
			'/[:key]' => '',
			'/[:key]/files' => '',
			'/[:key]/paths' => '',
			'/[:key]/providers' => '',
			'/[:key]/truncatedPaths' => '',
		));
	});

	$router->addRoutes(array(
		array('GET', '/module/key/all', function() {jsonResponse('Method not implemented');}),
		array('GET', '/module/key/list', function() {jsonResponse(moduleListKeys());}),
		array('GET', '/module/key/[:key]/files', function($key) {jsonResponse(moduleListFiles($key));}),
		array('GET', '/module/key/[:key]/paths', function($key) {jsonResponse(moduleListPaths($key));}),
		array('GET', '/module/key/[:key]/providers', function($key) {jsonResponse(moduleListProviders($key));}),
		array('GET', '/module/key/[:key]/truncatedPaths', function($key) {jsonResponse(moduleListTruncatedPaths($key));}),
	));

	$router->map('GET', '/module/key/[:key]', function($key) {
		jsonResponse(array(
			'files' => moduleListFiles($key),
			'paths' => moduleListPaths($key),
			'providers' => moduleListProviders($key),
			'truncatedPaths' => moduleListTruncatedPaths($key),
		));
	});

	/***************************************************************************
	****************************************************************************
	***************************************************************************/
	// By provider

	$router->map('OPTIONS', '/module/provider', function() {
		jsonResponse(array(
			'/provider' => '',
			'/all' => '',
			'/list' => '',
			'/[:provider]' => '',
			'/[:provider]/load' => '',
			'/[:provider]/files' => '',
			'/[:provider]/paths' => '',
			'/[:provider]/provides' => '',
		));
	});

	$router->addRoutes(array(
		array('GET', '/module/provider/all', function() {jsonResponse('Method not implemented');}),
		array('GET', '/module/provider/list', function() {jsonResponse(moduleList());}),
		array('GET', '/module/provider/[:provider]/files', function($provider) {jsonResponse(moduleFiles($provider));}),
		array('GET', '/module/provider/[:provider]/provides', function($provider) {jsonResponse(moduleProvides($provider));}),
	));

	$router->map('GET', '/module/provider/[:provider]', function($provider) {
		jsonResponse(array(
			'files' => moduleFiles($provider),
			'provides' => moduleProvides($provider),
		));
	});

?>
