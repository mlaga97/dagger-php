<?php
	global $mysqli;

	include __DIR__ . '/../pediatric.php';

	if($_SESSION['pediatric_check'] == 1) {
		write_pediatric($_SESSION['assessment_type'], $mysqli);
	}
?><br/>
