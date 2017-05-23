<?php
	global $log, $mysqli, $today;

	/**************************************************************************
	***************************************************************************
	**************************************************************************/

	$keys = "(id,";
	$values = "(0, ";

	// Get list of fields in the database
	$dbFieldQuery = 'SELECT column_name FROM information_schema.columns WHERE table_schema = "' . getConfigKey("edu.usm.dagger.main.db.database") . '" AND table_name = "response";';
	$dbFieldResult = $mysqli->query($dbFieldQuery);

	$dbFields = array();
	while($row = $dbFieldResult->fetch_assoc()) {
		array_push($dbFields, $row['column_name']);
	}

	// Spacing
	echo '<br/><br/><br/>';

	// Process mask and deprecation warnings first
	$transform = getConfigKey("edu.usm.dagger.main.insert.transform");
	$deprecate = getConfigKey("edu.usm.dagger.main.insert.deprecate");
	foreach($_SESSION as $key=>$value) {

		// Error if key is deprecated
		if(array_key_exists($key, $deprecate)) {
			echo 'Use of $_SESSION["' . $key . '"] is deprecated!<br/>';
			$log->error('Use of $_SESSION["' . $key . '"] is deprecated!');
		}

		if(array_key_exists($key, $transform)) {
			$_SESSION[$transform[$key]] = $_SESSION[$key];
			unset($_SESSION[$key]);
		}
	}

	// Pull the desired keys from $_SESSION and do some final post-processing
	foreach($_SESSION as $key=>$value) {

		// Only allow keys in whitelist
		if(in_array($key, getConfigKey("edu.usm.dagger.main.insert.whitelist"))) {

			// Ignore keys in blacklist
			if( !in_array($key, getConfigKey("edu.usm.dagger.main.insert.blacklist")) ) {

				// Check that field is actually in database table
				if(in_array($key, $dbFields)) {

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

				} else {

					// Log any time that we can't insert a key
					echo 'Error! Could not insert key "' . $key . '" into database.<br/>';
					$log->error('Could not insert key "'. $key .'" with value "' . $value . '"');

				}
			} else {

				// Error if configuration makes no sense
				echo '"' . $key . '" not whitelisted AND blacklisted!<br/>';
				$log->error('"' . $key . '" not whitelisted AND blacklisted!');
			}
		} else {

			// Error if configuration isn't ideal
			if( !in_array($key, getConfigKey("edu.usm.dagger.main.insert.blacklist")) ) {
				echo '"' . $key . '" not whitelisted OR blacklisted!<br/>';
				$log->error('"' . $key . '" not whitelisted OR blacklisted!');
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
