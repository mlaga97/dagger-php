<!--Carrots are good for your health-->
<?php
	function write_health($type, $mysqli)
	{
  	if ($mysqli->connect_errno)
	{
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();
	}

	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="HEALTH" AND '.$type.'=1 ORDER BY ordering';
		}
	else{
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
				echo "</table><!-- end table_health -->\n</div><!-- end div health -->\n";
			}
		}

	}
	};

			 function score_chronic_health_reviewAssessment($a){
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
					$a['valueHeight'] = $a['chronicHealth_physical_height '];
					$a['valueWeight'] = $a['chronicHealth_physical_weight'];
					$a['physicalDate'] = $a['chronicHealth_physical_date'];

					score_chronic_health($a);
					// Testing

			 }
			 chronicHealth_eAG_value
  ;
	$a[''] = $a[''];     function score_chronic_health($a){

           //if this function is called after via a search, we need to convert the -1 stored in the database to "NA" for scoring.
           //if this function is called by insert.php the values presented will be "NA" for no response.


           if  ($a['valueA1C'] === "-1"){
               $a['valueA1C'] = "NA";
           }
           if  ($a['valueEAG'] === "-1"){
               $a['valueEAG'] = "NA";
           }
           if  ($a['valueLDL'] === "-1"){
               $a['valueLDL'] = "NA";
           }
           if  ($a['valueHDL'] === "-1"){
               $a['valueHDL'] = "NA";
           }
           if  ($a['valueSYS'] === "-1"){
               $a['valueSYS'] = "NA";
           }
           if  ($a['valueDIA'] === "-1"){
               $a['valueDIA'] = "NA";
           }
           if  ($a['valueWeight'] === "-1"){
               $a['valueWeight'] = "NA";
           }
           if  ($a['valueHeight'] === "-1"){
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

            echo "<br/>";
            echo "<center><b>Chronic Care Responses</b></center>";
            echo "<br?";
            if (($a['valueA1C'] !== "NA")||($a['valueEAG'] !== "NA")){
                echo "Diabetes Responses<br>";
                     if ($a['valueA1C'] !== "NA"){
                         echo "A1C value: ";
                         echo $a['valueA1C'] . "%, Date of test: " . $a['A1CDate'] . "<br>";
                     }
                    if ($a['valueEAG'] !== "NA"){
                        echo "eAG value: ";
                        echo $a['valueEAG'] . " mg/dl, Date of test: "  . $a['eAGDate'] . "<br>";
                    }
                echo "<br/>";
            }

            if (($a['valueLDL'] !== "NA")||($a['valueHDL'] !== "NA")){
                echo "Cholestoral Responses<br>";

                     if ($a['valueLDL'] !== "NA"){
                          echo "LDL value: ";
                         echo $a['valueLDL'] . " mg/dl, ";
                     }

                    if ($a['valueHDL'] !== "NA"){
                        echo "HDL value: ";
                        echo $a['valueHDL'] . " mg/dl, ";
                    }
                    echo " Date of test: "  . $a['cholestoralDate'] . "<br>";
                    echo "<br/>";
            }

            if (($a['valueSYS'] !== "NA")&&($a['valueDIA'] !== "NA")){
                echo "Blood Pressure Responses<br>";
                echo "Systolic value: ";
                echo $a['valueSYS'] . ", ";
                echo "Diastolic value: ";
                echo $a['valueDIA'];
                echo " (" . $a['valueSYS'] . "/" . $a['valueDIA'] . " mm/Hg), ";
                echo " Date of test: " . $a['bpDate'] . "<br>";
                echo "<br/>";
            }

            if (($a['valueHeight'] != "NA")||($a['valueWeight'] != "NA")){
                echo "Physical Responses<br>";
                     if ($a['valueHeight'] !== "NA"){
                          echo "Height value: ";
                         echo $a['valueHeight'] . "\", ";
                     }
                    if ($a['valueWeight'] !== "NA"){
                        echo "Weight value: ";
                        echo $a['valueWeight'] . " lbs., ";
                    }
                    echo " Date of test: "  . $a['physicalDate'] . "<br>";
                    echo "<br>";
            }

        }
       }

       function score_questions($a){

          // print_r($a);
           if (($a['q1'] == "yes")||($a['q2'] == "yes")||($a['q3'] == "yes")){

            echo "<br/>";
            echo "<center><b>Outside Visits Responses</b></center>";
            echo "<br/>";
               if ($a['q1'] == "yes"){
                   echo "The client answered affirmative to: \"Since your last visit have you been in the hospital?\"<br>";
                    echo "Date of hospital visit: " . $a['hospital_visit_date'] . "<br>";
                    echo "Reason for the hospital visit: ";
                    if ($a['hospital_visit_reason'] === 'Other'){
                        echo $a['hospital_visit_other'] . "<br>";
                    } else if ($a['hospital_visit_reason'] != "Nothing Selected"){
                        echo $a['hospital_visit_reason'] . "<br>";
                    }
                    echo "<br>";
               }
               if ($a['q2'] == "yes"){
                   echo "The client answered affirmative to: \"Since your last visit have you been in the Emergency Room?\"<br>";
                    echo "Date of emergency room visit: " . $a['er_visit_date'] . "<br>";
                    echo "Reason for the emergency room visit: ";
                    if ($a['er_visit_reason'] === 'Other'){
                        echo $a['er_visit_other'] . "<br>";
                    } else if ($a['er_visit_reason'] != "Nothing Selected"){
                        echo $a['er_visit_reason'] . "<br>";
                    }
                    echo "<br>";
               }
               if ($a['q3'] == "yes"){
                   echo "The client answered affirmative to: \"Since your last visit have you been to the another medical provider?\"<br>";
                    echo "Date of provider visit: " . $a['office_visit_date'] . "<br>";
                    echo "Reason for the provider visit: ";
                    if ($a['office_visit_reason'] === 'Other'){
                        echo $a['office_visit_other'] . "<br>";
                    } else if ($a['office_visit_reason'] != "Nothing Selected"){
                        echo $a['office_visit_reason'] . "<br>";
                    }
                    echo "<br>";
               }

           }

       }
?>
