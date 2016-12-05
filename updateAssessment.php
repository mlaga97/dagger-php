<?php
	include 'include/dagger.php';
	loggingInit();
	allowPrevious('/reviewAssessment.php', '/updateAssessment.php');
	postToSession(array('status', 'previous'));
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
		<?php echo $_SESSION['logo'] ?>
		<div style="text-align: center;">
			<h1>Edit Personal Information</h1>
		</div>

		<br/><br/><br/>

		<form id='assessment_form' action='/reviewAssessment.php' method='post'>
			<?php

				// Show Modules
				moduleLoad('updateAssessment');

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