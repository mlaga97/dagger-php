<h3>Activity Date - Today?</h3>

<label><input type="radio" name="activityDateCheck" onclick="document.getElementById('edu.usm.dagger.module.qualtrics.activityDate_selection').style.display = 'none';"/>Yes</label>
<label><input type="radio" name="activityDateCheck" onclick="document.getElementById('edu.usm.dagger.module.qualtrics.activityDate_selection').style.display = 'block';"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.activityDate_selection' style='display: none;'>
	<br/>
	<label>Activity Date<br/><input type="date" name="assessment_date" value="<?php echo date('Y-m-d')?>"></label>
</div>

<br/><br/>

<hr/>