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
						// TODO: Session var visit_type is no longer a thing.
							if($_SESSION['visit_type'] === "Comprehensive") {
								echo "<h1>Brief ";
								print_r($_SESSION['assessment_type']);
								echo "Clinical Screening</h1>";
							} else {
								echo '<h1>Assessment</h1>';
							}
						?>
					</div> <!-- End div class title -->
				</div> <!-- End div class header -->
			</div> <!-- End div class top -->

			<br/><br/><br/>

			<!-- Body -->
			<form class='assessment_form' action='/postassessment.php' method='post' autocomplete='off' >
				<?php moduleLoad('assessment'); ?>
			</form>

		</div>
	</body>
</html>
