<?php
session_start();
//print_r($_SESSION);

if ($_SESSION['status'] != 'authorized' ||  $_SESSION['previous'] != 'insert.php') // && if such and such session != whatever previous page is.
{
    header("location:../index.php");
    die("Authentication required, redirecting");
}
$_SESSION['previous'] = 'updateAssessment.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>
			Edit Personal Information
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Edit Personal Information">
		<link rel="stylesheet" href="mystyle.css" type="text/css">
	</head>

	<body><form id ="edit_form" action="update.php" method="post">
	<script type="text/javascript"> //This function checks to make sure that our zip and date are entered correctly.

	 function isValidZip(txt)
    {
    	var reg_zip = /^\d{5}$/;
    	return reg_zip.test(txt);
    }; 

	function isValidDate(txt) 
	{
        var reg_date = /^(?:0[1-9]|1[0-2])\/(?:0[1-9]|[1-2][0-9]|3[0-1])\/(?:19\d{2}|20\d{2})$/;
        return reg_date.test(txt);
    }; 


	function edit_form_submit() {

	 var date_input = document.getElementById("dob");
	 var zip_input =  document.getElementById("zip");
	 var pid_input =  document.getElementById('pid');
	 var confirmation_pid_input = document.getElementById("c_p_id");

	 if(pid_input.value == ''){
	 	alert("Please enter a valid patient ID.");
	 	return false;
	 }

	 if (pid_input.value != confirmation_pid_input.value){
	 	alert("Please patient ID inputs DO NOT match.\nPlease confirm the patient ID.");
	 	return false;
	 }

    if (isValidDate(date_input.value) && (isValidZip(zip_input.value))) {
        return true;
    }
    else if (!isValidDate(date_input.value)) {
        alert("Invalid date! Please enter a date in the format Month/Day/Year such as 07/19/1988.");
        return false;
    }
    else if (!isValidZip(zip_input.value)) {
    	alert("Invalid zip! Please enter your five digit zip code.");
    	return false;
    }
	};	

	</script>
		<div id="container">
			<div id="top">
				<div id="logo">
					<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
				</div><!-- div logo end -->
				<div id="header">
					<div id="title">
						<center>
							<h1>Edit Personal Information</h1>
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
			<h1><center>Personal Information</center></h1>
			<div id="personal">
				<table id="tblPersonal">
					<tr><td class="personal"><label for="first_name">First Name:</label></td><td class="personal"><input type="text" autofocus="autofocus" name="first_name" value="<?php echo($_SESSION['first_name']);?>"></td>
					<td class="personal"><label for="last_name">Last Name:</label></td><td class="personal"><input type="text" name="last_name" value="<?php echo($_SESSION['last_name']);?>"></td></tr>
					<td class="personal"><label for="p_id">Patient ID:</label></td><td class="personal"><input id="pid" type="text" name="pt_id" value="<?php echo($_SESSION['pt_id']);?>"></td></tr>
					<tr><td></td><td></td></tr>
					<tr><td></td><td>MM/DD/YYYY</tr>
						<tr><td class="personal"><label for="dob">Date of birth:</label></td><td class="personal"><input id="dob" type="text" name="dob" value="<?php echo($_SESSION['dob']);?>"></td>
						<td class="personal"><label for="zip">Zip:</label></td><td class="personal"><input id="zip" input type="text" name="zip" value="<?php echo($_SESSION['zip']);?>"></td></tr>		
				</table>
			</div><!-- end div personal -->
			<br>	
			<br>
			<h1><center>Demographic Data</center></h1><p><center>Complete applicable information.</center>
			<div id="demo_data">				
				<table id="demo">
					<tr><td>
						<table border="1" align="center" id="table_sex">
							<tr><th class="tdtopic" colspan="4">Gender</th></tr>
							<tr><td class="sf">Male</td><td class="demo_input"><center><input type="radio" name="sex"  value="male" <?php if(strcmp($_SESSION['sex'],'male') == 0) echo "checked=\"checked\""  ?>/></center></td>
							<td class="sf">Female</td><td class="demo_input"><center><input type="radio" name="sex"  value="female" <?php if(strcmp($_SESSION['sex'],'female') == 0) echo "checked=\"checked\""  ?>/></center></td></tr>
							<tr><td class="sf">Transgender</td><td class="demo_input"><center><input type="radio" name="sex"  value="transgender" <?php if(strcmp($_SESSION['sex'],'transgender') == 0) echo "checked=\"checked\""  ?>/></center></td>
							<td class="sf">Other</td><td class="demo_input"><center><input type="radio" name="sex"  value="other" <?php if(strcmp($_SESSION['sex'],'other') == 0) echo "checked=\"checked\""  ?>/></center></td></tr>
						</table><!-- close table sex -->
					</td>
					<td>
					<table border="1" align="center" id="table_marital">
						<tr><th class="tdtopic" colspan="4">Marital Status</th></tr>
						<tr><td class="ms">Single.</td><td class="demo_input"><center><input type="radio" name="m_status"  value="single" <?php if(strcmp($_SESSION['m_status'],'single') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="ms">Married.</td><td class="demo_input"><center><input type="radio" name="m_status"  value="married" <?php if(strcmp($_SESSION['m_status'],'married') == 0) echo "checked=\"checked\""?>/></center></td></tr>
						<tr><td class="ms">Divorced.</td><td class="demo_input"><center><input type="radio" name="m_status"  value="divorced" <?php if(strcmp($_SESSION['m_status'],'divorced') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="ms">Widow(ed).</td><td class="demo_input"><center><input type="radio" name="m_status"  value="widow(ed)" <?php if(strcmp($_SESSION['m_status'],'widow(ed)') == 0) echo "checked=\"checked\""?>/></center></td></tr>
					</table>
					</td></tr>
					<tr><td colspan="2">
					<table border="1" id="table_education">
						<tr><th class="tdtopic" colspan="4">Education</th></tr>
						<tr><td class="ed">Some high school.</td><td class="demo_input"><center><input type="radio" name="ed"  value="Some high school" <?php if(strcmp($_SESSION['ed'],'Some high school') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="ed">4-year degree.</td><td class="demo_input"><center><input type="radio" name="ed"  value="4-year degree" <?php if(strcmp($_SESSION['ed'],'4-year degree') == 0) echo "checked=\"checked\""?>/></center></td></tr>
						<tr><td class="ed">High school diploma.</td><td class="demo_input"><center><input type="radio" name="ed"  value="High school diploma" <?php if(strcmp($_SESSION['ed'],'High school diploma') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="ed">More than 4 years college.</td><td class="demo_input"><center><input type="radio" name="ed"  value="More than 4 years college" <?php if(strcmp($_SESSION['ed'],'More than 4 years college') == 0) echo "checked=\"checked\""?>/></center></td></tr>
						<tr><td class="ed">2-year degree.</td><td class="demo_input"><center><input type="radio" name="ed"  value="2-year degree" <?php if(strcmp($_SESSION['ed'],'2-year degree') == 0) echo "checked=\"checked\""?>/></center></td><td class="ed" border="0"></td></tr>
					</table>			
					</td></tr>

					<tr><td colspan="2">
					<table border="1" id="table_ethnicity">
						<tr><th class="tdtopic" colspan="6">Ethnicity</th></tr>
						<tr><td class="eth">White/Caucasian.</td><td class="demo_input"><center><input type="radio" name="eth"  value="White/Caucasian" <?php if(strcmp($_SESSION['eth'],'White/Caucasian') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="eth">Native Hawaiian/Pacific Islander.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Native Hawaiian/Pacific Islander" <?php if(strcmp($_SESSION['eth'],'Native Hawaiian/Pacific Islander') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="eth">Black/African-American.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Black/African-American" <?php if(strcmp($_SESSION['eth'],'Black/African-American') == 0) echo "checked=\"checked\""?>/></center></td></tr>
						<tr><td class="eth">Hispanic/Latino.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Hispanic/Latino" <?php if(strcmp($_SESSION['eth'],'Hispanic/Latino') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="eth">Middle Eastern.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Middle Eastern" <?php if(strcmp($_SESSION['eth'],'Middle Eastern') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="eth">American Indian.</td><td class="demo_input"><center><input type="radio" name="eth"  value="American Indian" <?php if(strcmp($_SESSION['eth'],'American Indian') == 0) echo "checked=\"checked\""?>/></center></td></tr>
						<tr><td class="eth">Asian.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Asian" <?php if(strcmp($_SESSION['eth'],'Asian') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="eth">Vietnamese.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Vietnamese" <?php if(strcmp($_SESSION['eth'],'Vietnamese') == 0) echo "checked=\"checked\""?>/></center></td>
							<td>Other.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Other" <?php if(strcmp($_SESSION['eth'],'Other') == 0) echo "checked=\"checked\""?>/></center></td></tr>
					</table>			
					</td></tr>
					<tr><td colspan="2">
					<table border="1" id="table_living">
						<tr><th class="tdtopic" colspan="6">Living Arrangements</th></tr>
						<tr><td class="liv">Alone.</td><td class="demo_input"><center><input type="radio" name="living"  value="Alone" <?php if(strcmp($_SESSION['living'],'Alone') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="liv">With Family/Relatives.</td><td class="demo_input"><center><input type="radio" name="living"  value="With Family/Relatives" <?php if(strcmp($_SESSION['living'],'With Family/Relatives') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="liv">With Friends.</td><td class="demo_input"><center><input type="radio" name="living"  value="With Friends" <?php if(strcmp($_SESSION['living'],'With Friends') == 0) echo "checked=\"checked\""?>/></center></td></tr>
					</table>			
					</td></tr>
					</table><!-- end table demo -->
					<tr><td colspan="2">
					<table border="1" id="table_program">
						<tr><th class="tdtopic" colspan="6">Programs</th></tr>
						<tr><td class="pro">Homeless</td><td class="demo_input"><center><input type="checkbox" name="homeless"  value="1" <?php if(strcmp($_SESSION['homeless'],'1') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="pro">Chronic Care</td><td class="demo_input"><center><input type="checkbox" name="chronic_care"  value="1" <?php if(strcmp($_SESSION['chronic_care'],'1') == 0) echo "checked=\"checked\""?>/></center></td>
						</tr><tr><th class="tdtopic" colspan="6">Clinic Care</th></tr>
							<td class="pro">Brief</td><td class="demo_input"><center><input type="radio" name="clinic_care"  value="1" <?php if(strcmp($_SESSION['clinic_care'],'1') == 0) echo "checked=\"checked\""?>/></center></td>
							<td class="pro">Ongoing</td><td class="demo_input"><center><input type="radio" name="clinic_care"  value="2" <?php if(strcmp($_SESSION['clinic_care'],'2') == 0) echo "checked=\"checked\""?>/></center></td>
						</tr>
					</table>			
					</td></tr>
					</table><!-- end table demo -->

			</div><!-- close div demo_data -->
			
			<div class="page-break"></div><!--force page break here. good for 8.5X11 pages -->
			
		<h1><center>Information Confirmation</h1>
		<p>Please confirm the patient ID below. This input must match the patient ID entered in the personal information section above.</p></center>
			<div id="confirmation">
				<table id="tblConfirmation">
					<tr>
					<td class="personal"><label for="c_p_id">Patient ID:</label></td><td class="personal"><input type="text" name="c_p_id" id="c_p_id"></td></tr>
					<tr><td></td><td></td></tr>
				</table>
			</div><!-- end div  -->									
		<br>
		<p id="error_notice">There were errors on the form, please make sure all fields are fill out correctly.</p>
		<br>
		<br>
		<center>
		<input id="submit" type="submit" onclick="return edit_form_submit();" value="Submit" />
		<input id="reset_button" type="reset" value="Reset" />
		</center>
		<br>
		<br>
	</div><!-- div container end -->
		</form>
		<footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
		<center><a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"><img src="images/GRHOP.png" style="border:solid; border-color:black;" width="100" height="100" alt="G.R.H.O.P"></a></center>
		</body>
		</html>
	</body>
</html>