<?php

function write_events($type, $mysqli) {
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}

	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")) {
		$query = 'SELECT * FROM questions WHERE classification="event" AND '.$type.'=1 ORDER BY Ordering';
	} else {
		exit();
	}

	if($result = $mysqli->query($query)) {
		if($result->num_rows > 0) {
			if ($type==="Child") {
				echo "<br><hr>";
				echo "<h1><center>Major Events</center></h1>\n
				<p><center>Please indicate if your child has experienced any of the following events (Mark all that apply.)</center></p>\n
				<div id=\"major_events\">\n		
				<table border=\"1\" id=\"major_events\">\n";
			} else {
				echo "<br><hr>";
				echo "<h1><center>Major Events</center></h1>\n
				<p><center>Please indicate if you have experienced any of the following events (Mark all that apply.)</center></p>\n
				<div id=\"major_events\">\n		
				<table border=\"1\" id=\"major_events\">\n";	
			}
			if ($result) {
				// If we got a result from the query
				while($row = $result->fetch_assoc()) {
					// While we are obtaining those gathered results
					echo "<td class=\"event\">" . $row['question'] ."</td><td class=\"event_input\">\n<center><input type=\"checkbox\" name=\"e_" . $row['Sub_ID'] . "\" value=\"". $row['Sub_ID'] ."\" style=\"vertical-align: bottom\"/></center>
					</td></tr>\n";
					$_SESSION["e_" . $row['Sub_ID']] = "-1";
					//$c++;
				}
				echo "</table><!-- end table_major_events -->\n</div><!-- end div major_events -->\n";
			}
		}
	}
};

?>
