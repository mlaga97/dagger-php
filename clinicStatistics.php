<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious($_SESSION['admin'] == 1, '/clinicStatistics.php');

	// TODO: Move elsewhere
	function validateDate($date) {
		$d = DateTime::createFromFormat('Y-m-d', $date);
		return $d && $d->format('Y-m-d') === $date;
	}
?>

<!-- HTML start -->
<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
<html>
	<head>
		<title>Clinic Stats</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<meta name='description' content='Clinic Statistics'>
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
					// We can go ahead and get the user and clinic list with
					// no real processing logic.
					$userIds = $mysqli->query('SELECT id,name from users where id in (select user_id from groups where clinic_id in(select clinic_id from groups where user_id = ' . $_SESSION['user_id'] . '));');
					$clinicIds = $mysqli->query('SELECT id,name from clinic where id in (select clinic_id from groups where user_id = ' . $_SESSION['user_id'] . ');');

					// We start with the most general request, which is to find
					// the number of patients for the clinic group associated
					// with the user that is logged in.
					$results_query = 'SELECT COUNT(id) AS clients FROM response WHERE clinic_id IN (select clinic_id from groups where user_id = ' . $_SESSION['user_id'] . ') ';

					// Then, for each possible form value, we narrow the search
					// down according to those criteria (if applicable).
					if(array_key_exists('clinicStats_startDate', $_POST) && validateDate($_POST['clinicStats_startDate'])) {
						$results_query = $results_query . ' AND date > "' . $_POST['clinicStats_startDate']. '"';
					}
					if(array_key_exists('clinicStats_endDate', $_POST) && validateDate($_POST['clinicStats_endDate'])) {
						$results_query = $results_query . ' AND date < "' . $_POST['clinicStats_endDate']. '"';
					}
					if(array_key_exists('clinicStats_clinicId', $_POST)) {
						$results_query = $results_query;
					}
					if(array_key_exists('clinicStats_userId', $_POST)) {
						$results_query = $results_query;
					}

					// Once we have narrowed down as far as possible, we make
					// the query to the database, fetch the first row, then
					// check the value of 'clients', as this will be our result
					$results = $mysqli->query($results_query);
					$result_array = mysqli_fetch_assoc($results);
					$result = $result_array['clients'];
				?>

				<form action='clinicStatistics.php' method="post">

					<!-- Take the clinic list and generate a selection box with them, using the last value if possible. -->
					Clinic: <select name='clinicStats_clinicId'>
						<option <?php if(!array_key_exists('clinicStats_clinicId', $_POST)) echo 'selected'; ?>></option>
						<?php while( ($clinicId = mysqli_fetch_assoc($clinicIds)) ): ?>
							<option value='<?php echo $clinicId['id']; ?>' <?php if($_POST['clinicStats_clinicId'] == $clinicId['id']) echo 'selected'; ?>><?php echo $clinicId['name']; ?></option>
						<?php endwhile; ?>
					</select>

					<br/><br/>

					<!-- Take the user list and generate a selection box with them, using the last value if possible. -->
					Employee: <select name='clinicStats_userId'>
						<option <?php if(!array_key_exists('clinicStats_userId', $_POST)) echo 'selected'; ?>></option>
						<?php while( ($userId = mysqli_fetch_assoc($userIds)) ): ?>
							<option value='<?php echo $userId['id']; ?>' <?php if($_POST['clinicStats_userId'] == $userId['id']) echo 'selected'; ?>><?php echo $userId['name']; ?></option>
						<?php endwhile; ?>
					</select>

					<br/><br/>

					<!-- Switched to HTML5 date input type, in order to standardize and reduce dependencies. Try to use last value, if possible. -->
					Start date: <input type='date' name='clinicStats_startDate' value='<?php echo $_POST['clinicStats_startDate']?>'>
					End date: <input type='date' name='clinicStats_endDate' value='<?php echo $_POST['clinicStats_endDate']?>'>

					<br><br>
					<input type='submit'>
				</form>

				<br/><br/>

				<h2>These parameters yield <?php echo $result ?> patients so far!</h2>
			</div>

			<br/><br/><br/>

			<?php include 'include/footer.php' ?>
		</div>
	</body>
</html>
