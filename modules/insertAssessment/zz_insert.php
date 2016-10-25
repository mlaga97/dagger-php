<?php
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
