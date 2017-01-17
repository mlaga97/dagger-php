<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious('/reviewAssessment.php', '/updateAssessment.php');

	postToSession(array('status', 'previous'));
?>

<html>
	<head>
		<title>Brief <?php print_r($_SESSION['assessment_type']); ?> Assessment</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Assessment">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>

	<body>
		<?php echo $_SESSION['logo'] ?>
		<div style="text-align: center;">
			<h1>Edit Personal Information</h1>
		</div>

		<br/><br/><br/>

		<form class='assessment_form' action='/reviewAssessment.php' method='post'>
			<?php

				// Show Modules
				moduleLoad('updateAssessment');

			?>
		</form>
	</body>

	<body>
		<div class='container'>

			<!-- Header -->
			<div class='top'>
				<div class='logo'>
					<?php echo $_SESSION['logo']?>
				</div>
				<div class='header'>
					<div class='title'>
						<h1>Edit Personal Information</h1>
					</div>
				</div>
			</div>

			<br/><br/><br/>

			<!-- Body -->
			<form id='assessment_form' action='/reviewAssessment.php' method='post'>
				<?php moduleLoad('adminSettings'); ?>
			</form>

		</div>
	</body>
</html>