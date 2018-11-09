<?php

function getOrder($parameters) {
  global $mysqli;

  $order = false;

  $orderBy = 'id';
  if(array_key_exists('orderBy', $parameters)) {
    $LUT = [
      'id' => 'id',
      'userID' => 'user_id',
      'clinicID' => 'clinic_id',
      'visitDate' => 'visit_date',
      'dateSubmitted' => 'date_submitted',
      'patientID' => 'patient_id',
      'patientDOB' => 'patient_dob',
    ];

    if(array_key_exists($parameters['orderBy'], $LUT)) {
      $order = true;
      $orderBy = $LUT[$parameters['orderBy']];
    }
  }

  $orderDirection = 'DESC';
  if(array_key_exists('order', $parameters)) {
    $LUT = [
      'asc' => 'ASC',
      'ASC' => 'ASC',
      '1' => 'ASC',
      'desc' => 'DESC',
      'DESC' => 'DESC',
      '-1' => 'DESC',
    ];

    if(array_key_exists($parameters['order'], $LUT)) {
      $order = true;
      $orderDirection = $LUT[$parameters['order']];
    }
  }

  if($order) {
    return " ORDER BY $orderBy $orderDirection";
  }

  return '';
}

?>
