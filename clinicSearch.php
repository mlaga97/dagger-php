<?php
	include 'include/dagger.php';
	loggingInit();
	allowPrevious($_SESSION['admin'] == 1, '/clinicSearch.php');

	$mysqli = dbOpen();
?>

<!-- HTML start -->
<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
<html>
	<head>
		<title>Clinic Stats</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<meta name='description' content='Brief Adult Assessment'>
		<link rel='stylesheet' href='/include/mystyle.css' type='text/css'>
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
							<h1>Search Clinic Records</h1>
						</center>
					</div>
					<center>
						<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
					</center>
				</div>
			</div>

			<br/><br/><br/>

			<div style='text-align: center;'>
				<?php
					$userIds = $mysqli->query('SELECT id,name from users where id in (select user_id from groups where clinic_id in(select clinic_id from groups where user_id = ' . $_SESSION['user_id'] . '));');
					$clinicIds = $mysqli->query('SELECT id,name from clinic where id in (select clinic_id from groups where user_id = ' . $_SESSION['user_id'] . ');');

					$results_query = 'SELECT COUNT(id) AS clients FROM response WHERE clinic_id IN (select clinic_id from groups where user_id = ' . $_SESSION['user_id'] . ') ';
					/*******************************************
					*               Pick up here               *
					*******************************************/
					// If statements for various combinations of inputs
					$results = $mysqli->query($results_query);
				?>

				<form action='clinicSearch.php' method="post">
					<select name='clinicStats_clinicId'>
						<?php while( ($clinicId = mysqli_fetch_assoc($clinicIds)) ): ?>
							<option value='<?php echo $clinicId['id']; ?>' <?php if($_POST['clinicStats_clinicId'] == $clinicId['id']) echo 'selected'; ?>><?php echo $clinicId['name']; ?></option>
						<?php endwhile; ?>
					</select>

					<select name='clinicStats_userId'>
						<?php while( ($userId = mysqli_fetch_assoc($userIds)) ): ?>
							<option value='<?php echo $userId['id']; ?>' <?php if($_POST['clinicStats_userId'] == $userId['id']) echo 'selected'; ?>><?php echo $userId['name']; ?></option>
						<?php endwhile; ?>
					</select>

					End date: <input type='date' name='clinicStats_startDate' value='<?php $_POST['clinicStats_startDate']?>'>
					End date: <input type='date' name='clinicStats_endDate' value='<?php $_POST['clinicStats_endDate']?>'>

					<br><br>
					<input type='submit'>
				</form>

				<br/><br/>

				<h2>These parameters yield <?php // Print results here ?> patients so far!</h2>
			</div>

			<br/><br/><br/>

			<?php include 'include/footer.php' ?>
		</div>
	</body>
</html>
