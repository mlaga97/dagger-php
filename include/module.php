<?php

	function moduleList() {
		return array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/modules/"), array('..', '.'));
	}

	function moduleProvides($module) {
		$raw = array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/modules/" . $module), array('..', '.'));

		$processed = array();
		foreach($raw as $file) {
			if(is_dir($_SERVER['DOCUMENT_ROOT'] . "/modules/" . $module . '/' . $file)) {
				array_push($processed, $file);
			}
		}

		return $processed;
	}

	function moduleListKeys() {
		$keyList = array();

		foreach(moduleList() as $module) {
			foreach(moduleProvides($module) as $key) {
				array_push($keyList, $key);
			}
		}

		return array_unique($keyList);
	}

	function moduleListProviders($key) {
		$providerList = array();

		foreach(moduleList() as $module) {
			if(in_array($key, moduleProvides($module))) {
				array_push($providerList, $module);
			}
		}

		return $providerList;
	}

	function moduleListFiles($key) {
		$files = array();

		foreach(moduleListProviders($key) as $module) {
			$providerPath = $_SERVER['DOCUMENT_ROOT'] . "/modules/" . $module . '/' . $key;
			$files = array_merge($files, array_diff(scandir($providerPath), array('..', '.')));
		}

		sort($files);

		return array_unique($files);
	}

	function moduleListPaths($key) {
		$paths = array();

		foreach(moduleListFiles($key) as $file) {
			$paths = array_merge($paths, array_diff(glob($_SERVER['DOCUMENT_ROOT'] . "/modules/*/" . $key . '/' . $file), array('..', '.')));
		}

		return $paths;
	}

	// Takes variable argument list
	function moduleLoad() {
		foreach(func_get_args() as $key) {
			foreach(moduleListPaths($key) as $file) {
				include $file;
			}
		}
	}

?>
