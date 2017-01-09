<?php /* Function Library */

	/**
	 * Unsets the keys $_SESSION from a blacklist.
	 * 
	 * @param string[] $keysToUnset Blacklist of keys to unset.
	 */
	function unsetKeys($keysToUnset) {
		foreach($keys as $key) {
			unset($_SESSION[$key]);
		}
	}

	/**
	 * Unsets all keys in $_SESSION except those from a whitelist.
	 *
	 * @param string[] $keysToUnset Whitelist of keys to keep.
	 */
	function unsetAllButTheseKeys($keysToKeep) {
		foreach ($_SESSION as $key) {
			if(!array_key_exists($key, $keysToKeep)) {
				unset($_SESSION[$key]);
			}
		}
	}

	/**
	 * Copies entire $_POST array to $_SESSION, with the ability to ignore
	 * certain keys using a blacklist.
	 * 
	 * @param string[] $ignoreKeys List of keys to ignore.
	 */
	function postToSession($ignoreKeys = array()) {
		foreach($_POST as $key=>$value) {
			if (!array_key_exists($key, $ignoreKeys)) {
				$_SESSION[$key] = $value;
			}
		}
	}

	/**
	 * Check if a string contains a match among any of the provided patterns.
	 * 
	 * @param string[] $patterns Array of regular expressions to attempt to
	 * match.
	 * @param string $subject The string to attempt to match.
	 * @return boolean True if a match was found, false if not.
	 */
	function multiPregMatch($patterns, $subject) {
		foreach($patterns as $pattern) {
			if(preg_match($pattern, $subject)) {
				return true;
			}
		}
		return false;
	}

?>
