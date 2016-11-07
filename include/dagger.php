<?php /* Initial Setup */

	// User session
	session_start();

	// Reject the unauthorized
	if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized') {
		header("location: /index.php");
		die("Authentication required, redirecting");
	}
?>

<?php /* Function Library */

	function loggingInit() {
		// Log4php Setup
		require_once('include/log4php/Logger.php');
		Logger::configure('include/log4php/config.xml');
		$GLOBALS["log"] = Logger::getLogger('myLogger');

		// Set Timezone Data
		date_default_timezone_set('America/Chicago');
		$GLOBALS["today"] = date('m-d-y h:i:s');
	}

	function dbOpen() {
		require_once('include/Mysql.php');
		require_once 'include/constants.php';
		$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);
		return $mysqli;
	}

	// Allow only certain pages to access this one
	function allowPrevious($access_whitelist, $new_name) {
		$type = gettype($access_whitelist);

		switch ($type) {
			case "string":
				break;

			case "array":
				break;

			case "boolean":
				break;

			default:
				die("checkPrevious requires a string or an array");
		}

		$_SESSION['previous'] = $new_name;
	}

	function unsetKeys($keysToUnset) {

		foreach($keys as $key) {
			unset($_SESSION[$key]);
		}

	}

	function unsetAllButTheseKeys($keysToKeep) {

		// Go through each key in $_SESSION
		foreach ($_SESSION as $key) {

			// Check if key is safe
			if(!array_key_exists($key, $keysToKeep)) {

				// Unset if not
				unset($_SESSION[$key]);

			}

		}

	}

	function loadModules($modulePath) {
		$modules = array_diff(scandir($modulePath), array('..', '.'));

		require_once('include/Mysql.php');
		require_once 'include/constants.php';
		$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

		// Show Modules
		foreach($modules as $module) {
			include $modulePath . $module;
		}

		mysqli_close($mysqli);
	}

	function postToSession($ignoreKeys = array()) {
		foreach($_POST as $key=>$value) {
			if (!array_key_exists($key, $ignoreKeys)) {
				$_SESSION[$key] = $value;
			}
		}
	}
?>