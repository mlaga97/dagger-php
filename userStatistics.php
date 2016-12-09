<?php
	include 'include/dagger.php';
	loggingInit();
	allowPrevious(true, '/userStatistics.php');

	$mysqli = dbOpen();

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

					// Once we have narrowed down as far as possible, we make
					// the query to the database, fetch the first row, then
					// check the value of 'clients', as this will be our result
					$results = $mysqli->query($results_query);
					$result_array = mysqli_fetch_assoc($results);
					$result = $result_array['clients'];
				?>

				<form action='userStatistics.php' method="post">
					<!-- Switched to HTML5 date input type, in order to standardize and reduce dependencies. Try to use last value, if possible. -->
					Start date: <input type='date' name='clinicStats_startDate' value='<?php echo $_POST['clinicStats_startDate']?>'>
					End date: <input type='date' name='clinicStats_endDate' value='<?php echo $_POST['clinicStats_endDate']?>'>

					<br><br>
					<input type='submit'>
				</form>

				<br/><br/>

				<h2>You've served <?php echo $result ?> patients during that time!</h2>
			</div>

			<br/><br/><br/>

			<?php include 'include/footer.php' ?>
		</div>
	</body>
</html>