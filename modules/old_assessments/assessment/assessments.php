<?php
	echo "<!--oldassessments-assessments-assessments.php -->";
	global $mysqli;

	include __DIR__ . '/../../presenting_problem/presenting_problem.php';

	if($_SESSION['pp_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>Presenting Problem</h3>";
		write_presenting_problem($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}
?>
