<?php

// Set up database
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/db.php');

function DB2User($userRow) {

  // Add structure
  $user = [];
  $user['flags'] = [];
  $user['login'] = [];
  $user['associations'] = [];
  $user['associations']['groups'] = [];
  $user['associations']['clinics'] = [];

  // Primary Key
  $user['id'] = $userRow['id'];

  // Login
  $user['login']['active'] = $userRow['active'];
  $user['login']['username'] = $userRow['uname'];
  //$user['login']['password'] = $userRow['pswd'];

  // Associations
  // TODO: Fold 'grouping' and 'university' both into 'groups'
  $user['associations']['grouping'] = $userRow['grouping'];
  $user['associations']['university'] = $userRow['university_id'];

  // Flags
  $user['flags']['admin'] = $userRow['admin'];
  $user['flags']['debug'] = $userRow['debug'];
  $user['flags']['tester'] = $userRow['test_acc'];

  // Special Flags
  if($_SESSION['user_id'] == $user['id'])
    $user['flags']['currentUser'] = true;

  return $user;
}

function getUserClinics($id) {
  global $mysqli;
  $output = [];

  // TODO: USE PREPARED STATEMENTS TO AVOID SQL INJECTION
  if($result = $mysqli->query('SELECT clinic_id FROM msihdp.groups WHERE user_id = ' . $id)) {
    while($row = $result->fetch_assoc()) {
      array_push($output, $row['clinic_id']);
    }
  }

  return $output;
}

function getUser($id) {
  global $mysqli;
  $output = [];

  // Get user
  // TODO: USE PREPARED STATEMENTS TO AVOID SQL INJECTION
  if($result = $mysqli->query('SELECT id, uname, university_id, clinic_id, admin, region, state, active, grouping, test_acc, debug FROM msihdp.users WHERE id = "' . $id . '" OR uname = "' . $id . '"')) {
    $output = DB2User($result->fetch_assoc());
    $result->close();
  }

  // TODO: Deprecate one of these!
  $output['clinics'] = getUserClinics($id);
  $output['associations']['clinics'] = getUserClinics($id);

  return $output;
}

function listUsersByID() {
  global $mysqli;
  $output = [];

  if($result = $mysqli->query('SELECT id, uname, university_id, clinic_id, admin, region, state, active, grouping, test_acc, debug FROM msihdp.users')) {
    while($row = $result->fetch_assoc()) {
      $output[$row["id"]] = DB2User($row);

      // TODO: Deprecate one of these!
      $output[$row["id"]]['clinics'] = getUserClinics($row["id"]);
      $output[$row['id']]['associations']['clinics'] = getUserClinics($row['id']);
    }
  }

  return $output;
}

function listUserIDs() {
  global $mysqli;
  $output = [];

  if($result = $mysqli->query('SELECT id FROM msihdp.users')) {
    while($row = $result->fetch_assoc()) {
      array_push($output, $row["id"]);
    }
  }

  return $output;
}

?>
