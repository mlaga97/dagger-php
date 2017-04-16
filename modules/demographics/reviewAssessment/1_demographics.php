<?php
	////////////////This is where we will print our strings for our results page////////////////////////////
	if ($_SESSION['grouping']== 10){ echo '<div id="demo_table" <?php style="display: none;">';} else {echo ' <div id="demo_table" style="margin-bottom: 40px;">';}

	echo "<h3>Demographic Information</h3>";
	echo "<table border=\"1\" width=\"800\">"; //Printing a magical 14!?

	// Removed first and last name

	// Updated Session field names
	if ($_SESSION['patientID']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Patient ID";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['patientID']);
	echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Patient ID";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['dob']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Date of Birth";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['dob']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Date of Birth:";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['demographics_zipCode']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Zip";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_zipCode']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Zip";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['demographics_gender']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Gender";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_gender']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Gender";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";;
	}
	if ($_SESSION['demographics_ethnicity']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Ethnicity";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_ethnicity']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Ethnicity";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['demographics_maritalStatus']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Marital Status";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_maritalStatus']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Marital Status:";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['demographics_education']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Education";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_education']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Education";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['demographics_livingArrangements']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Living";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['demographics_livingArrangements']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Living:";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}

// Removed child birth order

	echo "</table></div>";
?>
