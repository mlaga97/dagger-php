<?php
	global $mysqli;

	// Import the libraries needed for MySQL to be loaded
	require_once('./include/module.php');
	require_once('./include/config.php');

	// MySQL Setup
	$mysqli = new mysqli(
		getConfigKey('edu.usm.dagger.main.db.server'),
		getConfigKey('edu.usm.dagger.main.db.user'),
		getConfigKey('edu.usm.dagger.main.db.password')
	);
?>
