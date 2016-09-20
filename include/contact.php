<?php
session_start();

// A necessary function for translating our post variables into session variables. 
foreach($_POST as $key=>$value) 
{
$_SESSION[$key] = $value;
}
//print_r($_SESSION);
// These are page security parameters. We will not let the user in unless they meet all these conditions. 
if ($_SESSION['status'] != 'authorized')    
    {
	header("location:../index.php");
	   die("Authentication required, redirecting");
    }
$_SESSION['previous'] = 'contact.php';
//print_r($_SESSION);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <title>Client Contact Record</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="mystyle.css">
<link rel="stylesheet" type="text/css" href="src/datepickr.min.css">


<body onload="clearForm(form1); select_it(document.getElementById('contact_type').value)">
<script type="text/javascript">
//clear the validation form.	
    function clearForm(form)
    {
        form.reset();
    }
    
    function updateDiv(selection, div ){
        if (selection === "Other"){
            document.getElementById(div).style.display='block';
        } else {   
            document.getElementById(div).style.display='none';
        }
    }
    
    
    function formSubmit(form)
    {
      var pt_id = document.getElementById("pt_id");
      var contact_type = document.getElementById("contact_type");
      var contact_time = document.getElementById("contact_time");
      var pid_input =  document.getElementById('pt_id');
      var confirmation_pid_input = document.getElementById("c_p_id");
      var pt_id_length = pid_input.value.trim().length;
      
     
        if ((pt_id.value === "")&& (contact_type.value !== "group")){
            alert("Please enter a patient id.");
            return false;
        }
        
        if (contact_time.value === ""){
            alert("Please enter a time for the activity.");
            return false;
        }
        if (isNaN(contact_time.value)){
            alert("Please enter a numeric value for the time of activity.");
            return false;
        }
        if ((pt_id_length === 0 ) && (contact_type.value !== "group")){
            alert("Please enter a patient ID.");
            return false;
        }
        
        if ((pid_input.value !== confirmation_pid_input.value) && (contact_type.value !== "group")){
            alert("Please patient ID inputs DO NOT match.\nPlease confirm the patient ID.");
            return false;
        }
           form.submit();
    }
    
    function select_it(selection){
               //alert(selection);
               if (selection ==="phone call"){
                   document.getElementById('other_detail').style.display='none';
                   document.getElementById('pt_detail').style.display='block';
                   document.getElementById('confirmation_outer').style.display='block';
               }
               else if (selection ==="out of clinic"){
                   document.getElementById('other_detail').style.display='none';
                   document.getElementById('pt_detail').style.display='block';
                   document.getElementById('confirmation_outer').style.display='block';        
               }
               else if (selection ==="group") {
                   document.getElementById('pt_detail').style.display='none';
                   document.getElementById('other_detail').style.display='block';
                   document.getElementById('confirmation_outer').style.display='none';
               }
               else if (selection ==="patient assistance") {
                   document.getElementById('pt_detail').style.display='block';
                   document.getElementById('other_detail').style.display='none';
                   document.getElementById('confirmation_outer').style.display='block';
               }
               else {
                   document.getElementById('pt_detail').style.display='none';
                   document.getElementById('other_detail').style.display='none';
                   document.getElementById('confirmation_outer').style.display='none';
               }
                document.getElementById('time_spent').style.display='block';
            return false;
           }
 </script> 
 <?php
 include 'menu.php';
 write_menu();
 ?>
<style>

.calendar-icon {
display: inline-block;
vertical-align: middle;
width: 32px;
height: 32px;
background: url(images/calendar.png);
}

