<?php
session_start();

require_once('log4php/Logger.php');
Logger::configure('log4php/config.xml');
$log = Logger::getLogger('myLogger');
date_default_timezone_set('America/Chicago');$today = date('m-d-y h:i:s');

//print_r($_SESSION);

if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized'   ||
	$_SESSION['previous'] != 'edit.php' ||
	!array_key_exists('n1', $_SESSION)    ||
    !array_key_exists('n2', $_SESSION)    ||
    !array_key_exists('n3', $_SESSION)    ||
    !array_key_exists('n4', $_SESSION)    )
	{
		header("location:../index.php");
		die("Authentication required, redirecting");
	}

$_SESSION['previous'] = 'update.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>
			Assessment Evaluation
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Update Personal Information">
		<link rel="stylesheet" href="mystyle.css" type="text/css">
	</head>
	<body onload="clearForm();">
		<div id="container">
			<div id="top">
				<div id="logo">
					<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
				</div><!-- div logo end -->
				<div id="header">
					<div id="title">
						<center>
							<h1>Update Personal Information</h1>
						</center>
						</div><!-- div title end -->
						<center>						
							<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
						</center>
					</div><!-- div header end -->
				</div><!-- end div top -->	

				<script type="text/javascript"> //Our function to print the webpage. 
				function printpage()
				{
					window.print();
				}
				</script>	
				<br>
				<br>
				<br>	
				<br>	
                                <br>
                                <br>
                                <br>
<?php

	require_once'constants.php';
	$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

	if(strcmp($_POST['chronic_care'], 1) == 0)
		$cc = 1;
	else
		$cc = 0;

	if(strcmp($_POST['homeless'], 1) == 0)
		$h = 1;
	else
		$h = 0;

	if(strcmp($_POST['clinic_care'], 1) == 0 || strcmp($_POST['clinic_care'], 2) == 0){
		$cl_care = $_POST['clinic_care'];
	} else
		$cl_care = 0;
	
	$query = 'update response set first_name= "'. hash('sha256', $_POST['first_name']) .'", last_name= "'.hash('sha256', $_POST['last_name']).'", pt_id = "'.hash('sha256', $_POST['pt_id']) .'", dob = "'.$_POST['dob'].'", zip = "'.$_POST['zip'].'", sex = "'.$_POST['sex'].'", m_status = "'.$_POST['m_status'].'", ed = "'.$_POST['ed'].'", eth = "'.$_POST['eth'].'", living = "'.$_POST['living'].'", homeless = '.$h.', chronic_care = '.$cc.', clinic_care = '.$cl_care.' where id = ' .$_SESSION['insert_id'] .'';

        
	$result = $mysqli->query($query);
	//$insert_id = $mysqli->insert_id;
	$log->info("UPDATE LOG: " . $today ." response.id: " .$insert_id. " ". $_SESSION['user_id'] ." ". $query);
        
	if($result){
		echo "<p>The patient information was successfully updated.</p>";
	} else {
		echo "<p>The patient information was NOT updated.</p>";
	}
	//print_r($_SESSION);
	//echo $query;

	//unset($_SESSION);
	
?>
</center>
<center><input type="button" value="Return to Start" style= "height: 25px; width: 100px" onclick="window.location='../index.php';" />
	<input type="button" style= "height: 25px; width: 100px" value="Print this page" onclick="printpage()" /></center>
<footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
<center><a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"><img src="images/GRHOP.png" style="border:none;max-width:100%;" width="100" alt="G.R.H.O.P"></a></center>
</div>	
</body>
</html>

</html>
