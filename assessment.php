<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/preassessment.php', '/assessment.php');

	postToSession(array('status', 'previous'));

	$log->info("CLINIC LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));
?><!DOCTYPE html>
<html>
	<head>
		<title>Brief <?php print_r($_SESSION['assessment_type']); ?> Assessment</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Assessment">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>

	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<div class='top'>
				<div class='logo'>
					<?php echo $_SESSION['logo']?>
				</div>
				<div class='header'>
					<div class='title'>
						<?php
						// TODO:Session var visit_type is no longer a thing.
							if($_SESSION['visit_type'] === "Comprehensive") {
								echo "<h1>Brief ";
								print_r($_SESSION['assessment_type']);
								echo "Clinical Screening</h1>";
							} else {
								echo '<h1>Brief Patient Visit</h1>';
							}
						?>
					</div>
					<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
				</div>
			</div>

			<br/><br/><br/>

			<!-- Body -->
			<form class='assessment_form' action='/postassessment.php' method='post' autocomplete='off' >
				<?php moduleLoad('assessment'); ?>
			</form>

		</div>
	</body>
</html>
