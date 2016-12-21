<?php

	// Allow only certain pages to access this one
	function allowPrevious($access_whitelist, $new_name) {
		$type = gettype($access_whitelist);

		switch ($type) {
			case "string":
				if($_SESSION['previous'] != $access_whitelist) {
					header("location: /index.php");
					die("Access denied, redirecting!");
				}
				break;

			case "array":
				if(!in_array($_SESSION['previous'], $access_whitelist)) {
					header("location: /index.php");
					die("Access denied, redirecting!");
				}
				break;

			case "boolean":
				if(!$access_whitelist) {
					header("location: /index.php");
					die("Access denied, redirecting!");
				}
				break;

			default:
				die("checkPrevious requires a string, boolean, or an array");
		}

		$_SESSION['previous'] = $new_name;
	}

	// Configurable login function
	function login($username, $password) {
		global $log, $mysqli;

		// Build query from configuration data
		$query = 'SELECT ';
		foreach(getConfigKey("edu.usm.dagger.main.login.user.keys") as $key) {
			$query .= $key . ', ';
		}
		$query .= 'users.id AS user_id FROM users INNER JOIN university ON users.university_id = university.id WHERE uname = "' . $mysqli->real_escape_string($username) . '" AND pswd = "' . $mysqli->real_escape_string($password) . '" AND active = 1 LIMIT 1';

		// Run query
		$results = $mysqli->query($query);

		// Check if query returned anything
		if($results && $results->num_rows === 1) {

			// Copy user data to $_SESSION
			foreach($results->fetch_assoc() as $key => $value) {
				$_SESSION[$key] = $value;
			}

			// Allow user through
			$_SESSION['status'] = 'authorized';
			header("location: /home.php");

		} else {

			// Return Error Message
			return "Please enter a correct username and password.";

		}
	}

	// Function to reload user settings
	function reloadUserSettings() {
		global $log, $mysqli;

		// Build query from configuration data
		$query = 'SELECT ';
		foreach(getConfigKey("edu.usm.dagger.main.login.user.keys") as $key) {
			$query .= $key . ', ';
		}
		$query .= 'users.id AS user_id FROM users INNER JOIN university ON users.university_id = university.id WHERE users.id = "' . $_SESSION['user_id'] . '" AND active = 1 LIMIT 1';

		// Run query
		$results = $mysqli->query($query);

		// Check if query returned anything
		if($results && $results->num_rows === 1) {

			// Copy user data to $_SESSION
			foreach($results->fetch_assoc() as $key => $value) {
				$_SESSION[$key] = $value;
			}

		} else {

			// User was deleted or is no longer authorized, so kick them out
			header("location: /index.php");

		}
	}

?>
