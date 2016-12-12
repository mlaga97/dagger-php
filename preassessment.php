<?php
	include 'include/dagger.php';
	loggingInit();
	allowPrevious('/options.php', '/preassessment.php');

	global $mysqli;

	$log->info("CLINICS LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));

	unsetAllButTheseKeys(getConfigKey("edu.usm.dagger.main.preassessment.keysToKeep"));
?>

<html>
	<head>
		<title>Options</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Assessment Options">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>

	<body>
		<?php include 'include/menu.php' ?>
		<?php echo $_SESSION['logo'] ?>
		<form id='preassessment_form' action='/assessment.php' method='post'>
			<?php

				// Show modules
				moduleLoad('preassessment');

			?>
		</form>
	</body>
</html>