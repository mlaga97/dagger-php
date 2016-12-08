<?php
	global $mysqli;

	include __DIR__ . '/../stressors.php';
	include __DIR__ . '/../current_stress.php';
	include __DIR__ . '/../health.php';
	include __DIR__ . '/../events.php';
	include __DIR__ . '/../gad.php';
	include __DIR__ . '/../gad-2.php';
	include __DIR__ . '/../phq.php';
	include __DIR__ . '/../audit.php';
	include __DIR__ . '/../cage.php';
	include __DIR__ . '/../cd.php';
	include __DIR__ . '/../pcl.php';
	include __DIR__ . '/../ces_d.php';
	include __DIR__ . '/../symptoms.php';
	include __DIR__ . '/../psc.php';
	include __DIR__ . '/../dast.php';
	include __DIR__ . '/../duke.php';
	include __DIR__ . '/../self.php';
	include __DIR__ . '/../sdq.php';
	include __DIR__ . '/../life.php';
	include __DIR__ . '/../crafft.php';
	include __DIR__ . '/../pcl-2.php';
	include __DIR__ . '/../diagnosis.php';
	include __DIR__ . '/../diag_me.php';
	include __DIR__ . '/../adhd.php';
	include __DIR__ . '/../presenting_problem.php';
	include __DIR__ . '/../childStressors.php';
	
	if($_SESSION['pp_check'] == 1) {
		write_presenting_problem($_SESSION['assessment_type'], $mysqli);
	}
	
	if ($_SESSION['c_stress_check'] == 1) {
		write_current_stress("child");
		write_childStressors($_SESSION['assessment_type'], $mysqli);
	}
	
	
	if($_SESSION['stress_check'] == 1) {
		write_stressors($_SESSION['assessment_type'], $mysqli);
		write_current_stress($_SESSION['assessment_type']);
	}
	
	if($_SESSION['health_check'] == 1) {
		write_health($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['events_check'] == 1) {
		write_events($_SESSION['assessment_type'], $mysqli);
	}
	
	if (($_SESSION['gad_check'] == 1)||($_SESSION['phq_check'] == 1)||($_SESSION['audit_check'] == 1)||($_SESSION['gad2_check']==1)||
			($_SESSION['cage_check'] == 1)||($_SESSION['cd_check'] == 1)||($_SESSION['pcl_check'] == 1)||($_SESSION['ces_check'] == 1)||
			($_SESSION['psc_check'] == 1)||	($_SESSION['dast_check'] == 1)||($_SESSION['duke_check'] == 1)) {
		echo '
			<hr/><br/>
				
			<div id="gen_header">
				<h2>
					Below is a list of questions regarding your problems, complaints, feelings and self-confidence.
					Please read each question carefully and select the response that best represents your situation.
				</h2>
			</div><!--end div gen_header --><br>';
	}
	
	if( $_SESSION['sdq_check'] == 1) {
		write_sdq($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['gad_check'] == 1) {
		write_gad($_SESSION['assessment_type'], $mysqli);
		echo "<div class=\"page-break\"></div><!--force page break here. good for 8.5X11 pages -->";//these are manual page breaks for printing. May need to move them if you print the instruments in different order!
	}
	
	if($_SESSION['gad2_check'] == 1) {
		write_gad2($_SESSION['assessment_type'], $mysqli);
	}
		
	if($_SESSION['phq_check'] == 1) {
		write_phq($_SESSION['assessment_type'], $mysqli);
	}
	
	if( $_SESSION['symptom_check'] == 1) {
		write_symptoms($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['audit_check'] == 1) {
		write_audit($_SESSION['assessment_type'], $mysqli);
		echo "<div class=\"page-break\"></div><!--force page break here. good for 8.5X11 pages -->";//these are manual page breaks for printing. May need to move them if you print the instruments in different order!
	}
	
	if($_SESSION['cage_check'] == 1) {
		write_cage($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['cd_check'] == 1) {
		write_cd($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['pcl_check'] == 1) {
		write_pcl($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['pcl2_check'] == 1) {
		write_pcl2($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['diagnosis_check'] == 1) {
		write_diagnosis($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['diag_me_check'] == 1) {
		write_diag_me($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['ces_check'] == 1) {
		write_ces_d($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['psc_check'] == 1) {
		write_psc($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['dast_check'] == 1) {
		write_dast($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['duke_check'] == 1) {
		write_duke($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['self_check'] == 1) {
		write_self($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['life_check'] == 1) {
		write_life($_SESSION['assessment_type'], $mysqli);
	
	}
	
	if($_SESSION['crafft_check'] == 1) {
		write_crafft($_SESSION['assessment_type'], $mysqli);
	}
	
	if($_SESSION['adhd_check'] == 1) {
		write_adhd($_SESSION['assessment_type'], $mysqli);
	}
?><br/>
