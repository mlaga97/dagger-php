<?php
session_start();
// A necessary function for translating our post variables into session variables. 
foreach ($_POST as $key => $value) {
    $_SESSION[$key] = $value;
}
//print_r($_SESSION);
// These are page security parameters. We will not let the user in unless they meet all these conditions. 

if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized' ||
        $_SESSION['previous'] != 'adult.php') {
    header("location:../index.php");
    die("Authentication required, redirecting");
}
if (isset($_SESSION['grouping']) && ($_SESSION['grouping'] == 10)){
    header("location:submit.php");
    die("Redirecting");
}
//print_r($_SESSION);

$_SESSION['previous'] = 'chronic_health.php';
?>

<!-- HTML Start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>
            Chronic Health Concerns
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Brief Adult Assessment">
        <link rel="stylesheet" href="mystyle.css" type="text/css">


<script type="text/javascript">

    //clear the validation form.	
    function clearForm(form){
        form.reset();
    }
    
    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function isValidDate(txt) {
        var reg_date = /(?:0[1-9]|1[0-2])\/(?:0[1-9]|[1-2][0-9]|3[0-1])\/(?:19\d{2}|20\d{2})/;
        return reg_date.test(txt);
        }
    
    
    // This function reads the code that was entered, compares with the known clinic_id as read from $_SESSION, and either rejects the submission or submits to insert.php
    function formSubmit(form)
    {
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
     
        if (a1c.value=== ""){
            alert("Please a value for A1C or enter \"NA\" if no result is available.");
            return false;
        }
        if ((a1c.value !== "") && ((!isNumber(a1c.value)) && (a1c.value!=="NA"))) {
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

           form.submit();

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
                </div><!-- close div header -->
            </div><!--close div top -->
                     
                <form id="form1" name="form1" action="questions.php" method="post">
                    <!-- ************************************************************** -->
                    <div id="chronic_data" >
                        <br>
                        <br>
                        <center><h1>Chronic Health Monitoring</h1><p>Please enter the following health information.</p><p>Date format: MM/DD/YYYY</p><p>If you do not have test results to enter, enter "NA" in the results.</p></center>
                        <table id="chronic">
                            <tr><td>
                                    <table border="1" align="center" id="table_sugar">
                                        <tr><th class="tdtopic" colspan="6">Diabetes</th></tr>
                                        <tr><td class="t_name"><label for="a1c">Hemoglobin A1C (%):</label></td>
                                            <td class="t_input"><input type="text" autofocus="autofocus" name="valueA1C" id="valueA1C"></td>
                                            <td class="date_label"><label for="a1c">Test Date:</label></td>
                                            <td class="t_date"><input type="text" autofocus="autofocus" name="A1CDate" id="A1CDate"></td>
                                        </tr>
                                        <tr><td class="t_name"><label for="eAG">Blood Sugar (eAG) (mg/dl):</label></td>
                                            <td class="t_input"><input type="text" name="valueEAG" id="valueEAG" ></td>
                                            <td class="date_label"><label for="a1c">Test Date:</label></td>
                                            <td class="t_date"><input type="text" autofocus="autofocus" name="eAGDate" id="eAGDate"></td>
                                        </tr>                         
                                    </table><!-- close table_sugar -->
                                </td></tr> 
                            <tr><td>
                                    <table border="1" align="center" id="table_colestoral">
                                        <tr><th class="tdtopic" colspan="6">Cholesterol (mg/dL)</th></tr>
                                        <tr><td class="t_name"><label for="a1c">Low-Density Lipoproteins (LDL):</label></td>
                                            <td class="t_input"><input type="text" autofocus="autofocus" name="valueLDL" id="valueLDL"></td>
                                            <td class="t_name"><label for="eAG">High-Density Lipoproteins (HDL):</label></td>
                                            <td class="t_input"><input type="text" name="valueHDL" id="valueHDL"></td>
                                            <td class="date_label"><label for="col_date">Test Date:</label></td>
                                            <td class="t_date"><input type="text" autofocus="autofocus" name="cholestoralDate" id="cholestoralDate"></td>
                                        </tr>                         
                                    </table><!-- close table_a1c -->
                                </td></tr> 
                            <tr><td>
                                    <table border="1" align="center" id="table_blood">
                                        <tr><th class="tdtopic" colspan="6">Blood Pressure (mm/Hg)</th></tr>
                                        <tr><td class="t_name"><label for="a1c">Systolic:</label></td>
                                            <td class="t_input"><input type="text" autofocus="autofocus" name="valueSYS" id="valueSYS"></td>
                                            <td class="t_name"><label for="eAG">Diastolic:</label></td>
                                            <td class="t_input"><input type="text" name="valueDIA" id="valueDIA"></td>
                                            <td class="date_label"><label for="bp_date">Test Date:</label></td>
                                            <td class="t_date"><input type="text" autofocus="autofocus" name="bpDate" id="bpDate"></td>
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
                                            <td class="t_date"><input type="text" autofocus="autofocus" name="physicalDate" id="physicalDate"></td>
                                        </tr>                         
                                    </table><!-- close table_a1c -->
                                </td></tr>
                        </table><!-- end table chronic -->
                    </div><!-- close div demo_data -->
                    <br>
                </form>

                    <center>
                        <input id="submit"  type="submit" onclick="formSubmit(form1);" value="Submit" >
                        <input id="reset_button" type="reset" onclick="clearForm(form1)" value="Reset" />
                    </center>
                    <br>
                    <br>
                    <br>


                    <footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
                    <center><a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"><img src="images/GRHOP.png" style="border:solid; border-color:black;" width="100" height="100" alt="G.R.H.O.P"></a></center>
                    </body>
                    </html>
