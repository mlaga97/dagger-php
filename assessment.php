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
        <link rel="stylesheet" type="text/css" href="/include/src/datepickr.min.css">
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

	<script src="/include/src/datepickr.min.js"></script>
	<script>
		/* DatePickr Configuration */

		// Regular datepickr
		datepickr('#datepickr');

		// Custom date format
		datepickr('.datepickr', { dateFormat: 'Y-m-d'});

		// Min and max date
		datepickr('#minAndMax', {
			// few days ago
			minDate: new Date().getTime() - 2.592e8,
			// few days from now
			maxDate: new Date().getTime() + 2.592e8
		});

		// datepickr on an icon, using altInput to store the value
		// altInput must be a direct reference to an input element (for now)
		datepickr('.calendar-icon', { altInput: document.getElementById('calendar-input') });

		// If the input contains a value, datepickr will attempt to run Date.parse on it
		datepickr('[title="parseMe"]');

		// Overwrite the global datepickr prototype
		// Won't affect previously created datepickrs, but will affect any new ones
		datepickr.prototype.l10n.months.shorthand = ['jan', 'feb', 'mar', 'april', 'may', 'jun', 'jul', 'aug', 'sept', 'oct', 'nov', 'dec'];
		datepickr.prototype.l10n.months.longhand = ['January', 'Feburary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		datepickr.prototype.l10n.weekdays.shorthand = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
		datepickr.prototype.l10n.weekdays.longhand = ['Sunday', 'Monday', 'Tuesdat', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
		datepickr('#someFrench.sil-vous-plait', { dateFormat: '\\le j F Y' });

	</script>

</html>