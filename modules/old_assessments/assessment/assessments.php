<?php
	echo "<!--oldassessments-assessments-assessments.php -->";
	global $mysqli;

	include __DIR__ . '/../../stressors/stressors.php';
	include __DIR__ . '/../../current_stress/current_stress.php';
	include __DIR__ . '/../../health/health.php';
	include __DIR__ . '/../../events/events.php';
	include __DIR__ . '/../../phq/phq.php';
	include __DIR__ . '/../../pcl/pcl.php';
	include __DIR__ . '/../../ces_d/ces_d.php';
	include __DIR__ . '/../../psc/psc.php';
	include __DIR__ . '/../../dast/dast.php';
	include __DIR__ . '/../../duke/duke.php';
	include __DIR__ . '/../../self/self.php';
	include __DIR__ . '/../../sdq/sdq.php';
	include __DIR__ . '/../../life/life.php';
	include __DIR__ . '/../../diagnosis/diagnosis.php';
	include __DIR__ . '/../../diag_me/diag_me.php';
	include __DIR__ . '/../../adhd/adhd.php';
	include __DIR__ . '/../../presenting_problem/presenting_problem.php';
	include __DIR__ . '/../../childStressors/childStressors.php';

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

	if($_SESSION['phq_check'] == 1) {
		echo "<div class='write'>";
		echo "<h3>PHQ-9</h3>";
		write_phq($_SESSION['assessment_type'], $mysqli);
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
?>
