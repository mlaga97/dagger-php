<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/assessment.php', '/postassessment.php');

	postToSession();
?><!DOCTYPE html>
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
	<div class="container">
		<div class="top">
			<div class="logo">
				<?php echo $_SESSION['logo'] ?>
			</div>
		</div>

		<?php

			// Show Modules
			moduleLoad('postassessment');

		?>

		<form id="form" name="form1" action="/reviewAssessment.php" method="post">
			<center><h1>Time spent with the client.</h1></center>
			<p><strong>Please record the time, in minutes, you spent associated with this assessment: </strong>
			<input type="text" autofocus="autofocus" name="assessment_time" id="assessment_time">
			</p>
		</form>

		<center>
			<input class="submit"  type="submit" onclick="formSubmit();" value="Review Assessment" >
			<input class="reset_button" type="reset" onclick="clearForm()" value="Reset" />
		</center>

		<br/><br/><br/>

		<?php include 'modules/main/footer.php' ?>
	</div>	<!-- Close DIV Class 'container' -->
	</body>
</html>
