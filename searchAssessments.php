<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/searchAssessments.php');
	$pageTitle = "Search Client Records";

	unset($_SESSION ['search_select']);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Search Assessments</title>
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">
		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>
	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<?php include 'modules/main/header.php'; ?>

			<!-- Body -->
			<div style='text-align: center;'>
				<?php moduleLoad('searchAssessments'); ?>
			</div>

			<!-- Footer -->
			<?php include 'modules/main/footer.php' ?>

		</div>
	</body>
</html>
