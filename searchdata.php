<?php
session_start ();

// These are page security parameters. We will not let the user in unless they meet all these conditions.
if ($_SESSION ['status'] != 'authorized') {
	header ( "location: /index.php" );
	die ( "Authentication required, redirecting" );
}

unset ( $_SESSION ['search_select'] );
require_once ('include/gad.php');
require_once ('include/Mysql.php');
require_once ('include/constants.php');
require_once ("include/pChart/class/pDraw.class.php");
require_once ("include/pChart/class/pImage.class.php");
require_once ("include/pChart/class/pData.class.php");

$_SESSION ['previous'] = '/searchdata.php';

?>
<!-- HTML start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
<title>Search!</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="Brief Adult Assessment">
<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
</head>
<body onload="clearForm();">
<?php include 'include/menu.php'; ?>
    <div id="container">
		<div id="top">
			<div id="logo">
          <?php echo $_SESSION['logo']?>
				<!--Pulling string from the database-->
			</div>
			<!-- div logo end -->
			<div id="header">
				<div id="title">
					<center>
						<h1>Search Client Records</h1>
					</center>
				</div>
				<!-- div title end -->
				<center>            
              <?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
            </center>
			</div>
			<!-- div header end -->
		</div>
		<!-- end div top -->

		<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
		<html>
