<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious($_SESSION['admin'] == 1, '/moduleList.php');
	$pageTitle = "Module List";
?>

<html>
	<head>
		<title>Module List</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<meta name='description' content='Module List'>
		<link rel='stylesheet' href='/include/dagger.css' type='text/css'>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>
	<body>
		<div class='container'>

			<!-- Menu -->
			<?php showMenu(); ?>

			<!-- Header -->
			<?php include 'modules/main/header.php'; ?>

			<!-- Body -->
			<div>
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
											$path = '/var/www/html/modules/' . $module . '/' . $directory . '/' . $file;
											echo $directory . '/' . $file . ' (' . substr(md5_file($path), 0, 5) . ')<br/>';
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

									foreach(moduleListPaths($key) as $path) {
										$explodedPath = explode('/', $path);
										echo $explodedPath[5] . '/' . $explodedPath[7] . ' (' . substr(md5_file($path), 0, 5) . ')<br/>';
									}
								}
							?>
						</td>
					</tr>
				</table>
			</div>

			<br/><br/><br/>

			<!-- Footer -->
			<?php include 'modules/main/footer.php' ?>

		</div>
	</body>
</html>
