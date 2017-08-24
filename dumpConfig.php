<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious($_SESSION['admin'] == 1, '/dumpConfig.php');

	header('Content-Type: application/json');
	echo(prettyPrint(json_encode(getConfig())));
?>
