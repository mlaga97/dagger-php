<?php
	session_start();

	require_once('include/log4php/Logger.php');
	Logger::configure('include/log4php/config.xml');
	$log = Logger::getLogger('myLogger');
	date_default_timezone_set('America/Chicago');$today = date('m-d-y h:i:s');

	foreach($_POST as $key=>$value) {
		if (($key != 'status') && ($key != 'previous')) {
			$_SESSION[$key] = $value;
		}
	}

	if(
		!isset($_SESSION['status']) ||
		$_SESSION['status'] != 'authorized' ||
		$_SESSION['previous'] != '/reviewAssessment.php' ||
		!array_key_exists('n1', $_SESSION) ||
		!array_key_exists('n2', $_SESSION) ||
		!array_key_exists('n3', $_SESSION) ||
		!array_key_exists('n4', $_SESSION)
	) {
		header("location: /index.php");
		die("Authentication required, redirecting");
	}

	$_SESSION['previous'] = '/insertAssessment.php';

	require_once 'include/constants.php';
	$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

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


	$keys = "(id,";
	$values = "(0, ";
	foreach($_SESSION as $key=>$value) { 	//We want to insert the values contained in $_SESSION not $copy.
			if (($key != 'st')  && ($key != 'status') && ($key != 'id') &&($key != 'logo') && ($key != 'n1') && ($key != 'n2')  //took out st, so if it barfs, we'll leave it in.
					&& ($key != 'n3')  && ($key != 'n4') && ($key != 'GRHOP_standard') && ($key != 'admin') && ($key != 'c_p_id')       //throw st away. I can't figure out where this is comming from in adult.php.
					&& ($key != 'previous') && ($key != 'search_select') && ($key != 'university_id')&& ($key != 'grouping')
					&& ($key != 'contact_date') && ($key != 'entry_date') && ($key != 'contact_outcome')
					&& ($key != 'outcome_other') && ($key != 'contact_reason') && ($key != 'reason_other') && ($key != 'test_acc')) {
						$keys = $keys .   $key . " ,";
						if($key == 'pt_id' || $key == 'first_name' || $key == 'last_name') { // Here we are setting the name and pt_id to password.
							$value = strtolower($value);
							$value = hash('sha256', $value);
							$values = $values . " '" . $value . "',";
						} else {
							if ((($key === 'A1CDate')|| ($key === 'eAGDate') ||($key === 'cholestoralDate') ||
									($key === 'bpDate')||($key === 'physicalDate') || ($key === 'hospital_visit_date')||
									($key === 'er_visit_date') || ($key === 'office_visit_date')||($key === 'assessment_date')) && ($value === '')) {
										$values = $values ." '" . "0000-00-00" . "',";
									} else {
										$values = $values . " '" . $value . "',";
									}
						}
					}
	}
	$keys = $keys . "date)";
	$values = $values . "NOW())";
	$query = "insert into response $keys values $values";
	if ($_SESSION['grouping'] !=10) { //grouping = 10 means the user is logged in as a CFHC employee. We are not keeping their data only scoring assessments.
		$result = $mysqli->query($query);
		$insert_id = $mysqli->insert_id;
		$_SESSION['insert_id'] = $insert_id;
		if ($_SESSION['grouping'] ==10) { //see note above.
			$log->info("INSERT LOG: " . $today ." response.id: CFHC non-insert ". $_SESSION['user_id'] ." ". $query);
		} else {
			$log->info("INSERT LOG: " . $today ." response.id: " .$insert_id. " ". $_SESSION['user_id'] ." ". $query);
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>Assessment Evaluation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Assessment Evaluation">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>
	<body>
		<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
		<center><h1>Success!</h1></center>

		<center><input type="button" value="Return to Start" style= "height: 25px; width: 100px" onclick="window.location='/index.php';" /></center>

		<?php include 'include/footer.php' ?>
	</body>
</html>
