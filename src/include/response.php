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

    // Prepare statement
    if (!($query = $mysqli->prepare('INSERT INTO `json_response` (`data`) VALUES (?)'))) {
      echo 'Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error;
    }

    // Bind statement
    if (!$query->bind_param('s', json_encode($response))) {
      echo 'Binding parameters failed: (' . $query->errno . ') ' . $query->error;
    }

    // Execute statement
    if (!$query->execute()) {
      echo 'Execute parameters failed: (' . $query->errno . ') ' . $query->error;
    }

    $insertID = $mysqli->insert_id;
    return $insertID;
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
