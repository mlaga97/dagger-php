<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/include/dagger.php';
	global $log, $mysqli, $today;

	// Select based on pt_id, as obtained from the GET request.
	$query_results = $mysqli->query("SELECT * FROM response WHERE pt_id = '" . $mysqli->real_escape_string($_GET['pt_id']). "'" );

	global $row; // To make changes done in the foreach loop stick.
	$results_array = array();

	while( $row = $query_results->fetch_assoc() ) {
		foreach ( $row as $key => $value ) {

			// Do pre-processing in here
			if($value == '-1' && !multiPregMatch(getConfigKey("edu.usm.dagger.main.viewAssessment.dontSet_-1_to_0"), $key)) {
				$row[$key] = 0;
			}

		}

		// Push the result to the final array, once preprocessing is done.
		array_push($results_array, $row);
	}

	// Send the result to the client.
	echo json_encode($results_array);
?>
