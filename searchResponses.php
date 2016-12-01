<?php
include 'include/dagger.php';
loggingInit();
allowPrevious(true, '/clientSearch.php');

unset ( $_SESSION ['search_select'] );
?>

<html>
	<head>
		<title>Options</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Search Response Data">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
	</head>

	<body>
		<?php include 'include/menu.php'; ?>
		<div id='container'>
			<div id='top'>
				<div id='logo'>
					<?php echo $_SESSION['logo']?>
				</div>
				<div id='header'>
					<div id='title'>
						<center>
							<h1>Search Client Records</h1>
						</center>
					</div>
					<center>
						<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
					</center>
				</div>
			</div>

			<?php

				// Show modules
				moduleLoad('clientSearch');

			?>

			<?php include 'include/footer.php' ?>
		</div>
	</body>
</html>
