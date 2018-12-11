<?php

// TODO: Config items for user keys

// Set up database
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/db.php');

function postResponse($response) {
  global $mysqli;

  // Parse out values into proper fields
  $userID = $response['metadata']['user']['id'];
  $clinicID = $response['metadata']['clinic']['id'];
  $visitDate = $response['metadata']['visit']['date'];
  $patientID = $response['metadata']['patient']['id'];
  $patientDOB = $response['metadata']['patient']['dob'];
  $dateSubmitted = $response['metadata']['dateSubmitted']; // TODO: Stop trusting the client
  $selectedAssessments = json_encode($response['assessments']['selected']);
  $assessmentResponses = json_encode($response['assessments']['responses']);

  // Escape each string in place to avoid SQL injection
  $userID = $mysqli->real_escape_string($userID);
  $clinicID = $mysqli->real_escape_string($clinicID);
  $visitDate = $mysqli->real_escape_string($visitDate);
  $patientID = $mysqli->real_escape_string($patientID);
  $patientDOB = $mysqli->real_escape_string($patientDOB);
  $dateSubmitted = $mysqli->real_escape_string($dateSubmitted); // TODO: Stop trusting the client
  $selectedAssessments = $mysqli->real_escape_string($selectedAssessments);
  $assessmentResponses = $mysqli->real_escape_string($assessmentResponses);

  $result = $mysqli->query("
    INSERT INTO `json_response` (
      `user_id`,
      `clinic_id`,
      `visit_date`,
      `date_submitted`,
      `patient_id`,
      `patient_dob`,
      `selected_assessments`,
      `assessment_responses`
    ) VALUES (
      '$userID',
      '$clinicID',
      '$visitDate',
      '$dateSubmitted',
      '$patientID',
      '$patientDOB',
      '$selectedAssessments',
      '$assessmentResponses'
    )
  ");

  // Get the id of the new record
  $responseID = $mysqli->insert_id;

  // Return the response ID to the client
  return $responseID;
}

function responseToObject($result) {

  // Extract values
  $responseID = $result['id'];
  $userID = $result['user_id'];
  $clinicID = $result['clinic_id'];
  $visitDate = $result['visit_date'];
  $patientID = $result['patient_id'];
  $patientDOB = $result['patient_dob'];
  $dateSubmitted = $result['date_submitted'];
  $selectedAssessments = $result['selected_assessments'];
  $assessmentResponses = $result['assessment_responses'];

  // Unescape values
  $selectedAssessments = json_decode($selectedAssessments);
  $assessmentResponses = json_decode($assessmentResponses);

  // Parse out values into proper fields
  return [
    metadata => [
      id => $responseID,
      user => [ id => $userID ],
      clinic => [ id => $clinicID ],
      patient => [
        id => $patientID,
        dob => $patientDOB,
      ],
      visit => [
        date => $visitDate,
      ],
      dateSubmitted => $dateSubmitted,
    ],
    assessments => [
      selected => $selectedAssessments,
      responses => $assessmentResponses,
    ],
  ];
}

function getResponse($id) {
  global $mysqli;

  // Avoid SQL injection
  $id = $mysqli->real_escape_string($id);

  // Get response and convert into useful shape
  if($result = $mysqli->query('SELECT *, "HIDDEN" as patient_id FROM msihdp.json_response WHERE id = ' . $id)) {
    $row = $result->fetch_assoc();
    return responseToObject($row);
  }

  return [];
}

function listResponsesByID($query = '') {
  global $mysqli;
  $output = [];

  // TODO: Don't send assessmentResponses unless asked
  if($result = $mysqli->query('SELECT *, "HIDDEN" as patient_id, patient_dob, selected_assessments FROM msihdp.json_response' . $query)) {
    while($row = $result->fetch_assoc()) {
      $output[$row['id']] = responseToObject($row);
    }
  }

  return $output;
}

function listResponseIDs($query = '') {
  global $mysqli;
  $output = [];

  if($result = $mysqli->query('SELECT id FROM msihdp.json_response' . $query)) {
    while($row = $result->fetch_assoc()) {
      array_push($output, $row["id"]);
    }
  }

  return $output;
}

?>
