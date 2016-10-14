<?php
	session_start();

	require_once('include/log4php/Logger.php');
	Logger::configure('include/log4php/config.xml');
	$log = Logger::getLogger('myLogger');
	date_default_timezone_set('America/Chicago');$today = date('m-d-y h:i:s');

	foreach($_POST as $key=>$value) {
		if (($key != 'status') && ($key != 'previous')) {
			$_SESSION[$key] = $value;
		}
	}

	if(
			!isset($_SESSION['status']) ||
			$_SESSION['status'] != 'authorized' ||
			$_SESSION['previous'] != '/submit.php' ||
			!array_key_exists('n1', $_SESSION) ||
			!array_key_exists('n2', $_SESSION) ||
			!array_key_exists('n3', $_SESSION) ||
			!array_key_exists('n4', $_SESSION)
	) {
		header("location: /index.php");
		die("Authentication required, redirecting");
	}

	$_SESSION['previous'] = '/reviewAssessment.php';

	$modules = array_diff(scandir('modules/reviewAssessment'), array('..', '.'));
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>Assessment Evaluation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Assessment Evaluation">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>
	<body onload="clearForm();">
		<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
		<center><h1>Assessment Evaluation</h1></center>
		<center><?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today); ?></center>

		<script type="text/javascript"> //Our function to print the webpage. 
			function printpage() {
				window.print();
			}
		</script>

		<center>
			<?php

				// Show Modules
				// TODO: assessment_type and mysqli
				foreach($modules as $module) {
					include 'modules/reviewAssessment/' . $module;
					echo '<br/>';
				}

			?>
		</center>

		<center>
			<input type="button" value="Submit" style= "height: 25px; width: 100px" onclick="window.location='/insertAssessment.php';" />
			<?php if ($_SESSION['grouping'] != 10){echo "<input type=\"button\" value=\"Edit Personal Data\" style= \"height: 25px; width: 125px\" onclick=\"window.location=\'/edit.php\';\"/>";} ?>
			<input type="button" style= "height: 25px; width: 100px" value="Print this page" onclick="printpage()" />
		</center>

		<?php include 'include/footer.php' ?>
	</body>
</html>