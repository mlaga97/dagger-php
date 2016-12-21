<?php
	$noRedirect = true;
	require_once 'include/dagger.php';
	session_unset();

	// Checking to see if the username and password were entered correctly.
	if ($_POST && !empty($_POST['username']) && !empty($_POST['password'])) {
	    $response = login($_POST['username'], $_POST['password']);
	}

	// Here we set our session previous variable. This variable is used to allow user access to the next web-page.
	allowPrevious(true, '/login.php');
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Login">
		<link rel="stylesheet" href="include/mystyle.css" type="text/css">
		<title>Login Page</title>
	</head>

	<body>
		<!-- Show the date and time. -->
		<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today); ?><br>

		<br/>

		<!-- Show Shuffled Logo Array -->
		<table style="width: 400;">
			<?php

				$logo_array = array (
						'<a href="https://www.usm.edu/social-work"><img src="/include/images/usm.png" style="border:solid; border-color:black;" width="100" height="100" alt="University of Southern Mississippi, School of Social Work"></a>',
						'<a href="https://www.southalabama.edu/gcbhrc/"><img src="/include/images/usa.png" style="border:solid; border-color:black;" width="100" height="100" alt="University of Southern Alabama,     School of Social Work"></a>',
						'<a href="https://uwf.edu/socialwork/"><img src="/include/images/uwf.png" style="border:solid; border-color:black;" width="100" height="100" alt="University of West Florida,         School of Social Work"></a>' 
				);

				// Shuffle our logo array to allow random logo placement upon page refresh.
				shuffle($logo_array);
				foreach($logo_array as $string) {
					echo "<td> $string </td>";
				}

			?>
		</table>

		<br/><br/><br/>

		<!-- Login Form -->
		<form method="post">
			<h2>Login<br><small>Enter your credentials</small></h2>

			<label>Username: <input type="text" autofocus="autofocus" name="username" /></label>
			<br/><br/>

			<label>Password: <input type="password" autofocus="autofocus" name="password" /></label>
			<br/><br/>

			<input type="submit" id="submit" value="Login" name="submit" />
		</form>

		<!-- Error Message -->
		<?php if (isset($response)) echo "<br><hf class='alert'>" . $response. "</hf>"; ?>

		<!-- Show Footer -->
		<?php include 'modules/main/footer.php'; ?>
	</body>
</html>
