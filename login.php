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
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Login">
		<link rel="stylesheet" href="include/mystyle.css" type="text/css">
		<title>Dagger Login</title>
	</head>

	<body>
		<div class='container' >

			<div style="height:30px;" >&nbsp;</div>

			<div style="border:1px solid #999;background-color:lightyellow;padding:10px;text-align:center;height:30px;margin-bottom:100px;">
				Access to and use of this website is restricted to authorized users only.
			</div>
			<!-- Login Form -->
			<div class='login-form' style="height:300px;">
				<form method="post" autocomplete="off" >
					<h2>Dagger Login</h2>

					<label>Username <input type="text" name="username" autofocus required /></label>
					<br/><br/>

					<label>Password <input type="password" name="password" required /></label>
					<br/><br/>

					<input type="submit" class="submit" value="Login" name="submit" />
				</form>
			</div>

			<!-- Error Message -->
			<div class='login-error'>
				<?php if (isset($response)) echo "<br><h3>" . $response. "</h3>"; ?>
			</div>

			<!-- Show Footer -->
			<?php include 'modules/main/footer.php'; ?>
		</div>
	</body>
</html>
