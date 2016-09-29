<?php 
session_start();

require_once('include/log4php/Logger.php');
Logger::configure('include/log4php/config.xml');
$log = Logger::getLogger('myLogger');
date_default_timezone_set('America/Chicago');$today = date('m-d-y h:i:s');
$log->info("CLINIC LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));

foreach($_POST as $key=>$value) 
{
	if (($key != 'status') && ($key != 'previous'))
	{
		$_SESSION[$key] = $value;
	}
}
// Redirect submission from clinic.php to contact.php if $_SESSION['assessment_type'] != 'face to face'

//We're now not using the contact system. The contact_type will be stored in the database in table response.
if (isset($_SESSION['contact_type']) && ($_SESSION['contact_type'] != "face to face")){
//    header("location:contact.php");
//    die("Redirecting"); 
}

if (!isset($_SESSION['status']) || ($_SESSION['status']   != 'authorized' || // && if such and such session != whatever previous page is. 
    $_SESSION['previous'] != '/preassessment.php' ||
    $_SESSION['clinic_id'] < 1    || !isset($_SESSION['assessment_type'])))//added the isset test. I found you could move 
									//to this page from adult without the assessment_type set.
    {
	header("location: /index.php");
	die("Authentication required, redirecting");
    }

foreach($_SESSION as $key=>$value)
{

	if(($key != 'id')           && ($key != 'uname')      && ($key != 'pswd')       && ($key != 'university_id') && ($key != 'clinic_id')    && ($key != 'status')       && 
	   ($key != 'logo')         && ($key != 'user_id')    && ($key != 'first_name') && ($key != 'last_name')     && ($key != 'stress_check') && ($key != 'health_check') && 
	   ($key != 'events_check') && ($key != 'gad_check')  && ($key != 'pcl_check')  && ($key != 'audit_check')   && ($key != 'cage_check')   && ($key != 'cd_check')     && 
	   ($key != 'phq_check')    && ($key != 'ces_check')  && ($key != 'GRHOP_standard') && ($key != 'assessment_type') && ($key != 'psc_check') 
	&& ($key != 'dast_check')   && ($key != 'duke_check') && ($key != 'symptom_check') && ($key != 'previous') && ($key != 'admin') 
         &&($key != 'self_check')   && ($key != 'sdq_check')  &&($key != 'crafft_check')&&($key != 'life_check')&&($key != 'gad2_check') 
         && ($key != 'pcl2_check')  && ($key != 'diagnosis_check')&& ($key != 'diag_me_check') && ($key != 'grouping') && ($key!='visit_type')&& 
                ($key!='adhd_check')&&($key!='contact_type') && ($key != 'c_stress_check')&& ($key != 'pp_check') && ($key!='hypertension_check')
			&& ($key!='pediatric_check'))
	{
		$_SESSION[$key] = -1;

			if($key == 'sex')
			{
		 		$_SESSION['sex'] = "";
			}

			if($key == 'eth')
			{
		  		$_SESSION['eth'] = "";
			}
		
			if($key == 'living')
			{
		  		$_SESSION['living'] = "";
			}

	}
}

$_SESSION['previous'] = '/adult.php';
//    print_r($_SESSION);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>
            Brief <?php print_r($_SESSION['assessment_type']) ?> Assessment
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Brief Assessment">
        <link rel="stylesheet" href="/include/mystyle.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="/include/src/datepickr.min.css">
        
<style>
.calendar-icon {
display: inline-block;
vertical-align: middle;
width: 32px;
height: 32px;
background: url(images/calendar.png);
}

</style>        
    </head>

    <body>     
        <form id ="adult_form" action="/assessment_time.php" method="post">
            
<script type="text/javascript"> //This function checks to make sure that our zip and date are entered correctly.
function isValidZip(txt){
    	var reg_zip = /^\d{5}$/;
    	return reg_zip.test(txt);
    }; 
function isValidDate(txt) {
        var reg_date = /(?:0[1-9]|1[0-2])\/(?:0[1-9]|[1-2][0-9]|3[0-1])\/(?:19\d{2}|20\d{2})/; //MM-DD-YYYY
        var reg1_date = /(?:19\d{2}|20\d{2})\-(?:0[1-9]|1[0-2])\-(?:0[1-9]|[1-2][0-9]|3[0-1])/; //YYYY-MM-DD
        return ((reg_date.test(txt)) || (reg1_date.test(txt)));
    }; 

function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

function adult_form_submit() {
    
    // Begin demographic variables.
    //var group = 0; 
    <?php  echo "var group = $_SESSION[grouping];\n"; ?> 
            //group 10 doesn't see the demo info therefore we need to skip the checks for data being entered.
            
    var date_input = document.getElementById("dob");
    var zip_input =  document.getElementById("zip");
    var pid_input =  document.getElementById('pid');
    var confirmation_pid_input = document.getElementById("c_p_id");
    
    // Start outside visits variables
    var hospital_date_input = document.getElementById("hospital_visit_date");
    var er_date_input = document.getElementById("er_visit_date");
    var office_date_input = document.getElementById("office_visit_date");
    var q1_rads =document.getElementsByName("q1");
    var q2_rads =document.getElementsByName("q2");
    var q3_rads =document.getElementsByName("q3");
    var h_visit_reason_select =document.getElementById("hospital_visit_reason");
    var er_visit_reason_select =document.getElementById("er_visit_reason");
    var o_visit_reason_select =document.getElementById("office_visit_reason");  
    var h_visit_reason_other =document.getElementById("hospital_visit_other");
    var er_visit_reason_other =document.getElementById("er_visit_other");
    var o_visit_reason_other =document.getElementById("office_visit_other");
    
    // Strart chronic health variables.
    var a1c =     document.getElementById("valueA1C");
    var eAG =     document.getElementById("valueEAG");
    var ldl =     document.getElementById("valueLDL");
    var hdl =     document.getElementById("valueHDL");
    var dia =     document.getElementById("valueDIA");
    var sys =     document.getElementById("valueSYS");
    var height =  document.getElementById("valueHeight");
    var weight =  document.getElementById("valueWeight");
    var a1cDate = document.getElementById("A1CDate");
    var eAGDate = document.getElementById("eAGDate");
    var cholDate = document.getElementById("cholestoralDate");
    var bpDate =  document.getElementById("bpDate");
    var phyDate = document.getElementById("physicalDate");
    var numEAG =  document.getElementById("valueEAG");
    numEAG = parseFloat(numEAG.value);
    var numSys=   document.getElementById("valueSYS");
    numSys = parseFloat(numSys.value);
    var numDia=   document.getElementById("valueDIA");
    numDia = parseFloat(numDia.value);
    var response;

    if ((group !== 10) && (group !== 6 )){
        if (q1_rads[0].checked === true) { //the patient has been to the hospital, check the date.
            if((hospital_date_input.value == '')||(!isValidDate(hospital_date_input.value) )){
                alert("Please enter a valid hospital discharge date.");
                return false;
            }
            if((h_visit_reason_select.value === "Other")&& (h_visit_reason_other.value === "")){ //make sure there is additional information in the text box.
                alert("Please type a reason for the hospital visit.");
                return false;
            }
        }
        if (q2_rads[0].checked === true) {
            if((er_date_input.value == '')||(!isValidDate(er_date_input.value) )){
                alert("Please enter a valid emergency room visit date.");
                return false;
            }
            if((er_visit_reason_select.value === "Other")&& (er_visit_reason_other.value === "")){ //make sure there is additional information in the text box.
                alert("Please type a reason for the emergency room visit.");
                return false;
           }
        }
        if (q3_rads[0].checked === true) {   
            if((office_date_input.value == '')||(!isValidDate(office_date_input.value) )){
                alert("Please enter a valid provider office visit date.");
                return false;
            }
            if((o_visit_reason_select.value === "Other")&& (o_visit_reason_other.value === "")){ //make sure there is additional information in the text box.
                alert("Please type a reason for the provider office visit.");
                return false;
           }
        }
        var leader = "All \"Outside Visits\" questions must have a yes/no selection.";
        // Check the outside visits inputs.
        if ((q1_rads[0].checked === false)&&(q1_rads[1].checked === false)){
            alert(leader.concat("\nPlease make a selection for question 1."));
            return false;
        }
        if ((q2_rads[0].checked === false)&&(q2_rads[1].checked === false)){
            alert(leader.concat( "\nPlease make a selection for question 2."));
            return false;
        }
        if ((q3_rads[0].checked === false)&&(q3_rads[1].checked === false)){
            alert(leader.concat( "\nPlease make a selection for question 3."));
            return false;
        }

        // Check the demographic inputs.      
        if (pid_input.value == ''){
            alert("Please enter a valid patient ID.");
            return false;
        }
        if (pid_input.value != confirmation_pid_input.value){
            alert("Please patient ID inputs DO NOT match.\nPlease confirm the patient ID.");
            return false;
        }
        if (!isValidDate(date_input.value)) {
            alert("Invalid date! Please enter a date of birth in the format Month/Day/Year such as 07/19/1988.");
            return false;
        }
        if (!isValidZip(zip_input.value)) {
            alert("Invalid zip! Please enter your five digit zip code.");
            return false;
        }   

        // Check the chronic health inputs.
        if (a1c.value=== ""){
            alert("Please a value for A1C or enter \"NA\" if no result is available.");
            return false;
        }
        if ((a1c.value !== "") && (!isNumber(a1c.value)) && (a1c.value!=="NA")) {
            alert("Please confirm you entry for A1C. \n It appears to not be numeric.");
            return false;
        }
        if ((a1c.value !== "NA") && (!isValidDate(a1cDate.value))) {
            alert("Please enter a valid date for A1C test.");
            return false;
        }
        if (eAG.value ===""){
            alert("Please a value for eAG or enter \"NA\" if no result is available.");
            return false;
        }    
        if ((eAG.value !=="") && (!isNumber(eAG.value)) && (eAG.value !== "NA")) {
            alert("Please confirm you entry for eAG. \n It appears to not be numeric.");
            return false;
        }
        if ((numEAG >= 450)||(numEAG <= 70)){
            response = confirm("Please confirm you entry for average blood sugar. \nIt appears to be outside an acceptable range (70-450). \n\nIf this is an accurate measurement, a Physician should be alerted!\n\
                                    \n\nClick ok to proceed and record value. Cancel to return and edit the value.");
            if(response === false){
               return false; 
            }   
        }
        if ((eAG.value !=="NA") && (!isValidDate(eAGDate.value))) {
            alert("Please enter a valid date for eAG test.");
            return false;
        }            
        if (ldl.value ===""){
            alert("Please a value for LDL or enter \"NA\" if no result is available.");
            return false;
        }             
        if ((ldl.value !== "") && (!isNumber(ldl.value)) && (ldl.value!== "NA")) {
            alert("Please confirm you entry for LDL. \n It appears to not be numeric.");
            return false;
        }        
        if (hdl.value ===""){
            alert("Please a value for HDL or enter \"NA\" if no result is available.");
            return false;
        }        
        if ((hdl.value !== "") && (!isNumber(hdl.value)) && (hdl.value !== "NA")) {
            alert("Please confirm you entry for HDL. \n It appears to not be numeric.");
            return false;
        }
        if ((ldl.value !=="") &&(hdl.value ==="") && (ldl.value !=="NA")) {
            alert("Please enter a value for HDL cholorestoral.");
            return false;
        }
        if ((ldl.value ==="")&&(hdl.value !=="") &&(hdl.value !=="NA")) {
            alert("Please enter a value for LDL cholorestoral.");
            return false;
        }
        if (((ldl.value !== "NA")||(hdl.value !=="NA")) && (!isValidDate(cholDate.value))) {
            alert("Please enter a valid date for cholorestoral test.");
            return false;
        }
        if (sys.value ===""){
            alert("Please a value for Systolic blood pressure or enter \"NA\" if no result is available.");
            return false;
        }
        if ((sys.value !== "") && (!isNumber(sys.value)) && (sys.value!=="NA")) {
            alert("Please confirm you entry for systolic blood pressure. \n It appears to not be numeric.");
            return false;
        }
        if (dia.value ===""){
            alert("Please a value for Diastolic blood pressure or enter \"NA\" if no result is available.");
            return false;
        }
        if ((dia.value !== "") && (!isNumber(dia.value)) && (dia.value!=="NA")) {
            alert("Please confirm you entry for diastolic blood pressure. \n It appears to not be numeric.");
            return false;
        }  
        if ((dia.value !=="")&&(sys.value ==="")) {
            alert("Please enter a value for systolic blood pressure.");
            return false;
        }
        if ((dia.value ==="")&&(sys.value !=="")) {
            alert("Please enter a value for diastolic blood pressure.");
            return false;
        }
        if ((numSys >= 180)||(numSys <= 90)){
            response = confirm("Please confirm you entry for Systolic blood pressure. \nIt appears to be outside an acceptable range (90-140). \nConfirm treatment plan!\n\
                                    \n\nClick ok to proceed and record value. Cancel to return and edit the value.");
            if (response === false){
                return false;
            }   
        }
        if (numDia >= 100){
            response = confirm("Please confirm you entry for Diastolic blood pressure. \nIt appears to be outside an acceptable range (>=100). \nConfirm treatment plan!\n\
                                    \n\nClick ok to proceed and record value. Cancel to return and edit the value.");
            if (response === false){
               return false; 
            } 
        }
        if (((dia.value !== "NA")||(sys.value !=="NA")) && (!isValidDate(bpDate.value))) {
            alert("Please enter a valid date for blood pressure measurement.");
            return false;
        }        
        if (weight.value=== ""){
            alert("Please a value for client weight or enter \"NA\" if no result is available.");
            return false;
        }
        if ((weight.value !== "") && (!isNumber(weight.value)) && (weight.value!=="NA")) {
            alert("Please confirm you entry for client weight. \n It appears to not be numeric.");
            return false;
        }
        if (height.value=== ""){
            alert("Please a value for client height or enter \"NA\" if no result is available.");
            return false;
        }
        if ((height.value !== "") && (!isNumber(height.value)) && (height.value!=="NA")) {
            alert("Please confirm you entry for client height. \n It appears to not be numeric.");
            return false;
        }
        if ((weight.value !=="")&&(height.value ==="")) {
            alert("Please enter a value for client height.");
            return false;
        }
        if ((weight.value ==="")&&(height.value !=="")) {
            alert("Please enter a value for client weight.");
            return false;
        }
        if (((weight.value !== "NA")||(height.value !=="NA")) && (!isValidDate(phyDate.value))) {
            alert("Please enter a valid date for physical measurements.");
            return false;
        }
    }
};

function show(rad, q)
    {
        var rads=document.getElementsByName(rad.name);
        document.getElementById(q).style.display=(rads[1].checked)?'none':'block';
        document.getElementById(q).style.display=(rads[0].checked)?'block':'none';
    };

function showMe (box) {

    var chboxs = document.getElementsByName("chronic_care");
    var vis = "none";
    for(var i=0;i<chboxs.length;i++) { 
        if(chboxs[i].checked){
         vis = "block";
            break;
        }
    }
    document.getElementById(box).style.display = vis;
};

function addDate (box) {

    var d = new Date();
    var s = new String();
    
    s = (d.getMonth()+1) + '/' +d.getDate() + '/' + d.getFullYear();
    //var chboxs = document.getElementsById(box);
    //alert (box.valueOf().toString());
    //alert (s.toString());
    
    //var i = document.getElementsById("A1CDate");
    //alert (i.toString());
    
    //i.value = "Here";
    //for(var i=0;i<chboxs.length;i++) { 
      //   alert("here");
      //  if(chboxs[i].checked){
         alert(s.toString());
      //      break;
      //  }
   // }
    
};
</script>
<?php include 'include/menu.php'; ?>
                <div id="container">
                    <div id="top">
                        <div id="logo">
                            <?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
                        </div><!-- div logo end -->
                        <div id="header">
                            <div id="title">
                                <center>
                                    <?php
                                    if ($_SESSION['visit_type'] === "Comprehensive"){
                                        echo "<h1>Brief ";
                                        print_r($_SESSION['assessment_type']);
                                        echo "Clinical Screening</h1>";
                                    }
                                    else {
                                        echo ' <h1>Brief Patient Visit</h1>';
                                    }
                                ?>
                                </center>
                            </div><!-- div title end -->
                            <center>						
                                <?php date_default_timezone_set('America/Chicago');
                                $today = date('l jS \of F Y h:i:s A');
                                print_r($today); ?>
                            </center>
                        </div><!-- div header end -->
                    </div><!-- end div top -->

                    <br>
                    <br>
                    <br>
                    <?php
                     if ($_SESSION['grouping']== 10){ echo '<div id="personal" <?php style="display: none;">';} else {echo ' <div id="personal">';}
                    echo '
                    <h1><center>Personal Information</center></h1>
                        <table id="tblPersonal">
                            <tr><td class="personal"><label for="first_name">First Name:</label></td><td class="personal"><input type="text" autofocus="autofocus" name="first_name"></td>
                                <td class="personal"><label for="last_name">Last Name:</label></td><td class="personal"><input type="text" name="last_name"></td></tr>
                            <tr><td class="personal"><label for="p_id">Patient ID:</label></td><td class="personal"><input id="pid" type="text" name="pt_id"></td>
                            <td class="personal"><label for="assessment_date">Date of Assessment:</label></td><td class="personal">
                            <input id ="assessment_date" name = "assessment_date" class="datepickr" placeholder=""></td>
                            </tr>
                            <tr><td></td><td></td></tr>
                            <tr><td></td><td>MM/DD/YYYY</td></tr>
                            <tr><td class="personal"><label for="dob">Date of birth:</label></td><td class="personal"><input id="dob" type="text" name="dob"></td>
                                <td class="personal"><label for="zip">Zip:</label></td><td class="personal"><input id="zip" input type="text" name="zip"></td></tr>		
                        </table>
                    </div><!-- end div personal -->
                    <br>	
                    <br>';
                    
                    if ($_SESSION['grouping']== 10){ echo '<div id="demo_data" <?php style="display: none;">';} else {echo '<div id="demo_data">';}
                    echo '        
                            <h1><center>Demographic Data</center></h1><p><center>Complete applicable information.</center>
                        <table id="demo">
                            <tr><td>
                                    <table border="1" align="center" id="table_sex">
                                        <tr><th class="tdtopic" colspan="4">Gender</th></tr>
                                        <tr><td class="sf">Male</td><td class="demo_input"><center><input type="radio" name="sex"  value="male"/></center></td>
                                <td class="sf">Female</td><td class="demo_input"><center><input type="radio" name="sex"  value="female"/></center></td></tr>
                            <tr><td class="sf">Transgender</td><td class="demo_input"><center><input type="radio" name="sex"  value="transgender"/></center></td>
                            <td class="sf">Other</td><td class="demo_input"><center><input type="radio" name="sex"  value="other"/></center></td></tr>
                        </table><!-- close table sex -->
                        </td>';
                    if ($_SESSION['assessment_type'] == "Adult"){
                        echo ' <td><table border="1" align="center" id="table_marital">
                                <tr><th class="tdtopic" colspan="4">Marital Status</th></tr>
                                <tr><td class="ms">Single.</td><td class="demo_input"><center><input type="radio" name="m_status"  value="single"/></center></td>
                        <td class="ms">Married.</td><td class="demo_input"><center><input type="radio" name="m_status"  value="married"/></center></td></tr>
                        <tr><td class="ms">Divorced.</td><td class="demo_input"><center><input type="radio" name="m_status"  value="divorced"/></center></td>
                        <td class="ms">Widow(ed).</td><td class="demo_input"><center><input type="radio" name="m_status"  value="widow(ed)"/></center></td></tr>
                        </table>
                        </td></tr>';
                    }
                           
                    if ($_SESSION['assessment_type'] == "Adult"){   
                        echo '<tr><td colspan="2">
                                <table border="1" id="table_education">
                            <tr><th class="tdtopic" colspan="4">Education</th></tr>
                            <tr><td class="ed">Elementary/Jr. high school.</td><td class="demo_input"><center><input type="radio" name="ed"  value="Elementary/Jr. high school"/></center></td>
                                <td class="ed">2-year degree.</td><td class="demo_input"><center><input type="radio" name="ed"  value="2-year degree"/></center></td></tr>
                            <tr><td class="ed">Some high school.</td><td class="demo_input"><center><input type="radio" name="ed"  value="Some high school"/></center></td>
                                <td class="ed">4-year degree.</td><td class="demo_input"><center><input type="radio" name="ed"  value="4-year degree"/></center></td></tr>
                            <tr><td class="ed">High school diploma or GED.</td><td class="demo_input"><center><input type="radio" name="ed"  value="High school diploma or GED"/></center></td>
                                <td class="ed">More than 4 years college.</td><td class="demo_input"><center><input type="radio" name="ed"  value="More than 4 years college"/></center></td></tr>
                            <tr><td class="ed">Some college.</td><td class="demo_input"><center><input type="radio" name="ed"  value="Some college"/></center></td><td class="ed" border="0"></td><td></td></tr>
                        </table>			
                        </td></tr>';
                    } 
                    else {
                         echo '<tr><td colspan="2">
                                <table border="1" id="table_education">
                            <tr><th class="tdtopic" colspan="24">Education: Highest grade completed</th></tr>
                            <tr><td class="c_ed" align="right">1</td><td class="demo_input"><center><input type="radio" name="ed"  value="1"/></center></td>
                                <td class="c_ed" align="right">2</td><td class="demo_input"><center><input type="radio" name="ed"  value="2"/></center></td>
                                <td class="c_ed" align="right">3</td><td class="demo_input"><center><input type="radio" name="ed"  value="3"/></center></td>
                                <td class="c_ed" align="right">4</td><td class="demo_input"><center><input type="radio" name="ed"  value="4"/></center></td>
                                <td class="c_ed" align="right">5</td><td class="demo_input"><center><input type="radio" name="ed"  value="5"/></center></td>
                                <td class="c_ed" align="right">6</td><td class="demo_input"><center><input type="radio" name="ed"  value="6"/></center></td>
                                <td class="c_ed" align="right">7</td><td class="demo_input"><center><input type="radio" name="ed"  value="7"/></center></td>
                                <td class="c_ed" align="right">8</td><td class="demo_input"><center><input type="radio" name="ed"  value="8"/></center></td>
                                <td class="c_ed" align="right">9</td><td class="demo_input"><center><input type="radio" name="ed"  value="9"/></center></td>
                                <td class="c_ed" align="right">10</td><td class="demo_input"><center><input type="radio" name="ed"  value="10"/></center></td>
                                <td class="c_ed" align="right">11</td><td class="demo_input"><center><input type="radio" name="ed"  value="11"/></center></td>
                                <td class="c_ed" align="right">12</td><td class="demo_input"><center><input type="radio" name="ed"  value="12"/></center></td></tr>    
                        </table>			
                        </td></tr>
                        <tr><td colspan="2">
                                <table border="1" id="table_birth_order">
                                    <tr><th class="tdtopic" colspan="8">Birth Order</th></tr>
                                    <tr><td class="bo">Oldest. </td><td class="demo_input"><center><input type="radio" name="c_bo"  value="Oldest"/></center></td>
                                        <td class="bo">Youngest. </td><td class="demo_input"><center><input type="radio" name="c_bo"  value="Youngest"/></center></td>
                                        <td class="bo">Middle. </td><td class="demo_input"><center><input type="radio" name="c_bo"  value="Middle"/></center></td>
                                        <td class="bo">Twin. </td><td class="demo_input"><center><input type="radio" name="c_bo"  value="Twin"/></center></td>
                                    </tr>
                                </table>			
                        </td></tr>';   
                        }
                        echo '<tr><td colspan="2">
                                <table border="1" id="table_ethnicity">
                                    <tr><th class="tdtopic" colspan="6">Ethnicity</th></tr>
                                    <tr><td class="eth">White/Caucasian.</td><td class="demo_input"><center><input type="radio" name="eth"  value="White/Caucasian"/></center></td>
                            <td class="eth">Native Hawaiian/Pacific Islander.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Native Hawaiian/Pacific Islander"/></center></td>
                        <td class="eth">Black/African-American.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Black/African-American"/></center></td></tr>
                        <tr><td class="eth">Hispanic/Latino.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Hispanic/Latino"/></center></td>
                        <td class="eth">Middle Eastern.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Middle Eastern"/></center></td>
                        <td class="eth">American Indian.</td><td class="demo_input"><center><input type="radio" name="eth"  value="American Indian"/></center></td></tr>
                        <tr><td class="eth">Asian.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Asian"/></center></td>
                        <td class="eth">Vietnamese.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Vietnamese"/></center></td>
                        <td>Other.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Other"/></center></td></tr>
                        </table>			
                        </td></tr>';
                        if ($_SESSION['assessment_type'] == "Adult"){   
                            echo '<tr><td colspan="2">
                                <table border="1" id="table_living">
                                    <tr><th class="tdtopic" colspan="6">Living Arrangements</th></tr>
                                    <tr><td class="liv">Alone.</td><td class="demo_input"><center><input type="radio" name="living"  value="Alone"/></center></td>
                            <td class="liv">With Family/Relatives.</td><td class="demo_input"><center><input type="radio" name="living"  value="With Family/Relatives"/></center></td>
                        <td class="liv">With Friends.</td><td class="demo_input"><center><input type="radio" name="living"  value="With Friends"/></center></td></tr>
                        </table>			
                        </td></tr>';}
                        else {
                            echo '<tr><td colspan="2">
                                <table border="1" id="table_living">
                                    <tr><th class="tdtopic" colspan="8">Living Arrangements</th></tr>
                                    <tr><td class="c_liv">With Parents</td><td class="demo_input"><center><input type="radio" name="living"  value="With Parents"/></center></td>
                                        <td class="c_liv">With Family/Friend.</td><td class="demo_input"><center><input type="radio" name="living"  value="With Family/Friend"/></center></td>
                                        <td class="c_liv">Foster Care.</td><td class="demo_input"><center><input type="radio" name="living"  value="Foster Care"/></center></td>
                                        <td class="c_liv">Shelter.</td><td class="demo_input"><center><input type="radio" name="living"  value="Shelter"/></center></td>
                                    </tr>
                                </table>			
                        </td></tr>';
                        }
                        
                        echo '</table><!-- end table demo -->
                        <tr><td colspan="2">
                                <table border="1" id="table_program">
                                    <tr><th class="tdtopic" colspan="6">Programs</th></tr>
                                    <tr><td class="pro">Homeless</td><td class="demo_input"><center><input type="checkbox" name="homeless"  value="1"/></center></td>
                                    <td class="pro">Chronic Care</td><td class="demo_input"><center><input type="checkbox" name="chronic_care"  value="1" /></center></td>
                                    <tr><td class="pro">Hepatitis C</td><td class="demo_input"><center><input type="checkbox" name="hep_c"  value="1"/></center></td>
                                    <td class="pro">Ryan White</td><td class="demo_input"><center><input type="checkbox" name="ryan_white"  value="1"/></center></td>
                                    <tr><td class="pro">Care Team</td><td class="demo_input"><center><input type="checkbox" name="care_team"  value="1"/></center></td><td><td>
                    </tr><tr><th class="tdtopic" colspan="6">Clinic Care</th></tr>
                <td class="pro">Brief</td><td class="demo_input"><center><input type="radio" name="clinic_care"  value="1"/></center></td>
                <td class="pro">Ongoing</td><td class="demo_input"><center><input type="radio" name="clinic_care"  value="2"/></center></td>
                </tr>
                <tr><th class="tdtopic" colspan="6">Behavioral Health</th></tr>
                <td class="pro"> w/ handoff</td><td class="demo_input"><center><input type="radio" name="bh_care"  value="w handoff"/></center></td>
                <td class="pro"> w/o handoff</td><td class="demo_input"><center><input type="radio" name="bh_care"  value="wo handoff"/></center></td>
                </tr>
                </table>
                </td></tr>
                
                    <table border="1" id="table_program">
                        <tr><th class="tdtopic" colspan="6">System Involvement</th></tr><tr>
                        <td class="eth">Singing River Svcs</td><td class="demo_input"><center><input type="checkbox" name="system_involvement_singing_river" value="1"/></center></td>
                        <td class="eth">Gulf Coast MH</td><td class="demo_input"><center><input type="checkbox" name="system_involvement_gulf_coast" value="1"/></center></td>
                        <td class="eth">Memorial Beh. Health</td><td class="demo_input"><center><input type="checkbox" name="system_involvement_memorial"  value="1"/></center></td></tr>
                    </table>
                </td></tr>
                <tr><td colspan="2">
                    <table border="1" id="table_program">
                        <tr><th class="tdtopic" colspan="6">Community Connections</th></tr><tr>
                        <td class="community_connections">Harrison</td><td class="demo_input"><center><input type="radio" name="community_connections" value="Harrison"/></center></td>
                        <td class="community_connections">Hancock</td><td class="demo_input"><center><input type="radio" name="community_connections" value="Hancock"/></center></td>
                        <td class="community_connections">Jackson</td><td class="demo_input"><center><input type="radio" name="community_connections" value="Jackson"/></center></td></tr>
                    </table>
                </td></tr>
                </td></tr>
                </table><!-- end table demo -->
            </div><!-- close div demo_data -->
                    <div id="chronic_data"';
                   if ($_SESSION['grouping']== 10){ echo ' style="display: none;">';} else {echo '>';}
                    echo '
                    
                        <br>
                        <br>
                        <center><h1>Chronic Health Monitoring</h1><p>Please enter the following health information.</p><p>Date format: YYYY/MM/DD</p><p>If you do not have test results to enter, enter "NA" in the results.</p></center>
                        <table id="chronic">
                            <tr><td>
                                    <table border="1" align="center" id="table_sugar">
                                        <tr><th class="tdtopic" colspan="6">Diabetes</th></tr>
                                        <tr><td class="t_name"><label for="a1c">Hemoglobin A1C (%):</label></td>
                                            <td class="t_input"><input type="text" autofocus="autofocus" name="valueA1C" id="valueA1C"></td>
                                            <td class="date_label"><label for="a1c">Test Date:</label></td>
                                            <td class="t_date"><input name="A1CDate" id="A1CDate" class="datepickr" placeholder=""></td>
                                        </tr>
                                        <tr><td class="t_name"><label for="eAG">Blood Sugar (eAG) (mg/dl):</label></td>
                                            <td class="t_input"><input type="text" name="valueEAG" id="valueEAG" ></td>
                                            <td class="date_label"><label for="a1c">Test Date:</label></td>
                                            <td class="t_date"><input  name="eAGDate" id="eAGDate" class="datepickr" placeholder=""></td>
                                        </tr>                         
                                    </table><!-- close table_sugar -->
                                </td></tr> 
                            <tr><td>
                                    <table border="1" align="center" id="table_colestoral">
                                        <tr><th class="tdtopic" colspan="6">Cholesterol (mg/dL)</th></tr>
                                        <tr><td class="t_name"><label for="a1c">Low-Density Lipoproteins (LDL):</label></td>
                                            <td class="t_input"><input type="text"  name="valueLDL" id="valueLDL"></td>
                                            <td class="t_name"><label for="eAG">High-Density Lipoproteins (HDL):</label></td>
                                            <td class="t_input"><input type="text" name="valueHDL" id="valueHDL"></td>
                                            <td class="date_label"><label for="col_date">Test Date:</label></td>
                                            <td class="t_date"><input name="cholestoralDate" id="cholestoralDate" class="datepickr" placeholder=""></td>
                                        </tr>                         
                                    </table><!-- close table_a1c -->
                                </td></tr> 
                            <tr><td>
                                    <table border="1" align="center" id="table_blood">
                                        <tr><th class="tdtopic" colspan="6">Blood Pressure (mm/Hg)</th></tr>
                                        <tr><td class="t_name"><label for="a1c">Systolic:</label></td>
                                            <td class="t_input"><input type="text"  name="valueSYS" id="valueSYS"></td>
                                            <td class="t_name"><label for="eAG">Diastolic:</label></td>
                                            <td class="t_input"><input type="text" name="valueDIA" id="valueDIA"></td>
                                            <td class="date_label"><label for="bp_date">Test Date:</label></td>
                                            <td class="t_date"><input name="bpDate" id="bpDate" class="datepickr" placeholder=""></td>
                                        </tr>                         
                                    </table><!-- close table_a1c -->
                                </td></tr>
                            <tr><td>
                                    <table border="1" align="center" id="table_physical">
                                        <tr><th class="tdtopic" colspan="6">Physical</th></tr>
                                        <tr><td class="t_name"><label for="height">Height (inches):</label></td>
                                            <td class="t_input"><input type="text" autofocus="autofocus" name="valueHeight" id="valueHeight"></td>
                                            <td class="t_name"><label for="weight">Weight (lbs.):</label></td>
                                            <td class="t_input"><input type="text" name="valueWeight" id="valueWeight"></td>
                                            <td class="date_label"><label for="weight">Test Date:</label></td>
                                            <td class="t_date"><input type="text"  name="physicalDate" id="physicalDate" class="datepickr" placeholder=""></td>
                                        </tr>                         
                                    </table><!-- close table_a1c -->
                                </td></tr>
                        </table><!-- end table chronic -->
                    </div>               
                <div id="questions"';if ($_SESSION['grouping']== 10){ echo ' style="display: none;">';} else {echo '>';}
                       echo' <center><h1>Outside Visits</h1></center>
                        <br>
                        <p><STRONG>1</STRONG>: Since your last visit and other than Emergency Room visit, have you been in the hospital?
                            <INPUT TYPE="radio"  id="q1_1" NAME="q1" VALUE="yes" onclick="show(this, \'q1_fu\');">Yes
                            <INPUT TYPE="radio"  id="q1_2" NAME="q1" VALUE="no"  onclick="show(this, \'q1_fu\');">No</p>
                        <div id="q1_fu" style="display:none;">
                            <p><strong>Date of discharge: </strong>
                                <input type="text"  name="hospital_visit_date" id="hospital_visit_date" class="datepickr" placeholder=""> (format: YYYY/MM/DD)
                            </p>
                            <p><strong>Reason for visit:</strong>
                                 <select name="hospital_visit_reason" id="hospital_visit_reason" onchange="updateDiv(this.value)">
                                    <option value="Nothing Selected"></option>
                                    <option value="Chronic Condition Related">Chronic Condition Related</option>
                                    <option value="Accident">Accident</option>
                                    <option value="Other">Other</option>
                                </select> 
                            <p>
                                If other, what was the specific reason? (Maximum 150 characters)
                            </p>
                            <p>
                                <input type="text"  name="hospital_visit_other" id="hospital_visit_other" maxlength="150" size="150">
                            </p>
                            
                        </div>
                        <p><STRONG>2</STRONG>: Since your last visit have you been to the Emergency Room?
                            <INPUT TYPE="radio" id= "q2_1" NAME="q2" VALUE="yes" onclick="show(this, \'q2_fu\');">Yes
                            <INPUT TYPE="radio" id= "q2_2" NAME="q2"  VALUE="no"  onclick="show(this, \'q2_fu\');">No</p>
                        <div id="q2_fu" style="display:none;">
                            <p><strong>Date of ER visit:</strong>
                                <input type="text"  name="er_visit_date" id="er_visit_date" class="datepickr" placeholder=""> (format: YYYY/MM/DD)
                            </p>
                            <p><strong>Reason for ER visit:</strong>
                                 <select name="er_visit_reason" id="er_visit_reason">
                                    <option value="Nothing Selected"></option>
                                    <option value="Chronic Condition Related">Chronic Condition Related</option>
                                    <option value="Accident">Accident</option>
                                    <option value="Other">Other</option>
                                </select> 
                            <p>
                                If other, what was the specific reason? (Maximum 150 characters)
                            </p>
                            <p>
                               <input type="text"  name="er_visit_other" id="er_visit_other" maxlength="150" size="150">
                            </p>
                        </div>
                        <p><STRONG>3</STRONG>: Since your last visit have you been to the another medical provider?
                            <INPUT TYPE="radio" id= "q3_1" NAME="q3" VALUE="yes" onclick="show(this, \'q3_fu\');">Yes
                            <INPUT TYPE="radio" id="q3_2"  NAME="q3"  VALUE="no"  onclick="show(this, \'q3_fu\');">No</p>
                        <div id="q3_fu" style="display:none;">
                            <p><strong>Date of office visit:</strong>
                                <input type="text"  name="office_visit_date" id="office_visit_date" class="datepickr" placeholder=""> (format: YYYY/MM/DD)
                            </p>
                            <p><strong>Reason for office visit:</strong>
                                 <select name="office_visit_reason" id="office_visit_reason">
                                    <option value="Nothing Selected"></option>
                                    <option value="Chronic Condition Related">Chronic Condition Related</option>
                                    <option value="Accident">Accident</option>
                                    <option value="Other">Other</option>
                                </select>
                            </p>
                            <p>
                                If other, what was the specific reason? (Maximum 150 characters)
                            </p>
                            <p>
                                <input type="text"  name="office_visit_other" id="office_visit_other" maxlength="150" size="150">
                            </p>
                        </div>
                        <p>    
                    </div>
';
?>
            
            <div class="page-break"></div><!--force page break here. good for 8.5X11 pages -->
			<?php

				require_once 'include/constants.php';
				$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);
				$i = 0;

				include 'include/stressors.php';
				include 'include/current_stress.php';
				include 'include/health.php';
				include 'include/events.php';
				include 'include/gad.php';
                                include 'include/gad-2.php';
				include 'include/phq.php';
				include 'include/audit.php';
				include 'include/cage.php';
				include 'include/cd.php';
				include 'include/pcl.php';
				include 'include/ces_d.php';
				include 'include/symptoms.php';
				include 'include/psc.php';
				include 'include/dast.php';
				include 'include/duke.php';
                                include 'include/self.php';
                                include 'include/sdq.php';     
                                include 'include/life.php';
                                include 'include/crafft.php';
                                include 'include/pcl-2.php';
                                include 'include/diagnosis.php';
                                include 'include/diag_me.php';
                                include 'include/adhd.php';
                                include 'include/presenting_problem.php';
                                include 'include/childStressors.php';
                                include 'include/hypertension.php';
                                include 'include/pediatric.php';

                                if($_SESSION['pp_check'] == 1){
                                    write_presenting_problem($_SESSION['assessment_type'], $mysqli);
                                }
                                
                                if ($_SESSION['c_stress_check'] == 1){
                                    
                                    write_current_stress("child");
                                    write_childStressors($_SESSION['assessment_type'], $mysqli);	
                                }
				
				
				if($_SESSION['stress_check'] == 1)	
				{			
					write_stressors($_SESSION['assessment_type'], $mysqli);	
					write_current_stress($_SESSION['assessment_type']);
				}

				if($_SESSION['health_check'] == 1)
				{
                                    
					write_health($_SESSION['assessment_type'], $mysqli);
				}

				if($_SESSION['events_check'] == 1)
				{
					write_events($_SESSION['assessment_type'], $mysqli);
				}
						
				if (($_SESSION['gad_check'] == 1)||($_SESSION['phq_check'] == 1)||($_SESSION['audit_check'] == 1)||($_SESSION['gad2_check']==1)||
				($_SESSION['cage_check'] == 1)||($_SESSION['cd_check'] == 1)||($_SESSION['pcl_check'] == 1)||($_SESSION['ces_check'] == 1)||
				($_SESSION['psc_check'] == 1)||	($_SESSION['dast_check'] == 1)||($_SESSION['duke_check'] == 1))	
				{
				echo "<hr><br><div id=\"gen_header\"><h2>Below is a list of questions regarding your problems, complaints, feelings and self-confidence. 
					 Please read each question carefully and select the response that best represents your situation.</h2></div><!--end div gen_header --><br>";
				}

                                if( $_SESSION['sdq_check'] == 1)
				{
					write_sdq($_SESSION['assessment_type'], $mysqli);
				}
                                
				if($_SESSION['gad_check'] == 1)
				{
					write_gad($_SESSION['assessment_type'], $mysqli);
					echo "<div class=\"page-break\"></div><!--force page break here. good for 8.5X11 pages -->";//these are manual page breaks for printing. May need to move them if you print the instruments in different order!
				}
                                
                                if($_SESSION['gad2_check'] == 1)
				{
					write_gad2($_SESSION['assessment_type'], $mysqli);
				}
					
				if($_SESSION['phq_check'] == 1)
				{
					write_phq($_SESSION['assessment_type'], $mysqli);
				}
                                
                                if( $_SESSION['symptom_check'] == 1) //phq-15
				{
					write_symptoms($_SESSION['assessment_type'], $mysqli);
				}

				if($_SESSION['audit_check'] == 1)
				{
					write_audit($_SESSION['assessment_type'], $mysqli);
					echo "<div class=\"page-break\"></div><!--force page break here. good for 8.5X11 pages -->";//these are manual page breaks for printing. May need to move them if you print the instruments in different order!	
				}			

				if($_SESSION['cage_check'] == 1)
				{
					write_cage($_SESSION['assessment_type'], $mysqli);
				}

				if($_SESSION['cd_check'] == 1)
				{
					write_cd($_SESSION['assessment_type'], $mysqli);
				}

				if($_SESSION['pcl_check'] == 1)
				{
					write_pcl($_SESSION['assessment_type'], $mysqli);
				}
                                
                                if($_SESSION['pcl2_check'] == 1)
				{
					write_pcl2($_SESSION['assessment_type'], $mysqli);
				}
                                
                                if($_SESSION['diagnosis_check'] == 1)
				{
					write_diagnosis($_SESSION['assessment_type'], $mysqli);
				}
                                
                                if($_SESSION['diag_me_check'] == 1)
				{
					write_diag_me($_SESSION['assessment_type'], $mysqli);
				}

				if($_SESSION['ces_check'] == 1)
				{
					write_ces_d($_SESSION['assessment_type'], $mysqli);	
				}

				if($_SESSION['psc_check'] == 1)
				{
					write_psc($_SESSION['assessment_type'], $mysqli);	
				}	

				if($_SESSION['dast_check'] == 1)
				{
					write_dast($_SESSION['assessment_type'], $mysqli);	
				}	

				if($_SESSION['duke_check'] == 1)
				{
					write_duke($_SESSION['assessment_type'], $mysqli);	
				}
                                
                                if($_SESSION['self_check'] == 1)
				{
					write_self($_SESSION['assessment_type'], $mysqli);	
				}
                                
                                if($_SESSION['life_check'] == 1)
				{
					write_life($_SESSION['assessment_type'], $mysqli);
                                        
				}
                                
                                if($_SESSION['crafft_check'] == 1)
				{
					write_crafft($_SESSION['assessment_type'], $mysqli);	
				}
                                
                                if($_SESSION['adhd_check'] == 1)
				{
					write_adhd($_SESSION['assessment_type'], $mysqli);	
				}
                                
                                if($_SESSION['hypertension_check'] == 1)
				{
					write_hypertension($_SESSION['assessment_type'], $mysqli);	
				}
                                
                                if($_SESSION['pediatric_check'] == 1)
				{
					write_pediatric($_SESSION['assessment_type'], $mysqli);	
				}
				
				echo "<br>\n";	
				mysqli_close($mysqli); 
                                if ($_SESSION['grouping']== 10){ echo '<div id="confirmation" <?php style="display: none;">';} else {echo ' <div id="confirmation">';}
			?>
		<center><h1>Information Confirmation</h1>
		<p>Please confirm the patient ID below. This input must match the patient ID entered in the personal information section above.</p></center>
			
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
		<input id="submit" type="submit" onclick="return adult_form_submit();" value="Submit" />
		<input id="reset_button" type="reset" value="Reset" />
		</center>
		<br>
		<br>
	</div><!-- div container end -->
		</form>
		<?php include 'include/footer.php' ?>
                <script src="/include/src/datepickr.min.js"></script>
<script>
// Regular datepickr
datepickr('#datepickr');
// Custom date format
datepickr('.datepickr', { dateFormat: 'Y-m-d'});
// Min and max date
datepickr('#minAndMax', {
// few days ago
minDate: new Date().getTime() - 2.592e8,
// few days from now
maxDate: new Date().getTime() + 2.592e8
});
// datepickr on an icon, using altInput to store the value
// altInput must be a direct reference to an input element (for now)
datepickr('.calendar-icon', { altInput: document.getElementById('calendar-input') });
// If the input contains a value, datepickr will attempt to run Date.parse on it
datepickr('[title="parseMe"]');
// Overwrite the global datepickr prototype
// Won't affect previously created datepickrs, but will affect any new ones
datepickr.prototype.l10n.months.shorthand = ['jan', 'feb', 'mar', 'april', 'may', 'jun', 'jul', 'aug', 'sept', 'oct', 'nov', 'dec'];
datepickr.prototype.l10n.months.longhand = ['January', 'Feburary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
datepickr.prototype.l10n.weekdays.shorthand = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
datepickr.prototype.l10n.weekdays.longhand = ['Sunday', 'Monday', 'Tuesdat', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
datepickr('#someFrench.sil-vous-plait', { dateFormat: '\\le j F Y' });
</script>	
</body>
</html>
