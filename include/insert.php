<?php
session_start();

require_once('log4php/Logger.php');
Logger::configure('log4php/config.xml');
$log = Logger::getLogger('myLogger');
date_default_timezone_set('America/Chicago');$today = date('m-d-y h:i:s');

foreach($_POST as $key=>$value)
{ 
if (($key != 'status') && ($key != 'previous'))
	{
		$_SESSION[$key] = $value;
	}
}
//print_r($_SESSION);

if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized'   ||
	$_SESSION['previous'] != 'submit.php' ||
	!array_key_exists('n1', $_SESSION)    ||
    !array_key_exists('n2', $_SESSION)    ||
    !array_key_exists('n3', $_SESSION)    ||
    !array_key_exists('n4', $_SESSION)    )
	{
		header("location:../index.php");
		die("Authentication required, redirecting");
	}

$_SESSION['previous'] = 'insert.php';
//print_r($_SESSION);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>
			Assessment Evaluation
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Assessment Evaluation">
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
							<h1>Assessment Evaluation</h1>
						</center>
						</div><!-- div title end -->
						<center>						
							<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
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

	include 'stressors.php';
        include 'presenting_problem.php';
	include 'events.php';
	include 'health.php';
	include 'cd.php';
	include 'gad.php';
	include 'phq.php';
	include 'audit.php';
	include 'cage.php';	
	include 'pcl.php';
	include 'psc.php';
	include 'ces_d.php';
	include 'dast.php';
 	include 'duke.php';
        include 'self.php';
        include 'sdq.php';
        include 'pcl-2.php';
        include 'gad-2.php';
        include 'crafft.php';
        include 'life.php';
        include 'adhd.php';
	include 'hypertension.php';
	include 'pediatric.php';
 
   	 ////////////////This is where we will print our strings for our results page////////////////////////////
        if ($_SESSION['grouping']== 10){ echo '<div id="demo_table" <?php style="display: none;">';} else {echo ' <div id="demo_table">';}
	 echo "<table border=\"1\" width=\"800\">"; //Printing a magical 14!?
	 echo "<th bgcolor = \"D8D8D8\" width = \"800\" colspan=\"2\"><font size = \"6\"><center>Demographic Information</center></font></th>";


	 if ($_SESSION['first_name']!= '')  
	 { 
	 echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
	 echo "<b>First Name: </b>";
	 echo "</td><td width = \"400\">";
     Print_r($_SESSION['first_name']);
     echo "</td></tr>";
	 }
	 else
	 {
	 echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
	 echo "<b>First Name:</b>";
	 echo "</td><td width = \"400\">";
	 echo " Data unspecified.";
	 echo "</td></tr>";
	 }

   	 if ($_SESSION['last_name']!= '')  
	 { 
	 echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
	 echo "<b>Last Name: </b>";
	 echo "</td><td width = \"400\">";
     Print_r($_SESSION['last_name']);
     echo "</td></tr>";
	 }
	 else
	 {
	 echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
	 echo "<b>Last Name:</b>";
	 echo "</td><td width = \"400\">";
	 echo " Data unspecified.";
	 echo "</td></tr>";
	 }


	 if ($_SESSION['pt_id']!= '')  
	 { 
	 echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
	 echo "<b>Patient ID: </b>";
	 echo "</td><td width = \"400\">";
     Print_r($_SESSION['pt_id']);
     echo "</td></tr>";
	 }
	 else
	 {
	 echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
	 echo "<b>Patient ID:</b>";
	 echo "</td><td width = \"400\">";
	 echo " Data unspecified.";
	 echo "</td></tr>";
	 }

	  if ($_SESSION['dob']!= '')  
	 { 
	 echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
	 echo "<b>Date of Birth:</b> ";
	 echo "</td><td width = \"400\">";
     Print_r($_SESSION['dob']);
     echo "</td></tr>";
	 }
	 else
	 {
	 echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
	 echo "<b>Date of Birth:</b>";
	 echo "</td><td width = \"400\">";
	 echo " Data unspecified.";
	 echo "</td></tr>";
	 }

        
     if ($_SESSION['zip']!= '')  
	 {
	 echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
	 echo "<b>Zip:</b> ";
	 echo "</td><td width = \"400\">";
     Print_r($_SESSION['zip']);
     echo "</td></tr>";
	 }
	 else
	 {
	 echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
	 echo "<b>Zip:</b>";
	 echo "</td><td width = \"400\">";
	 echo " Data unspecified.";
	 echo "</td></tr>";
	 }

     if ($_SESSION['sex']!= '')  
	 { 
	 echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
	 echo "<b>Sex:</b> ";
	  echo "</td><td width = \"400\">";
     Print_r($_SESSION['sex']);
     echo "</td></tr>";
	 }
	 else
	 {
	 echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
	 echo "<b>Sex:</b>";
	 echo "</td><td width = \"400\">";
	 echo " Data unspecified.";
	 echo "</td></tr>";;
	 }

	 if ($_SESSION['eth']!= '')  
	 {
	 echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
	 echo "<b>Ethnicity:</b> ";
	 echo "</td><td width = \"400\">";
     Print_r($_SESSION['eth']);
     echo "</td></tr>";
	 }
	 else
	 {
	 echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
	 echo "<b>Ethnicity:</b>";
	 echo "</td><td width = \"400\">";
	 echo " Data unspecified.";
	 echo "</td></tr>";
	 }
   
     if ($_SESSION['m_status']!= '') 
	 { 
	 echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
	 echo "<b>Marital Status:</b> ";
	 echo "</td><td width = \"400\">";
     Print_r($_SESSION['m_status']);
     echo "</td></tr>";
	 }
	 else
	 {
	 echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
	 echo "<b>Marital Status:</b>";
	 echo "</td><td width = \"400\">";
	 echo " Data unspecified.";
	 echo "</td></tr>";
	 }

	 if ($_SESSION['ed']!= '')  
	 {
	 echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
	 echo "<b>Education:</b> ";
	 echo "</td><td width = \"400\">";
     Print_r($_SESSION['ed']);
     echo "</td></tr>";
	 }
	 else
	 {
	 echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
	 echo "<b>Education:</b>";
	 echo "</td><td width = \"400\">";
	 echo " Data unspecified.";
	 echo "</td></tr>";
	 }

	 if ($_SESSION['living']!= '')  
	 { 
	 echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
	 echo "<b>Living</b> ";
	 echo "</td><td width = \"400\">";
         Print_r($_SESSION['living']);
         echo "</td></tr>";
	 }
	 else
	 {
	 echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
	 echo "<b>Living:</b>";
	 echo "</td><td width = \"400\">";
	 echo " Data unspecified.";
	 echo "</td></tr>";
	 }
         
         if ($_SESSION['assessment_type'] == 'Child'){
            if ($_SESSION['c_bo']!=""){
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

	
	////////////////////////////////////////This is where we are doing our calculations/////////////////////

	//we'll make a copy of the values saved in $_SESSION and set all '-1' values to 0 so we can do the cut-off calculations.
	//except the duke and the cd-risc. They need to keep the -1 values for scoring.
	$copy = $_SESSION;
	$regexp = "/duke*/";
	$regexp1 = "/cd_*/";
        $regexp2 = "/self_*/";
        $regexp3 = "/phq_*/";
	foreach($copy as $key=>$value)
	{
		if ((!preg_match($regexp, $key)) && (!preg_match($regexp1, $key)) && (!preg_match($regexp2, $key)) && (!preg_match($regexp3, $key))){ //exclude the duke and cd-risc responses from the zeroing.
			if ($value == '-1')
			{
				$copy[$key] = 0;
			}
		}
	}
	
	////////////////////////////////////////These are where we score our tests/////////////////////
	
	echo "<table border=\"1\" width=\"800\">";
	echo "<th><center><h2>Scoring for assessment</h2></center></th>";
        echo "</table>";

        if (($_SESSION['assessment_type'] == 'Child')&&($_SESSION['pp'] != "")){ //we need to do presenting problem.
            pp_scoring($_SESSION, $mysqli);
            stressors_scoring($_SESSION, $mysqli);
        }
	if($_SESSION['stress_check'] == 1)
	{
	stressors_scoring($copy, $mysqli);
	}

        if($_SESSION['self_check'] == 1)
	{
	self_scoring($copy, $mysqli);
	}
       
	if($_SESSION['cd_check'] == 1)
	{
	cd_scoring($_SESSION['assessment_type'], $copy, $mysqli);
	}

	if($_SESSION['gad_check'] == 1)
	{
	gad_scoring($copy, $mysqli);
	}
        
        if($_SESSION['gad2_check'] == 1)
	{
	gad2_scoring($copy, $mysqli);
	}

	if($_SESSION['phq_check'] == 1)
	{
	phq_scoring($copy, $mysqli);
	}

	if($_SESSION['psc_check'] == 1)
	{
	psc_scoring($copy, $mysqli);
	}

	if($_SESSION['audit_check'] == 1)
	{
	$sex = $_SESSION['sex'];
	audit_scoring($copy, $sex, $mysqli);
	}

	if($_SESSION['cage_check'] == 1)
	{
	cage_scoring($copy, $mysqli);
	}

	if($_SESSION['pcl_check'] == 1)
	{
	pcl_scoring($copy, $mysqli);
	}
        
        if($_SESSION['pcl2_check'] == 1)
	{
	pcl2_scoring($copy, $mysqli);
	}
        
        if($_SESSION['crafft_check'] == 1)
	{
	crafft_scoring($copy, $mysqli);
	}

	if($_SESSION['ces_check'] == 1)
	{
	ces_d_scoring($copy, $mysqli);
	}

	if($_SESSION['dast_check'] == 1)
	{
	dast_scoring($copy, $mysqli);
	}

	if($_SESSION['duke_check'] == 1)
	{
	duke_scoring($copy, $mysqli);
	}
        
        if($_SESSION['sdq_check'] == 1)
	{
	sdq_scoring($copy, $mysqli);
        }
        if($_SESSION['life_check'] == 1)
	{
	life_scoring($copy, $mysqli);
	}
        if($_SESSION['adhd_check'] == 1)
	{
	adhd_scoring($copy, $mysqli);
	}
        if($_SESSION['hypertension_check'] == 1)
	{
	hypertension_scoring($copy, $mysqli);
	}
        if($_SESSION['pediatric_check'] == 1)
	{
	pediatric_scoring($copy, $mysqli);
	}

	////////////////////////////////////Checks to see first if the phq-9 was published, second to see if they are at risk for suicide////////////
        $alert=false;
        if (isset($_SESSION['phq_check']) && ($_SESSION['phq_check']>0))
        {
                if ($_SESSION['phq_9']>0)
                {
                         $alert=true;
                }
        }
        if(isset($_SESSION['life_check'])&&($_SESSION['life_check']>0))
        {
                if(($_SESSION['life_1']>0)||($_SESSION['life_2']>0))
                {
                         $alert=true;
                }
        }
        if ($alert)
        {
                echo '<h2><p style = "color: red; text-align: left"><b>
                Warning, suicide consultation needed.
                </b></p></h2>';
                echo "<br>";
        }        
	/////////////////////////////////////Printing our stressors////////////////////////////////////////
	if(($_SESSION['stress_check'] == 1)||($_SESSION['assessment_type'] == 'Child'))
	{
	$n = 1;
	$first = 0;
	echo "<br/>";
	$count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'stressor'");
	$count_no = $count->fetch_assoc();
	while($n <= $count_no['num'])
	{
                if (isset($_SESSION['s_' .$n])){
                if(($_SESSION['s_' .$n] > -1) && ($n!=30)) //stressor 30 is a special case.
                {
                        $first++;
                        if($first == 1)
                        {
                                echo "<b>The patient has stress due to:</b> ";
                                echo "<br/>";
                        }
                        $result = $mysqli->query("SELECT question from questions where classification = 'stressor' and Sub_ID =  $n");
                        $row = $result->fetch_assoc();
                        echo $row['question'];
                        echo "<br/>";
                }}
                $n++;
        }
	echo "<br>";
        
        $temp = $_SESSION['s_30'];
        if (($_SESSION['assessment_type']=='Child')&&($_SESSION['s_30']!="")){
            echo "<b>The child noted the following stressful event:</b> ".$_SESSION['s_30']."<br>";
        }
        
	}

	//////////////////////////////////Print our life events////////////////////////////////////////////////
	if($_SESSION['events_check'] == 1)
	{
	$n = 1;
	$first = 0;
	$count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'event'");
	$count_no = $count->fetch_assoc();
	while($n <= $count_no['num'])
	{	
		if($_SESSION['e_' .$n] > -1)
		{
			$first++;
			if($first == 1)
			{
				echo "<b>The patient has been through the following events:</b> "; 
				echo "<br/>";
			}
			$result = $mysqli->query("SELECT question from questions where classification = 'event' and Sub_ID =  $n");
			$row = $result->fetch_assoc();
			echo $row['question'];
			echo "<br/>";
		}
		$n++;
	}
	echo "<br>";
	}	


        //////////////////////////////////Print our symptoms////////////////////////////////////////////////
	if($_SESSION['symptom_check'] == 1 || $_SESSION['assessment_type'] == 'Child')
	{
	$n = 1;
	$first = 0;
	$count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'symptom'");
	$count_no = $count->fetch_assoc();
	while($n <= $count_no['num'])
	{	
		if($_SESSION['symptom_' .$n] > -1)
		{
			$first++;
			if($first == 1)
			{
				echo "<br/>";
				echo "<b>The patient lists experiencing the following symptoms:</b> "; 
				echo "<br/>";
			}
			$result = $mysqli->query("SELECT question from questions where classification = 'symptom' and Sub_ID =  $n");
			$row = $result->fetch_assoc();
			echo $row['question'];
			switch ($_SESSION['symptom_' .$n]){
				case 0:
				echo ": Not bothered at all";
				break;
				case 1:
				echo ": Bothered a little";
				break;
				case 2:
				echo ": Bothered a lot";
				break;
			}
			echo "<br/>";
		}
		$n++;
	}
	echo "<br>";
	}	

	//////////////////////////////////Print our symptoms////////////////////////////////////////////////
if ($_SESSION['diagnosis_check'] == 1) {   
    $n = 1;
    $first = 0;
    $count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'Diagnosis'");
    $count_no = $count->fetch_assoc();
    while ($n <= $count_no['num']) {   
       
            $first++;
            if (($first == 1)&&(($_SESSION['diagnosis_1'] >0)||($_SESSION['diagnosis_2'] >0)||($_SESSION['diagnosis_3'] >0)||($_SESSION['diagnosis_4'] >0)||
                    ($_SESSION['diagnosis_5'] >0)||($_SESSION['diagnosis_6'] >0)||($_SESSION['diagnosis_7'] >0)||($_SESSION['diagnosis_8'] >0)||($_SESSION['diagnosis_9'] >0)||($_SESSION['diagnosis_10'] >0))) {
                echo "<br/>";
                echo "<b>The patient noted the following diagnoses. If the diagnosis is red, the patient stated the diagnosis was a reason for the office visit today. Discomfort scale is 0-4 (none to overwhelming)</b> ";
                echo "<br/>";
            }
            $result = $mysqli->query("SELECT question from questions where classification = 'Diagnosis' and Sub_ID =  $n");
            $row = $result->fetch_assoc();
            echo "";
            if ($_SESSION['diagnosis_' . $n] > 0){ //affirmative
                echo ' <span style = "color: red;">';
                echo $row['question'] . "</span>";
                if ($_SESSION['diagnosis_' . $n . "_3"] != 0) {
                    echo ". The patient additionally noted the following level of discomfort or stress associated with the diagnosis: " . $_SESSION['diagnosis_' . $n . "_3"];
                }
                echo "<br/>";
            }     
        $n++;
    }
}

if ($_SESSION['diag_me_check'] == 1) {   
    $n = 1;
    $first = 0;
    $count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'Diag_me'");
    $count_no = $count->fetch_assoc();
    while ($n <= $count_no['num']) {   
       
            $first++;
            if (($first == 1)&&(($_SESSION['diag_me_1'] >0)||($_SESSION['diag_me_2'] >0)||($_SESSION['diag_me_3'] >0)||($_SESSION['diag_me_4'] >0)||
                    ($_SESSION['diag_me_5'] >0)||($_SESSION['diag_me_6'] >0)||($_SESSION['diag_me_7'] >0)||($_SESSION['diag_me_8'] >0)||($_SESSION['diag_me_9'] >0)||($_SESSION['diag_me_10'] >0))) {
                echo "<br/>";
                echo "<b>The patient noted the following diagnoses. Discomfort scale is 0-4 (none to overwhelming)</b> ";
                echo "<br/>";
            }
            $result = $mysqli->query("SELECT question from questions where classification = 'Diag_me' and Sub_ID =  $n");
            $row = $result->fetch_assoc();
            echo "";
            if ($_SESSION['diag_me_' . $n] > 0){ //affirmative
                echo ' <span style = "color: red;">';
                echo $row['question'] . "</span>";
                if ($_SESSION['diag_me_' . $n . "_3"] > 0) {
                    echo ". The patient additionally noted the following level of discomfort or stress associated with the diagnosis: " . $_SESSION['diag_me_' . $n . "_3"];
                }
                echo "<br/>";
            }     
        $n++;
    }
}

if ($_SESSION['grouping'] !== 10){
score_chronic_health($_SESSION);
score_questions($_SESSION);
}
	//////////////////////////////////Print our chronic health responses////////////////////////////////////////////////
/*
    if  (($_SESSION['valueA1C'] != "") || ($_SESSION['A1CDate'] != "") || ($_SESSION['valueEAG'] != "") || ($_SESSION['eAGDate'] != "")
           ||($_SESSION['valueLDL'] != "")||($_SESSION['valueHDL'] != "")||($_SESSION['cholestoralDate'] != "")
           ||($_SESSION['valueSYS'] != "")||($_SESSION['valueDIA'] != "") ||($_SESSION['bpDate'] != "") 
           ||($_SESSION['valueHeight'] != "")||($_SESSION['valueWeight'] != "")||($_SESSION['physicalDate'] != "")) {   
          
            echo "<br/>";
            echo "<center><b>Chronic Care Responses</b></center>";
            echo "<br/>";
            if (($_SESSION['valueA1C'] != "")||($_SESSION['valueEAG'] != "")){
                echo "Diabetes Responses<br>";  
                     if ($_SESSION['valueA1C'] != ""){
                         echo "A1C value: ";
                         echo $_SESSION['valueA1C'] . "%, Date of test: " . $_SESSION['A1CDate'] . "<br>";
                     }
                    if ($_SESSION['valueEAG'] != ""){
                        echo "eAG value: ";
                        echo $_SESSION['valueEAG'] . " mg/dl, Date of test: "  . $_SESSION['eAGDate'] . "<br>";
                    }
                echo "<br/>";    
            }
            
            if (($_SESSION['valueLDL'] != "")||($_SESSION['valueHDL'] != "")){
                echo "Cholestoral Responses<br>";
               
                     if ($_SESSION['valueLDL'] != ""){
                          echo "LDL value: ";
                         echo $_SESSION['valueA1C'] . " mg/dl, ";
                     }
                
                    if ($_SESSION['valueHDL'] != ""){
                        echo "HDL value: ";
                        echo $_SESSION['valueEAG'] . " mg/dl, ";  
                    }
                    echo " Date of test: "  . $_SESSION['cholestoralDate'] . "<br>";
                    echo "<br/>";
            }
            
            if (($_SESSION['valueSYS'] != "")||($_SESSION['valueDIA'] != "")){
                echo "Blood Pressure Responses<br>";                     
                echo "Systolic value: ";
                echo $_SESSION['valueSYS'] . ", ";
                echo "Diastolic value: ";
                echo $_SESSION['valueDIA'];
                echo " (" . $_SESSION['valueSYS'] . "/" . $_SESSION['valueDIA'] . " mm/Hg, ";
                echo " Date of test: " . $_SESSION['bpDate'] . "<br>";
                echo "<br/>";
            }
            
            if (($_SESSION['valueHeight'] != "")||($_SESSION['valueWeight'] != "")){
                echo "Physical Responses<br>";               
                     if ($_SESSION['valueHeight'] != ""){
                          echo "Height value: ";
                         echo $_SESSION['valueHeight'] . "\", ";
                     }                
                    if ($_SESSION['valueWeight'] != ""){
                        echo "Weight value: ";
                        echo $_SESSION['valueWeight'] . " lbs., ";  
                    }
                    echo " Date of test: "  . $_SESSION['physicalDate'] . "<br>";
                    echo "<br>";
            }
            
        }
 */  



///////////////Additional Coding///////////////////////////////////////////////////////////////////////////////

	// Do the other side of pediatric.php
	// TODO: Much of this could be moved into the bitmask library.
	$pediatric_bitmask_fields = array("HLS_FH_Diab", "HLS_FH_HBP", "HLS_FH_HD", "HLS_FH_Overwt");
	foreach($pediatric_bitmask_fields as $field_name) {
		$sum = 0;

		$sum += $_SESSION[$field_name . '-1'];
		$sum += $_SESSION[$field_name . '-2'];
		$sum += $_SESSION[$field_name . '-3'];
		$sum += $_SESSION[$field_name . '-4'];
		$sum += $_SESSION[$field_name . '-5'];
		$sum += $_SESSION[$field_name . '-6'];
		
		unset($_SESSION[$field_name . '-1']);
		unset($_SESSION[$field_name . '-2']);
		unset($_SESSION[$field_name . '-3']);
		unset($_SESSION[$field_name . '-4']);
		unset($_SESSION[$field_name . '-5']);
		unset($_SESSION[$field_name . '-6']);
		
		$_SESSION[$field_name] = $sum;
	}


    //Convert the strings to the mysql default format.
    //YYYY-MM-DD
    // Prevent the chronic health stuff from being reported.
        if ($_SESSION['A1CDate']!==""){
        $_SESSION['A1CDate'] = date("Y-m-d", strtotime($_SESSION['A1CDate']));
        }
        if ($_SESSION['eAGDate']!==""){
        $_SESSION['eAGDate'] = date("Y-m-d", strtotime($_SESSION['eAGDate']));
        }
        if ($_SESSION['bpDate']!==""){
        $_SESSION['bpDate'] = date("Y-m-d", strtotime($_SESSION['bpDate']));
        }
        if ($_SESSION['physicalDate']!==""){
        $_SESSION['physicalDate'] = date("Y-m-d", strtotime($_SESSION['physicalDate']));
        }
        if ($_SESSION['cholestoralDate']!==""){
        $_SESSION['cholestoralDate'] = date("Y-m-d", strtotime($_SESSION['cholestoralDate']));
        }
        if ($_SESSION['hospital_visit_date']!==""){
        $_SESSION['hospital_visit_date'] = date("Y-m-d", strtotime($_SESSION['hospital_visit_date']));
        }
        if ($_SESSION['er_visit_date']!==""){
        $_SESSION['er_visit_date'] = date("Y-m-d", strtotime($_SESSION['er_visit_date']));
        }
        if ($_SESSION['office_visit_date']!==""){
        $_SESSION['office_visit_date'] = date("Y-m-d", strtotime($_SESSION['office_visit_date']));
        }
        //Convert any "NA" responses in the chronic health questions to -1.

        if ($_SESSION['valueA1C'] === "NA"){
            $_SESSION['valueA1C']= '-1';
        }
        if ($_SESSION['valueEAG'] === "NA"){
            $_SESSION['valueEAG']= '-1';
        }
        if ($_SESSION['valueHDL'] === "NA"){
            $_SESSION['valueHDL']= '-1';
        }
        if ($_SESSION['valueLDL'] === "NA"){
            $_SESSION['valueLDL']= '-1';
        }
        if ($_SESSION['valueSYS'] === "NA"){
            $_SESSION['valueSYS']= '-1';
        }
        if ($_SESSION['valueDIA'] === "NA"){
            $_SESSION['valueDIA']= '-1';
        }
        if ($_SESSION['valueHeight'] === "NA"){
            $_SESSION['valueHeight']= '-1';
        }
        if ($_SESSION['valueWeight'] === "NA"){
            $_SESSION['valueWeight']= '-1';
        }
    
	$keys = "(id,";
	$values = "(0, ";
	foreach($_SESSION as $key=>$value) { 	//We want to insert the values contained in $_SESSION not $copy. 
											//Allowing a '-1' to be inserted will notify us that the pt did not respond to the question.
			//if (($key != 'st')         && ($key != 'status')     && ($key != 'id')           &&($key != 'logo')          && ($key != 'n1')           && ($key != 'n2') //took out st, so if it barfs, we'll leave it in. 
			//&& ($key != 'n3')          && ($key != 'n4')         && ($key != 'stress_check') && ($key != 'health_check') && ($key != 'events_check') && ($key != 'gad_check') && ($key != 'phq_check')
			//&& ($key != 'audit_check') && ($key != 'cage_check') && ($key != 'cd_check')     && ($key != 'pcl_check')    && ($key != 'ces_check')    && ($key != 'previous')  && ($key != 'GRHOP_standard')
			//&& ($key != 'admin') && ($key != 'dast_check') && ($key != 'duke_check') && ($key != 'psc_check') && ($key != 'c_p_id')&& ($key != 'symptom_check') && ($key != 'self_check')) 
			
			if (($key != 'st')  && ($key != 'status') && ($key != 'id') &&($key != 'logo') && ($key != 'n1') && ($key != 'n2')  //took out st, so if it barfs, we'll leave it in. 
			&& ($key != 'n3')  && ($key != 'n4') && ($key != 'GRHOP_standard') && ($key != 'admin') && ($key != 'c_p_id')       //throw st away. I can't figure out where this is comming from in adult.php.
                        && ($key != 'previous') && ($key != 'search_select') && ($key != 'university_id')&& ($key != 'grouping') 
                        && ($key != 'contact_date') && ($key != 'entry_date') && ($key != 'contact_outcome') 
                        && ($key != 'outcome_other') && ($key != 'contact_reason') && ($key != 'reason_other') && ($key != 'test_acc'))
			{ 													
			$keys = $keys .   $key . " ,";

			if($key == 'pt_id' || $key == 'first_name' || $key == 'last_name') 				// Here we are setting the name and pt_id to password.
			{
				$value = strtolower($value);
				$value = hash('sha256', $value);
				//$values = $values . " sha1('" . $value . "'),";
				$values = $values . " '" . $value . "',";
				//hash('sha224',$info_store)
			}
			else
			{
                            if ((($key === 'A1CDate')|| ($key === 'eAGDate') ||($key === 'cholestoralDate') ||
                                ($key === 'bpDate')||($key === 'physicalDate') || ($key === 'hospital_visit_date')||
                                ($key === 'er_visit_date') || ($key === 'office_visit_date')||($key === 'assessment_date')) && ($value === '')){
                                $values = $values ." '" . "0000-00-00" . "',";
                            } else {
				$values = $values . " '" . $value . "',";
                            }
			}
                        
		}
	}
	$keys = $keys . "date)";
	$values = $values . "NOW())";
	$query = "insert into response $keys values $values";

        if ($_SESSION['grouping'] !=10){ //grouping = 10 means the user is logged in as a CFHC employee. We are not keeping their data only scoring assessments.
            $result = $mysqli->query($query);
            $insert_id = $mysqli->insert_id;
            $_SESSION['insert_id'] = $insert_id;
        }
	
	//print_r($_SESSION);
        //echo $query;
        
        if ($_SESSION['grouping'] ==10){ //see note above.
            $log->info("INSERT LOG: " . $today ." response.id: CFHC non-insert ". $_SESSION['user_id'] ." ". $query);
        } else{
            $log->info("INSERT LOG: " . $today ." response.id: " .$insert_id. " ". $_SESSION['user_id'] ." ". $query);         
        }
	
//unset($_SESSION);
	
?>
</center>
<center><input type="button" value="Return to Start" style= "height: 25px; width: 100px" onclick="window.location='../index.php';" />
    <?php if ($_SESSION['grouping'] != 10){echo "<input type=\"button\" value=\"Edit Personal Data\" style= \"height: 25px; width: 125px\" onclick=\"window.location=\'edit.php\';\"/>";} ?>
	<!-- <input type="button" value="Edit Personal Data" style= "height: 25px; width: 125px" onclick="window.location='edit.php';"/> -->
	<input type="button" style= "height: 25px; width: 100px" value="Print this page" onclick="printpage()" /></center>
<footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
<center><a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"><img src="images/GRHOP.png" style="border:none;max-width:100%;" width="100" alt="G.R.H.O.P"></a></center>
</div>	
</body>
</html>

</html>
