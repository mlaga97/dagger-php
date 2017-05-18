<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/home.php');

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
			<div class='top' style="margin-bottom:80px;">
				<div class='header'>
						<h1>Dagger Online Assessments</h1>
				</div>
			</div>

			<!-- Body -->
			<div style="text-align:center;margin-bottom:295px;">
				<input type="submit" value="Assessment"
					onclick="window.location='/preassessment.php'" autofocus />
					<input type="submit"
					value="Search"
					onclick="window.location='/searchAssessments.php';" />
			</div>

			<!-- Footer -->
			<?php include 'modules/main/footer.php' ?>

		</div>
	</body>
</html>
