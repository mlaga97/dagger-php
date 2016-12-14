<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/home.php');

	postToSession(array('status', 'previous'));

	$log->info("OPTIONS LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ".  print_r($_SESSION, true));
?>

<html>
    <head>
        <title>
            Welcome
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Brief Adult Assessment">
        <link rel="stylesheet" href="/include/mystyle.css" type="text/css">
    </head>
    <body onload="clearForm();">
		<?php include 'include/menu.php'; ?>
		<?php echo $_SESSION['logo']; ?>

        <div class="welcome-message" align="center">
            <h1>Welcome</h1>
            <p>Please make your selection from the menu at the top of the page.</p>
        </div>

        <br/><br/><br/>

		<?php include 'include/footer.php'; ?>
	</body>
</html>
