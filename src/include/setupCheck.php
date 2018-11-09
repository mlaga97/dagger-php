<?php
	// TODO: Documentation, refactor

	// Check that we could connect
	if (mysqli_connect_error()) {
		die('Error: Connection Failed (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	}

	// Define default database
	if(empty($configuring)) {
		$databaseExists = $mysqli->select_db(getConfigKey("edu.usm.dagger.main.db.database"));

		if(!$databaseExists) {
			//header("location: /setup.php");
			die("Dagger needs to be configured! (That database doesn't exist)");
		}
	}

	// Check database tables
	$tables = [];
	$tablesResult = $mysqli->query("SHOW TABLES");
	while($row = $tablesResult->fetch_assoc()) {
		foreach($row as $key => $value) {
			array_push($tables, $value);
		}
	}

	foreach(getConfigKey("edu.usm.dagger.main.db.tables") as $table) {
		if(!in_array($table, $tables)) {
			// TODO: Something else other than just bitch about it.
			die('Database table "' . $table . '" does not exist!');
		}
	}

	////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////

	foreach(getConfigKey("edu.usm.dagger.dbConfig.tables") as $tableName => $table) {
		// Get list of fields for table
		$tableFieldResult = $mysqli->query('SELECT column_name FROM information_schema.columns WHERE table_schema = "' . getConfigKey("edu.usm.dagger.main.db.database") . '" AND table_name = "' . $tableName . '";');

		// Iterate into array
		$fields = [];
		while($row = $tableFieldResult->fetch_assoc()) {
			array_push($fields, $row['column_name']);
		}

		// Check against what the configuration says should be there
		foreach($table["keys"] as $field => $type) {
			if(!in_array($field, $fields)) {
				// TODO: Maybe don't automatically add fields.
				$mysqli->query("ALTER TABLE " . $tableName . " ADD " . $field . " " . $type . ";");
				echo 'Added field ' . $tableName . '.' . $field . ' (' . $type . ')!<br/>';
			}
		}
	}

?>
