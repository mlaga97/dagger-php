<?php

	session_start();
	require_once('include/Mysql.php');
	require_once 'include/constants.php';
	$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

	require_once('include/log4php/Logger.php');
	Logger::configure('include/log4php/config.xml');
	$log = Logger::getLogger('myLogger');
	date_default_timezone_set('America/Chicago');$today = date('m-d-y h:i:s');

	if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized') {
	    header("location: /index.php");
	    die("Authentication required, redirecting");
	}
	$log->info("CLINICS LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));
	$_SESSION['previous'] = '/preassessment.php';

	foreach ($_SESSION as $key => $value) {
	    if (($key != 'user_id') && ($key != 'clinic_id') && ($key != 'admin') && ($key != 'university_id') && ($key != 'grouping') && ($key != 'logo') &&
	            ($key != 'status') && ($key != 'previous') && ($key != 'test_acc')) {
	        unset($_SESSION[$key]);
	    }
	}

	$modules = array_diff(scandir('modules/preassessment'), array('..', '.'));
?>

<html>
	<head>
		<title>Options</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Clinic Select">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>

	<body>
		<?php include 'include/menu.php' ?>
		<?php echo $_SESSION['logo'] ?>
		<form id='preassessment_form' action='/assessment.php' method='post'>
			<?php

				// Show Modules
				foreach($modules as $module) {
					include 'modules/preassessment/' . $module;
					echo '<br/>';
				}

			?>
		</form>
	</body>
</html>