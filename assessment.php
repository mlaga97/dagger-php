<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/preassessment.php', '/assessment.php');

	postToSession(array('status', 'previous'));

	$log->info("CLINIC LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php print_r($_SESSION['assessment_type']); ?> Assessment</title>
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">
		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>

	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->

			<!-- Header -->
			<div class='top'>
				<div class='header'>
					<div class='title'>
						<h1>Assessment</h1>
					</div> <!-- End div class title -->
				</div> <!-- End div class header -->
			</div> <!-- End div class top -->


			<!-- Body -->
			<form class='assessment_form' action='/postassessment.php' method='post' autocomplete='off' >
				<?php moduleLoad('assessment'); ?>
			</form>

			<!-- Show Footer -->
			<?php include 'modules/main/footer.php'; ?>

		</div>
	</body>
</html>
