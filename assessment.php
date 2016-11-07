<?php
	include 'include/dagger.php';
	loggingInit();
	allowPrevious('/preassessment.php', '/assessment.php');
	postToSession(array('status', 'previous'));

	$log->info("CLINIC LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));

	foreach($_SESSION as $key=>$value) {
		if(($key != 'id')           && ($key != 'uname')      && ($key != 'pswd')       && ($key != 'university_id') && ($key != 'clinic_id')    && ($key != 'status')       && 
		   ($key != 'logo')         && ($key != 'user_id')    && ($key != 'first_name') && ($key != 'last_name')     && ($key != 'stress_check') && ($key != 'health_check') && 
		   ($key != 'events_check') && ($key != 'gad_check')  && ($key != 'pcl_check')  && ($key != 'audit_check')   && ($key != 'cage_check')   && ($key != 'cd_check')     && 
		   ($key != 'phq_check')    && ($key != 'ces_check')  && ($key != 'GRHOP_standard') && ($key != 'assessment_type') && ($key != 'psc_check') 
		&& ($key != 'dast_check')   && ($key != 'duke_check') && ($key != 'symptom_check') && ($key != 'previous') && ($key != 'admin') 
	         &&($key != 'self_check')   && ($key != 'sdq_check')  &&($key != 'crafft_check')&&($key != 'life_check')&&($key != 'gad2_check') 
	         && ($key != 'pcl2_check')  && ($key != 'diagnosis_check')&& ($key != 'diag_me_check') && ($key != 'grouping') && ($key!='visit_type')&& 
	                ($key!='adhd_check')&&($key!='contact_type') && ($key != 'c_stress_check')&& ($key != 'pp_check') && ($key!='hypertension_check')
				&& ($key!='pediatric_check'))
		{
			$_SESSION[$key] = -1;

			if($key == 'sex') {
		 		$_SESSION['sex'] = "";
			}

			if($key == 'eth') {
		  		$_SESSION['eth'] = "";
			}

			if($key == 'living') {
		  		$_SESSION['living'] = "";
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
				// TODO: assessment_type
				dbOpen();
				loadModules('modules/assessment/');
				dbClose();

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