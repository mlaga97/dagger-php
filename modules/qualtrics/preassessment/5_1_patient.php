<label>
	<h3>Patient ID</h3>
	<input type="text" name="patientID">
</label>

<br/><br/>

<!-- Temporary fix for old assessments wrapped in conditionals of deprecated field assessment_type -->
<script>
function setAssessmentTypeVal(dateString)
{
	var today = new Date();
	var birthDate = new Date(dateString);
	var age = today.getFullYear() - birthDate.getFullYear();
	var m = today.getMonth() - birthDate.getMonth();
	if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
	{
		age--;
	}
	var hiddenField = document.getElementById('assessment_type');
	if (age < 18)
	{
		hiddenField.value = "Child";
	}
	else
	{
		hiddenField.value = "Adult";
	}
}
</script>

<label>
	<h3>Patient DOB</h3>
	<input type="date" name="dob" onblur="setAssessmentTypeVal(this.value);">
</label>

<!-- Temp fix for old assessment display -->
<input type="hidden" id="assessment_type" name="assessment_type" value="Adult" >

<br/><br/><hr/>
