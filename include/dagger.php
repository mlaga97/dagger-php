<?php /* Initial Setup */

	// User session
	session_start();

	// Reject the unauthorized
	if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized') {
		header("location: /index.php");
		die("Authentication required, redirecting!");
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

	function moduleList() {
		return array_diff(scandir("modules/"), array('..', '.'));
	}

	function moduleProvides($module) {
		$raw = array_diff(scandir("modules/" . $module), array('..', '.'));

		$processed = array();
		foreach($raw as $file) {
			if(!preg_match('/\.php/', $file)) {
				array_push($processed, $file);
			}
		}

		return $processed;
	}

	function moduleListKeys() {
		$keyList = array();
		foreach(moduleList() as $module) {
			$keys = array_diff(scandir("modules/" . $module), array('..', '.'));

			foreach($keys as $key) {
				if(!preg_match('/\.php/', $key)) {
					array_push($keyList, $key);
				}
			}
		}

		return array_unique($keyList);
	}

	function moduleListProviders($key) {
		$raw = array_diff(glob("modules/*/" . $key), array('..', '.'));

		$processed = array();
		foreach($raw as $file) {
			if(!preg_match('/\.php/', $file)) {
				array_push($processed, $file);
			}
		}

		return $processed;
	}

	function moduleListPaths($key) {
		$files = array();
		foreach(moduleListProviders($key) as $provider) {
			$files = array_merge($files, array_diff(scandir($provider), array('..', '.')));
		}

		sort($files);

		$paths = array();
		foreach($files as $file) {
			$paths = array_merge($paths, array_diff(glob("modules/*/" . $key . '/' . $file), array('..', '.')));
		}

		return $paths;
	}

	// Takes variable argument list
	function moduleLoad() {
		foreach(func_get_args() as $key) {
			foreach(moduleListPaths($key) as $file) {
				include $file;
			}
		}
	}

	function postToSession($ignoreKeys = array()) {
		foreach($_POST as $key=>$value) {
			if (!array_key_exists($key, $ignoreKeys)) {
				$_SESSION[$key] = $value;
			}
		}
	}
?>
