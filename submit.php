<?php
session_start();

// A necessary function for translating our post variables into session variables. 
foreach($_POST as $key=>$value) 
{
$_SESSION[$key] = $value;
}
//print_r($_SESSION);
// These are page security parameters. We will not let the user in unless they meet all these conditions. 
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized')// || ($_SESSION['previous'] != 'assessment_time.php' && $_SESSION['previous'] != 'adult.php'))    
    {
	header("location: /index.php");
	   die("Authentication required, redirecting");
    }

// The following conditions change a variable from not existing to "" for later. 
if(!array_key_exists('eth', $_SESSION))
{
	$_SESSION['eth'] = "";
}

if(!array_key_exists('sex', $_SESSION))
{
	$_SESSION['sex'] = "";
}

if(!array_key_exists('m_status', $_SESSION))
{
	$_SESSION['m_status'] = "";
}

if(!array_key_exists('living', $_SESSION))
{
	$_SESSION['living'] = "";
}

if(!array_key_exists('ed', $_SESSION))
{
	$_SESSION['ed'] = "";
}

if(!array_key_exists('first_name', $_SESSION))
{
    $_SESSION['first_name'] = "";
}

if(!array_key_exists('last_name', $_SESSION))
{
    $_SESSION['last_name'] = "";
}

$_SESSION['previous'] = '/submit.php';


?>

<!-- HTML Start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>
		 Survey Submission Form
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Adult Assessment">
		<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
		

<script type="text/javascript">

	// Need to get the clinic_id into the javascript so it must be read here. 
	// I would love to have another way to do this since this exposes the value if you "view source" of the resultant webpage.
	var c_id = <?php echo $_SESSION['user_id'];?> ;

	//clear the validation form.	
	function clearForm(form)
	{
		form.reset();
	}

	// gets the values from the radio buttons	
	function findSelection(field) {
	    var sizes = document.getElementsByName(field);
	    for (i=0; i < sizes.length; i++) { //there can be only 1 input for radio buttons.
	    	if (sizes[i].checked==true) {     
	        	return sizes[i].value;
	        }
	    }
	}
	
	// This function reads the code that was entered, compares with the known clinic_id as read from $_SESSION, and either rejects the submission or submits to insert.php
	function formSubmit(form)
	{
		var n = findSelection("n1").toString(); //get the first number.
	    var temp =  findSelection("n2").toString();
		n = n + temp;
		temp =  findSelection("n3").toString();
		n = n + temp;
		temp =  findSelection("n4").toString();
		n = n + temp;	

		if (n.toString() == c_id.toString())
		{    
			form.submit();
		} 
		else
		{
			alert ("Incorrect code. Please try again.");
			return false;
		}	
	}		
