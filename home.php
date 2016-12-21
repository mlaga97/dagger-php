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
		<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
    </head>
    <body onload="clearForm();">
		<?php showMenu(); ?>
		<?php echo $_SESSION['logo']; ?>

        <div class="welcome-message" align="center">
            <h1>Welcome</h1>
            <p>Please make your selection from the menu at the top of the page.</p>
        </div>

        <br/><br/><br/>

		<?php include 'modules/main/footer.php'; ?>
	</body>
</html>
