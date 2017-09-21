<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/preassessment.php');
	$pageTitle = "Assessment Options";

	$log->info("CLINICS LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));

	// TODO: This should do the thing below it.
	unsetAllButTheseKeys(getConfigKey("edu.usm.dagger.main.preassessment.keysToKeep"));

	// Reset all the session variables returned from the search
	// TODO: Don't pull the DB response into $_SESSION in the first place. (MVC would help)
	foreach($_SESSION as $key=>$value) {
		if(!in_array($key, getConfigKey("edu.usm.dagger.main.assessment.dontReset"))) {
			if(in_array($key, $_SESSION)) {
				unset($_SESSION[$key]);
			}

			if(in_array($key, getConfigKey("edu.usm.dagger.main.assessment.setBlank"))) {
				$_SESSION[$key] = '';
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Assessment Options</title>
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">

		<script src="/lib/jquery/3.2.1/jquery.min.js"></script>
		<script src="/lib/lodash/4.17.4/lodash.min.js"></script>

		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>
	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<?php include 'modules/main/header.php'; ?>

			<!-- Body -->
			<form id='preassessment_form' action='/assessment.php' method='post' autocomplete='off' >
				<?php moduleLoad('preassessment'); ?>
			</form>

			<!-- Footer -->
			<?php include 'modules/main/footer.php'; ?>

		</div>
	</body>
</html>
