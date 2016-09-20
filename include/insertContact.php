<?php

session_start();

foreach ($_POST as $key => $value) {
    if (($key != 'status') && ($key != 'previous')) {
        $_SESSION[$key] = $value;
    }
}

if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized' ||
        $_SESSION['previous'] != 'submitContact.php' ||
        !array_key_exists('n1', $_SESSION) ||
        !array_key_exists('n2', $_SESSION) ||
        !array_key_exists('n3', $_SESSION) ||
        !array_key_exists('n4', $_SESSION)) {
    header("location:../index.php");
    die("Authentication required, redirecting");
}

$_SESSION['previous'] = 'insertContact.php';
//print_r($_SESSION);
if ($_SESSION['contact_type'] === 'group'){
    $_SESSION['pt_id'] = "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <?php
   
    include 'menu.php';
write_menu();
    ?>
    <head>
        <title>
            Contact Submission Review
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Contact Submission Review">
        <link rel="stylesheet" href="mystyle.css" type="text/css">
    </head>
    <body onload="clearForm();">
        <div id="container">
            <div id="top">
                <div id="logo">
<?php echo $_SESSION['logo'] ?>
                </div><!-- div logo end -->
                <div id="header">
                    <div id="title">
                        <center>
                            <h1>Contact Submission Review</h1>
                        </center>
                    </div><!-- div title end -->
                    <center>						
<?php
date_default_timezone_set('America/Chicago');
$today = date('l jS \of F Y h:i:s A');
print_r($today);
?>
                    </center>
                </div><!-- div header end -->
            </div><!-- end div top -->	

            <script type="text/javascript"> //Our function to print the webpage. 
                function printpage()
                {
                    window.print();
                }
            </script>				
            <?php
            require_once'constants.php';
            $mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

            echo "<table border=\"1\" width=\"800\">";
            echo "<th bgcolor = \"D8D8D8\" width = \"800\" colspan=\"2\"><font size = \"6\"><center>Contact Information</center></font></th>";

            if ($_SESSION['pt_id'] != '') {   
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Patient Id: </b>";
                echo "</td><td width = \"400\">";
                Print_r($_SESSION['pt_id']);
                echo "</td></tr>";
            } else {
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Patient Id:</b>";
                echo "</td><td width = \"400\">";
                echo " Data unspecified.";
                echo "</td></tr>";
            }

            if ($_SESSION['contact_date'] != '') {  
                echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
                echo "<b>Contact Date: </b>";
                echo "</td><td width = \"400\">";
                Print_r($_SESSION['contact_date']);
                echo "</td></tr>";
            } else {
                echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
                echo "<b>Contact Date:</b>";
                echo "</td><td width = \"400\">";
                echo " Data unspecified.";
                echo "</td></tr>";
            }
            
            if ($_SESSION['contact_type'] != '') { 
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Type of Contact: </b>";
                echo "</td><td width = \"400\">";
                Print_r($_SESSION['contact_type']);
                echo "</td></tr>";
            } else {
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Type of Contact:</b>";
                echo "</td><td width = \"400\">";
                echo " Data unspecified.";
                echo "</td></tr>";
            }

            if ($_SESSION['contact_outcome'] != '') {  
                echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
                echo "<b>Contact Outcome:</b> ";
                echo "</td><td width = \"400\">";
                Print_r($_SESSION['contact_outcome']);
                echo "</td></tr>";
            } else {
                echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
                echo "<b>Contact Outcome:</b>";
                echo "</td><td width = \"400\">";
                echo " Data unspecified.";
                echo "</td></tr>";
            }

            if ($_SESSION['outcome_other'] != '') {  
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Outcome Other Description:</b> ";
                echo "</td><td width = \"400\">";
                Print_r($_SESSION['outcome_other']);
                echo "</td></tr>";
            } else {
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Outcome Other Description:</b>";
                echo "</td><td width = \"400\">";
                echo " Data unspecified.";
                echo "</td></tr>";
            }

            if ($_SESSION['contact_reason'] != '') {  
                echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
                echo "<b>Contact Reason:</b> ";
                echo "</td><td width = \"400\">";
                Print_r($_SESSION['contact_reason']);
                echo "</td></tr>";
            } else {
                echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
                echo "<b>Contact Reason:</b>";
                echo "</td><td width = \"400\">";
                echo " Data unspecified.";
                echo "</td></tr>";
                ;
            }

            if ($_SESSION['reason_other'] != '') {  
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Contact Reason Other Description:</b> ";
                echo "</td><td width = \"400\">";
                Print_r($_SESSION['reason_other']);
                echo "</td></tr>";
            } else {
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Contact Reason Other Description:</b>";
                echo "</td><td width = \"400\">";
                echo " Data unspecified.";
                echo "</td></tr>";
            }
            
            if ($_SESSION['group_other'] != '') {  
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Details of group activity:</b> ";
                echo "</td><td width = \"400\">";
                Print_r($_SESSION['group_other']);
                echo "</td></tr>";
            } else {
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Details of group activity:</b>";
                echo "</td><td width = \"400\">";
                echo " Data unspecified.";
                echo "</td></tr>";
            }
            
            if ($_SESSION['contact_time'] != '') {  
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Time spent on contact activity:</b> ";
                echo "</td><td width = \"400\">";
                Print_r($_SESSION['contact_time']);
                echo "</td></tr>";
            } else {
                echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
                echo "<b>Time spent on contact activity:</b>";
                echo "</td><td width = \"400\">";
                echo " Data unspecified.";
                echo "</td></tr>";
            }
            echo "</table>";
            //Finally, get to insert 

            $keys = "(id,";
            $values = "(0, ";
            foreach ($_SESSION as $key => $value) {
                if (($key === 'user_id') || ($key === 'clinic_id') || ($key === 'pt_id') || ($key === 'contact_date') || ($key === 'entry_date') || ($key === 'contact_type')
                        || ($key === 'contact_outcome') || ($key === 'outcome_other') || ($key === 'contact_reason') || ($key === 'reason_other') || ($key === 'group_other')
                        || ($key === 'contact_time')) {
                    
                    $keys = $keys . $key . " ,";

                    if ($key === 'pt_id' || $key === 'first_name' || $key === 'last_name') {     // Here we are setting the name and pt_id to password.
                        if ($value !=""){
                            $value = strtolower($value);
                            $value = hash('sha256', $value);
                        }
                        else {
                            $value = "";
                        }
                        $values = $values . " '" . $value . "',";                                           
                        
                    } else {
                        $values = $values . " '" . $value . "',";
                    }
                }
            }
            $keys = $keys . "entry_date)";
            $values = $values . "NOW())";
            $query = "insert into contact_activity $keys values $values";

            $result = $mysqli->query($query);
            $insert_id = $mysqli->insert_id;

            $_SESSION['insert_id'] = $insert_id;
	//print_r($_SESSION);
	//echo $query;
            ?>
            
            <br><br><br><br><br>
</body>
<center><input type="button" style= "height: 25px; width: 100px" value="Print this page" onclick="printpage()" /></center>
<footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
<center><a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"><img src="images/GRHOP.png" style="border:none;max-width:100%;" width="100" alt="G.R.H.O.P"></a></center>
</div>	

</html>