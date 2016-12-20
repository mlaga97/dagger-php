<?php /* Initial Setup */
	// User session
	session_start();

	if(empty($noRedirect)) {

		// Reject the unauthorized
		if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized') {
			header("location: /index.php");
			die("Authentication required, redirecting!");
		}
	} else {
		unset($noRedirect);
	}

	// MySQL Setup
	$mysqli = new mysqli(
			getConfigKey("edu.usm.dagger.main.db.server"),
			getConfigKey("edu.usm.dagger.main.db.user"),
			getConfigKey("edu.usm.dagger.main.db.password"),
			getConfigKey("edu.usm.dagger.main.db.name")
	);

	// Log4php Setup
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/log4php/Logger.php');
	Logger::configure($_SERVER['DOCUMENT_ROOT'] . '/include/log4php/config.xml');
	$log = Logger::getLogger('myLogger');

	// Set Timezone Data
	date_default_timezone_set('America/Chicago');
	$today = date('m-d-y h:i:s');
?>

<?php /* Function Library */

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
				if(!array_key_exists($_SESSION['previous'], $access_whitelist)) {
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
		return array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/modules/"), array('..', '.'));
	}

	function moduleProvides($module) {
		$raw = array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/modules/" . $module), array('..', '.'));

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
			$keys = array_diff(scandir($_SERVER['DOCUMENT_ROOT'] . "/modules/" . $module), array('..', '.'));

			foreach($keys as $key) {
				if(!preg_match('/\.php/', $key)) {
					array_push($keyList, $key);
				}
			}
		}

		return array_unique($keyList);
	}

	function moduleListProviders($key) {
		$raw = array_diff(glob($_SERVER['DOCUMENT_ROOT'] . "/modules/*/" . $key), array('..', '.'));

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
			$paths = array_merge($paths, array_diff(glob($_SERVER['DOCUMENT_ROOT'] . "/modules/*/" . $key . '/' . $file), array('..', '.')));
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

	function getMenu() {
		$path = $_SERVER['DOCUMENT_ROOT'] . '/menu.json';
		$contents = file_get_contents($path);
		$menu = json_decode($contents, true);

		foreach(moduleList() as $module) {
			if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module . '/menu.json')) {
				$path = $_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module . '/menu.json';
				$contents = file_get_contents($path);
				$menu = array_merge_recursive($menu, json_decode($contents, true));
			}
		}

		return $menu;
	}

	function showMenu() {

		function menu2html($menu) {
			$html = '';

			foreach($menu as $menuItemId => $menuItem) {
				if(array_key_exists('displayOnlyIfThisSessionKeyIsTrue', $menuItem)) {
					if(!$_SESSION[$menuItem['displayOnlyIfThisSessionKeyIsTrue']]) {
						continue;
					}
				}

				$html .= '<li><a href="' . $menuItem['href'] . '">' . $menuItem['name'] . '</a>';
				if(array_key_exists('children', $menuItem)) {
					$html .= '<ul>' . menu2html($menuItem['children']) . '</ul>';
				}
				$html .= '</li>';
			}

			return $html;
		}

		echo '<ul id="nav">' . menu2html(getMenu()) . '</ul><br/><br/><br/><br/>';
	}

	function getConfig() {
		$path = $_SERVER['DOCUMENT_ROOT'] . '/config.json';
		$contents = file_get_contents($path);
		$config = json_decode($contents, true);

		foreach(moduleList() as $module) {
			if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module . '/config.json')) {
				$path = $_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module . '/config.json';
				$contents = file_get_contents($path);
				$config = array_merge_recursive($config, json_decode($contents, true));
			}
		}

		return $config;
	}

	function getConfigKey($key) {
		$config = getConfig();
		return $config[$key];
	}

	function postToSession($ignoreKeys = array()) {
		foreach($_POST as $key=>$value) {
			if (!array_key_exists($key, $ignoreKeys)) {
				$_SESSION[$key] = $value;
			}
		}
	}

	function multiPregMatch($patterns, $subject) {
		foreach($patterns as $pattern) {
			if(preg_match($pattern, $subject)) {
				return true;
			}
		}
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
				echo $key . ': ' . $value . '<br/>';
			}

			// Allow user through
			$_SESSION['status'] = 'authorized';
			header("location: /home.php");

		} else {

			// Return Error Message
			return "Please enter a correct username and password.";

		}
	}

?>
