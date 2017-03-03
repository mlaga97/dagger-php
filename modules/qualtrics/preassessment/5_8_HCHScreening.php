<h3>HCH Screening</h3>

<label><input type="radio" name="hchScreening_Check" value='true' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.hchScreening_selection').style.display = 'block';"/>Yes</label>
<label><input type="radio" name="hchScreening_Check" value='false' checked="checked" onclick="document.getElementById('edu.usm.dagger.module.qualtrics.hchScreening_selection').style.display = 'none';"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.hchScreening_selection' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Application Type</h3>
	<label><input type="radio" name="hchScreening_applicationType" value="initial"/>Initial</label>
	<label><input type="radio" name="hchScreening_applicationType" value="recertification"/>Recertification</label>

	<br/>
	<h3>HCH Eligibility</h3>
	<label><input type="radio" name="hchScreening_eligibility" value="true"/>Yes</label>
	<label><input type="radio" name="hchScreening_eligibility" value="false"/>No</label>
</div>

<br/><br/>

<hr/>