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
						<h1>Assessment Options</h1>
					</div>
					<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
				</div>
			</div>

			<br/><br/>

			<!-- Body -->
			<form id='preassessment_form' action='/assessment.php' method='post' autocomplete='off' >
				<?php moduleLoad('preassessment'); ?>
			</form>

		</div>
	</body>
</html>
