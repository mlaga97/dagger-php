<?php
	session_start();

	// A necessary function for translating our post variables into session variables. 
	foreach ($_POST as $key => $value) {
	    $_SESSION[$key] = $value;
	}

	// These are page security parameters. We will not let the user in unless they meet all these conditions. 
	if ($_SESSION['status'] != 'authorized' ||
	        $_SESSION['previous'] != '/assessment.php') {
	    header("location: /index.php");
	    die("Authentication required, redirecting");
	}

	$_SESSION['previous'] = '/assessment_time.php';

	$modules = array_diff(scandir('modules/postassessment'), array('..', '.'));
?>

<html>
	<head>
		<title>Time Spent</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Adult Assessment">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
		<script type="text/javascript">
			//clear the validation form.
			function clearForm() {
				document.getElementById("form").reset();
			}

			function formSubmit() {
				var form = document.getElementById("form")
				var assessment_time_input = document.getElementById("assessment_time");

				// Need to check to make sure they entered a time.
				if ((assessment_time_input.value === '') || (isNaN(assessment_time_input.value)) ){
					alert("Please enter the time you spent associated with this assessment.");
					return false;
				}
				form.submit();
			} 
		</script>
	</head>

	<body onload="clearForm()">
		<div id="top">
			<div id="logo">
				<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
			</div><!-- div logo end -->
		</div><!--close div top -->    

		<?php

			// Show Modules
			// TODO: assessment_type and mysqli
			foreach($modules as $module) {
				include 'modules/postassessment/' . $module;
				echo '<br/>';
			}

		?>

		<form id="form" name="form1" action="/submit.php" method="post">
			<center><h1>Time spent with the client.</h1></center>
			<p><strong>Please record the time, in minutes, you spent associated with this assessment: </strong>
			<input type="text" autofocus="autofocus" name="assessment_time" id="assessment_time"> 
			</p>                                
		</form>

		<center>
			<input id="submit"  type="submit" onclick="formSubmit();" value="Submit" >
			<input id="reset_button" type="reset" onclick="clearForm()" value="Reset" />
		</center>

		<br/><br/><br/>

		<?php include 'include/footer.php' ?>
	</body>
</html>