<?php
	/*	/module/
	 *		/key/
	 *			/list						moduleListKeys()
	 *			/{key-name}/
	 *				/files					moduleListFiles($key)
	 *				/paths					moduleListPaths($key)
	 *				/providers				moduleListProviders($key)
	 *		/provider/
	 *			/list						moduleList()
	 *			/{provider-name}/
	 *				/load					moduleLoad($module)
	 *				/files
	 *				/paths
	 *				/provides				moduleProvides($module)
	 */

	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/module.php';

	$methods["/key/list"] = function($subURI, $context, $getVars) {
		$response = array();

		// TODO: Move to library
		foreach(moduleListKeys() as $module) {
			array_push($response, $module);
		}

		$context["response"] = $response;
		return $context;
	};

	$methods["/key"] = function($subURI, $context, $getVars) {
		$explodedURI = explodeURI($subURI);
		$response = array();

		if(!array_key_exists(0, $explodedURI)) {
			$context['error'] = 'Method not implemented';
		} else if(array_key_exists(1, $explodedURI)) {
			switch($explodedURI[1]) {
				case 'files':
					$response = moduleListFiles($explodedURI[0]);
					break;
				case 'paths':
					$response = moduleListPaths($explodedURI[0]);
					break;
				case 'providers':
					$response = moduleListProviders($explodedURI[0]);
					break;
			}
		} else {
			$response['files'] = moduleListFiles($explodedURI[0]);
			$response['paths'] = moduleListPaths($explodedURI[0]);
			$response['providers'] = moduleListProviders($explodedURI[0]);
		}

		if(!empty($response))
			$context['response'] = $response;
		return $context;
	};

	$methods["/provider/list"] = function($subURI, $context, $getVars) {
		$response = array();

		// TODO: Move to library
		foreach(moduleList() as $module) {
			array_push($response, $module);
		}

		$context["response"] = $response;
		return $context;
	};

	$methods["/provider"] = function($subURI, $context, $getVars) {
		$explodedURI = explodeURI($subURI);

		if(!array_key_exists(0, $explodedURI)) {
			$context['error'] = 'Method not implemented';
			return;
		}

		if(array_key_exists(1, $explodedURI)) {
			switch($explodedURI[1]) {
				case 'files':
					$context['error'] = 'Method not implemented';
					break;
				case 'paths':
					$context['error'] = 'Method not implemented';
					break;
				case 'provides':
					$response = moduleProvides($explodedURI[0]);
					break;
				default:
					$context['error'] = 'Method not implemented';
					break;
			}
		} else {
			$response['provides'] = moduleProvides($explodedURI[0]);
		}

		if(!empty($response))
			$context['response'] = $response;
		return $context;
	};
?>
