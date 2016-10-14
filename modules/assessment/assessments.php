<?php
	include 'include/stressors.php';
	include 'include/current_stress.php';
	include 'include/health.php';
	include 'include/events.php';
	include 'include/gad.php';
	include 'include/gad-2.php';
	include 'include/phq.php';
	include 'include/audit.php';
	include 'include/cage.php';
	include 'include/cd.php';
	include 'include/pcl.php';
	include 'include/ces_d.php';
	include 'include/symptoms.php';
	include 'include/psc.php';
	include 'include/dast.php';
	include 'include/duke.php';
	include 'include/self.php';
	include 'include/sdq.php';
	include 'include/life.php';
	include 'include/crafft.php';
	include 'include/pcl-2.php';
	include 'include/diagnosis.php';
	include 'include/diag_me.php';
	include 'include/adhd.php';
	include 'include/presenting_problem.php';
	include 'include/childStressors.php';
	include 'include/pediatric.php';
	
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
	
	if($_SESSION['pediatric_check'] == 1) {
		write_pediatric($_SESSION['assessment_type'], $mysqli);
	}
?>