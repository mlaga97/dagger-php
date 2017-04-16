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
	if($value == '-1' && !multiPregMatch(getConfigKey("edu.usm.dagger.main.reviewAssessment.dontSet_-1_to_0"), $key)) {
		$copy[$key] = 0;
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Assessment Evaluation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Assessment Evaluation">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>
	<body onload="clearForm();">
	<div class="container">
		<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
		<center><h1>Assessment Review</h1></center>
		<div style="border:1px solid #999;background-color:lightyellow;padding:10px;text-align:center;">
			You must confirm Patient ID and click Submit below to complete the review.
		</div>

			<!-- Before moduleLoad('reviewAssessment'); -->
			<?php

				// Show Modules
				moduleLoad('reviewAssessment');

			?>
			<!-- After moduleLoad('reviewAssessment'); -->

		<!-- Improve ME!!! -->
		<!-- Confirm patientID -->
		<script>
			function enableSubmit(c_pt_id) {
				var submitButton = document.getElementById('edu.usm.dagger.reviewAssessment.submitButton');
				var pt_id = '<?php echo $_SESSION["patientID"]; ?>';
				if (pt_id == c_pt_id)
				{
					submitButton.disabled = false;
				}
				else {
					submitButton.disabled = true;
				}
			}
		</script>

		<div style="align:center;">
			<label for="edu.usm.dagger.reviewAssessment.confirm_patientID" > Confirm Patient ID</label>
			<input type="text" id="edu.usm.dagger.reviewAssessment.confirm_patientID" oninput="enableSubmit(this.value);"/>
		</div>

		<center>
			<input type="button" value="Submit" id="edu.usm.dagger.reviewAssessment.submitButton" disabled style= "height: 25px; width: 100px" onclick="window.location='/insertAssessment.php';" />
			<?php if ($_SESSION['grouping'] != 10) { ?>
				<!--<input type="button" value="Edit Personal Data" style="height: 25px; width: 125px" onclick="window.location='/updateAssessment.php'"/> -->
			<?php } ?>
		</center>

		<?php include 'modules/main/footer.php' ?>
	</div> <!-- Close DIV Class 'container' -->
	</body>
</html>
