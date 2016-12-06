<?php
	global $mysqli, $copy;

	include __DIR__ . '/../pediatric.php';

	if($_SESSION['pediatric_check'] == 1) {
		pediatric_scoring($copy, $mysqli);
	}
?>
