<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(array('/postassessment.php', '/updateAssessment.php'), '/reviewAssessment.php');

	postToSession(array('status', 'previous'));
?>

<?php
	//we'll make a copy of the values saved in $_SESSION and set all '-1' values to 0 so we can do the cut-off calculations.
	//except the duke and the cd-risc. They need to keep the -1 values for scoring.
	$copy = $_SESSION;
	if($value == '-1' && !multiPregMatch(getConfigKey("dagger.main.reviewAssessment.dontSet_-1_to_0"), $key)) {
		$copy[$key] = 0;
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Activity Review</title>
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">
		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>
	<body>
	<div class="container">
		<br><br>
		<center><h1>Assessment Review</h1></center>

		<?php

			// Show Modules
			moduleLoad('reviewAssessment');

		?>

		<?php include 'modules/main/footer.php' ?>
	</div> <!-- Close DIV Class 'container' -->
	</body>
</html>
