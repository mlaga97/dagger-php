<?php

$_SESSION['hypertension_check'] = 0;

if($_SESSION['test_acc']) {
	echo '
		<div title="The Pediatric Healthy Lifestyles Screening is ">
			<label><input id="pediatric_check" input type="checkbox" name="pediatric_check" value="1" /> Pediatric Health Lifestyles</label>
		</div>
	';
}

?>
