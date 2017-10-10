<?php
	global $mysqli;

	// Import the libraries needed for MySQL to be loaded
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/module.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/config.php');

	// MySQL Setup
	$mysqli = new mysqli(
		getConfigKey('edu.usm.dagger.main.db.server'),
		getConfigKey('edu.usm.dagger.main.db.user'),
		getConfigKey('edu.usm.dagger.main.db.password')
	);
?>
