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

if(!isset($_SESSION['search_select'])) {
header("location:searchdata.php");
   die("Authentication required, redirecting");
}
$id_search = $_SESSION['search_select'];
$query_search_results =  $mysqli->query("SELECT * FROM response WHERE id = $id_search");
$row = $query_search_results->fetch_assoc();
$_SESSION['previous'] = 'searchdataresults.php';
$regexp = "/duke*/";
$regexp1 = "/cd_*/";
$regexp2 = "/self_*/";
$regexp3 = "/value*/"; //chronic health stuff.
$regexp4 = "/phq_*/";
$regexp5 = "/adhd_*/";
    foreach($row as $key=>$value){
        if ((!preg_match($regexp, $key)) && (!preg_match($regexp1, $key)) && (!preg_match($regexp2, $key)) && (!preg_match($regexp3, $key))&& (!preg_match($regexp4, $key))&& (!preg_match($regexp5, $key))) { //exclude the duke responses from the zeroing.
            if ($value == '-1'){
                $row[$key] = 0;
            }
        }
    }
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>A_
           <?php echo $row['date'] ?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Brief Adult Assessment">
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
                            <h1>Past Result Data Sheet</h1>
                        </center>
                        </div><!-- div title end -->
                        <center>                        
                            <?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
                        </center>
                    </div><!-- div header end -->
                </div><!-- end div top -->  
