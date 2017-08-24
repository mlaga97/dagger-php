<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/module.php';

	$methods["/module/key/list"] = function() {
		global $response;

		// TODO: Move to library
		foreach(moduleListKeys() as $module) {
			array_push($response, $module);
		}

	};

	$methods["/module/provider/list"] = function() {
		global $response;

		// TODO: Move to library
		foreach(moduleList() as $module) {
			array_push($response, $module);
		}

	};
?>
