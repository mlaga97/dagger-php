<?php

	// Log4php Setup
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/log4php/Logger.php');
	Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/include/log4php/config.xml');
	$log = Logger::getLogger('myLogger');

	// Set Timezone Data
	date_default_timezone_set('America/Chicago');
	$today = date('m-d-y h:i:s');

	// User session
	session_start();

	// Reject the unauthorized
	if(empty($noRedirect)) {
		if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized') {
			header("location: /index.php");
			die("Authentication required, redirecting!");
		}
	}

	// Import the libraries needed for MySQL to be loaded
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/module.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/config.php');

	// MySQL Setup
	$mysqli = new mysqli(
		getConfigKey("edu.usm.dagger.main.db.server"),
		getConfigKey("edu.usm.dagger.main.db.user"),
		getConfigKey("edu.usm.dagger.main.db.password")
	);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/setupCheck.php');

	// Import the dependencies for user access
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/access.php');

	// Reload user settings and reject anyone that is inactive
	if(empty($noRedirect)) {
		reloadUserSettings();
	}

	// Load the remaining libraries
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/utility.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/menu.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/version.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/json.php');

	// Reset the $noRedirect key used on the login page now that setup is done
	if(!empty($noRedirect)) {
		unset($noRedirect);
	}
?>
