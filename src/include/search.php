<?php

function getSearch($parameters) {
  global $mysqli;

  $query = '';
  $search = false;

  // Handle searches on traditional columns
  $LUT = [
    'id' => 'id',
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

  // TODO: Handle searches on selected_assessments

  // Handle searches on assessment_responses
  // TODO: Derive LUT from config, not hardcoded.
  $LUT = [
    // Demographics
    'gender' => '$.demographics.gender',
    'ethnicity' => '$.demographics.ethnicity',
    'maritalStatus' => '$.demographics.maritalStatus',
    'livingArrangements' => '$.demographics.livingArrangements',
    'zip' => '$.demographics.zip',
    'education' => '$.demographics.education',

    // MIHDP
    'hasInsurance' => '$.mihdp.hasInsurance',
    'behavioralHealth' => '$.mihdp.behavioralHealth',
    'chronicCare' => '$.mihdp.chronicCare',
    'nutritionCounseling' => '$.mihdp.nutritionCounseling',
    'activityType' => '$.mihdp.activityType',

    // MIHDP Programs
    'hepC' => '$.programs.hepC',
    'ryanWhite' => '$.programs.ryanWhite',
    'homeless' => '$.programs.homeless',
  ];
  foreach($LUT as $key => $value) {
    if(array_key_exists($key, $parameters)) {
      if($search) {
        $query .= ' AND ';
      }

      $search = true;
      $query .= "(JSON_CONTAINS(assessment_responses, '\"" . $mysqli->real_escape_string($parameters[$key]) . "\"', '$value')";
      $query .= " OR JSON_CONTAINS(assessment_responses, '" . $mysqli->real_escape_string($parameters[$key]) . "', '$value'))";
    }
  }

  if($search) {
    return ' WHERE ' . $query;
  } else {
    return '';
  }
}

?>
