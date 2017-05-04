<!-- TODO: Split into own module. -->

<?php if ($_SESSION['grouping'] != 10) { ?>

<h3>New Hemoglobin A1C Record</h3>

<label><input type="radio" name="chronicHealth_A1C_check" value='1' onclick="toggleDisplay('dagger.module.qualtrics.chronicHealth_A1C', true, true);sendFocus('dagger.module.qualtrics.chronicHealth_A1C_value');" required />Yes</label>
<label><input type="radio" name="chronicHealth_A1C_check" value='0' onclick="toggleDisplay('dagger.module.qualtrics.chronicHealth_A1C', false, false);clearFields('dagger.module.qualtrics.chronicHealth_A1C');" checked/>No</label>

<div id='dagger.module.qualtrics.chronicHealth_A1C' style='display: none; margin-left: 50px;'>
	<br/>
	<?php // Valid ranges for chronicHealth provided by Dr. Lauren Zakaras, clinical director MIHDP ?>
	<label>Hemoglobin A1C</label> <input type="number" id="dagger.module.qualtrics.chronicHealth_A1C_value" name="chronicHealth_A1C_value" min="3" max="30" step="0.1" /> <label>%</label>
	<br />
	<br />
	<label>Date</label> <input type="date" name="chronicHealth_A1C_date" onblur="formatDate(this);" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyyy" />
</div>

<br/>
<br/>
<hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Blood Sugar eAG Record</h3>

<label><input type="radio" name="chronicHealth_eAG_check" value='1' onclick="toggleDisplay('dagger.module.qualtrics.chronicHealth_eAG', true, true);sendFocus('dagger.module.qualtrics.chronicHealth_eAG_value');" required />Yes</label>
<label><input type="radio" name="chronicHealth_eAG_check" value='0' onclick="toggleDisplay('dagger.module.qualtrics.chronicHealth_eAG', false, false);clearFields('dagger.module.qualtrics.chronicHealth_eAG');" checked />No</label>

<div id='dagger.module.qualtrics.chronicHealth_eAG' style='display: none; margin-left: 50px;'>
	<br/>
	<br />
	<label>Blood Sugar eAG</label> <input type="number" id="dagger.module.qualtrics.chronicHealth_eAG_value" name="chronicHealth_eAG_value" min="20" max="1500" /> <label>mg/dL</label>
	<br/>
	<br />
	<label>Date</label> <input type="date" name="chronicHealth_eAG_date" onblur="formatDate(this);" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyyy" >
</div>

<br/>
<br/>
<hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Cholesterol Record</h3>

<label><input type="radio" name="chronicHealth_cholesterol_check" value='1' onclick="toggleDisplay('dagger.module.qualtrics.chronicHealth_cholesterol', true, true);sendFocus('dagger.module.qualtrics.chronicHealth_cholesterol_LDL');" required />Yes</label>
<label><input type="radio" name="chronicHealth_cholesterol_check" value='0' onclick="toggleDisplay('dagger.module.qualtrics.chronicHealth_cholesterol', false, false);clearFields('dagger.module.qualtrics.chronicHealth_cholesterol');" checked />No</label>

<div id='dagger.module.qualtrics.chronicHealth_cholesterol' style='display: none; margin-left: 50px;'>
	<br/>
	<label>LDL Cholesterol</label> <input type="number" id="dagger.module.qualtrics.chronicHealth_cholesterol_LDL" name="chronicHealth_cholesterol_LDL" min="15" max="1300" /> <label>mg/dL</label>
	<br/>
	<br/>
	<label>HDL Cholesterol</label> <input type="number" name="chronicHealth_cholesterol_HDL" min="15" max="250" /> <label>mg/dL</label>
	<br/>
	<br/>
	<label>Date</label>
	<input type="date" name="chronicHealth_cholesterol_date" onblur="formatDate(this);" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyyy" >
</div>

<br/>
<br/>
<hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Blood Pressure Record</h3>

<label><input type="radio" name="chronicHealth_bloodPressure_check" value='1' onclick="toggleDisplay('dagger.module.qualtrics.chronicHealth_bloodPressure', true, true);sendFocus('dagger.module.qualtrics.chronicHealth_bloodPressure_systolic');" required />Yes</label>
<label><input type="radio" name="chronicHealth_bloodPressure_check" value='0' onclick="toggleDisplay('dagger.module.qualtrics.chronicHealth_bloodPressure', false, false);clearFields('dagger.module.qualtrics.chronicHealth_bloodPressure');" checked />No</label>

<div id='dagger.module.qualtrics.chronicHealth_bloodPressure' style='display: none; margin-left: 50px;'>
	<br/>
	<label>Systolic</label> <input type="number" id="dagger.module.qualtrics.chronicHealth_bloodPressure_systolic" name="chronicHealth_bloodPressure_systolic" min="30" max="380" />
	<br/>
	<br/>
	<label>Diastolic</label> <input type="number" name="chronicHealth_bloodPressure_diastolic" min="25" max="300" />
	<br/>
	<br/>
	<label>Date</label>
	<input type="date" name="chronicHealth_bloodPressure_date" onblur="formatDate(this);" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyyy" >
</div>

<br/>
<br/>
<hr/>

<!-- ----------------------------------------------------------------------- -->

<h3>New Height and Weight Record</h3>

<label><input type="radio" name="chronicHealth_physical_check" value='1' onclick="toggleDisplay('dagger.module.qualtrics.chronicHealth_physical', true, true);sendFocus('dagger.module.qualtrics.chronicHealth_physical_height');" required />Yes</label>
<label><input type="radio" name="chronicHealth_physical_check" value='0' onclick="toggleDisplay('dagger.module.qualtrics.chronicHealth_physical', false, false);clearFields('dagger.module.qualtrics.chronicHealth_physical');" checked />No</label>

<div id='dagger.module.qualtrics.chronicHealth_physical' style='display: none; margin-left: 50px;'>
	<br/>
	<label>Height</label> <input type="number" id="dagger.module.qualtrics.chronicHealth_physical_height" name="chronicHealth_physical_height" min="24" max="108" step="0.1" /> <label>in.</label>
	<br/>
	<br/>
	<label>Weight</label> <input type="number" name="chronicHealth_physical_weight" min="1" max="1999" step="0.1" /> <label>lbs.</labe>
	<br/>
	<br/>
	<label>Date</label> <input type="date" name="chronicHealth_physical_date" onblur="formatDate(this);" max="<?php echo date('Y-m-d')?>" placeholder="mm/dd/yyyy" >
</div>

<br/>
<br/>
<hr/>

<?php } ?>
