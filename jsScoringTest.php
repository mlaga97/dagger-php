<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/preassessment.php');
	$pageTitle = "JS Scoring Test";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Assessment Options</title>
		<link rel="stylesheet" href="/include/dagger.css" type="text/css">

		<script src="/lib/jquery/3.2.1/jquery.min.js"></script>
		<script src="/lib/lodash/4.17.4/lodash.min.js"></script>

		<script type="text/javascript" src="/include/scripts.js"></script>
	</head>
	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<?php include 'modules/main/header.php'; ?>

			<!-- Body -->
			<div class='jsScoringTarget'>
			</div>

			<!-- Footer -->
			<?php include 'modules/main/footer.php'; ?>

		</div>

		<script>
			$.ajax({ 
				dataType: 'json', 
				url: '/api/v1/response/5625', 
				data: {}, 
				success: scoreResponses 
			});

			function scoreResponses(rawResponse) {
				var response = rawResponse.response;

				$('.jsScoringTarget').append(renderDuke(scoreDuke(response)));
			}
		</script>

		<script src="/modules/duke/scoring.js"></script>
	</body>
</html>
