<?php

  function getSearch($parameters) {
    global $mysqli;

    $query = '';
    $search = false;

    if(array_key_exists('userID', $parameters)) {
      if($search)
        $query .= ' AND ';

      $search = true;
      $query .= 'user_id = ' . $mysqli->real_escape_string($parameters['userID']);
    }

    if(array_key_exists('clinicID', $parameters)) {
      if($search)
        $query .= ' AND ';

      $search = true;
      $query .= 'clinic_id = ' . $mysqli->real_escape_string($parameters['clinicID']);
    }

    if(array_key_exists('patientID', $parameters)) {
      if($search)
        $query .= ' AND ';

      $search = true;
      $query .= 'patient_id = ' . $mysqli->real_escape_string($parameters['patientID']);
    }

    if(array_key_exists('patientDOB', $parameters)) {
      if($search)
        $query .= ' AND ';

      $search = true;
      $query .= 'patient_dob = ' . $mysqli->real_escape_string($parameters['patientDOB']);
    }

    if($search) {
      return ' WHERE ' . $query;
    } else {
      return '';
    }
  }

  // TODO: Implement with GET body
  function jsonSearch($parameters) {
  }

?>
