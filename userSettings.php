<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/userSettings.php');
	$pageTitle = "User Settings";

	// Get Current User Record
	$query = 'SELECT id, name, uname, pswd, university_id, clinic_id, admin, employee_id, grouping, test_acc FROM users WHERE id = ' . $_SESSION['user_id'] . ' LIMIT 1';
	$info = $mysqli->query($query);
	$row = $info->fetch_assoc();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Options</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="User Settings">
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>
	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<?php include 'modules/main/header.php'; ?>

			<!-- Body -->
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
								$update_query = 'UPDATE users SET pswd = "' . $mysqli->real_escape_string($_POST['newPassword']) . '" WHERE id=' . $_SESSION['user_id'] . ';';
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

			<!-- Footer -->
			<?php include 'modules/main/footer.php' ?>

		</div>
	</body>
</html>