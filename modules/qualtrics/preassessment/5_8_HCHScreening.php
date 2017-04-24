<h3>HCH Screening</h3>

<label><input type="radio" name="hchScreening_check" value='1' onclick="toggleDisplay('dagger.module.qualtrics.hchScreening_selection', true, true);sendFocus('dagger.module.qualtrics.hchScreening_applicationType_Initial');" required />Yes</label>
<label><input type="radio" name="hchScreening_check" value='0' onclick="toggleDisplay('dagger.module.qualtrics.hchScreening_selection', false, false);clearFields('dagger.module.qualtrics.hchScreening_selection');" checked />No</label>

<div id='dagger.module.qualtrics.hchScreening_selection' style='display: none; margin-left: 50px;'>
	<br/>
	<label>Application Type</label>
	<label><input type="radio" id="dagger.module.qualtrics.hchScreening_applicationType_Initial" name="hchScreening_applicationType" value="Initial"/>Initial</label>
	<label><input type="radio" name="hchScreening_applicationType" value="Recertification"/>Recertification</label>

	<br/><br/>
	<label>HCH Eligible</label>
	<label><input type="radio" name="hchScreening_eligibility" value="Yes"/>Yes</label>
	<label><input type="radio" name="hchScreening_eligibility" value="No"/>No</label>
</div>

<br/>
<br/>
<hr/>
