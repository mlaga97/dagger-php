<?php

$_SESSION['hypertension_check'] = 0;

if($_SESSION['test_acc']) {
	echo '
		<div title="The Hypertension Self-care Activity Level Effects Test is">
			<label><input id="hypertension_check" input type="checkbox" name="hypertension_check" value="1" /> H-SCALE</label>
		</div>
	';
}

?>