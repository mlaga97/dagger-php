<?php
	include 'include/dagger.php';
	loggingInit();
	$mysqli = dbOpen();

	// Update User Record
	$update_query = 'UPDATE users ';
	foreach($_POST as $key=>$value) {
		if($key == "name" || $key == "uname" || $key == "pswd") {
			$update_query = 'UPDATE users SET ' . $key . '="' . $value . '" WHERE id=' . $_SESSION['user_id'] . ';';
		} else {
			$update_query = 'UPDATE users SET ' . $key . '=' . $value . ' WHERE id=' . $_SESSION['user_id'] . ';';
		}
		$null = $mysqli->query($update_query);
	}

	// Force logout to reload settings.
	// TODO: Not this.
	allowPrevious($_SERVER['REQUEST_METHOD'] !== 'POST', '/userSettings.php');

	// Get Current User Record
	$query = 'SELECT id, name, uname, pswd, university_id, clinic_id, admin, employee_id, grouping, test_acc FROM users WHERE id = ' . $_SESSION['user_id'] . ' LIMIT 1';
	$info = $mysqli->query($query);
	$row = $info->fetch_assoc();
?>

<html>
	<head>
		<title>Options</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Admin Settings">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>

	<body>
		<?php include 'include/menu.php'; ?>
		<div id='container'>
			<div id='top'>
				<div id='logo'>
					<?php echo $_SESSION['logo']?>
				</div>
				<div id='header'>
					<div id='title'>
						<center>
							<h1>User Settings</h1>
						</center>
					</div>
					<center>
						<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
					</center>
				</div>
			</div>

			<br/><br/><br/>

			<div style='text-align: center;'>
		        <form action="settings.php" method="post">
					id:<br><input type="text" name="id" value="<?php echo $row['id'] ?>"><br><br>
					name:<br><input type="text" name="name" value="<?php echo $row['name'] ?>"><br><br>
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

			<?php include 'include/footer.php' ?>
		</div>
	</body>
</html>