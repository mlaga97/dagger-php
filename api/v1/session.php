<?php
	/*
	 * /session			$_SESSION
	 */

	$router->map('GET', '/session', function() {
		jsonResponse($_SESSION);
	});

?>
