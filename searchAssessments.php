<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/searchAssessments.php');

	unset($_SESSION ['search_select']);
?>

<html>
	<head>
		<title>Search Assessments</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Search Response Data">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>

	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<div class='top'>
				<div class='logo'>
					<?php echo $_SESSION['logo']?>
				</div>
				<div class='header'>
					<div class='title'>
						<h1>Search Client Records</h1>
					</div>
				</div>
			</div>

			<!-- Body -->
			<?php moduleLoad('searchAssessments'); ?>

			<br/>

			<!-- Footer -->
			<?php include 'modules/main/footer.php' ?>

		</div>
	</body>
</html>
