<?php
	/*
	 *	/module/
	 *		/key/
	 *			/all
	 *			/list						moduleListKeys()
	 *			/{key-name}/
	 *				/files					moduleListFiles($key)
	 *				/paths					moduleListPaths($key)
	 *				/providers				moduleListProviders($key)
	 *				/truncatedPaths			moduleListTruncatedPaths($key)
	 *		/provider/
	 *			/all
	 *			/list						moduleList()
	 *			/{provider-name}/
	 *				/load					????
	 *				/files					moduleFiles($module)
	 *				/paths					????
	 *				/provides				moduleProvides($module)
	 */
	// TODO: A lot

	/***************************************************************************
	****************************************************************************
	***************************************************************************/
	// By Key

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
