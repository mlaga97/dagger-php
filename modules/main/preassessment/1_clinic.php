<?php
	global $mysqli;
	
	$clinic_select = $mysqli->query('SELECT clinic_id from groups where user_id = ' . $_SESSION['user_id']);
	if ($clinic_select) {
	
		echo "<table border=\"1\" width=\"800\"><tr><td colspan = \"2\"><h3><b> Please select your clinic. </b></h3><br></td></tr>\n";
	
		while ($row = $clinic_select->fetch_assoc()) {
			$clinic_name = $mysqli->query('SELECT name from clinic where id = ' . $row['clinic_id']);
			$row2 = $clinic_name->fetch_assoc();
	
			echo "<tr><td>" . $row2['name'] . " </td><td><center><input type=\"radio\" name =\"clinic_id\" value=\"" . $row['clinic_id'] . "\"/></center></td></tr>\n";
			//$_SESSION['clinic_id'] = $row['clinic_id'];
		}
	} else {
		echo "Query error!";
	}
	echo "</table>";

?>

<br/>
