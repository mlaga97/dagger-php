<?php
	/**
	 * Library for configuration handling.
	 * 
	 * Configuration data is stored in the form of JSON files with key-value
	 * pairs, and is loaded by filename from both the webroot as well as from
	 * individual modules.
	 * 
	 * If multiple files define the same key or subkeys, the result will be the
	 * recursive merge of all available trees.
	 * 
	 * Multiple filenames can be used for separate configuration chains (e.g.
	 * 'config.json' and 'menu.json') and new configuration chains can be added
	 * by modules if appropriate.
	 * 
	 * Key names are defined in the Java namespace style, with the inverted
	 * fully qualified domain name followed by package name and so forth,
	 * this is not strictly enforced.
	 * 
	 * 
	 * Example config.json file:
	 * 
	 *     {
	 *         "edu.usm.dagger.main.example_object": {
	 *             "key": "value",
	 *             "foo": false,
	 *             "bar": 4
	 *         },
	 *         "edu.usm.dagger.main.example_array": [
	 *             "Hello",
	 *         	   3,
	 *             true
	 *         ],
	 *         "edu.usm.dagger.main.example_number": 5,
	 *         "edu.usm.dagger.main.example_string": "Test"
	 *     }
	 */


	/**
	 * Loads all json configuration files with a particular filename.
	 * 
	 * Takes a filename and loads ./[filename] and
	 * ./modules/[module]/[filename] for every available module, and returns
	 * them as individual elements of the resulting array.
	 * 
	 * @param string $filename [optional] Filename to search for and load.
	 * 
	 * @return array Array of individual configuration data loaded.
	 */
	function getUnmergedConfig($filename = 'config.json') {
		$path = $_SERVER['DOCUMENT_ROOT'] . '/' . $filename;
		$contents = file_get_contents($path);
		$config = json_decode($contents, true);

		foreach(moduleList() as $module) {
			if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module . '/' . $filename)) {
				$path = $_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module . '/' . $filename;
				$contents = file_get_contents($path);
				array_push($config, json_decode($contents, true));
			}
		}

		return $config;
	}


	/**
	 * Loads all json configuration files with a particular filename.
	 * 
	 * Takes a filename and loads ./[filename] and
	 * ./modules/[module]/[filename] for every available module, then
	 * recursively merges them together.
	 * 
	 * @param string $filename [optional] Filename to search for and load.
	 * 
	 * @return array Array of all configuration data loaded.
	 */
	function getConfig($filename = 'config.json') {
		$path = $_SERVER['DOCUMENT_ROOT'] . '/' . $filename;
		$contents = file_get_contents($path);
		$config = json_decode($contents, true);

		foreach(moduleList() as $module) {
			if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module . '/' . $filename)) {
				$path = $_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module . '/' . $filename;
				$contents = file_get_contents($path);
				$config = array_merge_recursive($config, json_decode($contents, true));
			}
		}

		return $config;
	}

	/**
	 * Loads all config.json files from the webroot and module roots for a
	 * particular configuration key.
	 *
	 * @param string $key Configuration key in question.
	 *
	 * @return array Array of configuration data for the key in question.
	 */
	function getConfigKey($key) {
		$config = getConfig();
		if( array_key_exists($key, $config)) {
			return $config[$key];
		} else {
			return array();
		}
	}

?>
