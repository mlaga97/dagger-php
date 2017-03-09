<?php if ($_SESSION['grouping'] != 10) { ?>

<!-- Programs -->
<h3>Programs</h3>

<label><input type="checkbox" name="carePath_homeless" value=""/>Homeless</label><br/>
<label><input type="checkbox" name="carePath_hepatitis_c" value=""/>Hepatitis C</label><br/>
<label><input type="checkbox" name="carePath_careTeam" value=""/>Care Team</label><br/>
<label><input type="checkbox" name="carePath_chronicCare" value=""/>Chronic Care</label><br/>
<label><input type="checkbox" name="carePath_ryanWhite" value=""/>Ryan White</label><br/>
<label><input type="checkbox" name="carePath_other" value=""/>Other</label><input type="text" name="carePath_other_data"/><br/>

<?php } ?>
