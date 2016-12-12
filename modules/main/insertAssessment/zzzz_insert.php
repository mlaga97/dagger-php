<?php
	$mysqli = dbOpen();

	global $log, $today;

	/**************************************************************************
	***************************************************************************
	**************************************************************************/

	$keys = "(id,";
	$values = "(0, ";

	// Pull the desired keys from $_SESSION and do some final post-processing
	foreach($_SESSION as $key=>$value) {

		// Ignore keys in blacklist
		// TODO: Perhaps a whitelist would be less likely to fail upon insertion?
		if( !in_array($key, getConfigKey("edu.usm.dagger.main.insert.insert_blacklist")) ) {

			// Append key to list of keys
			$keys = $keys . $key . " ,";

			if( in_array($key, getConfigKey("edu.usm.dagger.main.insert.encryption_whitelist")) ) {

				// Encrypt values to protect patient privacy
				$value = strtolower($value);
				$value = hash('sha256', $value);
				$values = $values . " '" . $value . "',";

			} elseif( in_array($key, getConfigKey("edu.usm.dagger.main.insert.datefix_whitelist")) && ($value === '') ) {

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
