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