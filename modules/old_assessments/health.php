<!--Carrots are good for your health-->
<?php
	function write_health($type, $mysqli)
	{
  	if ($mysqli->connect_errno)
	{
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();
	}

	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")) {
			$query = 'SELECT * FROM questions WHERE classification="HEALTH" AND '.$type.'=1 ORDER BY ordering';
		}
	else {
		exit();
		}


	if($result = $mysqli->query($query))
	{

		if($result->num_rows > 0)
		{
			if ($type==="Child")
			{
				echo "<br><hr>";
				echo "<h1><center>Current Health</center></h1>\n
				<p><center>Please indicate if any of these current health trends are true for your child. (Mark all that apply.)</center></p>\n
				<div id=\"health\">\n
				<table border=\"1\" id=\"health\">\n";
			}
			else
			{
				echo "<br><hr>";
				echo "<h1><center>Current Health.</center></h1>\n
				<p><center>Please indicate if any of these current health trends are true. (Mark all that apply.)</center></p>\n
				<div id=\"health\">\n
				<table border=\"1\" id=\"health\">\n";
			}

			if ($result)
			{ //we got a result from the query
				while($row = $result->fetch_assoc())
				{
					echo "<td class=\"event\" width = \"800\">" . $row['question'] ."</td><td class=\"event_input\" width = \"50\">\n<center><input type=\"checkbox\" name=\"h_" . $row['Sub_ID'] . "\" value=\"". $row['Sub_ID'] ."
					\" style=\"vertical-align: bottom\"/></center></td></tr>\n";
					$_SESSION["h_" . $row['Sub_ID']] = "-1";
					//$c++;
				}
				echo "</table><!-- end table_health -->\n</div><!-- end div health -->\n<br><br>\n";
			}
		}

	}
	};

			 function score_chronic_health_reviewAssessment($a) {
				 	$a['valueA1C'] = $a['chronicHealth_A1C_value'];
					$a['A1CDate'] = $a['chronicHealth_A1C_date'];
					$a['valueEAG'] = $a['chronicHealth_eAG_value'];
					$a['eAGDate'] = $a['chronicHealth_eAG_date'];
					$a['valueLDL'] = $a['chronicHealth_cholesterol_LDL'];
					$a['valueHDL'] = $a['chronicHealth_cholesterol_HDL'];
					$a['cholestoralDate'] = $a['chronicHealth_cholesterol_date'];
					$a['valueSYS'] = $a['chronicHealth_bloodPressure_systolic'];
					$a['valueDIA'] = $a['chronicHealth_bloodPressure_diastolic'];
					$a['bpDate'] = $a['chronicHealth_bloodPressure_date'];
					$a['valueHeight'] = $a['chronicHealth_physical_height'];
					$a['valueWeight'] = $a['chronicHealth_physical_weight'];
					$a['physicalDate'] = $a['chronicHealth_physical_date'];

					score_chronic_health($a);
					// Testing

			 }

			 $a[''] = $a[''];function score_chronic_health($a) {

           //if this function is called after via a search, we need to convert the -1 stored in the database to "NA" for scoring.
           //if this function is called by insert.php the values presented will be "NA" for no response.


           if  ($a['valueA1C'] === "-1" || $a['valueA1C'] == 0){
               $a['valueA1C'] = "NA";
           }
           if  ($a['valueEAG'] === "-1" || $a['valueEAG'] == 0){
               $a['valueEAG'] = "NA";
           }
           if  ($a['valueLDL'] === "-1" || $a['valueLDL'] == 0){
               $a['valueLDL'] = "NA";
           }
           if  ($a['valueHDL'] === "-1" || $a['valueHDL'] == 0){
               $a['valueHDL'] = "NA";
           }
           if  ($a['valueSYS'] === "-1" || $a['valueSYS'] == 0){
               $a['valueSYS'] = "NA";
           }
           if  ($a['valueDIA'] === "-1" || $a['valueDIA'] == 0){
               $a['valueDIA'] = "NA";
           }
           if  ($a['valueWeight'] === "-1" || $a['valueWeight'] == 0){
               $a['valueWeight'] = "NA";
           }
           if  ($a['valueHeight'] === "-1" || $a['valueHeight'] == 0){
               $a['valueHeight'] = "NA";
           }

           // mask out the default dates in the database.
           if ($a['A1CDate'] === "0000-00-00"){
               $a['A1CDate'] = "";
           }
           if ($a['eAGDate'] === "0000-00-00"){
               $a['eAGDate'] = "";
           }
           if ($a['cholestoralDate'] === "0000-00-00"){
               $a['cholestoralDate'] = "";
           }
           if ($a['bpDate'] === "0000-00-00"){
               $a['bpDate'] = "";
           }
           if ($a['physicalDate'] === "0000-00-00"){
               $a['physicalDate'] = "";
           }



           if(($a['valueA1C'] !== "NA") || ($a['A1CDate'] !== "") || ($a['valueEAG'] !== "NA") || ($a['eAGDate'] !== "")
           ||($a['valueLDL'] !== "NA")||($a['valueHDL'] !== "NA")||($a['cholestoralDate'] !== "")
           ||($a['valueSYS'] !== "NA")||($a['valueDIA'] !== "NA") ||($a['bpDate'] !== "")
           ||($a['valueHeight'] !== "NA")||($a['valueWeight'] !== "NA")||($a['physicalDate'] !== "")) {

						echo "<div style='margin-bottom: 40px;'>";
            echo "<h3>Chronic Care</h3>";
						echo "<table border='1'>";
						echo "<thead><tr>";
						echo "<th>Category</th><th>Measures</th><th>Date</th>";
						echo "</tr></thead>";
						echo "<tbody>";
            if (($a['valueA1C'] !== "NA")||($a['valueEAG'] !== "NA")) {
                     if ($a['valueA1C'] !== "NA") {
											 	 echo "<tr><td>Diabetes</td>";
                         echo "<td>A1C: ";
                         echo $a['valueA1C'] . "%</td><td style='text-align:center;'>" . $a['A1CDate'] . "</td></tr>";
                     }
                    if ($a['valueEAG'] !== "NA") {
												echo "<tr><td>Diabetes</td>";
                        echo "<td>eAG: ";
                        echo $a['valueEAG'] . " mg/dL</td><td style='text-align:center;'>"  . $a['eAGDate'] . "</td></tr>";
                    }
            }

            if (($a['valueLDL'] !== "NA")||($a['valueHDL'] !== "NA")) {
                echo "<tr><td>Cholestoral</td><td>";

                     if ($a['valueLDL'] !== "NA") {
                          echo "LDL: ";
                         echo $a['valueLDL'] . " mg/dL, ";
                     }

                    if ($a['valueHDL'] !== "NA") {
                        echo "HDL: ";
                        echo $a['valueHDL'] . " mg/dL";
                    }
                    echo "</td><td style='text-align:center;'>"  . $a['cholestoralDate'] . "</td></tr>";
            }

            if (($a['valueSYS'] !== "NA")&&($a['valueDIA'] !== "NA")){
                echo "<tr><td>Blood Pressure</td><td>";
                echo "Systolic: ";
                echo $a['valueSYS'] . ", ";
                echo "Diastolic: ";
                echo $a['valueDIA'];
                echo " (" . $a['valueSYS'] . "/" . $a['valueDIA'] . " mm/Hg)";
                echo "</td><td style='text-align:center;'>" . $a['bpDate'] . "</td></tr>";
            }

            if (($a['valueHeight'] != "NA")||($a['valueWeight'] != "NA")) {
                echo "<tr><td>Physical</td><td>";
                     if ($a['valueHeight'] !== "NA") {
                          echo "Height: ";
                         echo $a['valueHeight'] . " in., ";
                     }
                    if ($a['valueWeight'] !== "NA") {
                        echo "Weight: ";
                        echo $a['valueWeight'] . " lbs.";
                    }
                    echo "</td><td style='text-align:center;'>"  . $a['physicalDate'] . "</td></tr>";

            }

						echo "</tbody></table></div>";

        }
    }

			 function score_questions_reviewAssessment($a){
				 $a['q2'] = $a['outsideVisits_emergencyRoom'];
				 $a['er_visit_date'] = $a['outsideVisits_emergencyRoom_visitDate'];
				 $a['er_visit_reason'] = $a['outsideVisits_emergencyRoom_reasonForVisit'];
				 $a['er_visit_other'] = $a['outsideVisits_emergencyRoom_otherReasonForVisit'];
				 $a['q1'] = $a['outsideVisits_hospital_nonER'];
				 $a['hospital_visit_date'] = $a['outsideVisits_hospital_nonER_dischargeDate'];
				 $a['hospital_visit_reason'] = $a['outsideVisits_hospital_nonER_reasonForVisit'];
				 $a['hospital_visit_other'] = $a['outsideVisits_hospital_nonER_otherReasonForVisit'];
				 $a['q3'] = $a['outsideVisits_other'];
				 $a['office_visit_date'] = $a['outsideVisits_other_visitDate'];
				 $a['office_visit_reason'] = $a['outsideVisits_other_reasonForVisit'];
				 $a['office_visit_other'] = $a['outsideVisits_other_otherReasonForVisit'];
				score_questions($a);
			 }

       function score_questions($a){

          // print_r($a);
           if (($a['q1'] == "yes")||($a['q2'] == "yes")||($a['q3'] == "yes")){
						 	echo "<div style='margin-bottom: 40px;'>";
            	echo "<h3>Outside Visits</h3>";
							echo "<p><i>Since last visit patient has been admitted to...</i></p>";
							echo "<table border='1'>";
							echo "<thead><tr><th>Provider</th><th>Reason</th><th>Date</th></thead>";
							echo "<tbody>";
              if ($a['q1'] == "yes"){
									 echo "<tr>";
                   echo "<td>Hospital (non-ER)</td>";
                    echo "<td>";
                    if ($a['hospital_visit_reason'] === 'Other'){
                        echo "Other: " . $a['hospital_visit_other'] . "</td>";
                    } else if ($a['hospital_visit_reason'] != "Nothing Selected"){
                        echo $a['hospital_visit_reason'] . "</td>";
                    }
										echo "<td style='text-align:center;'>" . $a['hospital_visit_date'] . "</td>";
                    echo "</tr>";
               }
               if ($a['q2'] == "yes"){
								 	 echo "<tr>";
                   echo "<td>Emergency Room (ER)</td>";
                    echo "<td>";
                    if ($a['er_visit_reason'] === 'Other'){
                        echo "Other: " . $a['er_visit_other'] . "</td>";
                    } else if ($a['er_visit_reason'] != "Nothing Selected"){
                        echo $a['er_visit_reason'] . "</td>";
                    }
										echo "<td style='text-align:center;'>" . $a['er_visit_date'] . "</td>";
                    echo "</tr>";
               }
               if ($a['q3'] == "yes"){
								 	 echo "<tr>";
                   echo "<td>Another Medical Provider</td>";
                    echo "<td>";
                    if ($a['office_visit_reason'] === 'Other'){
                        echo "Other: " . $a['office_visit_other'] . "</td>";
                    } else if ($a['office_visit_reason'] != "Nothing Selected"){
                        echo $a['office_visit_reason'] . "</td>";
                    }
										echo "<td style='text-align:center;'>" . $a['office_visit_date'] . "</td>";
                    echo "</tr></tbody>";
               }
						 echo "</table></div>";

           }

       }

?>
