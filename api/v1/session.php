<?php
	/*
	 * /session			$_SESSION
	 */

	$router->map('GET', '/session', function() {
		session_start();
		jsonResponse($_SESSION);
	});

?>
