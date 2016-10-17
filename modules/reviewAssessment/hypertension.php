<?php
	include 'include/hypertension.php';

	if($_SESSION['hypertension_check'] == 1) {
		hypertension_scoring($copy, $mysqli);
	}
?>