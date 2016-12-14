<?php
	global $mysqli, $copy;

	// Assessments
	include __DIR__ . '/../stressors.php';
	include __DIR__ . '/../presenting_problem.php';
	include __DIR__ . '/../events.php';
	include __DIR__ . '/../health.php';
	include __DIR__ . '/../cd.php';
	include __DIR__ . '/../gad.php';
	include __DIR__ . '/../phq.php';
	include __DIR__ . '/../audit.php';
	include __DIR__ . '/../cage.php';
	include __DIR__ . '/../pcl.php';
	include __DIR__ . '/../psc.php';
	include __DIR__ . '/../ces_d.php';
	include __DIR__ . '/../dast.php';
	include __DIR__ . '/../duke.php';
	include __DIR__ . '/../self.php';
	include __DIR__ . '/../sdq.php';
	include __DIR__ . '/../pcl-2.php';
	include __DIR__ . '/../gad-2.php';
	include __DIR__ . '/../crafft.php';
	include __DIR__ . '/../life.php';
	include __DIR__ . '/../adhd.php';

	////////////////////////////////////////These are where we score our tests/////////////////////
	echo "<table border=\"1\" width=\"800\">";
	echo "<th><center><h2>Scoring for assessment</h2></center></th>";
	echo "</table>";
	if (($_SESSION['assessment_type'] == 'Child')&&($_SESSION['pp'] != "")) {
		//we need to do presenting problem.
		pp_scoring($_SESSION, $mysqli);
		stressors_scoring($_SESSION, $mysqli);
	}
	if($_SESSION['stress_check'] == 1) {
		stressors_scoring($copy, $mysqli);
	}
	if($_SESSION['self_check'] == 1) {
		self_scoring($copy, $mysqli);
	}
	if($_SESSION['cd_check'] == 1) {
		cd_scoring($_SESSION['assessment_type'], $copy, $mysqli);
	}
	if($_SESSION['gad_check'] == 1) {
		gad_scoring($copy, $mysqli);
	}
	if($_SESSION['gad2_check'] == 1) {
		gad2_scoring($copy, $mysqli);
	}
	if($_SESSION['phq_check'] == 1) {
		phq_scoring($copy, $mysqli);
	}
	if($_SESSION['psc_check'] == 1) {
		psc_scoring($copy, $mysqli);
	}
	if($_SESSION['audit_check'] == 1) {
		$sex = $_SESSION['sex'];
		audit_scoring($copy, $sex, $mysqli);
	}
	if($_SESSION['cage_check'] == 1) {
		cage_scoring($copy, $mysqli);
	}
	if($_SESSION['pcl_check'] == 1) {
		pcl_scoring($copy, $mysqli);
	}
	if($_SESSION['pcl2_check'] == 1) {
		pcl2_scoring($copy, $mysqli);
	}
	if($_SESSION['crafft_check'] == 1) {
		crafft_scoring($copy, $mysqli);
	}
	if($_SESSION['ces_check'] == 1) {
		ces_d_scoring($copy, $mysqli);
	}
	if($_SESSION['dast_check'] == 1) {
		dast_scoring($copy, $mysqli);
	}
	if($_SESSION['duke_check'] == 1) {
		duke_scoring($copy, $mysqli);
	}
	if($_SESSION['sdq_check'] == 1) {
		sdq_scoring($copy, $mysqli);
	}
	if($_SESSION['life_check'] == 1) {
		life_scoring($copy, $mysqli);
	}
	if($_SESSION['adhd_check'] == 1) {
		adhd_scoring($copy, $mysqli);
	}
?>
