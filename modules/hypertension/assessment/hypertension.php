<?php
	global $mysqli;

	include __DIR__ . '/../hypertension.php';

	if($_SESSION['hypertension_check'] == 1) {
		write_hypertension($_SESSION['assessment_type'], $mysqli);
	}
?><br/>
