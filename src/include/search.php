<?php

  // TODO: Rewrite this in a much more generic way
  function paginate($parameters) {
    global $mysqli;

    $paginate = false;

    $page = 1;
    if(array_key_exists('page', $parameters)) {
      $paginate = true;
      $page = $mysqli->real_escape_string($parameters['page']);
    }

    $count = 10;
    if(array_key_exists('count', $parameters)) {
      $paginate = true;
      $count = $mysqli->real_escape_string($parameters['count']);
    }

    $offset = ($page - 1) * $count;

    if($paginate) {
      return ' LIMIT ' . $offset . ', ' . $count;
    } else {
      return '';
    }
  }

  // TODO: Rewrite this in a much more generic way
  function getSearch($parameters) {
    global $mysqli;

    $query = '';
    $search = false;

    if(array_key_exists('visitDateStart', $parameters)) {
      if($search)
        $query .= ' AND ';

      $search = true;
      $query .= 'visit_date >= "' . $mysqli->real_escape_string($parameters['visitDateStart']) . '"';
    }

    if(array_key_exists('visitDateEnd', $parameters)) {
      if($search)
        $query .= ' AND ';

      $search = true;
      $query .= 'visit_date <= "' . $mysqli->real_escape_string($parameters['visitDateEnd']) . '"';
    }

    if(array_key_exists('dateSubmittedStart', $parameters)) {
      if($search)
        $query .= ' AND ';

      $search = true;
      $query .= 'date_submitted >= "' . $mysqli->real_escape_string($parameters['dateSubmittedStart']) . '"';
    }

    if(array_key_exists('dateSubmittedEnd', $parameters)) {
      if($search)
        $query .= ' AND ';

      $search = true;
      $query .= 'date_submitted <= "' . $mysqli->real_escape_string($parameters['dateSubmittedEnd']) . '"';
    }

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