</style>  
        <div id="top">
            <div id="logo">
                <?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
            </div><!-- div logo end -->
        </div><!--close div top -->    
        <form id="form1"  action="submitContact.php" method="post">
            <!-- ************************************************************** -->
            

            
            <div id="contact" >
                <center><h1>Client Contact</h1></center>
                <p><strong>Date of contact: </strong>
                        <input id ="contact_date" name = "contact_date" class="datepickr" ></p>
                <p><strong>Type of Contact:</strong>
                    <select onchange="select_it(this.value);" name="contact_type" id="contact_type">
                        <option  value="no selection" selected></option>
                        <option  value="group" <?php if ($_SESSION['contact_type'] == 'group') echo "selected"?>>Group</option>
                        <option  value="phone call" <?php if ($_SESSION['contact_type'] == 'phone call') echo "selected"?>>Telephone Call</option>
                        <option  value="patient assistance" <?php if ($_SESSION['contact_type'] == 'patient assistance') echo "selected"?>>Patient Assistance</option>
                        <option  value="out of clinic" <?php if ($_SESSION['contact_type'] == 'out of clinic') echo "selected"?>>Out of Clinic Visit</option>                            
                    </select> 
                </p>
                
               <div id="pt_detail" style="display: none;" > 
                    <p><strong>Patient ID: </strong>
                        <input type="text"  name="pt_id" id="pt_id">
                    </p>                            
                    <p><strong>Reason for Contact:</strong>
                    <select name="contact_reason" id="contact_reason" onchange="updateDiv(this.value, 'reason_other')">
                        <option selected="selected" value="Nothing Selected"></option>
                        <option value="Support in lieu of appointment">Support in lieu of appointment</option>
                        <option value="Missed appointment follow up">Missed appointment follow up</option>
                        <option value="Check up call">Check up call</option>
                        <option value="Response to patient message">Response to patient message</option>
                        <option value="Other">Other</option>
                    </select> 
                    <div id="reason_other" style="display:none;">
                       <p>
                       If other, what was the specific reason? (Maximum 150 characters)
                       </p>
                       <p>
                           <input type="text"  name="reason_other" id="reason_other" maxlength="150" size="150">
                       </p>
                    </div>
                <p><strong>Outcome of Contact:</strong>
                    <select name="contact_outcome" id="contact_outcome" onchange="updateDiv(this.value, 'outcome_other')">
                        <option selected="selected" value="Nothing selected" ></option>
                        <option value="Spoke to client">Spoke to Client</option>
                        <option value="Unable to speak to client">Unable to speak to client</option>
                        <option value="Other">Other</option>
                    </select>     
                    <div id="outcome_other" style="display:none;">
                       <p>
                       If other, what was the outcome? (Maximum 150 characters)
                       </p>
                       <p>
                           <input type="text"  name="outcome_other" id="outcome_other" maxlength="150" size="150">
                       </p>
                    </div>
                </div>
            
            <div id="other_detail" style="display: none;" >  
                    <div id="other_group">
                       <p>
                       Provide details of group activity. (Maximum 150 characters)
                       </p>
                       <p>
                           <input type="text"  name="group_other" id="group_other" maxlength="150" size="150">
                       </p>
                    </div>
                </div>
                 <div id="time_spent" style="display: none;" >  
                     <p>
                       Provide time, in minutes, spent on contact activity. 
                       </p>
                       <p>
                           <input type="text"  name="contact_time" id="contact_time" maxlength="10" size="10">
                       </p>
                 </div>
             </div>     
        
        
        <div id="confirmation_outer" style="display: none;">
        <h1><center>Information Confirmation</h1>
		<p>Please confirm the patient ID below. This input must match the patient ID entered above.</p></center>
			<div id="confirmation">
				<table id="tblConfirmation">
					<tr>
					<td class="personal"><label for="c_p_id">Patient ID:</label></td><td class="personal"><input type="text" name="c_p_id" id="c_p_id"></td></tr>
					<tr><td></td><td></td></tr>
				</table>
			</div><!-- end div  -->	
        </div>
		<br>
    <center>
        <input id="submit"  type="submit" onclick="return formSubmit(form1);" value="Submit" >
        <input id="reset_button" type="reset" onclick="clearForm(form1)" value="Reset" />
    </center>
            <br>
    </form>
     
    <footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
    <center><a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"><img src="images/GRHOP.png" style="border:solid; border-color:black;" width="100" height="100" alt="G.R.H.O.P"></a></center>




<script src="src/datepickr.min.js"></script>
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