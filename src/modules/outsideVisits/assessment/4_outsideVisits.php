<!-- TODO: Make better -->

<?php if ($_SESSION['grouping'] != 10) { ?>

<!-- ----------------------------------------------------------------------- -->

<h3>Outside Visits</h3>

<p>Since your last visit, have you been admitted to:</p>

<label>Emergency Room (ER)</label>
<label><input type="radio" name="outsideVisits_emergencyRoom" value='yes' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_emergencyRoom_form', true, true);sendFocus('dagger.module.qualtrics.outsideVisits_emergencyRoom_visitDate');" required />Yes</label>
<label><input type="radio" name="outsideVisits_emergencyRoom" value='no' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_emergencyRoom_form', false, false);toggleDisplay('dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit', false);clearFields('dagger.module.qualtrics.outsideVisits_emergencyRoom_form');" checked />No</label>

<div id='dagger.module.qualtrics.outsideVisits_emergencyRoom_form' style='display: none; margin-left: 50px;'>
	<br />
	<label>ER Visit Date </label>
	<input type="date" id="dagger.module.qualtrics.outsideVisits_emergencyRoom_visitDate" name="outsideVisits_emergencyRoom_visitDate" onblur="formatDate(this);" max="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" />

	<br/><br />
	<label>ER Visit Reason</label><br />
	<label><input type="radio" name="outsideVisits_emergencyRoom_reasonForVisit" value='Chronic Condition Related' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit', false);clearFields('dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit');"/>Chronic Condition Related</label><br/>
	<label><input type="radio" name="outsideVisits_emergencyRoom_reasonForVisit" value='Accident' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit', false);clearFields('dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit');"/>Accident</label><br/>
	<label><input type="radio" name="outsideVisits_emergencyRoom_reasonForVisit" value='Other' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit', true);sendFocus('dagger.module.qualtrics.outsideVisits_emergencyRoom_otherReasonForVisit');"/>Other</label><br/>

	<div id='dagger.module.qualtrics.outsideVisits_emergencyRoom_form.otherReasonForVisit' style='display: none; margin-left: 50px;margin-top:5px;'>
		<label>Other Reason <input type="text" style="width:100%;" id="dagger.module.qualtrics.outsideVisits_emergencyRoom_otherReasonForVisit" name="outsideVisits_emergencyRoom_otherReasonForVisit" class="noreq" /></label>
	</div>
</div>

<br/>

<label>Hospital (Not including ER) </label>
<label><input type="radio" name="outsideVisits_hospital_nonER" value='yes' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_hospital_nonER_form', true, true);sendFocus('dagger.module.qualtrics.outsideVisits_hospital_nonER_dischargeDate');" required />Yes</label>
<label><input type="radio" name="outsideVisits_hospital_nonER" value='no' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_hospital_nonER_form', false, false);toggleDisplay('dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit', false);clearFields('dagger.module.qualtrics.outsideVisits_hospital_nonER_form');" checked />No</label>

<div id='dagger.module.qualtrics.outsideVisits_hospital_nonER_form' style='display: none; margin-left: 50px;'>
	<br />
	<label>Hospital Discharge Date </label>
	<input type="date" id="dagger.module.qualtrics.outsideVisits_hospital_nonER_dischargeDate" name="outsideVisits_hospital_nonER_dischargeDate" onblur="formatDate(this);"  max="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy"/>

	<br /><br />
	<label>Hospital Visit Reason</label><br />
	<label><input type="radio" name="outsideVisits_hospital_nonER_reasonForVisit" value='Chronic Condition Related' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit', false);clearFields('dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit');"/>Chronic Condition Related</label><br/>
	<label><input type="radio" name="outsideVisits_hospital_nonER_reasonForVisit" value='Accident' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit', false);clearFields('dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit');"/>Accident</label><br/>
	<label><input type="radio" name="outsideVisits_hospital_nonER_reasonForVisit" value='Other' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit', true);sendFocus('dagger.module.qualtrics.outsideVisits_hospital_nonER_otherReasonForVisit');"/>Other</label><br/>

	<div id='dagger.module.qualtrics.outsideVisits_hospital_nonER_form.otherReasonForVisit' style='display: none; margin-left: 50px;'>
		<br />
		<label>Other Reason <input type="text" style="width:100%;" id="dagger.module.qualtrics.outsideVisits_hospital_nonER_otherReasonForVisit" name="outsideVisits_hospital_nonER_otherReasonForVisit" class="noreq"/></label>
	</div>
</div>

<br/>
<label>Other medical provider</label>
<label><input type="radio" name="outsideVisits_other" value='yes' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_other_form', true, true);sendFocus('dagger.module.qualtrics.outsideVisits_other_visitDate');" required />Yes</label>
<label><input type="radio" name="outsideVisits_other" value='no' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_other_form', false, false);toggleDisplay('dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit', false);clearFields('dagger.module.qualtrics.outsideVisits_other_form');" checked />No</label>
<div id='dagger.module.qualtrics.outsideVisits_other_form' style='display: none; margin-left: 50px;'>
	<br />
	<label>Date of office visit</label>
	<input type="date" id="dagger.module.qualtrics.outsideVisits_other_visitDate" name="outsideVisits_other_visitDate" onblur="formatDate(this);" max="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" />

	<br /><br />
	<label>Provider Visit Reason</label><br />
	<label><input type="radio" name="outsideVisits_other_reasonForVisit" value='Chronic Condition Related' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit', false);clearFields('dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit');"/>Chronic Condition Related</label><br/>
	<label><input type="radio" name="outsideVisits_other_reasonForVisit" value='Accident' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit', false);clearFields('dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit');"/>Accident</label><br/>
	<label><input type="radio" name="outsideVisits_other_reasonForVisit" value='Other' onclick="toggleDisplay('dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit', true);sendFocus('dagger.module.qualtrics.outsideVisits_other_otherReasonForVisit');"/>Other</label><br/>

	<div id='dagger.module.qualtrics.outsideVisits_other_form.otherReasonForVisit' style='display: none; margin-left: 50px;'>
		<br/>
		<label>Other Reason <input type="text" style="width:100%;" id="dagger.module.qualtrics.outsideVisits_other_otherReasonForVisit" name="outsideVisits_other_otherReasonForVisit" class="noreq"/></label>
	</div>
</div>

<br/><br/>

<hr/>

<?php } ?>
