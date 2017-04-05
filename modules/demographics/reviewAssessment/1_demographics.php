<?php
	////////////////This is where we will print our strings for our results page////////////////////////////
	if ($_SESSION['grouping']== 10){ echo '<div id="demo_table" <?php style="display: none;">';} else {echo ' <div id="demo_table">';}
	echo "<table border=\"1\" width=\"800\">"; //Printing a magical 14!?
	echo "<th bgcolor = \"D8D8D8\" width = \"800\" colspan=\"2\"><center><h3>Demographic Information</h3></center></th>";

	// Removed first and last name

	// Updated Session field names
	if ($_SESSION['patientID']!= '') {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Patient ID: </b>";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['patientID']);
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
	if ($_SESSION['demographics_zipCode']!= '') {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Zip:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_zipCode']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Zip:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['demographics_gender']!= '') {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Gender:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_gender']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Gender:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";;
	}
	if ($_SESSION['demographics_ethnicity']!= '') {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Ethnicity:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_ethnicity']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Ethnicity:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['demographics_maritalStatus']!= '') {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Marital Status:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_maritalStatus']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Marital Status:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['demographics_education']!= '') {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Education:</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_education']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Education:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}
	if ($_SESSION['demographics_livingArrangements']!= '') {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Living</b> ";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_livingArrangements']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		echo "<b>Living:</b>";
		echo "</td><td width = \"400\">";
		echo " Data unspecified.";
		echo "</td></tr>";
	}

// Removed child birth order

	echo "</table><br></div>";
?>
