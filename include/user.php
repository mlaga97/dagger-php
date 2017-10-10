<?php
	// TODO: Config items for user keys

	// Set up database
	require_once($_SERVER['DOCUMENT_ROOT'] . '/include/db.php');

	function getUser($id) {
		global $mysqli;
		$output = array();

		// Get user
		// TODO: USE PREPARED STATEMENTS TO AVOID SQL INJECTION
		if($result = $mysqli->query('SELECT id, uname, university_id, clinic_id, admin, region, state, active, grouping, test_acc, debug FROM msihdp.users WHERE id = "' . $id . '" OR uname = "' . $id . '"')) {
			$output = $result->fetch_assoc();
			$result->close();
		}

		return $output;
	}

	function listUsersByID() {
		global $mysqli;
		$output = array();

		if($result = $mysqli->query('SELECT id, uname, university_id, clinic_id, admin, region, state, active, grouping, test_acc, debug FROM msihdp.users')) {
			while($row = $result->fetch_assoc()) {
				$output[$row["id"]] = $row;
			}
		}

		return $output;
	}

	function listUserIDs() {
		global $mysqli;
		$output = array();

		if($result = $mysqli->query('SELECT id FROM msihdp.users')) {
			while($row = $result->fetch_assoc()) {
				array_push($output, $row["id"]);
			}
		}

		return $output;
	}
?>
