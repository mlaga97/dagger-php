<?php
	global $mysqli, $copy;

	// Assessments
	include __DIR__ . '/../../stressors/stressors.php';
	include __DIR__ . '/../../presenting_problem/presenting_problem.php';
	include __DIR__ . '/../../events/events.php';
	include __DIR__ . '/../../health/health.php';
	include __DIR__ . '/../../phq/phq.php';
	include __DIR__ . '/../../pcl/pcl.php';
	include __DIR__ . '/../../psc/psc.php';
	include __DIR__ . '/../../ces_d/ces_d.php';
	include __DIR__ . '/../../dast/dast.php';
	include __DIR__ . '/../../duke/duke.php';
	include __DIR__ . '/../../self/self.php';
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
