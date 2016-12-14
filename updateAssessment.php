<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/reviewAssessment.php', '/updateAssessment.php');

	postToSession(array('status', 'previous'));
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
</html>