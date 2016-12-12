<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/preassessment.php', '/assessment.php');

	postToSession(array('status', 'previous'));

	$log->info("CLINIC LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));

	foreach($_SESSION as $key=>$value) {
		if(!in_array($key, getConfigKey("edu.usm.dagger.main.assessment.dontReset"))) {
			$_SESSION[$key] = -1;

			if(in_array($key, getConfigKey("edu.usm.dagger.main.assessment.setBlank"))) {
				$_SESSION[$key] = '';
			}
		}
	}

?>

<html>
	<head>
		<title>Brief <?php print_r($_SESSION['assessment_type']); ?> Assessment</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Assessment">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
        <style>
			.calendar-icon {
				display: inline-block;
				vertical-align: middle;
				width: 32px;
				height: 32px;
				background: url(images/calendar.png);
			}
		</style>
	</head>

	<body>
		<?php include 'include/menu.php' ?>
		<?php echo $_SESSION['logo'] ?>
			<div style="text-align: center;">
				<?php
					if($_SESSION['visit_type'] === "Comprehensive") {
						echo "<h1>Brief ";
						print_r($_SESSION['assessment_type']);
						echo "Clinical Screening</h1>";
					} else {
						echo '<h1>Brief Patient Visit</h1>';
					}

					date_default_timezone_set('America/Chicago');
					$today = date('l jS \of F Y h:i:s A');
					print_r($today);
				?>
			</div>

		<br/><br/><br/>

		<form id='assessment_form' action='/postassessment.php' method='post'>
			<?php

				// Show Modules
				moduleLoad('assessment');

			?>
		</form>
	</body>
</html>