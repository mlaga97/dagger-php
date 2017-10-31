<?php
	echo "<!--oldassessments-assessments-assessments.php -->";
	global $mysqli;

	include __DIR__ . '/../stressors.php';
	include __DIR__ . '/../current_stress.php';
	include __DIR__ . '/../health.php';
	include __DIR__ . '/../events.php';
	include __DIR__ . '/../gad.php';
	include __DIR__ . '/../phq.php';
	include __DIR__ . '/../cage.php';
	include __DIR__ . '/../pcl.php';
	include __DIR__ . '/../ces_d.php';
	include __DIR__ . '/../psc.php';
	include __DIR__ . '/../dast.php';
	include __DIR__ . '/../duke.php';
	include __DIR__ . '/../self.php';
	include __DIR__ . '/../sdq.php';
	include __DIR__ . '/../life.php';
	include __DIR__ . '/../diagnosis.php';
	include __DIR__ . '/../diag_me.php';
	include __DIR__ . '/../adhd.php';
	include __DIR__ . '/../presenting_problem.php';
	include __DIR__ . '/../childStressors.php';

	if($_SESSION['pp_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>Presenting Problem</h3>";
		write_presenting_problem($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if ($_SESSION['c_stress_check'] == 1) {
		echo "<div class='write'>";
		// Assessment header in fxn
		write_current_stress("Child");
		echo "</div>";
	}

	if ($_SESSION['c_stress_check'] == 1) {
		echo "<div class='write'>";
		// Assessment header in fxn
		write_childStressors($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}


	if($_SESSION['stress_check'] == 1) {
		echo "<div class='write'>";
		// Assessment header in fxn
		write_stressors($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
		echo "<div class='write'>";
		// Assessment header in fxn
		write_current_stress($_SESSION['assessment_type']);
		echo "</div>";
	}

	if($_SESSION['health_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>Health</h3>";
		write_health($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['events_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>Events</h3>";
		write_events($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if( $_SESSION['sdq_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>SDQ</h3>";
		write_sdq($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['gad_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>GAD-7</h3>";
		write_gad($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
		echo "<div class=\"page-break\"></div><!--force page break here. good for 8.5X11 pages -->";//these are manual page breaks for printing. May need to move them if you print the instruments in different order!
	}

	if($_SESSION['phq_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>PHQ-9</h3>";
		write_phq($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['cage_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>CAGE</h3>";
		write_cage($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['pcl_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>PCL-C</h3>";
		write_pcl($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['diagnosis_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>Diagnosis</h3>";
		write_diagnosis($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['diag_me_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>Diagnosis ME</h3>";
		write_diag_me($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['ces_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>CES-D</h3>";
		write_ces_d($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['psc_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>PSC-17</h3>";
		write_psc($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['dast_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>DAST-10</h3>";
		write_dast($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['duke_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>The Duke</h3>";
		write_duke($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['self_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>Self-care</h3>";
		write_self($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}

	if($_SESSION['life_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>Life Attitudes</h3>";
		write_life($_SESSION['assessment_type'], $mysqli);
		echo "</div>";

	}

	if($_SESSION['adhd_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>ADHD Self-Report Scale</h3>";
		write_adhd($_SESSION['assessment_type'], $mysqli);
		echo "</div>";
	}
?>
