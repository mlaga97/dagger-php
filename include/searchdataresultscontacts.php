<?php

session_start();
require_once('Mysql.php');

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

$membership = new Membership();

foreach($_POST as $key=>$value) 
{
$_SESSION[$key] = $value;
}

//print_r($_SESSION);
//print_r($_POST);

if(!isset($_SESSION['search_select_contact'])) {
header("location:searchdata.php");
   die("Authentication required, redirecting");
}

$id_search = $_SESSION['search_select_contact'];
$query_search_results =  $mysqli->query("SELECT contact_activity.id, (select users.name from users where users.id = contact_activity.user_id) as user, contact_activity.pt_id, contact_activity.contact_date, contact_activity.entry_date, contact_activity.contact_type, contact_activity.contact_outcome, contact_activity.outcome_other, contact_activity.contact_reason, (select clinic.name from clinic where clinic.id= contact_activity.clinic_id) as clinic, contact_activity.contact_time, contact_activity.group_other FROM contact_activity, users WHERE contact_activity.id = $id_search");
$row = $query_search_results->fetch_assoc();
//print_r($row);
$_SESSION['previous'] = 'searchdataresultscontacts.php';
?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>C_
           <?php echo $row['contact_date']; ?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Contact Information">
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
                            <h1>Past Contact Data Sheet</h1>
                        </center>
                        </div><!-- div title end -->
                        <center>                        
                            <?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
                        </center>
                    </div><!-- div header end -->
                </div><!-- end div top -->  
                
<?php

//echo "<p>Contact ID: ". $row['id'] . "</p>";
echo "<br>";
echo "<p><b>Clinician: </b>" . $row['user']. "</p>";
echo "<p><b>Contact Date: </b>" .$row['contact_date']. "</p>";
echo "<p><b>Entry Date: </b>" . $row['entry_date']. "</p>";
echo "<p><b>Contact Type: </b>". $row['contact_type']. "</p>";
echo "<p><b>Contact Outcome: </b>" . $row['contact_outcome']. "</p>";
echo "<p><b>Outcome Other: </b>" . $row['outcome_other']. "</p>";
echo "<p><b>Contact Reason: </b>" . $row['contact_reason']. "</p>";
echo "<p><b>Reason Other: </b>" . $row['reason_other']. "</p>";
echo "<p><b>Clinic: </b>" . $row['clinic']. "</p>";
echo "<p><b>Contact Time: </b>" . $row['contact_time']. "</p>";
echo "<p><b>Group Other: </b>" . $row['group_other']. "</p>";

echo "</body></html>";
//print_r($_SESSION);

