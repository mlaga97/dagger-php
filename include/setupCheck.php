<?php
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
	$tables = array();
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
		$fields = array();
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

	////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////
	// TODO: Probably belongs somewhere else.

	// Password Encyption Library
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/password.php');

	// Ensure column can store hashed passwords
	$null = $mysqli->query("ALTER TABLE users CHANGE COLUMN pswd pswd VARCHAR(255) NOT NULL;");

	// Encrypt unencrypted passwords
	$users = $mysqli->query('SELECT id, pswd FROM ' . $tableName . ' WHERE NOT secured_password <=> 1;');
	while($user = $users->fetch_assoc()) {

		// Variables and things
		$original_password = $user['pswd'];
		$id = $user['id'];
		$hashed = password_hash($original_password, PASSWORD_DEFAULT);

		// Update DB
		$null = $mysqli->query('UPDATE users SET secured_password = 1, pswd = "' . $hashed . '" WHERE id=' . $user['id'] . ';');

		// Pull back from DB
		$results = $mysqli->query('SELECT pswd FROM users WHERE id = "' . $user['id'] . '" AND active = 1 LIMIT 1');
		$user = $results->fetch_assoc();

		// Verify that the DB is correct
		if(password_verify($original_password, $user['pswd'])) {
			echo "Updated successfully!";
		} else {
			// Revert Back Otherwise
			echo "Error!";
			$null = $mysqli->query('UPDATE users SET secured_password = 0, pswd = "' . $original_password . '" WHERE id=' . $user['id'] . ';');
		}
	}
?>