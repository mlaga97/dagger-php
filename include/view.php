<?php 
session_start();
?>
<script type="text/javascript">
	function clearForm()
	{	
		document.getElementById('form1').reset();
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>
			View Previous Assessment
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Adult Assessment">
		<link rel="stylesheet" href="mystyle.css" type="text/css">
	</head>
	<body onload="clearForm();">
		<div id="container">
			<div id="top">
				<div id="logo">
					<a href="https://www.usm.edu/social-work"><img src="images/swk.png" style="border:none;max-width:100%;" width="150" alt="University of Southern Mississippi, School of Social Work"></a>
				</div><!-- div logo end -->
				<div id="header">
					<div id="title">
						<center>
							<h1>View Previous Assessment</h1>
						</center>
						</div><!-- div title end -->
						<center>						
							<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
						</center>
					</div><!-- div header end -->
				</div><!-- end div top -->			
				<br>
				<br>
				<br>
				<h1><center>Search Information</h1>
					<form id="form1" action="search.php" method="post" >
				<div id="search">
					<table id="tblSearch">
						<tr><td class="search"><label for="name">Clinic ID:</label></td><td class="search"><input type="text" name="name"></td>
						<td class="search"><label for="phone">Patient ID:</label></td><td class="search"><input type="text" name="phone"></td></tr>
						<tr><td></td><td></td></tr>
					</table>
				</center>
				</div><!-- end div personal -->
			<input id="submit"  type="submit" value="Submit" >
			</form>	
		</body>
</html>	
			
		