<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/searchAssessments.php');

	unset($_SESSION ['search_select']);
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Search Assessments</title>
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>

	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<div class='top'>
				<div class='header'>
					<h1>Search Client Records</h1>
				</div>
			</div>

			<!-- Body -->
			<div id="dagger.module.searchAssessments" >
				<?php moduleLoad('searchAssessments'); ?>
			</div>


			<!-- Footer -->
			<?php include 'modules/main/footer.php' ?>

		</div>
	</body>
</html>
