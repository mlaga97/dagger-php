<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/assessment.php', '/postassessment.php');
	$pageTitle = "Time On Assessment";

	postToSession();
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Time Spent</title>
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">

	</head>
	<body>
		<div class="container" >

			<br/><br/><br/>

			<!-- Header -->
			<?php include 'modules/main/header.php'; ?>

			<!-- Body -->
			<div>
				<?php moduleLoad('postassessment'); ?>
			</div>

			<!-- Form Options -->
			<div style="text-align:center;margin-bottom:238px;">
				<form id="form" name="form1" action="/reviewAssessment.php" method="post" autocomplete="off">
					<label>Time associated with this assessment</label>
					<input type="number" min="0" max="600" step="1" id="assessment_time" name="assessment_time"  required autofocus > <label>minutes</label>
					<br><br>
					<br><br>
					<input type="submit" value="Review Assessment">
				</form>
			</div>

			<!-- Footer -->
			<?php include 'modules/main/footer.php' ?>

		</div>
	</body>
</html>
