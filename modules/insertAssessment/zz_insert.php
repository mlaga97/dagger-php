<?php
	$mysqli = dbOpen();

	global $log, $today;

	// These keys should not be inserted into the DB
	$insert_blacklist = array(
			'admin', 'university_id', 'grouping', 'logo', 'status', 'previous', 'test_acc',
			'n1', 'n2', 'n3', 'n4',
			'st', 'id', 'GRHOP_standard', 'c_p_id', 'search_select', 'contact_date',
			'entry_date', 'contact_outcome', 'outcome_other', 'contact_reason', 'reason_other',
	);

	// These keys should be encrypted to protect patient privacy 
	$insert_encrypted_whitelist = array('pt_id', 'first_name', 'last_name');

	// These keys need to have empty values substituted with 0000-00-00 in order to please the DB
	$insert_dates_whitelist = array('A1CDate', 'eAGDate', 'cholestoralDate', 'bpDate', 'physicalDate', 'hospital_visit_date', 'er_visit_date', 'office_visit_date', 'assessment_date');

	/**************************************************************************
	***************************************************************************
	**************************************************************************/

	$keys = "(id,";
	$values = "(0, ";

	if(array_key_exists('admin', $insert_blacklist)) {
		echo 'admin blacklisted';
	} else {
		echo 'admin not blacklisted';
	}

	if(array_key_exists('stress_check', $insert_blacklist)) {
		echo 'stress_check blacklisted';
	} else {
		echo 'stress_check not blacklisted';
	}

	// Pull the desired keys from $_SESSION and do some final post-processing
	foreach($_SESSION as $key=>$value) {

		// Ignore keys in blacklist
		// TODO: Perhaps a whitelist would be less likely to fail upon insertion?
		if( !array_key_exists($key, $insert_blacklist) ) {

			// Append key to list of keys
			$keys = $keys . $key . " ,";

			if( array_key_exists($key, $insert_encrypted_whitelist) ) {

				// Encrypt values to protect patient privacy
				$value = strtolower($value);
				$value = hash('sha256', $value);
				$values = $values . " '" . $value . "',";

			} elseif( array_key_exists($key, $insert_dates_whitelist) && ($value === '') ) {

				// Empty date values need to be substituted with 0000-00-00 in order to please the DB
				$values = $values ." '" . "0000-00-00" . "',";
			} else {

				// All other values can just be appended as-is
				$values = $values . " '" . $value . "',";
			}
		}
	}

	// Generate query for insertion into DB
	$keys = $keys . "date)";
	$values = $values . "NOW())";
	$query = "insert into response $keys values $values";

	// Insert query into DB unless the user is not a CFHC employee, as we only score their assessments.
	if ($_SESSION['grouping'] != 10) {

		// Insert
		$result = $mysqli->query($query);

		// Keep track of insert_id just in case we need to edit.
		// TODO: Is this necessary with reviewAssessment.php?
		$insert_id = $mysqli->insert_id;
		$_SESSION['insert_id'] = $insert_id;

		// Log, just in case.
		$log->info("INSERT LOG: " . $today ." response.id: " .$insert_id. " ". $_SESSION['user_id'] ." ". $query);
	} else {
		$log->info("INSERT LOG: " . $today ." response.id: CFHC non-insert ". $_SESSION['user_id'] ." ". $query);
	}
?>
