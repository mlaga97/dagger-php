<?php
	// TODO: Config items for user keys

	// Set up database
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/db.php');

  function postResponse($response) {
    global $mysqli;

    // Parse out values into proper fields
    $userID = $response['metadata']['user']['id'];
    $clinicID = $response['metadata']['clinic']['id'];
    $patientID = $response['metadata']['patient']['id'];
    $patientDOB = $response['metadata']['patient']['dob'];
    $selectedAssessments = json_encode($response['assessments']['selected']);
    $assessmentResponses = json_encode($response['assessments']['responses']);

    // Escape each string in place to avoid SQL injection
    $userID = $mysqli->real_escape_string($userID);
    $clinicID = $mysqli->real_escape_string($clinicID);
    $patientID = $mysqli->real_escape_string($patientID);
    $patientDOB = $mysqli->real_escape_string($patientDOB);
    $selectedAssessments = $mysqli->real_escape_string($selectedAssessments);
    $assessmentResponses = $mysqli->real_escape_string($assessmentResponses);

    $result = $mysqli->query("
      INSERT INTO `json_response` (
        `user_id`,
        `clinic_id`,
        `patient_id`,
        `patient_dob`,
        `selected_assessments`,
        `assessment_responses`
      ) VALUES (
        '$userID',
        '$clinicID',
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
    $userID = $result['user_id'];
    $clinicID = $result['clinic_id'];
    $patientID = $result['patient_id'];
    $patientDOB = $result['patient_dob'];
    $selectedAssessments = $result['selected_assessments'];
    $assessmentResponses = $result['assessment_responses'];

    // Unescape values
    $selectedAssessments = json_decode($selectedAssessments);
    $assessmentResponses = json_decode($assessmentResponses);

    // Parse out values into proper fields
    return [
      metadata => [
        user => [ id => $userID ],
        clinic => [ id => $clinicID ],
        patient => [
          id => $patientID,
          dob => $patientDOB,
        ],
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
    if($result = $mysqli->query('SELECT * FROM msihdp.json_response WHERE id = ' . $id)) {
      $row = $result->fetch_assoc();
      return responseToObject($row);
		}

		return [];
  }

	function listResponsesByID() {
		global $mysqli;
		$output = [];

		if($result = $mysqli->query('SELECT * FROM msihdp.json_response')) {
			while($row = $result->fetch_assoc()) {
        $output[$row['id']] = responseToObject($row);
			}
		}

		return $output;
	}

	function listResponseIDs() {
		global $mysqli;
		$output = [];

		if($result = $mysqli->query('SELECT id FROM msihdp.json_response')) {
			while($row = $result->fetch_assoc()) {
				array_push($output, $row["id"]);
			}
		}

		return $output;
	}

?>
