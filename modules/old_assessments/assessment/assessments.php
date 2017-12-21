<?php
	echo "<!--oldassessments-assessments-assessments.php -->";
	global $mysqli;

	include __DIR__ . '/../../stressors/stressors.php';
	include __DIR__ . '/../../current_stress/current_stress.php';
	include __DIR__ . '/../../health/health.php';
	include __DIR__ . '/../../events/events.php';
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

?>
