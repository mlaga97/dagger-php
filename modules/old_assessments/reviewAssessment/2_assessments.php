<?php
	$mysqli = dbOpen();

	//we'll make a copy of the values saved in $_SESSION and set all '-1' values to 0 so we can do the cut-off calculations.
	//except the duke and the cd-risc. They need to keep the -1 values for scoring.
	$copy = $_SESSION;
	$regexp = "/duke*/";
	$regexp1 = "/cd_*/";
	$regexp2 = "/self_*/";
	$regexp3 = "/phq_*/";
	foreach($copy as $key=>$value) {
		if ((!preg_match($regexp, $key)) && (!preg_match($regexp1, $key)) && (!preg_match($regexp2, $key)) && (!preg_match($regexp3, $key))){ //exclude the duke and cd-risc responses from the zeroing.
			if ($value == '-1') {
				$copy[$key] = 0;
			}
		}
	}



	// Assessments

	include 'include/stressors.php';
	include 'include/presenting_problem.php';
	include 'include/events.php';
	include 'include/health.php';
	include 'include/cd.php';
	include 'include/gad.php';
	include 'include/phq.php';
	include 'include/audit.php';
	include 'include/cage.php';
	include 'include/pcl.php';
	include 'include/psc.php';
	include 'include/ces_d.php';
	include 'include/dast.php';
	include 'include/duke.php';
	include 'include/self.php';
	include 'include/sdq.php';
	include 'include/pcl-2.php';
	include 'include/gad-2.php';
	include 'include/crafft.php';
	include 'include/life.php';
	include 'include/adhd.php';
	include 'include/pediatric.php';

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
	if($_SESSION['pediatric_check'] == 1) {
		pediatric_scoring($copy, $mysqli);
	}
?>
