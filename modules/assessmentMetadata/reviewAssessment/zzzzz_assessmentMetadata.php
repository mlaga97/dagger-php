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

<form id="dagger.confirm.submit" style="text-align:center;margin-bottom:21px;padding:20px;border:1px solid black;background-color:lightyellow;" action="/insertAssessment.php" method="post">

	<!-- TODO: Move elsewhere -->
	<?php if(in_array($_SESSION["activityType"], array("Appointment", "Warm Hand Off", "Warm Hand Off and Physician Consult", "Physician Consult Only", "Patient Assistance", "HCH Screening", "Phone Call")) ) { ?>
		<label for="dagger.reviewAssessment.assessmentTime" > Activity Duration (Minutes)</label>
		<input type="number" min="0" max="600" step="1" id="dagger.reviewAssessment.assessmentTime" name="assessmentTime" /><br/>
	<?php } ?>

	<label for="dagger.reviewAssessment.confirm_patientID" > Confirm Patient ID</label>
	<input type="text" id="dagger.reviewAssessment.confirm_patientID" oninput="enableSubmit(this.value);" autocomplete="off"/>

	<input type="submit" value="Submit" id="dagger.reviewAssessment.submitButton" disabled />
	<?php if ($_SESSION['grouping'] != 10) { ?>
		<!--<input type="button" value="Edit Personal Data" style="height: 25px; width: 125px" onclick="window.location='/updateAssessment.php'"/> -->
	<?php } ?>

</form> <!-- End div dagger.confirm.submit -->

<br /><br />
