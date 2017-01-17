<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/home.php');

	postToSession(array('status', 'previous'));

	$log->info("OPTIONS LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ".  print_r($_SESSION, true));
?>

<html>
	<head>
		<title>Welcome</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Dagger Home Page">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>

	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<div class='top'>
				<div class='logo'>
					<?php echo $_SESSION['logo']?>
				</div>
				<div class='header'>
					<div class='title'>
						<h1>Admin Settings</h1>
					</div>
					<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
				</div>
			</div>

			<br/><br/><br/>

			<!-- Body -->
			<div class='welcome-message'>
				<h1>Welcome</h1>
				<p>Please make your selection from the menu at the top of the page.</p>
			</div>

			<br/><br/><br/>

			<!-- Footer -->
			<?php include 'modules/main/footer.php' ?>

		</div>
	</body>
</html>