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
	 *		/provider/
	 *			/all
	 *			/list						moduleList()
	 *			/{provider-name}/
	 *				/load					moduleLoad($module) ?????????????????????????????
	 *				/files					moduleFiles($module)
	 *				/provides				moduleProvides($module)
	 */
	// TODO: A lot

	$router->addRoutes(array(
		array('GET', '/module/key/all', function() {jsonResponse('Method not implemented');}),
		array('GET', '/module/key/list', function() {jsonResponse(moduleListKeys());}),
		array('GET', '/module/key/[:key]/files', function($key) {jsonResponse(moduleListFiles($key));}),
		array('GET', '/module/key/[:key]/paths', function($key) {jsonResponse(moduleListPaths($key));}),
		array('GET', '/module/key/[:key]/providers', function($key) {jsonResponse(moduleListProviders($key));}),

		array('GET', '/module/provider/all', function() {jsonResponse('Method not implemented');}),
		array('GET', '/module/provider/list', function() {jsonResponse(moduleList());}),
		//array('GET', '/module/provider/[:provider]/load', function($provider) {jsonResponse(moduleListPaths($key));}),
		array('GET', '/module/provider/[:provider]/files', function($provider) {jsonResponse(moduleFiles($key));}),
		//array('GET', '/module/provider/[:provider]/paths', function($provider) {jsonResponse(moduleListPaths($key));}),
		array('GET', '/module/provider/[:provider]/provides', function($provider) {jsonResponse(moduleProvides($provider));}),
	));

?>
