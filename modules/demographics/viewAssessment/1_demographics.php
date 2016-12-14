<?php
	////////////////This is where we will print our strings for our results page////////////////////////////
	if ($_SESSION['grouping']== 10){ echo '<div id="demo_table" <?php style="display: none;">';} else {echo ' <div id="demo_table">';}
	echo "<table border=\"1\" width=\"800\">"; //Printing a magical 14!?
	echo "<th bgcolor = \"D8D8D8\" width = \"800\" colspan=\"2\"><font size = \"6\"><center>Demographic Information</center></font></th>";
	if ($_SESSION['first_name']!= '') {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>First Name: </b>";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['first_name']);
	echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>First Name:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['last_name']!= '') {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Last Name: </b>";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['last_name']);
	echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Last Name:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['pt_id']!= '') {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Patient ID: </b>";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['pt_id']);
	echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Patient ID:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['dob']!= '') {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Date of Birth:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['dob']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Date of Birth:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['zip']!= '') {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
		echo "<b>Zip:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['zip']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Zip:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['sex']!= '') {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Sex:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['sex']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Sex:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";;
	}
	if ($_SESSION['eth']!= '') {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
		echo "<b>Ethnicity:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['eth']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Ethnicity:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['m_status']!= '') {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Marital Status:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['m_status']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Marital Status:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['ed']!= '') {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
		echo "<b>Education:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['ed']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Education:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['living']!= '') {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Living</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['living']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Living:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['assessment_type'] == 'Child') {
		if ($_SESSION['c_bo']!="") {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
		echo "<b>Birth Order:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['c_bo']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
		echo "<b>Birth Order:</b> ";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
		}
	}
	echo "</table><br></div>";
?>
