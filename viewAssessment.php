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


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Patient Activity</title>
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>
	<body>
	<div class="container">

		<!-- Menu -->
		<?php showMenu(); ?>

		<div class="top">
				<center>
					<h1>Patient Record</h1>
				</center>
		</div>

		<div>
			<!-- Before moduleLoad('viewAssessment'); -->
				<?php
					// Show Modules
					moduleLoad('viewAssessment');
				?>
			<!-- After moduleLoad('viewAssessment'); -->
		</div>



		<div style="text-align:center;margin-top:50px;">
			<input type="submit" value="Assessment"
				onclick="window.location='/preassessment.php'" />
				<input type="submit"
				value="Search"
				onclick="window.location='/searchAssessments.php';" />
		</div>

		<?php include 'modules/main/footer.php'?>
	</div>
	</body>
</html>
