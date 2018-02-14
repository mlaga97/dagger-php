<?php
	global $mysqli, $copy;

	// Assessments
	include __DIR__ . '/../../presenting_problem/presenting_problem.php';
	include __DIR__ . '/../../health/health.php';
	include __DIR__ . '/../../psc/psc.php';
	include __DIR__ . '/../../sdq/sdq.php';
	include __DIR__ . '/../../life/life.php';
	include __DIR__ . '/../../adhd/adhd.php';

	////////////////////////////////////////These are where we score our tests/////////////////////
	if (($_SESSION['assessment_type'] == 'Child')&&($_SESSION['pp'] != "")) {
		//we need to do presenting problem.
		echo "<div class='scoring'>";
		echo "<h3>Presenting Problem</h3>";
		pp_scoring($_SESSION, $mysqli);
		echo "</div>";
		echo "<div class='scoring'>";
	}
	if($_SESSION['psc_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>PSC-17</h3>";
		psc_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['sdq_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>SDQ</h3>";
		sdq_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['life_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>Life Attitudes</h3>";
		life_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['adhd_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>ADHD Self-Report Scale</h3>";
		adhd_scoring($copy, $mysqli);
		echo "</div>";
	}
?>
