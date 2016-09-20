<?php

/* 
 We need a couple of check boxes that require the clinician to ask the following questions.
 
Since your last visit have you been in the hospital (yes or no)
If yes
How many days (data field)
When were you discharged (date field)
Why were in the hospital (select chronic condition related, accident, other)
 
Since your last visit have you been to the ER (yes or no)
               What date (date field)
               Why ((select chronic condition related, accident, other)
 
Since your last visit have you been to the another medical provider (yes or no)
               What date (date field)
               Why (select chronic condition related, accident, other)
 
In addition we need a way to track phone calls and the purpose of the call. This might be better as a select box with the following options
               Date of call
               Purpose (select support in lieu of appointment, missed appointment follow up, check up call, response to patient message)
 
 */

session_start();
// A necessary function for translating our post variables into session variables. 
foreach ($_POST as $key => $value) {
    $_SESSION[$key] = $value;
}
//print_r($_SESSION);
// These are page security parameters. We will not let the user in unless they meet all these conditions. 
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized' ||
        $_SESSION['previous'] != 'chronic_health.php') {
    header("location:../index.php");
    die("Authentication required, redirecting");
}

$_SESSION['previous'] = 'questions.php';
//print_r($_SESSION);
?>

<html>
    <head>
        <title>
            Outside Visits
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Brief Adult Assessment">
        <link rel="stylesheet" href="mystyle.css" type="text/css">


<script type="text/javascript">

    //clear the validation form.	
    function clearForm(form)
    {
        form.reset();
    }
    
    function isValidDate(txt) 
    {
        var reg_date = /(?:0[1-9]|1[0-2])\/(?:0[1-9]|[1-2][0-9]|3[0-1])\/(?:19\d{2}|20\d{2})/;
        return reg_date.test(txt);
    }
    
    // This function reads the code that was entered, compares with the known clinic_id as read from $_SESSION, and either rejects the submission or submits to insert.php
    function formSubmit(form)
    {
         
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

    if ((q1_rads[0].checked === false)&&(q1_rads[1].checked === false)){
        alert("Please all questions must have a yes/no selection.\n Please make a selection for question 1.");
        return false;
    }
    if ((q2_rads[0].checked === false)&&(q2_rads[1].checked === false)){
        alert("Please all questions must have a yes/no selection.\n Please make a selection for question 2.");
        return false;
    }
    if ((q3_rads[0].checked === false)&&(q3_rads[1].checked === false)){
        alert("Please all questions must have a yes/no selection.\n Please make a selection for question 3.");
        return false;
    }
    
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
    
    form.submit();
    
    } 
    function show(rad, q)
    {
        var rads=document.getElementsByName(rad.name);
        document.getElementById(q).style.display=(rads[1].checked)?'none':'block';
        document.getElementById(q).style.display=(rads[0].checked)?'block':'none';
    }
    
    
    
    
</script>
    </head>
        <body onload="clearForm()">
            <div id="top">
                <div id="logo">
                    <?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
                </div><!-- div logo end -->
            </div><!--close div top -->    
                <form id="form1" name="form1" action="assessment_time.php" method="post">
                    <!-- ************************************************************** -->
                    <div id="questions" >
                        <center><h1>Outside Visits</h1></center>
                        <br>
                        <p><STRONG>1</STRONG>: Since your last visit and other than Emergency Room visit, have you been in the hospital?
                            <INPUT TYPE="radio"  id="q1_1" NAME="q1" VALUE="yes" onclick="show(this, 'q1_fu');">Yes
                            <INPUT TYPE="radio"  id="q1_2" NAME="q1" VALUE="no"  onclick="show(this, 'q1_fu');">No</p>
                        <div id="q1_fu" style="display:none;">
                            <p><strong>Date of discharge: </strong>
                                <input type="text" autofocus="autofocus" name="hospital_visit_date" id="hospital_visit_date"> (format: MM/DD/YYYY)
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
                                <input type="text" autofocus="autofocus" name="hospital_visit_other" id="hospital_visit_other" maxlength="150" size="150">
                            </p>
                            
                        </div>
                        <p><STRONG>2</STRONG>: Since your last visit have you been to the Emergency Room?
                            <INPUT TYPE="radio" id= "q2_1" NAME="q2" VALUE="yes" onclick="show(this, 'q2_fu');">Yes
                            <INPUT TYPE="radio" id= "q2_2" NAME="q2"  VALUE="no"  onclick="show(this, 'q2_fu');">No</p>
                        <div id="q2_fu" style="display:none;">
                            <p><strong>Date of ER visit:</strong>
                                <input type="text" autofocus="autofocus" name="er_visit_date" id="er_visit_date"> (format: MM/DD/YYYY)
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
                               <input type="text" autofocus="autofocus" name="er_visit_other" id="er_visit_other" maxlength="150" size="150">
                            </p>
                        </div>
                        <p><STRONG>3</STRONG>: Since your last visit have you been to the another medical provider?
                            <INPUT TYPE="radio" id= "q3_1" NAME="q3" VALUE="yes" onclick="show(this, 'q3_fu');">Yes
                            <INPUT TYPE="radio" id="q3_2"  NAME="q3"  VALUE="no"  onclick="show(this, 'q3_fu');">No</p>
                        <div id="q3_fu" style="display:none;">
                            <p><strong>Date of office visit:</strong>
                                <input type="text" autofocus="autofocus" name="office_visit_date" id="office_visit_date"> (format: MM/DD/YYYY)
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
                                <input type="text" autofocus="autofocus" name="office_visit_other" id="office_visit_other" maxlength="150" size="150">
                            </p>
                        </div>
                        <p>    
                    </div>        
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



