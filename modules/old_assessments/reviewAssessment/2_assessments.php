<?php
	global $mysqli, $copy;

	// Assessments
	include __DIR__ . '/../stressors.php';
	include __DIR__ . '/../presenting_problem.php';
	include __DIR__ . '/../events.php';
	include __DIR__ . '/../health.php';
	include __DIR__ . '/../gad.php';
	include __DIR__ . '/../phq.php';
	include __DIR__ . '/../pcl.php';
	include __DIR__ . '/../psc.php';
	include __DIR__ . '/../ces_d.php';
	include __DIR__ . '/../dast.php';
	include __DIR__ . '/../duke.php';
	include __DIR__ . '/../self.php';
	include __DIR__ . '/../sdq.php';
	include __DIR__ . '/../life.php';
	include __DIR__ . '/../adhd.php';


	////////////////////////////////////////These are where we score our tests/////////////////////

	if (($_SESSION['assessment_type'] == 'Child')&&($_SESSION['pp'] != "")) {
		//we need to do presenting problem.
		echo "<div class='scoring'>";
		echo "<h3>Presenting Problem</h3>";
		pp_scoring($_SESSION, $mysqli);
		echo "</div>";
		echo "<div class='scoring'>";
		echo "<h3>Stress</h3>";
		stressors_scoring($_SESSION, $mysqli);
		echo "</div>";
	}
	if($_SESSION['stress_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>Stress</h3>";
		stressors_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['self_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>Self-care</h3>";
		self_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['gad_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>GAD-7</h3>";
		gad_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['phq_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>PHQ-9</h3>";
		phq_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['psc_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>PSC-17</h3>";
		psc_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['pcl_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>PCL-C</h3>";
		pcl_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['ces_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>CES-D</h3>";
		ces_d_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['dast_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>DAST-10</h3>";
		dast_scoring($copy, $mysqli);
		echo "</div>";
	}
	if($_SESSION['duke_check'] == 1) {
		echo "<div class='scoring'>";
		echo "<h3>The Duke</h3>";
		duke_scoring($copy, $mysqli);
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
