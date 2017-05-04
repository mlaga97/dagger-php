<?php if ($_SESSION['grouping'] != 10) { ?>

<!-- Programs -->
<h3>Programs</h3>

<label><input type="checkbox" name="carePath_homeless" value="1"/>Homeless</label><br/>
<label><input type="checkbox" name="carePath_hepatitis_c" value="1"/>Hepatitis C</label><br/>
<label><input type="checkbox" name="carePath_ryanWhite" value="1"/>Ryan White</label><br/>
<label><input type="checkbox" name="carePath_other" value="1" onchange="cb_toggleField(this, 'edu.usm.dagger.modules.qualtrics.carePath_other_data')"/>Other</label> <input type="text" style="width:300px;" id="edu.usm.dagger.modules.qualtrics.carePath_other_data" name="carePath_other_data" disabled/><br/>
<br />
<br />
<hr>
<?php } ?>
