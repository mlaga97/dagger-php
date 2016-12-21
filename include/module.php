<?php

	function moduleList() {
		return array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/modules/"), array('..', '.'));
	}

	function moduleProvides($module) {
		$raw = array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/modules/" . $module), array('..', '.'));

		$processed = array();
		foreach($raw as $file) {
			if(!preg_match('/\.php/', $file)) {
				array_push($processed, $file);
			}
		}

		return $processed;
	}

	function moduleListKeys() {
		$keyList = array();
		foreach(moduleList() as $module) {
			$keys = array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/modules/" . $module), array('..', '.'));

			foreach($keys as $key) {
				if(!preg_match('/\.php/', $key)) {
					array_push($keyList, $key);
				}
			}
		}

		return array_unique($keyList);
	}

	function moduleListProviders($key) {
		$raw = array_diff(glob($_SERVER['DOCUMENT_ROOT'] . "/modules/*/" . $key), array('..', '.'));

		$processed = array();
		foreach($raw as $file) {
			if(!preg_match('/\.php/', $file)) {
				array_push($processed, $file);
			}
		}

		return $processed;
	}

	function moduleListPaths($key) {
		$files = array();
		foreach(moduleListProviders($key) as $provider) {
			$files = array_merge($files, array_diff(scandir($provider), array('..', '.')));
		}

		sort($files);

		$paths = array();
		foreach($files as $file) {
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
