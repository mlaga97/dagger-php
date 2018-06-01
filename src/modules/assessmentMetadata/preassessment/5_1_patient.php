<label>
	<h3>Patient ID</h3>
	<input type="text" name="patientID" required autofocus />
</label>

<br/><br/>

<!-- Temporary fix for old assessments wrapped in conditionals of deprecated field assessment_type -->
<script>
function setAssessmentTypeVal(dateString) {
	var today = new Date();
	var birthDate = new Date(dateString);
	var age = today.getFullYear() - birthDate.getFullYear();
	var m = today.getMonth() - birthDate.getMonth();
	if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
		age--;
	}
	var hiddenField = document.getElementById('assessment_type');
	var displayedField = document.getElementById('assessment_type_display');
	if (age < 18) {
		hiddenField.value = "Child";
		displayedField.value = "Child";

		dagger.jsonAssessment.preassessment.updateKey('assessment_type', 'Child');
	}
	else if (age >= 18) {
		hiddenField.value = "Adult";
		displayedField.value = "Adult";
		dagger.jsonAssessment.preassessment.updateKey('assessment_type', 'Adult');
	}
	else {
		displayedField.value = "";
	}

	// Display, clear calculated age
	var ca = document.getElementById('current_age');
	if (age >= 1) {
		ca.value = age;
	}
	else {
		ca.value = "";
	}


		// Toggle for Adult & Child assessement options
		//var ax_div_obj = document.getElementById('assessment_selection');
    var adult_selections = document.getElementsByClassName('adultonly');
		var child_selections = document.getElementsByClassName('childonly');

		if (hiddenField.value == "Child") {

				for(var i=0, len=adult_selections.length; i < len; i++) {
		        adult_selections[i].style.display = "none";
		    }

				for(var i=0, len=child_selections.length; i < len; i++) {
		        child_selections[i].style.display = "block";
		    }
		}
		else {

				for(var i=0, len=adult_selections.length; i < len; i++) {
		        adult_selections[i].style.display = "block";
		    }

				for(var i=0, len=child_selections.length; i < len; i++) {
		        child_selections[i].style.display = "none";
		    }
		}

	}


</script>


<!-- TODO: Move to demographics? -->
<label>
	<h3>Patient DOB</h3>
	<input type="date" name="dob" onblur="formatDate(this);setAssessmentTypeVal(this.value);" min="1900-01-01" max="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" required />
</label>

<div style="float:right;width:300px;text-align:right;">
	<label>
		&nbsp;&nbsp;Assessment Type
		<input type="text" id="assessment_type_display" style="width:120px;" value="" readonly disabled />
	</label>
</div>

<div style="float:right;width:200px;">
	<label>
		&nbsp;&nbsp;Current Age
		<input type="text" id="current_age" style="width:40px;" value="" readonly disabled />
	</label>
</div>

<!-- Temp fix for old assessment display -->
<input type="hidden" id="assessment_type" name="assessment_type" value="Adult" />

<br/><br/><hr/>
