<?php /* Function Library */

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
