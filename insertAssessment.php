<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/reviewAssessment.php', '/insertAssessment.php');

	postToSession(array('status', 'previous'));
?><!DOCTYPE html>
<html>
	<head>
		<title>Assessment Evaluation</title>
		<meta charset="utf-8">
		<?php // User is not actually logged out until redirected -- enforce redirect in 30 sec ?>
		<meta http-equiv="refresh" content="30; url=/index.php" />
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">
		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>
	<body>
	<div class="container" >

		<?php

			// Show Modules
			moduleLoad('insertAssessment');

		?>

		<div style="text-align:center;">
			<h1>Patient Record Saved</h1>
		</div>


		<div style="text-align:center;margin-bottom:70px;">
			Reauthenticate your login credentials to continue.
		</div>

		<div style="text-align:center;margin-bottom:70px;">
			<input type="button" value="Logout / Login" onclick="window.location='/index.php';" autofocus />
			<br><br>
		</div>

		<div style="text-align:center;margin-bottom:162px;">
			You will be automatically logged out in 30 seconds.
		</div>

		<?php include 'modules/main/footer.php' ?>
	</div> <!-- Close DIV Class 'container' -->
	</body>
</html>
