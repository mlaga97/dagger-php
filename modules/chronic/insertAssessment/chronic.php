<?php
	//Convert the strings to the mysql default format.
	//YYYY-MM-DD
	// Prevent the chronic health stuff from being reported.
	if($_SESSION['A1CDate']!=="") {
		$_SESSION['A1CDate'] = date("Y-m-d", strtotime($_SESSION['A1CDate']));
	}
	if($_SESSION['eAGDate']!=="") {
		$_SESSION['eAGDate'] = date("Y-m-d", strtotime($_SESSION['eAGDate']));
	}
	if($_SESSION['bpDate']!=="") {
		$_SESSION['bpDate'] = date("Y-m-d", strtotime($_SESSION['bpDate']));
	}
	if($_SESSION['physicalDate']!=="") {
		$_SESSION['physicalDate'] = date("Y-m-d", strtotime($_SESSION['physicalDate']));
	}
	if($_SESSION['cholestoralDate']!=="") {
		$_SESSION['cholestoralDate'] = date("Y-m-d", strtotime($_SESSION['cholestoralDate']));
	}
	if($_SESSION['hospital_visit_date']!=="") {
		$_SESSION['hospital_visit_date'] = date("Y-m-d", strtotime($_SESSION['hospital_visit_date']));
	}
	if($_SESSION['er_visit_date']!=="") {
		$_SESSION['er_visit_date'] = date("Y-m-d", strtotime($_SESSION['er_visit_date']));
	}
	if($_SESSION['office_visit_date']!=="") {
		$_SESSION['office_visit_date'] = date("Y-m-d", strtotime($_SESSION['office_visit_date']));
	}

	//Convert any "NA" responses in the chronic health questions to -1.
	if($_SESSION['valueA1C'] === "NA") {
		$_SESSION['valueA1C']= '-1';
	}
	if($_SESSION['valueEAG'] === "NA") {
		$_SESSION['valueEAG']= '-1';
	}
	if($_SESSION['valueHDL'] === "NA") {
		$_SESSION['valueHDL']= '-1';
	}
	if($_SESSION['valueLDL'] === "NA") {
		$_SESSION['valueLDL']= '-1';
	}
	if($_SESSION['valueSYS'] === "NA") {
		$_SESSION['valueSYS']= '-1';
	}
	if($_SESSION['valueDIA'] === "NA") {
		$_SESSION['valueDIA']= '-1';
	}
	if($_SESSION['valueHeight'] === "NA") {
		$_SESSION['valueHeight']= '-1';
	}
	if($_SESSION['valueWeight'] === "NA") {
		$_SESSION['valueWeight']= '-1';
	}
?>
