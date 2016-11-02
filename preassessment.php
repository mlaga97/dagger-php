<?php
	include 'include/dagger.php';
	loggingInit();
	allowPrevious('/options.php', '/preassessment.php');

	$log->info("CLINICS LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));

	unsetAllButTheseKeys(array('user_id', 'clinic_id', 'admin', 'university_id', 'grouping', 'logo', 'status', 'previous', 'test_acc'));
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

				// Load and run the modules with database access
				dbOpen();
				loadModules('modules/preassessment/');
				dbClose();

			?>
		</form>
	</body>
</html>