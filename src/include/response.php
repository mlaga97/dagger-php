<?php
	// TODO: Config items for user keys

	// Set up database
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/db.php');

	function getResponse($id) {
		global $mysqli;
		$output = array();

		// TODO: USE PREPARED STATEMENTS TO AVOID SQL INJECTION
		if($result = $mysqli->query('SELECT * FROM msihdp.response WHERE id = ' . $id)) {
			foreach($result->fetch_assoc() as $key => $value) {
				if($value != null) {
					$output[$key] = $value;
				}
			}
		}

		return $output;
	}

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

	function listResponsesByID() {
		global $mysqli;
		$output = array();

		if($result = $mysqli->query('SELECT * FROM msihdp.response')) {
			while($row = $result->fetch_assoc()) {
				$output[$row["id"]] = array();

				foreach($row as $key => $value) {
					if($value != null) {
						$output[$row["id"]][$key] = $value;
					}
				}
			}
		}

		return $output;
	}

	function listResponseIDs() {
		global $mysqli;
		$output = array();

		if($result = $mysqli->query('SELECT id FROM msihdp.response')) {
			while($row = $result->fetch_assoc()) {
				array_push($output, $row["id"]);
			}
		}

		return $output;
	}

?>
