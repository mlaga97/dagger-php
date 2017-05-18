<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/preassessment.php');

	$log->info("CLINICS LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));

	unsetAllButTheseKeys(getConfigKey("edu.usm.dagger.main.preassessment.keysToKeep"));
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Assessment Options</title>
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">
		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>

	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<div class='top'>
				<div class='header'>
					<div class='title'>
						<h1>Assessment Options</h1>
					</div> <!-- End div class title -->
				</div> <!-- End div class header -->
			</div> <!-- End div class top -->

			<!-- Body -->
			<form id='preassessment_form' action='/assessment.php' method='post' autocomplete='off' >
				<?php moduleLoad('preassessment'); ?>
			</form>

			<!-- Show Footer -->
			<?php include 'modules/main/footer.php'; ?>

		</div>
	</body>
</html>
