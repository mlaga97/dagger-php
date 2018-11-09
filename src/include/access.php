<?php

/**
 * Updates the password for the given userID.
 * 
 * @param string $userID
 * @param string $password
 */
function updatePassword($userID, $password) {
  global $log, $mysqli;

  $hash = password_hash($password, PASSWORD_BCRYPT);

  // We use $userID because MySQL doesn't like updates on non-key fields (i.e. uname)
  $query = "UPDATE users SET pswd='$hash' WHERE id='$userID'";
  $results = $mysqli->query($query);
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
 * @return string|boolean Returns error string if login failed.
 */
function login($username, $password) {
  global $log, $mysqli;

  $username = $mysqli->real_escape_string($username);
  $query = "SELECT *, id as user_id FROM users WHERE uname='$username'";
  $results = $mysqli->query($query);

  // Check that there is exactly one matching user
  if ($results && $results->num_rows === 1) {
    $user = $results->fetch_assoc();

    // Check for unhashed password
    // TODO: Remove, eventually.
    if (substr($user['pswd'], 0, 2) !== '$2') {
      if ($user['pswd'] === $password) {
        updatePassword($user['id'], $user['pswd']);
        return login($username, $password);
      }
    }

    // Verify that the password matches the hash 
    if (password_verify($password, $user['pswd'])) {
      $_SESSION['status'] = 'authorized';

      // Don't store the hash in $_SESSION
      unset($user['pswd']);
      foreach($user as $key => $value) {
        $_SESSION[$key] = $value;
      }

      return true;
    }
  }

  return 'Incorrect username or password.';
}

?>
