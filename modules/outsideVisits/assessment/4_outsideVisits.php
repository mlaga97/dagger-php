<?php if ($_SESSION['grouping'] != 10) { ?>

<script>

function checkboxShowHide(checkbox, id, uncheckedState) {
	if(uncheckedState) {
		if(checkbox.checked) {
			document.getElementById(id).style.display = 'none';
		} else {
			document.getElementById(id).style.display = 'block';
		}
	} else {
		if(checkbox.checked) {
			document.getElementById(id).style.display = 'block';
		} else {
			document.getElementById(id).style.display = 'none';
		}
	}
}

</script>

<!-- ----------------------------------------------------------------------- -->

<h3>Outside Visits</h3>

<p>Since your last visit, have you been admitted to:</p>

<label><input type="checkbox" name="outsideVisits_emergencyRoom" value='true' onclick="checkboxShowHide(this, 'edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form', false);"/>Emergency Room (ER)</label>
<div id='edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Date of ER Visit</h3>
	<input type="date" name="outsideVisits_emergencyRoom_dischargeDate"/>

	<br/>
	<h3>Reason for Visit</h3>
	<label><input type="radio" name="outsideVisits_emergencyRoom_reasonForVisit" value='chronicConditionRelated' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit').style.display = 'none';"/>Chronic Condition Related</label><br/>
	<label><input type="radio" name="outsideVisits_emergencyRoom_reasonForVisit" value='accident' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit').style.display = 'none';"/>Accident</label><br/>
	<label><input type="radio" name="outsideVisits_emergencyRoom_reasonForVisit" value='other' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit').style.display = 'block';"/>Other</label><br/>

	<div id='edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit' style='display: none; margin-left: 50px;'>
		<br/>
		<label>Please specify: <input type="text" name="outsideVisits_emergencyRoom_otherReasonForVisit"/></label>
	</div>
</div>

<br/>

<label><input type="checkbox" name="outsideVisits_hospital_nonER" value='true' onclick="checkboxShowHide(this, 'edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form', false);"/>Hospital (Not including ER)</label>
<div id='edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Date of Discharge</h3>
	<input type="date" name="outsideVisits_hospital_nonER_dischargeDate"/>

	<br/>
	<h3>Reason for Visit</h3>
	<label><input type="radio" name="outsideVisits_hospital_nonER_reasonForVisit" value='chronicConditionRelated' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit').style.display = 'none';"/>Chronic Condition Related</label><br/>
	<label><input type="radio" name="outsideVisits_hospital_nonER_reasonForVisit" value='accident' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit').style.display = 'none';"/>Accident</label><br/>
	<label><input type="radio" name="outsideVisits_hospital_nonER_reasonForVisit" value='other' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit').style.display = 'block';"/>Other</label><br/>

	<div id='edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit' style='display: none; margin-left: 50px;'>
		<br/>
		<label>Please specify: <input type="text" name="outsideVisits_hospital_nonER_otherReasonForVisit"/></label>
	</div>
</div>

<br/>

<label><input type="checkbox" name="outsideVisits_other" value='true' onclick="checkboxShowHide(this, 'edu.usm.dagger.module.qualtrics.outsideVisits_other_form', false);"/>Other medical provider</label>
<div id='edu.usm.dagger.module.qualtrics.outsideVisits_other_form' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Date of office visit</h3>
	<input type="date" name="outsideVisits_other_dischargeDate"/>

	<br/>
	<h3>Reason for Visit</h3>
	<label><input type="radio" name="outsideVisits_other_reasonForVisit" value='chronicConditionRelated' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit').style.display = 'none';"/>Chronic Condition Related</label><br/>
	<label><input type="radio" name="outsideVisits_other_reasonForVisit" value='accident' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit').style.display = 'none';"/>Accident</label><br/>
	<label><input type="radio" name="outsideVisits_other_reasonForVisit" value='other' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit').style.display = 'block';"/>Other</label><br/>

	<div id='edu.usm.dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit' style='display: none; margin-left: 50px;'>
		<br/>
		<label>Please specify: <input type="text" name="outsideVisits_other_otherReasonForVisit"/></label>
	</div>
</div>

<br/><br/><hr/>

<?php } ?>