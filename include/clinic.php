<?php
	// Set up database
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/db.php');

	function getClinicUsers($id) {
		global $mysqli;
		$output = array();

		// TODO: USE PREPARED STATEMENTS TO AVOID SQL INJECTION
		if($result = $mysqli->query('SELECT user_id FROM msihdp.groups WHERE clinic_id = ' . $id)) {
			while($row = $result->fetch_assoc()) {
				array_push($output, $row['user_id']);
			}
		}

		return $output;
	}

	function getClinic($id) {
		global $mysqli;
		$output = array();

		// TODO: USE PREPARED STATEMENTS TO AVOID SQL INJECTION
		if($result = $mysqli->query('SELECT id, name, city, state FROM msihdp.clinic WHERE id = ' . $id)) {
			$output = $result->fetch_assoc();
			$result->close();
		}

		$output['users'] = getClinicUsers($id);

		return $output;
	}

	function listClinicsByID() {
		global $mysqli;
		$output = array();

		if($result = $mysqli->query('SELECT id, name, city, state FROM msihdp.clinic')) {
			while($row = $result->fetch_assoc()) {
				$output[$row["id"]] = $row;
				$output[$row["id"]]['users'] = getClinicUsers($row["id"]);
			}
		}

		return $output;
	}

	function listClinicIDs() {
		global $mysqli;
		$output = array();

		if($result = $mysqli->query('SELECT id FROM msihdp.clinic')) {
			while($row = $result->fetch_assoc()) {
				array_push($output, $row["id"]);
			}
		}

		return $output;
	}
?>
