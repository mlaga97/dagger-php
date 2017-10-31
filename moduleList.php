<?php
	include 'include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious($_SESSION['admin'] == 1, '/moduleList.php');
	$pageTitle = "Module List";
?>

<!DOCTYPE html>
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
								$providerList = daggerAPI('/api/v1/module/provider/list');
								foreach($providerList['response'] as $moduleName) {
									$moduleData = daggerAPI('/api/v1/module/provider/' . $moduleName, array("debug" => 1, "trace" => 1));
									echo '<br/><br/><h4>' . $moduleName . '</h4>';
									foreach($moduleData['response']['files'] as $directory => $files) {
										foreach($files as $file => $hash) {
											echo $directory . '/' . $file . ' (' . $hash . ')<br/>';
										}
									}
								}
							?>
						</td>
						<td>
							<h2>Files by Key</h2>
							<?php
								// TODO: Show file hash again
								$keyList = daggerAPI('/api/v1/module/key/list');
								foreach($keyList['response'] as $keyName) {
									// TODO: Get truncated paths [module]/[file]
									$keyProviders = daggerAPI('/api/v1/module/key/' . $keyName . '/truncatedPaths');

									echo '<br/><br/><h4>' . $keyName . '</h4>';
									foreach($keyProviders['response'] as $index=>$path) {
										echo $path . "<br/>";
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