</script>

	<!-- More HTML -->
	</head>
		<div id="container">
			<body onload="clearForm()">
				<div id="top">
					<div id="logo">
					<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
					</div><!-- div logo end -->
						<div id="header">
							<div id="title">
							<center><h1>Survey Submission Form</h1></center>
							</div><!-- div title end -->
                		</div><!-- close div header -->
            	</div><!--close div top -->
					<div id="clinic_id">
				<br><center><p>Please enter the clinic identification code and then submit.</p></center>
				<form id="form1" name="form1" action="/insert.php" method="post">
				<center><table id="clinic_id" border="1">

                     <tr><td class="n"><center></center></td>
						<td class="n"><center>0</center></td>
                        <td class="n"><center>1</center></td>
                        <td class="n"><center>2</center></td>
                        <td class="n"><center>3</center></td>
                        <td class="n"><center>4</center></td>
                        <td class="n"><center>5</center></td>
                        <td class="n"><center>6</center></td>
                        <td class="n"><center>7</center></td>
                        <td class="n"><center>8</center></td>
                        <td class="n"><center>9</center></td></tr>


                     <tr><td class="n"><center>Digit 1:</center></td>
						<td class="n"><center><input type="radio" name="n1"  value="0"/></center></td>
                        <td class="n"><center><input type="radio" name="n1"  value="1"/></center></td>
                        <td class="n"><center><input type="radio" name="n1"  value="2"/></center></td>
                        <td class="n"><center><input type="radio" name="n1"  value="3"/></center></td>
                        <td class="n"><center><input type="radio" name="n1"  value="4"/></center></td>
                        <td class="n"><center><input type="radio" name="n1"  value="5"/></center></td>
                        <td class="n"><center><input type="radio" name="n1"  value="6"/></center></td>
                        <td class="n"><center><input type="radio" name="n1"  value="7"/></center></td>
                        <td class="n"><center><input type="radio" name="n1"  value="8"/></center></td>
                        <td class="n"><center><input type="radio" name="n1"  value="9"/></center></td>

					<tr><td class="n"><center>Digit 2:</center></td>
						<td class="n"><center><input type="radio" name="n2"  value="0"/></center></td>
						<td class="n"><center><input type="radio" name="n2"  value="1"/></center></td>
						<td class="n"><center><input type="radio" name="n2"  value="2"/></center></td>
						<td class="n"><center><input type="radio" name="n2"  value="3"/></center></td>
						<td class="n"><center><input type="radio" name="n2"  value="4"/></center></td>
						<td class="n"><center><input type="radio" name="n2"  value="5"/></center></td>
						<td class="n"><center><input type="radio" name="n2"  value="6"/></center></td>
						<td class="n"><center><input type="radio" name="n2"  value="7"/></center></td>
						<td class="n"><center><input type="radio" name="n2"  value="8"/></center></td>
						<td class="n"><center><input type="radio" name="n2"  value="9"/></center></td>
 
                    <tr><td class="n"><center>Digit 3:</center></td>
						<td class="n"><center><input type="radio" name="n3"  value="0"/></center></td>
                        <td class="n"><center><input type="radio" name="n3"  value="1"/></center></td>
                        <td class="n"><center><input type="radio" name="n3"  value="2"/></center></td>
                        <td class="n"><center><input type="radio" name="n3"  value="3"/></center></td>
                        <td class="n"><center><input type="radio" name="n3"  value="4"/></center></td>
                        <td class="n"><center><input type="radio" name="n3"  value="5"/></center></td>
                        <td class="n"><center><input type="radio" name="n3"  value="6"/></center></td>
                        <td class="n"><center><input type="radio" name="n3"  value="7"/></center></td>
                        <td class="n"><center><input type="radio" name="n3"  value="8"/></center></td>
                        <td class="n"><center><input type="radio" name="n3"  value="9"/></center></td>

                    <tr><td class="n"><center>Digit 4:</center></td>
						<td class="n"><center><input type="radio" name="n4"  value="0"/></center></td>
                        <td class="n"><center><input type="radio" name="n4"  value="1"/></center></td>
                        <td class="n"><center><input type="radio" name="n4"  value="2"/></center></td>
                        <td class="n"><center><input type="radio" name="n4"  value="3"/></center></td>
                        <td class="n"><center><input type="radio" name="n4"  value="4"/></center></td>
                        <td class="n"><center><input type="radio" name="n4"  value="5"/></center></td>
                        <td class="n"><center><input type="radio" name="n4"  value="6"/></center></td>
                        <td class="n"><center><input type="radio" name="n4"  value="7"/></center></td>
                        <td class="n"><center><input type="radio" name="n4"  value="8"/></center></td>
                        <td class="n"><center><input type="radio" name="n4"  value="9"/></center></td>
				</table></center>
						</form>
			</div><!-- div clinic ID end -->
		</div><!-- div container end -->
		<br>
		<center>
		<input id="submit"  type="submit" onclick="formSubmit(form1);" value="Submit" >
		<input id="reset_button" type="reset" onclick="clearForm(form1)" value="Reset" />
		</center>
		<br>
		<br>
		<br>
	

		<?php include 'include/footer.php' ?>
	</body>
</html>
