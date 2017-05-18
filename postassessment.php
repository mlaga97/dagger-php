<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/assessment.php', '/postassessment.php');

	postToSession();
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Time Spent</title>
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">

	</head>

	<body>


	<div class="container" >
		<br><br>
		<center><h1>Time on Assessment</h1></center>
		<br><br>

		<div>
			<?php

				// Show Modules
				moduleLoad('postassessment');

			?>
		</div>

		<div style="text-align:center;margin-bottom:238px;">

			<form id="form" name="form1" action="/reviewAssessment.php" method="post" autocomplete="off">

				<label>Time associated with this assessment</label>
				<input type="number" min="0" max="600" step="1" id="assessment_time" name="assessment_time"  required autofocus > <label>minutes</label>
				<br><br>
				<br><br>
				<input type="submit" value="Review Assessment">

			</form>

		</div>

		<?php include 'modules/main/footer.php' ?>

	</div>	<!-- Close DIV Class 'container' -->
</body>
</html>
