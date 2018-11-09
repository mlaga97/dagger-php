<?php

function getSearch($parameters) {
  global $mysqli;

  $query = '';
  $search = false;

  $LUT = [
    'userID' => 'user_id =',
    'clinicID' => 'clinic_id =',
    'patientID' => 'patient_id =',
    'patientDOB' => 'patient_dob =',
    'visitDateEnd' => 'visit_date <=',
    'visitDateStart' => 'visit_date >=',
    'dateSubmittedEnd' => 'date_submitted <=',
    'dateSubmittedStart' => 'date_submitted >=',
  ];

  foreach($LUT as $key => $value) {
    if(array_key_exists($key, $parameters)) {
      if($search) {
        $query .= ' AND ';
      }

      $search = true;
      $query .= $value . ' "' . $mysqli->real_escape_string($parameters[$key]) . '"';
    }
  }

  if($search) {
    return ' WHERE ' . $query;
  } else {
    return '';
  }
}

?>
