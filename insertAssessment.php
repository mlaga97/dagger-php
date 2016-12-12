<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/reviewAssessment.php', '/insertAssessment.php');

	postToSession(array('status', 'previous'));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>Assessment Evaluation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Assessment Evaluation">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>
	<body>
		<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->

		<?php

			// Show Modules
			moduleLoad('insertAssessment');

		?>

		<center><h1>Success!</h1></center>

		<center><input type="button" value="Return to Start" style= "height: 25px; width: 100px" onclick="window.location='/index.php';" /></center>

		<?php include 'include/footer.php' ?>
	</body>
</html>
