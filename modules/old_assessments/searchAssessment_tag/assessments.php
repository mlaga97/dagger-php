<?php
	global $row;

	if ($row ['stress_check'] == 1)
		echo "Stress ";
	if ($row ['events_check'] == 1)
		echo "Event ";
	if ($row ['health_check'] == 1)
		echo "Health ";
	if ($row ['symptom_check'] == 1)
		echo "Symptom ";
	if ($row ['gad_check'] == 1)
		echo "GAD-7 ";
	if ($row ['gad2_check'] == 1)
		echo "GAD-2 ";
	if ($row ['phq_check'] == 1)
		echo "PHQ-9 ";
	if ($row ['audit_check'] == 1)
		echo "Audit ";
	if ($row ['cage_check'] == 1)
		echo "Cage ";
	if ($row ['cd_check'] == 1)
		echo "CD ";
	if ($row ['pcl_check'] == 1)
		echo "PCL-C ";
	if ($row ['pcl2_check'] == 1)
		echo "PCL-A ";
	if ($row ['psc_check'] == 1)
		echo "PSC ";
	if ($row ['ces_check'] == 1)
		echo "CES-D ";
	if ($row ['dast_check'] == 1)
		echo "DAST ";
	if ($row ['duke_check'] == 1)
		echo "DUKE ";
	if ($row ['sdq_check'] == 1)
		echo "SDQ ";
	if ($row ['adhd_check'] == 1)
		echo "ADHD ";
?>