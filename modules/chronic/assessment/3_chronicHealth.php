<!-- TODO: Split into own module. -->

<?php if ($_SESSION['grouping'] != 10) { ?>

<h3>New Hemoglobin A1C Record</h3>

<label><input type="radio" name="chronicHealth_A1C_check" value='1' onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.chronicHealth_A1C', true, true);"/>Yes</label>
<label><input type="radio" name="chronicHealth_A1C_check" value='0' checked="checked" onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.chronicHealth_A1C', false, false);"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.chronicHealth_A1C' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Hemoglobin A1C (%)</h3>
	<?php // Valid ranges for chronicHealth provided by Dr. Lauren Zakaras, clinical director MIHDP ?>
	<input type="number" name="chronicHealth_A1C_value" min="3" max="30" step="0.1" />

	<br/>
	<h3>A1C Test Date</h3>
	<input type="date" name="chronicHealth_A1C_date" onblur="formatDate(this);" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyyy" >
</div>

<br/><br/><hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Blood Sugar eAG Record</h3>

<label><input type="radio" name="chronicHealth_eAG_check" value='1' onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.chronicHealth_eAG', true, true);"/>Yes</label>
<label><input type="radio" name="chronicHealth_eAG_check" value='0' checked="checked" onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.chronicHealth_eAG', false, false);"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.chronicHealth_eAG' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Blood Sugar eAG (mg/dl)</h3>
	<input type="number" name="chronicHealth_eAG_value" min="20" max="1500" />

	<br/>
	<h3>eAG Test Date</h3>
	<input type="date" name="chronicHealth_eAG_date" onblur="formatDate(this);" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyyy" >
</div>

<br/><br/><hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Cholesterol Record</h3>

<label><input type="radio" name="chronicHealth_cholesterol_check" value='1' onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.chronicHealth_cholesterol', true, true);"/>Yes</label>
<label><input type="radio" name="chronicHealth_cholesterol_check" value='0' checked="checked" onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.chronicHealth_cholesterol', false, false);"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.chronicHealth_cholesterol' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>LDL Cholesterol</h3>
	<input type="number" name="chronicHealth_cholesterol_LDL" min="15" max="1300" />

	<br/>
	<h3>HDL Cholesterol</h3>
	<input type="number" name="chronicHealth_cholesterol_HDL" min="15" max="250" />

	<br/>
	<h3>Cholesterol Test Date</h3>
	<input type="date" name="chronicHealth_cholesterol_date" onblur="formatDate(this);" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyyy" >
</div>

<br/><br/><hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Blood Pressure Record</h3>

<label><input type="radio" name="chronicHealth_bloodPressure_check" value='1' onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.chronicHealth_bloodPressure', true, true);"/>Yes</label>
<label><input type="radio" name="chronicHealth_bloodPressure_check" value='0' checked="checked" onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.chronicHealth_bloodPressure', false, false);"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.chronicHealth_bloodPressure' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Systolic</h3>
	<input type="number" name="chronicHealth_bloodPressure_systolic" min="30" max="380" />

	<br/>
	<h3>Diastolic</h3>
	<input type="number" name="chronicHealth_bloodPressure_diastolic" min="25" max="300" />

	<br/>
	<h3>Blood Pressure Test Date</h3>
	<input type="date" name="chronicHealth_bloodPressure_date" onblur="formatDate(this);" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyyy" >
</div>

<br/><br/><hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Height and Weight Record</h3>

<label><input type="radio" name="chronicHealth_physical_check" value='1' onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.chronicHealth_physical', true, true);"/>Yes</label>
<label><input type="radio" name="chronicHealth_physical_check" value='0' checked="checked" onclick="toggleDisplay('edu.usm.dagger.module.qualtrics.chronicHealth_physical', false, false);"/>No</label>

<div id='edu.usm.dagger.module.qualtrics.chronicHealth_physical' style='display: none; margin-left: 50px;'>
	<br/>
	<h3>Height</h3>
	<input type="number" name="chronicHealth_physical_height" min="24" max="108" step="0.1" />

	<br/>
	<h3>Weight</h3>
	<input type="number" name="chronicHealth_physical_weight" min="1" max="1999" step="0.1" />

	<br/>
	<h3>Height and Weight Test Date</h3>
	<input type="date" name="chronicHealth_physical_date" onblur="formatDate(this);" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyyy" >
</div>

<br/><br/><hr/>

<?php } ?>
