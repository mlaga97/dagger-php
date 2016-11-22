<?php
	include 'include/dagger.php';
	loggingInit();
	allowPrevious(true, '/clinicSearch.php');

	$mysqli = dbOpen();
	$query = 'SELECT id, uname, pswd, university_id, clinic_id, admin, employee_id, grouping, test_acc FROM users WHERE id = ' . $_SESSION['user_id'] . ' LIMIT 1';

	$info = $mysqli->query($query);
	$row = $info->fetch_assoc();
?>

<form action="action_page.php">
	id:<br><input type="text" name="id" value="<?php echo $row['id'] ?>"><br>
	uname:<br><input type="text" name="id" value="<?php echo $row['uname'] ?>"><br>
	pswd:<br><input type="text" name="id" value="<?php echo $row['pswd'] ?>"><br>
	university_id:<br><input type="text" name="id" value="<?php echo $row['university_id'] ?>"><br>
	clinic_id:<br><input type="text" name="id" value="<?php echo $row['clinic_id'] ?>"><br>
	admin:<br><input type="text" name="id" value="<?php echo $row['admin'] ?>"><br>
	employee_id:<br><input type="text" name="id" value="<?php echo $row['employee_id'] ?>"><br>
	grouping:<br><input type="text" name="id" value="<?php echo $row['grouping'] ?>"><br>
	test_acc:<br><input type="text" name="id" value="<?php echo $row['test_acc'] ?>"><br>

	<input type="submit" value="Submit">
</form>