<body>

	<form id="form1" method="post" action=""> 


  <?php
		$mysqli = new mysqli ( DB_SERVER, DB_USER, DB_Password, DB_NAME );

		if ($_SESSION ['admin'] == 1) {

			echo "<br><br><b>You are logged in as an administrator.</b><br><br>";

			$query_responses = $mysqli->query ( "SELECT COUNT(id)as num FROM response where clinic_id in (select clinic_id from groups where user_id = " . $_SESSION ['user_id'] . ")" );
			$query_responses2 = $query_responses->fetch_assoc ();

			// Here we are pulling the clinic group associated with the administrator logged in, and showing the number.
			// I figured since there would only be one clinic group associated, why not just tell them?
			echo " The clinic group you are associated with has served ";
			echo $query_responses2 ['num'];
			echo " patients so far!<br><br>";

			// The followig lines of code ensure that data is correctly entered and submitted, including date. If so, we get results.
			if (array_key_exists ( 'end_date', $_POST ) && array_key_exists ( 'start_date', $_POST ) && array_key_exists ( 'employee_select', $_POST ) && $_POST ['start_date'] != "" && $_POST ['end_date'] != "") {
				$startdate = $_POST ['start_date'];
				$enddate = $_POST ['end_date'];
				$employeeselect = $_POST ['employee_select'];
				$startdate_array = explode ( "/", $startdate );
				$enddate_array = explode ( "/", $enddate );
				$startdate_final = $startdate_array [2] . "-" . $startdate_array [0] . "-" . $startdate_array [1];
				$enddate_final = $enddate_array [2] . "-" . $enddate_array [0] . "-" . $enddate_array [1];
				$employee_record_count = $mysqli->query ( "SELECT count(id)as record_count FROM response where date BETWEEN '$startdate_final' AND '$enddate_final' AND user_id = $employeeselect" );
				$employee_record_count2 = $employee_record_count->fetch_assoc ();
				echo "<br><br>";
				echo "This employee has seen " . $employee_record_count2 ['record_count'] . " patients so far!";
				echo "<br><br>";
			}

			if (array_key_exists ( 'end_date', $_POST ) && array_key_exists ( 'start_date', $_POST ) && array_key_exists ( 'clinic_select', $_POST ) && $_POST ['start_date'] != "" && $_POST ['end_date'] != "") {
				$startdate = $_POST ['start_date'];
				$enddate = $_POST ['end_date'];
				$clinicselect = $_POST ['clinic_select'];

				$startdate_array = explode ( "/", $startdate );
				$enddate_array = explode ( "/", $enddate );

				$startdate_final = $startdate_array [2] . "-" . $startdate_array [0] . "-" . $startdate_array [1];

				$enddate_final = $enddate_array [2] . "-" . $enddate_array [0] . "-" . $enddate_array [1];
				$employee_record_count = $mysqli->query ( "SELECT count(id)as record_count FROM response where date BETWEEN '$startdate_final' AND '$enddate_final' AND clinic_id = $clinicselect" );
				$employee_record_count2 = $employee_record_count->fetch_assoc ();

				echo "<br><br>";
				echo "This clinic has seen " . $employee_record_count2 ['record_count'] . " patients so far!";
				echo "<br><br>";
			}

			echo "<link rel=\"stylesheet\" href=\"https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css\" />";
			echo "<script src=\"https://code.jquery.com/jquery-1.12.4.min.js\" integrity=\"sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=\" crossorigin=\"anonymous\"></script>";
			echo "<script src=\"https://code.jquery.com/ui/1.12.0/jquery-ui.min.js\" integrity=\"sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=\" crossorigin=\"anonymous\"></script>";
			// echo "<link rel=\"stylesheet\" href=\"/resources/demos/style.css\" />";
			echo "<script>";
			echo "$(function() {";
			echo "$( \"#start_date\" ).datepicker(); ";
			echo "});";

			echo "$(function() {";
			echo "$( \"#end_date\" ).datepicker();";
			echo "});";
			echo "</script>";
			echo "<p>Starting Date: <input type=\"text\" name = \"start_date\" id=\"start_date\" />   Ending Date: <input type=\"text\" name = \"end_date\" id=\"end_date\" /></p>";

			$user_id_variable = $_SESSION ['user_id'];

			$clinic = "SELECT id,name from clinic where id in (select clinic_id from groups where user_id ='$user_id_variable')";
			$clinic_info = $mysqli->query ( $clinic );

			$employee = "SELECT id,name from users where id in (select user_id from groups where clinic_id in(select clinic_id from groups where user_id ='$user_id_variable'))";
			$employee_info = $mysqli->query ( $employee );

			$clinic_select = $clinic_info->fetch_assoc ();
			$employee_select = $employee_info->fetch_assoc ();

			// Here we begin printing our table. This table will contain the buttons for selecting employees/clinic.
			echo "<table width=\"520\"><td colspan = \"4\"><tr><td></td><td><h4><b> Clinic </b></h4></td><td></td><td><h4><b> Employee </b></h4></td><tr>\n";
			while ( $clinic_select || $employee_select ) {
				echo "<tr>";
				if ($clinic_select && $employee_select) {
					echo "<td><center><input type=\"radio\"width=\"260\" name =\"clinic_select\" value=\"" . $clinic_select ['id'] . "\"/></center></td><td style= 'text-align: left'>" . $clinic_select ['name'] . " </td>\n";
					echo "<td><center><input type=\"radio\"width=\"260\" name =\"employee_select\" value=\"" . $employee_select ['id'] . "\"/></center></td><td style= 'text-align: left'>" . $employee_select ['name'] . " </td>\n";
				} else if ($employee_select && ! $clinic_select) {
					echo "<td></td><td></td>";
					echo "<td><center><input type=\"radio\"width=\"260\" name =\"employee_select\" value=\"" . $employee_select ['id'] . "\"/></center></td><td style= 'text-align: left'>" . $employee_select ['name'] . " </td>\n";
				} else if (! $employee_select && $clinic_select) {
					echo "<td><center><input type=\"radio\"width=\"260\" name =\"clinic_select\" value=\"" . $clinic_select ['id'] . "\"/></center></td><td style= 'text-align: left'>" . $clinic_select ['name'] . " </td>\n";
					echo "<td></td><td></td>\n";
				}
				echo "</tr>";
				$clinic_select = $clinic_info->fetch_assoc ();
				$employee_select = $employee_info->fetch_assoc ();
			}
			echo "</td></table><br>";
			echo " <button type = \"submit\" action = \"/searchdata.php\" method = \"post\" style= \"height: 25px; width: 150px\">Search Clinic Data</button><br><br><br>";
		} else {
		}
		?> 
           <hr>
		<br>
		<h4>Please enter the patient ID here to search by.</h4>
		<i>Please note that if there is no record of the patient by ID,</i><br>
		<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;then
			nothing will be returned.</i><br> <br>
		<!--%nbsp; provides a single space.-->
		<label for="pt_id">Patient ID:</label> <input type="text"
			autofocus="autofocus" name="pt_id" />
		<button action="/searchdata.php" style="height: 25px; width: 100px">Search</button>
	</form>
</body>
		</html>

		<form id="form2" action="/searchdataresults.php" method="post"
			target="_blank">

			<!-- Javascript function for -->
			<script type="text/javascript">

function search_select(form2)
  {
    alert("Please enter a patient ID.");

    var checked = false;
    var radios = document.getElementsByName("search_select");
    for (var i = 0, radio; radio = radios[i]; i++)
    {
        if (radio.checked)
        {
          checked = true;
          document.getElementById("form2").submit();
        }
        else {
            alert("Please select an assessment to view.");
            return false;
        }
    }
 }
 
 function search_select_contact(form4)
  {
    alert("Please enter a patient ID.");

    var checked = false;
    var radios = document.getElementsByName("search_select_contact");
    for (var i = 0, radio; radio = radios[i]; i++)
    {
        if (radio.checked)
        {
          checked = true;
          document.getElementById("form4").submit();
        }
        else {
            alert("Please select an contact to view.");
            return false;
        }
    }
 }

 function update_employee_activity(form3, $i)
 {

  //This function is where we update the database.
  //$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);
  alert("Employee activity updated. ");
  document.getElementById("form3").submit();
  header("location: /index.php");

  //while()
 }