<?php
///////////////////////////////////////////////////Printing starts here////////////////////////////


     echo "<table border=\"1\" width=\"800\">"; //Printing a magical 14!?
     echo "<th bgcolor = \"D8D8D8\" width = \"800\" colspan=\"2\"><font size = \"6\"><center>Demographic Information</center></font></th>";

     if ($row['first_name']!= '') 
     { 
       echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
       echo "<b>First Name: </b>";
       echo "</td><td width = \"400\">";
     //Print_r($row['first_name']);
       echo "Encrypted Data";
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

     if ($row['last_name']!= '') 
     { 
     echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
     echo "<b>Last Name: </b>";
     echo "</td><td width = \"400\">";
     //Print_r($row['last_name']);
     echo "Encrypted Data";
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


     if ($row['pt_id']!= '') 
     { 
     echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">";
     echo "<b>Patient ID: </b>";
     echo "</td><td width = \"400\">";
     //Print_r($row['pt_id']);
     echo "Encrypted Data";
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

      if ($row['dob']!= '')  
     { 
     echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
     echo "<b>Date of Birth:</b> ";
     echo "</td><td width = \"400\">";
     Print_r($row['dob']);
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

     if ($row['zip']!= '') 
     {
     echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
     echo "<b>Zip:</b> ";
     echo "</td><td width = \"400\">";
     Print_r($row['zip']);
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

     if ($row['sex']!= '')  
     { 
     echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
     echo "<b>Sex:</b> ";
      echo "</td><td width = \"400\">";
     Print_r($row['sex']);
     echo "</td></tr>";
     }
     else
     {
     echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
     echo "<b>Sex:</b>";
     echo "</td><td width = \"400\">";
     echo " Data unspecified.";
     echo "</td></tr>";
     }

     if ($row['eth']!= '')  
     {
     echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
     echo "<b>Ethnicity:</b> ";
     echo "</td><td width = \"400\">";
     Print_r($row['eth']);
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
   
     if ($row['m_status']!= '')  
     { 
     echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
     echo "<b>Marital Status:</b> ";
     echo "</td><td width = \"400\">";
     Print_r($row['m_status']);
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

     if ($row['ed']!= '')  
     {
     echo "<tr bgcolor=\"#FAFAFA\"><td width = \"200\">"; 
     echo "<b>Education:</b> ";
     echo "</td><td width = \"400\">";
     Print_r($row['ed']);
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

     if ($row['living']!= '')  
     { 
     echo "<tr bgcolor=\"#D8D8D8\"><td width = \"200\">";
     echo "<b>Living</b> ";
     echo "</td><td width = \"400\">";
     Print_r($row['living']);
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

     echo "</table>";

require_once 'stressors.php';
require_once 'childStressors.php';
require_once 'presenting_problem.php';
require_once 'current_stress.php';
require_once 'health.php';
require_once 'events.php';
require_once 'gad.php';
require_once 'gad-2.php';
require_once 'phq.php';
require_once 'audit.php';
require_once 'cage.php';
require_once 'cd.php';
require_once 'pcl.php';
require_once 'psc.php';
require_once 'ces_d.php';
require_once 'dast.php';
require_once 'duke.php';
require_once 'self.php';
require_once 'sdq.php';
require_once 'pcl-2.php';
require_once 'crafft.php';
require_once 'life.php';
require_once 'adhd.php';
require_once 'hypertension.php';


$sex = $row['sex'];

    echo "<table border=\"1\" width=\"800\"><br><br>";
    echo "<th><center><h2>Scoring for assessment</h2></center></th>";
    echo "</table>";

if ($row['self_check'] ==1){
    self_scoring($row, $mysqli);
} 
if ($row['stress_check'] ==1){
    stressors_scoring($row, $mysqli);
}
if ($row['cd_check'] == 1){
    cd_scoring($row['assessment_type'],$row, $mysqli);
}
if ($row['gad_check'] == 1){
    gad_scoring($row);  
}
if ($row['gad2_check'] == 1){
    gad2_scoring($row);  
}
if ($row['phq_check'] == 1){
    phq_scoring($row, $mysqli);
}
if ($row['psc_check'] == 1){
    psc_scoring($row, $mysqli);
}
if ($row['audit_check'] == 1){
    audit_scoring($row, $sex, $mysqli);
}
if ($row['cage_check'] == 1){
    cage_scoring($row, $mysqli);
}
if ($row['pcl_check'] == 1){
    pcl_scoring($row, $mysqli);
}
if ($row['crafft_check'] == 1){
    crafft_scoring($row, $mysqli);
}
if ($row['pcl2_check'] == 1){
    pcl2_scoring($row, $mysqli);
}
if ($row['ces_check'] == 1){
    ces_d_scoring($row, $mysqli);
}
if ($row['dast_check'] == 1){
    dast_scoring($row, $mysqli);
}
if ($row['duke_check'] == 1){
    duke_scoring($row, $mysqli);
}
if ($row['sdq_check'] == 1){
    sdq_scoring($row, $mysqli);
}
if ($row['life_check'] ==1){
    life_scoring($row, $mysqli);
}
if ($row['adhd_check'] ==1){
    adhd_scoring($row, $mysqli);
}
if ($row['hypertension_check'] ==1){
    hypertension_scoring($row, $mysqli);
}

if(isset($row['phq_9'])||isset($row['life_1'])||(isset($row['life_2'])))
{
        if(($row['phq_9'] > 0)||($row['life_1']>0)||($row['life_2']>0))
        {
        echo '<h2><p style = "color: red; text-align: left"><b>
        Previous suicide consultation was recommended.
        </b></p></h2>';      
        }
}
echo "<br>";

    /////////////////////////////////////Printing our stressors////////////////////////////////////////
    if(True)
    {
    $n = 1;
    $temp = "";
    $first = 0;   
    $count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'stressor'");
    $count_no = $count->fetch_assoc();
    if ($row['assessment_type'] == 'Child'){
        pp_scoring($row, $mysqli);
        stressors_scoring($row, $mysqli);
    }
    while($n <= $count_no['num'])
    {
        if($row['s_' .$n] > 0)
        {
            $first++;
            if($first == 1)
            {
                echo "<br><b>The patient has stress due to:</b> "; 
                echo "<br>";
            }
            $result = $mysqli->query("SELECT question from questions where classification = 'stressor' and Sub_ID =  $n");
            $row2 = $result->fetch_assoc();
            if ($n != 30){ //question 30 is a special case. see stressors for children.
                echo $row2['question'];
                echo "<br/>";
            }
            }
        $n++;
    } 
    if (($row['assessment_type'] == 'Child') && ($row['s_30'] != "")){
        echo "<b>The child noted the following stressful event:</b> ".$row['s_30']."<br>";
    }
    
    }
    if ($row['diagnosis_check']==1) {
    $n = 1;
    $first = 0;
    $count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'Diagnosis'");
    $count_no = $count->fetch_assoc();
    while ($n <= $count_no['num']) {   
            $first++;
            if (($first == 1)&&(($row['diagnosis_1'] >0)||($row['diagnosis_2'] >0)||($row['diagnosis_3'] >0)||($row['diagnosis_4'] >0)||
                    ($row['diagnosis_5'] >0)||($row['diagnosis_6'] >0)||($row['diagnosis_7'] >0)||($row['diagnosis_8'] >0)||($row['diagnosis_9'] >0)||($row['diagnosis_10'] >0))) {
                echo "<br/>";
                echo "<b>The patient noted the following diagnoses.</b> ";
                echo "<br/>";
            }
            $result = $mysqli->query("SELECT question from questions where classification = 'Diagnosis' and Sub_ID =  $n");
            $row2 = $result->fetch_assoc();
            if ($row['diagnosis_' . $n] > 0){ //affirmative
                echo ' <span style = "color: red;">';
                echo $row2['question'] . "</span>";
                if ($row['diagnosis_' . $n . "_3"] != 0) {
                    echo ". The patient additionally noted the following level of discomfort or stress associated with the diagnosis: " . $row['diagnosis_' . $n . "_3"] . "<br>";
                }             
            }     
        $n++;
    }
    echo "<br/>";
}

    if ($row['diag_me_check']==1) {
    $n = 1;
    $first = 0;
    $count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'Diag_me'");
    $count_no = $count->fetch_assoc();
    while ($n <= $count_no['num']) {   
            $first++;
            if (($first == 1)&&(($row['diag_me_1'] >0)||($row['diag_me_2'] >0)||($row['diag_me_3'] >0)||($row['diag_me_4'] >0)||
                    ($row['diag_me_5'] >0)||($row['diag_me_6'] >0)||($row['diag_me_7'] >0)||($row['diag_me_8'] >0)||($row['diag_me_9'] >0)||($row['diagnosis_10'] >0))) {
                echo "<br/>";
                echo "<b>The patient noted the following MH/BH diagnoses.</b> ";
                echo "<br/>";
            }
            $result = $mysqli->query("SELECT question from questions where classification = 'Diag_me' and Sub_ID =  $n");
            $row2 = $result->fetch_assoc();
            if ($row['diag_me_' . $n] > 0){ //affirmative
                echo ' <span style = "color: red;">';
                echo $row2['question'] . "</span>";
                if ($row['diag_me_' . $n . "_3"] > 0) {
                    echo ". The patient additionally noted the following level of discomfort or stress associated with the diagnosis: " . $row['diag_me_' . $n . "_3"] . "<br>";
                }             
            }     
        $n++;
    }
    echo "<br/>";
}
    //////////////////////////////////Print our life events////////////////////////////////////////////////
    if(true)
    {
    $n = 1;
    $first = 0;
    $count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'event'");
    $count_no = $count->fetch_assoc();
    
    while($n <= $count_no['num'])
    {   
        if($row['e_' .$n] > 0)
        {
            $first++;
            if($first == 1)
            {
                echo "<br><b>The patient has been through the following events:</b> "; 
                echo "<br>";
            }
            $result = $mysqli->query("SELECT question from questions where classification = 'event' and Sub_ID =  $n");
            $row2 = $result->fetch_assoc();
            echo $row2['question'];
            echo "<br/>";
        }
        $n++;
    }
    }   

//////////////////////////////////Print our symptoms////////////////////////////////////////////////
    if(true)
    {
    $n = 1;
    $first = 0;
    $count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'symptom'");
    $count_no = $count->fetch_assoc();
    
    while($n <= $count_no['num'])
    {   
        if($row['symptom_' .$n] > 0)
        {
            $first++;
            if($first == 1)
            {
                echo "<br>";
                echo "<b>The patient lists experiencing the following symptoms:</b> "; 
                echo "<br>";
            }
            $result = $mysqli->query("SELECT question from questions where classification = 'symptom' and Sub_ID =  $n");
            $row2 = $result->fetch_assoc();
            echo $row2['question'];
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
            echo "<br>";
        }
        $n++;
    }
    
    }   

    //////////////////////////////////Print our health////////////////////////////////////////////////
    if(true)
    {
    $n = 1;
    $first = 0;
    $count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'Health'");
    $count_no = $count->fetch_assoc();
    
    while($n <= $count_no['num'])
    {   
        if($row['h_' .$n] > 0)
        {
            $first++;
            if($first == 1)
            {
                echo "<br>";
                echo "<b>The patient answered affirmative to the following health questions:</b> "; 
                echo "<br>";
            }
            $result = $mysqli->query("SELECT question from questions where classification = 'Health' and Sub_ID =  $n");
            $row2 = $result->fetch_assoc();
            echo $row2['question'];
            echo "<br>";
        }
        $n++;
    }
    } 
    

score_chronic_health($row);
score_questions($row);    
?>

<!-- Javascript function for printing the page. -->
<script>
                function printpage()
                {
                    window.print();
                }
</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>
            Past Result Sheet
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Brief Adult Assessment">
        <link rel="stylesheet" href="mystyle.css" type="text/css">
    </head>

    <br><br>
    <p style = "color: red; text-align: center"><b>Warning: once you click these links, you will not be able to return.</b></p>
    
    <center><input type="submit" value="Assessment" style= "height: 25px; width: 100px" onclick="window.location='clinic.php'" /> 
    <input type="submit" value="Search" style= "height: 25px; width: 100px" onclick="window.location='searchdata.php';" /> 
    <input type="button" style= "height: 25px; width: 100px" value="Print this page" onclick="printpage()" /> </center>

        <footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
        <center><a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"><img src="images/GRHOP.png" style="border:solid; border-color:black;" width="100" height="100" alt="G.R.H.O.P"></a></center>
