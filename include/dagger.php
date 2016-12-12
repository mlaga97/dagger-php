<?php /* Initial Setup */
	if(!$login_page) {
		// User session
		session_start();

		// Reject the unauthorized
		if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized') {
			header("location: /index.php");
			die("Authentication required, redirecting!");
		}
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
		$mysqli = new mysqli(
				getConfigKey("edu.usm.dagger.main.db.server"),
				getConfigKey("edu.usm.dagger.main.db.user"),
				getConfigKey("edu.usm.dagger.main.db.password"),
				getConfigKey("edu.usm.dagger.main.db.name")
		);
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
	
	function getConfigKey($key) {
		$configString = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config.json');
		$config = json_decode($configString, true);

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
?>








<?php
// Though we are not yet using the log, it has been included.
openlog("MSIHDP", LOG_PID, LOG_USER);

//This class will allow for easy connection to Mysql
class Mysql
{
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli(
				getConfigKey("edu.usm.dagger.main.db.server"),
				getConfigKey("edu.usm.dagger.main.db.user"),
				getConfigKey("edu.usm.dagger.main.db.password"),
				getConfigKey("edu.usm.dagger.main.db.name")
		)
        or die('There was a problem connecting to the database.');
    }

    function verify_Username_and_Pass($un, $pwd)
    {
        $query = "SELECT id,university_id, clinic_id, admin, grouping, test_acc FROM users WHERE uname =  ?  AND pswd =  ?  AND active = 1 LIMIT 1";
        $query_logo = "SELECT logo FROM university WHERE id =  ? LIMIT 1";
        if($stmt = $this->conn->prepare($query))
        {
            $stmt->bind_param( 'ss', $un, $pwd);
            $stmt->execute();
            $stmt->bind_result($id_copy, $university_id, $clinic_id, $admin, $grouping, $test_acc);
            if ($stmt->fetch())
            {
                $_SESSION['user_id']   = $id_copy;
                $_SESSION['clinic_id'] = $clinic_id;
                $_SESSION['admin']     = $admin;
                $_SESSION['university_id'] = $university_id;
                $_SESSION['grouping'] = $grouping;
                $_SESSION['test_acc'] = $test_acc;
                $stmt->close();
                if($stmt = $this->conn->prepare($query_logo))
                {    
                    $stmt->bind_param( 's', $university_id);
                    $stmt->execute();
                    $stmt->bind_result($_SESSION['logo']);
                    ($stmt->fetch());
                    $stmt->close();
                }
                return TRUE;
            }
        }
    }
}

closelog();

// Our Membership class is called in index.php whenever we sign into the initial code. It is being used hand in hand with the Mysql class to verify the user. 
class Membership
{
    function validate_user ($un, $pwd) 
    {
        $mysql = New Mysql();

        if(isset($_SESSION['id']))
        {
            $value = $_SESSION['id'];
        }

        $ensure_credentials = $mysql->verify_Username_and_Pass($un,$pwd);

        if($ensure_credentials)
        {
            $_SESSION['status'] = 'authorized';
            header("location: /home.php");
        }

        else
        {
           return "Please enter a correct username and password.";
        }
    }


    function confirm_Member()
    {
       session_start();
       if($_SESSION['status'] !='authorized'){
        header("location: /index.php");
        die("Authentication required, redirecting");
       }
    }
}

?>
