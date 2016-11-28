<?php
	include 'include/dagger.php';
	loggingInit();
	allowPrevious(true, '/clinicSearch.php');
	$mysqli = dbOpen();

	// Update User Record
	$update_query = 'UPDATE users ';
	foreach($_POST as $key=>$value) {
		if($key == "pswd" || $key == "uname") {
			$update_query = 'UPDATE users SET ' . $key . '="' . $value . '" WHERE id=' . $_SESSION['user_id'] . ';';
		} else {
			$update_query = 'UPDATE users SET ' . $key . '=' . $value . ' WHERE id=' . $_SESSION['user_id'] . ';';
		}
		$null = $mysqli->query($update_query);
	}

	// Get Current User Record
	$query = 'SELECT id, uname, pswd, university_id, clinic_id, admin, employee_id, grouping, test_acc FROM users WHERE id = ' . $_SESSION['user_id'] . ' LIMIT 1';
	$info = $mysqli->query($query);
	$row = $info->fetch_assoc();
?>



<html>
    <head>
        <title>
            Settings
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Brief Adult Assessment">
        <link rel="stylesheet" href="/include/mystyle.css" type="text/css">
    </head>
    <body>
		<?php include 'include/menu.php'; ?>
		<?php echo $_SESSION['logo']; ?>

        <br/><br/><br/>

		<div style='text-align: center;'>
	        <form action="settings.php" method="post">
				id:<br><input type="text" name="id" value="<?php echo $row['id'] ?>"><br><br>
				uname:<br><input type="text" name="uname" value="<?php echo $row['uname'] ?>"><br><br>
				pswd:<br><input type="text" name="pswd" value="<?php echo $row['pswd'] ?>"><br><br>
				university_id:<br><input type="text" name="university_id" value="<?php echo $row['university_id'] ?>"><br><br>
				clinic_id:<br><input type="text" name="clinic_id" value="<?php echo $row['clinic_id'] ?>"><br><br>
				admin:<br><input type="text" name="admin" value="<?php echo $row['admin'] ?>"><br><br>
				employee_id:<br><input type="text" name="employee_id" value="<?php echo $row['employee_id'] ?>"><br><br>
				grouping:<br><input type="text" name="grouping" value="<?php echo $row['grouping'] ?>"><br><br>
				test_acc:<br><input type="text" name="test_acc" value="<?php echo $row['test_acc'] ?>"><br><br>
	
				<input type="submit" value="Submit">
			</form>
		</div>

        <br/><br/><br/>

		<?php include 'include/footer.php'; ?>
	</body>
</html>
