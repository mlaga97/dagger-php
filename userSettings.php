<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;

	// Get Current User Record
	$query = 'SELECT id, name, uname, pswd, university_id, clinic_id, admin, employee_id, grouping, test_acc FROM users WHERE id = ' . $_SESSION['user_id'] . ' LIMIT 1';
	$info = $mysqli->query($query);
	$row = $info->fetch_assoc();
?>

<html>
	<head>
		<title>Options</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="User Settings">
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
		        <form action="userSettings.php" method="post">
					Current Password:<br/><input type="password" name="oldPassword"><br><br>
					New Password:<br/><input type="password" name="newPassword"><br><br>
					Confirm Password:<br/><input type="password" name="confirmPassword" onkeyup="checkPass(); return false;"><br><br>

					<input type="submit" value="Submit">
				</form>

				<?php
					// Update User Record
					if(array_key_exists('oldPassword', $_POST) && array_key_exists('newPassword', $_POST) && array_key_exists('confirmPassword', $_POST)) {
						if($row['pswd'] == $_POST['oldPassword']) {
							if($_POST['newPassword'] == $_POST['confirmPassword']) {
								$update_query = 'UPDATE users SET pswd = "' . $_POST['newPassword'] . '" WHERE id=' . $_SESSION['user_id'] . ';';
								$null = $mysqli->query($update_query);

								echo 'Password updated successfully!';
							} else {
								echo 'Failed to update password: Passwords do not match!';
							}
						} else {
							echo 'Failed to update password: Current Password incorrect!';
						}
					}
				?>
			</div>

	        <br/><br/><br/>

			<?php include 'include/footer.php' ?>
		</div>
	</body>
</html>