<!-- TODO: Split into own module. -->

<?php if ($_SESSION['grouping'] != 10) { ?>

<h3>New Hemoglobin A1C Record</h3>

<label><input type="radio" name="chronicHealth_A1C_check" value='true' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.chronicHealth_A1C').style.display = 'block';"/>Yes</label>
<label><input type="radio" name="chronicHealth_A1C_check" value='false' checked="checked" onclick="document.getElementById('edu.usm.dagger.module.qualtrics.chronicHealth_A1C').style.display = 'none';"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.chronicHealth_A1C' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Hemoglobin A1C (%)</h3>
	<input type="text" name="chronicHealth_A1C_value"/>

	<br/>
	<h3>A1C Test Date</h3>
	<input type="date" name="chronicHealth_A1C_date" value="<?php echo date('Y-m-d')?>">
</div>

<br/><br/><hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Blood Sugar eAG Record</h3>

<label><input type="radio" name="chronicHealth_eAG_check" value='true' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.chronicHealth_eAG').style.display = 'block';"/>Yes</label>
<label><input type="radio" name="chronicHealth_eAG_check" value='false' checked="checked" onclick="document.getElementById('edu.usm.dagger.module.qualtrics.chronicHealth_eAG').style.display = 'none';"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.chronicHealth_eAG' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Blood Sugar eAG (mg/dl)</h3>
	<input type="text" name="chronicHealth_eAG_value"/>

	<br/>
	<h3>eAG Test Date</h3>
	<input type="date" name="chronicHealth_eAG_date" value="<?php echo date('Y-m-d')?>">
</div>

<br/><br/><hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Cholesterol Record</h3>

<label><input type="radio" name="chronicHealth_cholesterol_check" value='true' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.chronicHealth_cholesterol').style.display = 'block';"/>Yes</label>
<label><input type="radio" name="chronicHealth_cholesterol_check" value='false' checked="checked" onclick="document.getElementById('edu.usm.dagger.module.qualtrics.chronicHealth_cholesterol').style.display = 'none';"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.chronicHealth_cholesterol' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>LDL Cholesterol</h3>
	<input type="text" name="chronicHealth_cholesterol_LDL"/>

	<br/>
	<h3>HDL Cholesterol</h3>
	<input type="text" name="chronicHealth_cholesterol_HDL"/>

	<br/>
	<h3>Cholesterol Test Date</h3>
	<input type="date" name="chronicHealth_cholesterol_date" value="<?php echo date('Y-m-d')?>">
</div>

<br/><br/><hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Blood Pressure Record</h3>

<label><input type="radio" name="chronicHealth_bloodPressure_check" value='true' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.chronicHealth_bloodPressure').style.display = 'block';"/>Yes</label>
<label><input type="radio" name="chronicHealth_bloodPressure_check" value='false' checked="checked" onclick="document.getElementById('edu.usm.dagger.module.qualtrics.chronicHealth_bloodPressure').style.display = 'none';"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.chronicHealth_bloodPressure' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Systolic</h3>
	<input type="text" name="chronicHealth_bloodPressure_systolic"/>

	<br/>
	<h3>Diastolic</h3>
	<input type="text" name="chronicHealth_bloodPressure_diastolic"/>

	<br/>
	<h3>Blood Pressure Test Date</h3>
	<input type="date" name="chronicHealth_bloodPressure_date" value="<?php echo date('Y-m-d')?>">
</div>

<br/><br/><hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Height and Weight Record</h3>

<label><input type="radio" name="chronicHealth_heightWeight_check" value='true' onclick="document.getElementById('edu.usm.dagger.module.qualtrics.chronicHealth_heightWeight').style.display = 'block';"/>Yes</label>
<label><input type="radio" name="chronicHealth_heightWeight_check" value='false' checked="checked" onclick="document.getElementById('edu.usm.dagger.module.qualtrics.chronicHealth_heightWeight').style.display = 'none';"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.chronicHealth_heightWeight' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Height</h3>
	<input type="text" name="chronicHealth_height"/>

	<br/>
	<h3>Weight</h3>
	<input type="text" name="chronicHealth_weight"/>

	<br/>
	<h3>Height and Weight Test Date</h3>
	<input type="date" name="chronicHealth_heightWeight_date" value="<?php echo date('Y-m-d')?>">
</div>

<br/><br/><hr/>

<?php } ?>
