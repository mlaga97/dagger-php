<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/preassessment.php', '/assessment.php');
	$pageTitle = "Assessment";

	postToSession(array('status', 'previous'));

	$log->info("CLINIC LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));
?>

<!DOCTYPE html>
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
			<?php include 'modules/main/header.php'; ?>

			<!-- Body -->
			<form class='assessment_form' action='reviewAssessment.php' method='post' autocomplete='off' >
				<?php moduleLoad('assessment'); ?>
			</form>

			<!-- Footer -->
			<?php include 'modules/main/footer.php'; ?>

		</div>
	</body>
</html>
