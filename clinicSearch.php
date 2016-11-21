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

$_SESSION ['previous'] = '/clinicSearch.php';

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
			echo " <button type = \"submit\" action = \"/clinicSearch.php\" method = \"post\" style= \"height: 25px; width: 150px\">Search Clinic Data</button><br><br><br>";
		} else {
		}
		?>
	</form>
</body>
		</html>

		<form id="form2" action="/searchdataresults.php" method="post"
			target="_blank">

			<!-- Javascript function for -->
			<script type="text/javascript">

 function update_employee_activity(form3, $i) {
  //This function is where we update the database.
  //$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);
  alert("Employee activity updated. ");
  document.getElementById("form3").submit();
  header("location: /index.php");
 }
</script>

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
