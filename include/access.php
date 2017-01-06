<?php

	/**
	 * Defines page access rules and declares new page name.
	 * 
	 * Page access rules can be provided in several forms, including:
	 * - string	   Name of allowed previous page
	 * - string[]  Names of allowed previous pages
	 * - bool      Value or expression to test
	 * 
	 * If a string or string[] is given, the page will log the user out if the
	 * name of the previous page is not present in the page access rules. If a
	 * boolean is given, the page will log the user out if the expression
	 * returns false.
	 * 
	 * If the user is not logged out, then the current page is assigned the new
	 * name provided.
	 * 
	 * @param string|string[]|boolean $access_whitelist New page access rules to enforce.
	 * 
	 * @param string $new_name New name to give to current page.
	 */
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
				die("checkPrevious requires a string, string[], or boolean");
		}

		$_SESSION['previous'] = $new_name;
	}

	/**
	 * Attempts to login with username and password.
	 * 
	 * If the login attempt fails, an error message will be returned, otherwise
	 * the user's configuration will be loaded and the user will be redirected
	 * to the main page.
	 * 
	 * @param string $username
	 * @param string $password
	 * 
	 * @return string|null Returns error string if login failed.
	 */
	function login($username, $password) {
		global $log, $mysqli;

		$query = 'SELECT ';
		foreach(getConfigKey("edu.usm.dagger.main.login.user.keys") as $key) {
			$query .= $key . ', ';
		}
		$query .= 'users.id AS user_id FROM users INNER JOIN university ON users.university_id = university.id WHERE uname = "' . $mysqli->real_escape_string($username) . '" AND pswd = "' . $mysqli->real_escape_string($password) . '" AND active = 1 LIMIT 1';

		$results = $mysqli->query($query);

		if($results && $results->num_rows === 1) {
			foreach($results->fetch_assoc() as $key => $value) {
				$_SESSION[$key] = $value;
			}

			$_SESSION['status'] = 'authorized';
			header("location: /home.php");
		} else {
			return "Please enter a correct username and password.";
		}
	}


	/**
	 * Reloads the user configuration and logs them out if the user is no longer
	 * active or does not exist.
	 */
	function reloadUserSettings() {
		global $log, $mysqli;

		$query = 'SELECT ';
		foreach(getConfigKey("edu.usm.dagger.main.login.user.keys") as $key) {
			$query .= $key . ', ';
		}
		$query .= 'users.id AS user_id FROM users INNER JOIN university ON users.university_id = university.id WHERE users.id = "' . $_SESSION['user_id'] . '" AND active = 1 LIMIT 1';

		$results = $mysqli->query($query);

		if($results && $results->num_rows === 1) {
			foreach($results->fetch_assoc() as $key => $value) {
				$_SESSION[$key] = $value;
			}
		} else {
			header("location: /index.php");
		}
	}

?>
