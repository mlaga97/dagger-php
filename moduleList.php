<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious($_SESSION['admin'] == 1, '/moduleList.php');
?>

<!-- HTML start -->
<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
<html>
	<head>
		<title>Module List</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<meta name='description' content='Module List'>
		<link rel='stylesheet' href='/include/mystyle.css' type='text/css'>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>
	<body>
		<?php showMenu(); ?>
		<div id='container'>
			<div id='top'>
				<div id='logo'>
					<?php echo $_SESSION['logo']?>
				</div>
				<div id='header'>
					<div id='title'>
						<center>
							<h1>Search Clinic Records</h1>
						</center>
					</div>
					<center>
						<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
					</center>
				</div>
			</div>

			<br/><br/><br/>

			<div style='text-align: center;'>
				<table style='width: 100%'>
					<tr>
						<td>
							<h2>Files by Module</h2>
							<?php
								foreach(moduleList() as $module) {
									echo '<br/><br/><h4>' . $module . '</h4>';

									foreach(moduleProvides($module) as $directory) {
										$directoryList[$directory] = true;

										$files = array_diff(scandir("modules/" . $module . '/' . $directory), array('..', '.'));

										foreach($files as $file) {
											echo $directory . '/' . $file . '<br/>';
										}
									}
								}
							?>
						</td>
						<td>
							<h2>Files by Key</h2>
							<?php
								foreach(moduleListKeys() as $key) {
									echo '<br/><br/><h4>' . $key . '</h4>';

									$files = array();
									foreach(moduleListProviders($key) as $provider) {
										$files = array_merge($files, array_diff(scandir($provider), array('..', '.')));
									}

									sort($files);

									$paths = array();
									foreach($files as $file) {
										$paths = array_merge($paths, array_diff(glob("modules/*/" . $key . '/' . $file), array('..', '.')));
									}

									foreach($paths as $path) {
										$explodedPath = explode('/', $path);
										echo $explodedPath[1] . '/' . $explodedPath[3] . '<br/>';
									}
								}
							?>
						</td>
					</tr>
				</table>
			</div>

			<br/><br/><br/>

			<?php include 'modules/main/footer.php' ?>
		</div>
	</body>
</html>