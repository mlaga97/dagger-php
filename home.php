<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/home.php');
	$pageTitle = "Dagger Online Assessments";

	postToSession(array('status', 'previous'));

	$log->info("OPTIONS LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ".  print_r($_SESSION, true));
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Welcome</title>
		<meta name="description" content="Dagger Home">
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">
		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>
	<body>
		<div class='container' >

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<?php include 'modules/main/header.php'; ?>

			<!-- Body -->
			<div style="text-align:center;margin-bottom:295px;">
				<input type="submit" value="Assessment" onclick="window.location='preassessment.php'" autofocus />
				<input type="submit" value="Search" onclick="window.location='searchAssessments.php';" />
			</div>

			<!-- Footer -->
			<?php include 'modules/main/footer.php' ?>

		</div>
	</body>
</html>
