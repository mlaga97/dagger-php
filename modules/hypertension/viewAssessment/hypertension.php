<?php
	global $mysqli, $copy;

	include __DIR__ . '/../hypertension.php';

	if($_SESSION['hypertension_check'] == 1) {
		hypertension_scoring($copy, $mysqli);
	}
?>