</script>

			<!-- Note, nothing will come up if there is nothing to come up. -->
<?php

$mysqli = new mysqli ( DB_SERVER, DB_USER, DB_Password, DB_NAME );

$membership = new Membership ();

if ($_POST && ! empty ( $_POST ['pt_id'] )) {
	$_SESSION ['pt_id'] = $_POST ['pt_id'];
	$info_store = strtolower ( $_SESSION ['pt_id'] );
	$info_store = hash ( 'sha256', $info_store );
	$id_store = $_SESSION ['user_id'];

	$query_clinic = "SELECT response.pt_id, response.id, response.date, clinic.name, response.stress_check, response.events_check, response.health_check, response.symptom_check, response.gad_check, response.phq_check, response.audit_check, response.cage_check, response.cd_check, response.pcl_check, response.psc_check, response.ces_check, response.dast_check, response.duke_check, response.sdq_check, response.life_check, response.crafft_check, response.gad2_check, response.pcl2_check, response.adhd_check, response.hypertension_check, response.pediatric_check FROM response, clinic where pt_id = '$info_store' AND clinic.id = response.clinic_id AND clinic_id IN(select clinic_id FROM groups where user_id = '$id_store')order by response.id  DESC";
	// We're going to make the above query into the one below.
	$query_contact = "SELECT contact_activity.pt_id, (select users.name from users where users.id = contact_activity.user_id) as name, contact_activity.id, contact_activity.contact_date, contact_activity.entry_date, contact_activity.contact_type, contact_activity.contact_outcome, contact_activity.outcome_other, contact_activity.contact_reason, contact_activity.reason_other, contact_activity.clinic_id, contact_activity.contact_time, contact_activity.group_other FROM contact_activity where pt_id = '$info_store' AND contact_activity.clinic_id IN(select clinic_id FROM groups where user_id = '$id_store')order by contact_activity.contact_date  DESC";
	$info = $mysqli->query ( $query_clinic );
	$contact_info = $mysqli->query ( $query_contact );
	echo "<table border = \"0\"><td>";
	echo "<tr>";
	$first = 0;

	while ( $row = $info->fetch_assoc () ) {
		if (($first === 0) && ($_SESSION ['admin'] == 1)) {
			echo $row ['pt_id'];
			echo "</tr><tr>";
			$first ++;
		}
		echo "<td>";
		echo "<input type =\"radio\" input id = \"id\" name =\"search_select\"  value=\"" . $row ['id'] . "\">";
		echo "</td>";

		echo "<td>";
		print_r ( $row ['name'] );
		echo "</td>";

		echo "<td>";
		echo "<p style = color:blue>";
		echo $row ['date'];
		echo "</p>";
		echo "</td>";

		echo "<td>";
		echo "<p style = color:red>";
		if ($row ['stress_check'] == 1)
			echo "Stress ";
		if ($row ['events_check'] == 1)
			echo "Event ";
		if ($row ['health_check'] == 1)
			echo "Health ";
		if ($row ['symptom_check'] == 1)
			echo "Symptom ";
		if ($row ['gad_check'] == 1)
			echo "GAD-7 ";
		if ($row ['gad2_check'] == 1)
			echo "GAD-2 ";
		if ($row ['phq_check'] == 1)
			echo "PHQ-9 ";
		echo "<br>";
		if ($row ['audit_check'] == 1)
			echo "Audit ";
		if ($row ['cage_check'] == 1)
			echo "Cage ";
		if ($row ['cd_check'] == 1)
			echo "CD ";
		if ($row ['pcl_check'] == 1)
			echo "PCL-C ";
		if ($row ['pcl2_check'] == 1)
			echo "PCL-A ";
		if ($row ['psc_check'] == 1)
			echo "PSC ";
		if ($row ['ces_check'] == 1)
			echo "CES-D ";
		if ($row ['dast_check'] == 1)
			echo "DAST ";
		if ($row ['duke_check'] == 1)
			echo "DUKE ";
		if ($row ['sdq_check'] == 1)
			echo "SDQ ";
		if ($row ['adhd_check'] == 1)
			echo "ADHD ";
		if ($row ['hypertension_check'] == 1)
			echo "Hypertension ";
		if ($row ['pediatric_check'] == 1)
			echo "Pediatric Lifestyles ";
		echo "</p>";
		echo "</td>";
		echo "</tr>";
	}
	echo "</table><br>";
	echo "<button onclick =\"search_select(form2);\" type =\"submit\" style = \"height: 25px; width: 100px\">View</button>";
	echo "<br>";
	echo "<br></form>";
	
	$first = 0;
	while ( $row = $contact_info->fetch_assoc () ) {
		if ($first == 0) {
			echo "<br><br><hr>";
			echo '<form id = "form4" action = "/searchdataresultscontacts.php" method = "post" target="_blank">';
			echo '<table border = "0"><tr ><td colspan = "5"><center><font size="">Patient Contacts</font></center></td></tr>';
			echo '<tr><td></td><td width="150">Date</td>';
			echo '<td width="200">Clinician</td>';
			echo '<td width="150">Contact Type</td>';
			echo '<td width="300">Contact Outcome</td></tr>';
			$first ++;
		}
		echo "<tr><td>";
		echo "<input type =\"radio\" input id = \"id\" name =\"search_select_contact\"  value=\"" . $row ['id'] . "\">";
		echo "</td>";
		echo "<td>  ";
		echo $row ['contact_date'];
		echo "</td>  ";
		echo "<td>  ";
		echo $row ['name'];
		echo "</td>";
		echo "<td>  ";
		echo $row ['contact_type'];
		echo "</td>";
		echo "<td>  ";
		echo $row ['contact_outcome'];
		echo "</td>";
		echo "</tr>";
	}
	if ($first > 0) {
		echo "</table><br>";
		echo "<button onclick =\"search_select_contact(form4);\" type =\"submit\" style = \"height: 50px; width: 100px\">View Contact Details</button>";
		echo "</form>";
		echo "<br><br><hr>";
	}
	echo "<br><center><h1>Select trend options below.</h1></center>";
	echo '<span class="class1">
        <ul>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_gad.php" target ="_blank" >GAD-7</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_phq.php" target ="_blank" >PHQ-9</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_pcl-c.php" target ="_blank" >PCL-C</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_audit.php" target ="_blank">AUDIT-C</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_cage.php" target ="_blank">CAGE</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_psc.php" target ="_blank">PSC-17</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_ces.php" target ="_blank">CES-D</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_dast.php" target ="_blank">DAST-10</a></li>
        </ul>
        <p>
        Please note: <ol><li>If there are no scorable assessments, there will be no trend graphic presented.</li> 
        <li>Only scorable responses will be shown on the trend.</li><li> The trend graphic will 
        be shown in a separate browser tab.</li><li>Trending requires at least two (2) scorable responses.</li>
        <li>Time progresses from left to right. In otherwords, scores to the left of the trend are OLDER than those on the right. This
        holds true even if multiple assessments were given on the same date.</li>
        <li>The date format is YYYY/MM/DD</li></ol>
        </p>';
	echo "<br><center><h1>Select The Duke trend options below.</h1></center>";
	echo '<ul>  
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_bar.php" target ="_blank">Composite (Bar)</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_line.php" target ="_blank">Composite (Line)</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_physical.php" target ="_blank">Physical</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_mental.php" target ="_blank">Mental</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_social.php" target ="_blank">Social</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_general.php" target ="_blank">General</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_perceived.php" target ="_blank">Perceived</a></li><br><br>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_self-esteem.php" target ="_blank">Self-Esteem</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_anxiety.php" target ="_blank">Anxiety</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_depression.php" target ="_blank">Depression</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_anxiety-depression.php" target ="_blank">Anxiety-Depression</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_pain.php" target ="_blank">Pain</a></li>
        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_disability.php" target ="_blank">Disability</a></li>
        </ul>
        </span>
        <p>
        Please note: <ol><li>The notes in the above trending section are applicable to this section.</li>
        <li>The composite options will trend all the sub-scores on a single trend. This yields a very busy trend.</li>
        <li>On composite trends, a \'-1\' on the trend indicates that the sub-score could not be calculated. These dates are omitted
        when a single item is trended.</li> 
        <li>The remaining choices yield the individual sub-score on a single trend.</li></ol>
        </p>';
} else {
	echo '<p style = "color: red; text-align: left">Please enter a patient ID.</p><br><br>';
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
			<html>
<head>
<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="Brief Adult Assessment">
<link rel="stylesheet" href="/include/mystyle.css" type="text/css">
</head>
<br>
<br>


<p style="color: red; text-align: center">
	<b>Warning: once you click these links, you will not be able to return.</b>
</p>

<center>
	<input type="button" value="Return to Start"
		style="height: 25px; width: 100px"
		onclick="window.location='/index.php';" /> <input type="submit"
		value="Assessment" style="height: 25px; width: 100px"
		onclick="window.location='/clinic.php'" />
</center>
   
 

	<?php include 'include/footer.php' ?></html>
		</form>
	</div>
</body>
</html>