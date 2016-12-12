<?php
	include 'include/dagger.php';
	loggingInit();
	allowPrevious(array('/postAssessment.php', '/updateAssessment.php'), '/reviewAssessment.php');
	postToSession(array('status', 'previous'));

	global $mysqli;

	//we'll make a copy of the values saved in $_SESSION and set all '-1' values to 0 so we can do the cut-off calculations.
	//except the duke and the cd-risc. They need to keep the -1 values for scoring.
	$copy = $_SESSION;
	if($value == '-1' && !multiPregMatch(getConfigKey("edu.usm.dagger.main.reviewAssessment.dontSet_-1_to_0"), $key)) {
		$copy[$key] = 0;
	}
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
				moduleLoad('reviewAssessment');

			?>
		</center>

		<center>
			<input type="button" value="Submit" style= "height: 25px; width: 100px" onclick="window.location='/insertAssessment.php';" />
			<?php if ($_SESSION['grouping'] != 10) { ?>
				<input type="button" value="Edit Personal Data" style="height: 25px; width: 125px" onclick="window.location='/updateAssessment.php'"/>
			<?php } ?>
			<input type="button" style= "height: 25px; width: 100px" value="Print this page" onclick="printpage()" />
		</center>

		<?php include 'include/footer.php' ?>
	</body>
</html>