<?php

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

	function getConfigKey($key) {
		$config = getConfig();
		return $config[$key];
	}

?>
