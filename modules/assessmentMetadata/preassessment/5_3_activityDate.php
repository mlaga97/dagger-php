<script>
	// Date should reset to today if activity date YES radio reselected
	function resetDate(date_id, today) {
		activity_date = document.getElementById(date_id);
		activity_date.value = today;
	}
</script>


<h3>Activity Date - Today?</h3>

<label><input type="radio" name="activityDate_check" checked="checked" onclick="toggleDisplay('dagger.module.qualtrics.activityDate_selection', false);resetDate('dagger.module.qualtrics.activityDate', '<?php echo date('Y-m-d')?>');" required />Yes</label>
<label><input type="radio" name="activityDate_check" onclick="toggleDisplay('dagger.module.qualtrics.activityDate_selection', true);sendFocus('dagger.module.qualtrics.activityDate');" />No</label>

<div style="float:right;width:500px;">
	<label>
		Today's Date
		<input type="text" style="width:120px;" value="<?php echo date('m/d/Y');?>" readonly disabled />
	</label>
</div>

<div id='dagger.module.qualtrics.activityDate_selection' style='display: none;'>
	<br/>
	<label>Activity Date <input type="date" id="dagger.module.qualtrics.activityDate" name="activityDate" onblur="formatDate(this);" value="<?php echo date('Y-m-d')?>" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyy" required /></label>
</div>

<br/><br/><hr/>
