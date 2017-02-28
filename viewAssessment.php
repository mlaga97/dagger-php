<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/searchAssessments.php', '/viewAssessment.php');

	postToSession(array('status', 'previous'));

	foreach ( $_POST as $key => $value ) {
		$_SESSION [$key] = $value;
	}

	if (! isset ( $_SESSION ['search_select'] )) {
		header ( "location: /searchdata.php" );
		die ( "Authentication required, redirecting" );
	}


	$id_search = $_SESSION ['search_select'];
	$query_search_results = $mysqli->query("SELECT * FROM response WHERE id = " . $mysqli->real_escape_string($id_search) );
	$copy = $query_search_results->fetch_assoc ();

	foreach ( $copy as $key => $value ) {
		if($value == '-1' && !multiPregMatch(getConfigKey("edu.usm.dagger.main.viewAssessment.dontSet_-1_to_0"), $key)) {
			$copy[$key] = 0;
		}

		// Copy to Session
		$_SESSION[$key] = $copy[$key];
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>Past Result Data Sheet</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Past Result Data Sheet">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>
	<body onload="clearForm();">
	<div class="container">
		<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
		<center><h1>Assessment Evaluation</h1></center>
		<center><?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today); ?></center>

		<script type="text/javascript"> //Our function to print the webpage. 
			function printpage() {
				window.print();
			}
		</script>

		<center>
			<?php

				// Show Modules
				moduleLoad('viewAssessment');

			?>
		</center>

		<br/><br/>

		<p style="color: red; text-align: center">
			<b>Warning: once you click these links, you will not be able to return.</b>
		</p>

		<center>
			<input type="submit" value="Assessment"
				style="height: 25px; width: 100px"
				onclick="window.location='/preassessment.php'" /> <input type="submit"
				value="Search" style="height: 25px; width: 100px"
				onclick="window.location='/searchAssessments.php';" /> <input type="button"
				style="height: 25px; width: 100px" value="Print this page"
				onclick="printpage()" />
		</center>

		<?php include 'modules/main/footer.php'?>
	</div> <!-- Close DIV Class 'container' -->
	</body>
</html>