<!-- TODO: Make better -->

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

function toggleDisplayCheckbox (checkbox_obj, divID) {
	var show = false;
	var req = false;
	if(checkbox_obj.checked == true) {
		show = true;
		req = true;
	}
	toggleDisplay(divID, show, req);
}

</script>

<!-- ----------------------------------------------------------------------- -->

<h3>Outside Visits</h3>

<p>Since your last visit, have you been admitted to:</p>

<!-- <label><input type="checkbox" name="outsideVisits_emergencyRoom" value='true'  />Emergency Room (ER)</label> -->

<label>Emergency Room (ER)</label>
<label><input type="radio" name="outsideVisits_emergencyRoom" value='yes' onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form', true, true);" />Yes</label>
<label><input type="radio" name="outsideVisits_emergencyRoom" value='no' checked="checked" onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form', false, false);" />No</label>

<div id='edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form' style='display: none; margin-left: 50px;'>
	<br />
	<label>ER Visit Date </label>
	<input type="date" name="outsideVisits_emergencyRoom_visitDate" onblur="formatDate(this);" max="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" />

	<br/><br />
	<label>ER Visit Reason</label><br />
	<label><input type="radio" name="outsideVisits_emergencyRoom_reasonForVisit" value='chronicConditionRelated' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit').style.display = 'none';"/>Chronic Condition Related</label><br/>
	<label><input type="radio" name="outsideVisits_emergencyRoom_reasonForVisit" value='accident' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit').style.display = 'none';"/>Accident</label><br/>
	<label><input type="radio" name="outsideVisits_emergencyRoom_reasonForVisit" value='other' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit').style.display = 'block';"/>Other</label><br/>

	<div id='edu.usm.dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit' style='display: none; margin-left: 50px;margin-top:5px;'>
		<label>Please specify: <input type="text" name="outsideVisits_emergencyRoom_otherReasonForVisit" class="noreq" /></label>
	</div>
</div>

<br/>

<label>Hospital (Not including ER) </label>
<label><input type="radio" name="outsideVisits_hospital_nonER" value='yes' onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form', true, true);"/>Yes</label>
<label><input type="radio" name="outsideVisits_hospital_nonER" value='no' checked="checked" onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form', false, false);"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form' style='display: none; margin-left: 50px;'>
	<br />
	<label>Hospital Discharge Date </label>
	<input type="date" name="outsideVisits_hospital_nonER_dischargeDate" onblur="formatDate(this);"  max="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy"/>

	<br /><br />
	<label>Reason for Visit</label><br />
	<label><input type="radio" name="outsideVisits_hospital_nonER_reasonForVisit" value='chronicConditionRelated' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit').style.display = 'none';"/>Chronic Condition Related</label><br/>
	<label><input type="radio" name="outsideVisits_hospital_nonER_reasonForVisit" value='accident' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit').style.display = 'none';"/>Accident</label><br/>
	<label><input type="radio" name="outsideVisits_hospital_nonER_reasonForVisit" value='other' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit').style.display = 'block';"/>Other</label><br/>

	<div id='edu.usm.dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit' style='display: none; margin-left: 50px;'>
		<br />
		<label>Please specify: <input type="text" name="outsideVisits_hospital_nonER_otherReasonForVisit" class="noreq"/></label>
	</div>
</div>

<br/>
<label>Other medical provider</label>
<label><input type="radio" name="outsideVisits_other" value='yes' onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.outsideVisits_other_form', true, true);"/>Yes</label>
<label><input type="radio" name="outsideVisits_other" value='no' checked="checked" onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.outsideVisits_other_form', false, false);"/>No</label>
<div id='edu.usm.dagger.module.qualtrics.outsideVisits_other_form' style='display: none; margin-left: 50px;'>
	<br />
	<label>Date of office visit</label>
	<input type="date" name="outsideVisits_other_visitDate" onblur="formatDate(this);" max="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" />

	<br /><br />
	<label>Reason for Visit</label><br />
	<label><input type="radio" name="outsideVisits_other_reasonForVisit" value='chronicConditionRelated' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit').style.display = 'none';"/>Chronic Condition Related</label><br/>
	<label><input type="radio" name="outsideVisits_other_reasonForVisit" value='accident' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit').style.display = 'none';"/>Accident</label><br/>
	<label><input type="radio" name="outsideVisits_other_reasonForVisit" value='other' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit').style.display = 'block';"/>Other</label><br/>

	<div id='edu.usm.dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit' style='display: none; margin-left: 50px;'>
		<br/>
		<label>Please specify: <input type="text" name="outsideVisits_other_otherReasonForVisit" class="noreq"/></label>
	</div>
</div>

<br/><br/>

<hr/>

<?php } ?>
