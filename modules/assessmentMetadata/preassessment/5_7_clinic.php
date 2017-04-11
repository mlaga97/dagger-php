<!-- TODO: Skip if only one clinic available. -->

<h3>Clinic</h3>

<?php
	global $mysqli;

	$clinic_select = $mysqli->query('SELECT clinic_id from groups where user_id = ' . $_SESSION['user_id']);
	while ($row = $clinic_select->fetch_assoc()) {
		$clinic_name = $mysqli->query('SELECT name from clinic where id = ' . $row['clinic_id']);
		$row2 = $clinic_name->fetch_assoc();
		?><label><input type="radio" name="clinicID" value="<?php echo $row['clinic_id']?>"  required="true" /><?php echo $row2['name']?></label>
		<br/><?php
	}

?>

<br/><br/><hr/>
