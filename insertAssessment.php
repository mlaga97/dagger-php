<?php
	session_start();

	require_once('include/log4php/Logger.php');
	Logger::configure('include/log4php/config.xml');
	$log = Logger::getLogger('myLogger');
	date_default_timezone_set('America/Chicago');$today = date('m-d-y h:i:s');

	foreach($_POST as $key=>$value) {
		if (($key != 'status') && ($key != 'previous')) {
			$_SESSION[$key] = $value;
		}
	}

	if(
		!isset($_SESSION['status']) ||
		$_SESSION['status'] != 'authorized' ||
		$_SESSION['previous'] != '/reviewAssessment.php' ||
		!array_key_exists('n1', $_SESSION) ||
		!array_key_exists('n2', $_SESSION) ||
		!array_key_exists('n3', $_SESSION) ||
		!array_key_exists('n4', $_SESSION)
	) {
		header("location: /index.php");
		die("Authentication required, redirecting");
	}

	$_SESSION['previous'] = '/insertAssessment.php';

	require_once 'include/constants.php';
	$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

	$modules = array_diff(scandir('modules/insertAssessment'), array('..', '.'));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>Assessment Evaluation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Assessment Evaluation">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>
	<body>
		<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->

		<?php

			// Show Modules
			// TODO: assessment_type and mysqli
			foreach($modules as $module) {
				include 'modules/insertAssessment/' . $module;
				echo '<br/>';
			}

		?>

		<center><h1>Success!</h1></center>

		<center><input type="button" value="Return to Start" style= "height: 25px; width: 100px" onclick="window.location='/index.php';" /></center>

		<?php include 'include/footer.php' ?>
	</body>
</html>
