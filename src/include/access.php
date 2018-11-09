<?php

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
  $query .= 'users.id AS user_id FROM users WHERE uname = "' . $mysqli->real_escape_string($username) . '" AND pswd = "' . $mysqli->real_escape_string($password) . '" AND active = 1 LIMIT 1';

  $results = $mysqli->query($query);

  if($results && $results->num_rows === 1) {
    foreach($results->fetch_assoc() as $key => $value) {
      $_SESSION[$key] = $value;
    }

    $_SESSION['status'] = 'authorized';
    return true;
  } else {
    return "Incorrect username or password.";
  }
}

?>
