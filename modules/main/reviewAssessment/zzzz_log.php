<?php
	global $log, $mysqli, $today;

	/**************************************************************************
	***************************************************************************
	**************************************************************************/

	$keys = "(id,";
	$values = "(0, ";

	// Get list of fields in the database
	$dbFieldQuery = 'SELECT column_name FROM information_schema.columns WHERE table_schema = "' . getConfigKey("edu.usm.dagger.main.db.name") . '" AND table_name = "response";';
	$dbFieldResult = $mysqli->query($dbFieldQuery);

	$dbFields = array();
	while($row = $dbFieldResult->fetch_assoc()) {
		array_push($dbFields, $row['column_name']);
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
			}
		}
	}

	// Generate query for insertion into DB
	$keys = $keys . "date)";
	$values = $values . "NOW())";
	$query = "insert into response $keys values $values";

	// Log Data in case user doesn't hit submit
	$log->info("REVIEW LOG: " . $today . $_SESSION['user_id'] ." ". $query);
?>
