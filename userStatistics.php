<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/userStatistics.php');
	$pageTitle = "Search Clinic Records";

	// TODO: Move elsewhere
	function validateDate($date) {
		$d = DateTime::createFromFormat('Y-m-d', $date);
		return $d && $d->format('Y-m-d') === $date;
	}
?>

<html>
	<head>
		<title>Clinic Stats</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<meta name='description' content='Brief Adult Assessment'>
		<link rel='stylesheet' href='/include/dagger.css' type='text/css'>
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
				<?php
					// We start with the most general request, which is to find
					// the number of patients for the clinic group associated
					// with the user that is logged in.
					$results_query = 'SELECT COUNT(id) AS clients FROM response WHERE clinic_id IN (select clinic_id from groups where user_id = ' . $_SESSION['user_id'] . ') ';

					// Then, for each possible form value, we narrow the search
					// down according to those criteria (if applicable).
					if(array_key_exists('clinicStats_startDate', $_POST) && validateDate($_POST['clinicStats_startDate'])) {
						$results_query = $results_query . ' AND date > "' . $mysqli->real_escape_string($_POST['clinicStats_startDate']) . '"';
					}
					if(array_key_exists('clinicStats_endDate', $_POST) && validateDate($_POST['clinicStats_endDate'])) {
						$results_query = $results_query . ' AND date < "' . $mysqli->real_escape_string($_POST['clinicStats_endDate']) . '"';
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

			<!-- Footer -->
			<?php include 'modules/main/footer.php' ?>

		</div>
	</body>
</html>
