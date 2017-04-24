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
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>

	<body>
	<div class="container">
		<div class="top">
			<div class="logo">
				<?php echo $_SESSION['logo'] ?>
			</div>
		</div>

		<?php

			// Show Modules
			moduleLoad('postassessment');

		?>

		<form id="form" name="form1" action="/reviewAssessment.php" method="post" autocomplete="off">
			<center><h1>Time on Assessment</h1></center>
			<label>Time associated with this assessment</label>
			<input type="number" min="0" max="600" step="1" id="assessment_time" name="assessment_time"  required autofocus > <label>minutes</label>

		<br /><br />
		<center>
			<input class="submit"  type="submit" value="Review Assessment" >
		</center>
		</form>

		<br/><br/><br/>

		<?php include 'modules/main/footer.php' ?>
	</div>	<!-- Close DIV Class 'container' -->
	</body>
</html>
