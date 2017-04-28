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
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>
	<body>
	<div class="container">
		<br><br>
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
				var submitButton = document.getElementById('dagger.reviewAssessment.submitButton');
				var pt_id = '<?php echo $_SESSION["patientID"]; ?>';
				if (pt_id == c_pt_id)
				{
					submitButton.disabled = false;
					submitButton.focus();
				}
				else {
					submitButton.disabled = true;
				}
			}
		</script>

		<div id="dagger.confirm.submit" style="text-align:center;margin-bottom:20px;padding:20px;border:1px solid black;background-color:lightyellow;">

				<label for="dagger.reviewAssessment.confirm_patientID" > Confirm Patient ID</label>
				<input type="text" id="dagger.reviewAssessment.confirm_patientID" oninput="enableSubmit(this.value);"/>

				<input type="button" value="Submit" id="dagger.reviewAssessment.submitButton" disabled onclick="window.location='/insertAssessment.php';" />
				<?php if ($_SESSION['grouping'] != 10) { ?>
					<!--<input type="button" value="Edit Personal Data" style="height: 25px; width: 125px" onclick="window.location='/updateAssessment.php'"/> -->
				<?php } ?>

		</div> <!-- End div dagger.confirm.submit -->

	<br /><br />

		<?php include 'modules/main/footer.php' ?>
	</div> <!-- Close DIV Class 'container' -->
	</body>
</html>
