<?php if ($_SESSION['grouping'] != 10) { ?>

<!-- Programs -->
<h3>Programs</h3>

<label><input type="checkbox" name="carePath_homeless" value="1"/>Homeless</label><br/>
<label><input type="checkbox" name="carePath_hepatitis_c" value="1"/>Hepatitis C</label><br/>
<label><input type="checkbox" name="carePath_careTeam" value="1"/>Care Team</label><br/>
<label><input type="checkbox" name="carePath_chronicCare" value="1"/>Chronic Care</label><br/>
<label><input type="checkbox" name="carePath_ryanWhite" value="1"/>Ryan White</label><br/>
<label><input type="checkbox" name="carePath_other" value="1"/>Other</label><input type="text" name="carePath_other_data"/><br/>

<?php } ?>
