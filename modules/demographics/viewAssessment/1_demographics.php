<?php
	////////////////This is where we will print our strings for our results page////////////////////////////
	if ($_SESSION['grouping']== 10){ echo '<div id="demo_table" <?php style="display: none;">';} else {echo ' <div id="demo_table" style="margin-bottom: 40px;">';}
	echo "<h3>Demographic Information</center></h3>";
	echo "<table border=\"1\" width=\"800\">"; //Printing a magical 14!?
	//if ($_SESSION['first_name']!= '') {
		//echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		//echo "<b>First Name: </b>";
		//echo "</td><td width = \"400\">";
		//Print_r($_SESSION['first_name']);
	//echo "</td></tr>";
	//} else {
		//echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		//echo "<b>First Name:</b>";
		//echo "</td><td width = \"400\">";
		//echo " Data unspecified.";
		//echo "</td></tr>";
	//}
	//if ($_SESSION['last_name']!= '') {
		//echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		//echo "<b>Last Name: </b>";
		//echo "</td><td width = \"400\">";
		//Print_r($_SESSION['last_name']);
	//echo "</td></tr>";
	//} else {
		//echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
		//echo "<b>Last Name:</b>";
		//echo "</td><td width = \"400\">";
		//echo " Data unspecified.";
		//echo "</td></tr>";
	//}
	//if ($_SESSION['pt_id']!= '') {
		//echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		//echo "<b>Patient ID: </b>";
		//echo "</td><td width = \"400\">";
		//Print_r($_SESSION['pt_id']);
	//echo "</td></tr>";
	//} else {
		//echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		//echo "<b>Patient ID:</b>";
		//echo "</td><td width = \"400\">";
		//echo " Data unspecified.";
		//echo "</td></tr>";
	//}
	if ($_SESSION['dob']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Date of Birth";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['dob']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Date of Birth";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['zip']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Zip";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['zip']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Zip";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['sex']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Gender";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['sex']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Gender";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";;
	}
	if ($_SESSION['eth']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Ethnicity";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['eth']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Ethnicity";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['m_status']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Marital Status";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['m_status']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Marital Status";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['ed']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Education";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['ed']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Education";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}
	if ($_SESSION['living']!= '') {
		echo "<tr><td width = \"200\">";
		echo "Living";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['living']);
		echo "</td></tr>";
	} else {
		echo "<tr><td width = \"200\">";
		echo "Living";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
	}


	if ($_SESSION['assessment_type'] == 'Child') {
		if ($_SESSION['c_bo']!="") {
		echo "<tr><td width = \"200\">";
		echo "Birth Order";
		echo "</td><td width = \"400\">";
		Print_r($_SESSION['c_bo']);
		echo "</td></tr>";
	} else {
		echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
		echo "<b>Birth Order:</b> ";
		echo "</td><td width = \"400\">";
		echo " Data unspecified";
		echo "</td></tr>";
		}
	}
	echo "</table></div>";
?>
