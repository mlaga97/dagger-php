<?php
session_start();          //This starts our session.
require_once('Mysql.php');
require_once 'constants.php';
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

//Here, we are checking to see if the user is authorized. $_SESSION['status'] is a variable that is set if the user successfully logs in. This functionality can be seen in
//If the user is not authorized, we will re-locate them to our starting page.
require_once('log4php/Logger.php');
Logger::configure('log4php/config.xml');
$log = Logger::getLogger('myLogger');
date_default_timezone_set('America/Chicago');$today = date('m-d-y h:i:s');

if (!isset($_SESSION['status']) || $_SESSION['status'] != 'authorized') {
//if ($_SESSION['status']   != 'authorized'  ||	$_SESSION['previous'] != 'options.php')	
    header("location:../index.php");
    die("Authentication required, redirecting");
}
$log->info("CLINICS LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". print_r($_SESSION, true));
$_SESSION['previous'] = 'clinic.php';
//print_r($_SESSION);

foreach ($_SESSION as $key => $value) {
    if (($key != 'user_id') && ($key != 'clinic_id') && ($key != 'admin') && ($key != 'university_id') && ($key != 'grouping') && ($key != 'logo') &&
            ($key != 'status') && ($key != 'previous') && ($key != 'test_acc')) {
        unset($_SESSION[$key]);
    }
}
//print_r($_SESSION);
?>


<!--The following page will be used  as the clinic select page. -->
<!-- HTML Start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>
            Options
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Clinic Select">
        <link rel="stylesheet" href="mystyle.css" type="text/css">
        <script type="text/javascript">

// gets the values from the radio buttons	

function formSubmit(form)
{
    var checked = false, radios = document.getElementsByName("clinic_id");
    for (var i = 0, radio; radio = radios[i]; i++)
    {
        if (radio.checked)
        {
            checked = true;
            break;
        }
    }
    if (!checked)
    {
        alert("Please select a clinic.");
        return false;
    }

    var checked = false, radios = document.getElementsByName("assessment_type");
    for (var i = 0, radio; radio = radios[i]; i++)
    {
        if (radio.checked)
        {
            checked = true;
            break;
        }
    }
    if (!checked)
    {
        alert("Please select an assessment type.");
        return false;
    }
    
        var checked = false, radios = document.getElementsByName("contact_type");
    for (var i = 0, radio; radio = radios[i]; i++)
    {
        if (radio.checked)
        {
            checked = true;
            break;
        }
    }
    if (!checked)
    {
        alert("Please select an contact type.");
        return false;
    }
    return true;
}

function clearForm()
{
    document.getElementById('form1').reset();
}
	</script>
</head>

<body onload="clearForm();"><form id="form1" action="adult.php" method="post" >
        
<?php
include 'menu.php';
write_menu();
?>
<div id="container">
    <div id="top">
        <div id="logo">
<?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
        </div><!-- div logo end -->
    <div id="header">
        <div id="title">
            <center>
                <h1>Assessment Options Selection</h1>
            </center>
        </div><!-- div title end -->
        <center>						
<?php
date_default_timezone_set('America/Chicago');
$today = date('l jS \of F Y h:i:s A');
print_r($today);
?>
        </center>
                    </div><!-- div header end -->
                </div><!-- end div top -->			
                <br>
                <br>
                <br>

                <?php
                require_once'constants.php';
                $mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

                if ($mysqli->connect_errno) {
                    printf("Connect failed: %s\n", $mysqli->connect_error);
                    exit();
                }
                $clinic_select = $mysqli->query('SELECT clinic_id from groups where user_id = ' . $_SESSION['user_id']);
                if ($clinic_select) {

                    echo "<table border=\"1\" width=\"800\"><tr><td colspan = \"2\"><h3><b> Please select your clinic. </b></h3><br></td></tr>\n";
                    
                    while ($row = $clinic_select->fetch_assoc()) {
                        $clinic_name = $mysqli->query('SELECT name from clinic where id = ' . $row['clinic_id']);
                        $row2 = $clinic_name->fetch_assoc();

                        echo "<tr><td>" . $row2['name'] . " </td><td><center><input type=\"radio\" name =\"clinic_id\" value=\"" . $row['clinic_id'] . "\"/></center></td></tr>\n";
                        //$_SESSION['clinic_id'] = $row['clinic_id'];
                    }
                } else {
                    echo "Query error!";
                }
                echo "</table>";
                ?>
                <?php
                $_SESSION['stress_check'] = 0;
                $_SESSION['c_stress_check'] = 0;
                $_SESSION['pp_check'] = 0;
                $_SESSION['events_check'] = 0;
                $_SESSION['health_check'] = 0;
                $_SESSION['symptom_check'] = 0;
                $_SESSION['gad_check'] = 0;
                $_SESSION['phq_check'] = 0;
                $_SESSION['audit_check'] = 0;
                $_SESSION['cage_check'] = 0;
                $_SESSION['cd_check'] = 0;
                $_SESSION['pcl_check'] = 0;
                $_SESSION['psc_check'] = 0;
                $_SESSION['ces_check'] = 0;
                $_SESSION['dast_check'] = 0;
                $_SESSION['GRHOP_standard'] = 0;
                $_SESSION['duke_check'] = 0;
                $_SESSION['self_check'] = 0;
                $_SESSION['gad2_check'] = 0;
                $_SESSION['life_check'] = 0;
                $_SESSION['crafft_check'] = 0;
                $_SESSION['pcl2_check'] = 0;
                $_SESSION['sdq_check'] = 0;
                $_SESSION['diagnosis_check'] = 0;
                $_SESSION['diag_me_check'] = 0;
                $_SESSION['adhd_check'] = 0;
                $_SESSION['hypertension_check'] = 0;
                $_SESSION['pediatric_check'] = 0;
                ?>

                <!--These will be our check boxes for our page.-->

                <script type="text/javascript">

                    function getRadioValue(groupName) {
                        var radios = document.getElementsByName(groupName);
                        window.rdValue = null;
                        for (var i = 0; i < radios.length; i++) {
                            var aRadio = radios[i];
                            if (aRadio.checked) {
                                var foundCheckedRadio = aRadio;
                                rdValue = foundCheckedRadio.value;
                                break;
                            }
                            else {
                                rdValue = 'noRadioChecked';
                            }
                        }
                        if (rdValue === 'noRadioChecked') {
                            alert("Please select an assessment type.");
                        }
                        return rdValue;
                    }

                    function check(type)
                    {
                        var a_type = getRadioValue('assessment_type'); //This gets the values of the radio button for assessment type. It also alerts if no type is selected.
                        uncheck();
                        if (type === 'grhop' && a_type === 'Adult') {
                            document.getElementById("stress_check").checked = true;
                            document.getElementById("events_check").checked = true;
                            document.getElementById("health_check").checked = true;
                            document.getElementById("gad_check").checked = true;
                            document.getElementById("phq_check").checked = true;
                            document.getElementById("audit_check").checked = true;
                            document.getElementById("cage_check").checked = true;
                            document.getElementById("cd_check").checked = true;
                            document.getElementById("pcl_check").checked = true;
                            document.getElementById("ces_check").checked = true;
                        } else if (type === 'grhop' && a_type === 'Adolescent') {
                        } else if (type === 'whandoff' && a_type === 'Child') {
                            document.getElementById("c_stress_check").checked = true;
                            document.getElementById("pp_check").checked = true;
                            document.getElementById("health_check").checked = true;
                        } else if (type === 'ms_ax' && a_type === 'Adult') {
                            document.getElementById("stress_check").checked = true;
                            document.getElementById("events_check").checked = true;
                            document.getElementById("health_check").checked = true;
                            document.getElementById("gad_check").checked = true;
                            document.getElementById("phq_check").checked = true;
                            document.getElementById("audit_check").checked = true;
                            document.getElementById("dast_check").checked = true;
                        } else if (type === 'ms_ax' && a_type === 'Adolescent') {
                        } else if (type === 'ms_ax' && a_type === 'Child') {
                        } else if (type === 'ms_fu' && a_type === 'Adult') {
                            document.getElementById("gad_check").checked = true;
                            document.getElementById("phq_check").checked = true;
                        } else if (type === 'ms_fu' && a_type === 'Adolescent') {
                        } else if (type === 'ms_fu' && a_type === 'Child') {
                        } else if (type === 'alabama_partial' && a_type === 'Adult') {
                            document.getElementById("stress_check").checked = true;
                            document.getElementById("gad_check").checked = true;
                            document.getElementById("phq_check").checked = true;
                            document.getElementById("audit_check").checked = true;
                        } else if (type === 'alabama_partial' && a_type === 'Adolescent') {
                            document.getElementById("gad2_check").checked = true;
                            document.getElementById("stress_check").checked = true;
                            document.getElementById("psc_check").checked = true;
                            document.getElementById("symptom_check").checked = true;
                            document.getElementById("crafft_check").checked = true;
                        } else if (type === 'alabama_partial' && a_type === 'Child') {
                            document.getElementById("sdq_check").checked = true;
                        } else if (type === 'alabama_complete' && a_type === 'Adult') {
                            document.getElementById("stress_check").checked = true;
                            document.getElementById("gad_check").checked = true;
                            document.getElementById("phq_check").checked = true;
                            document.getElementById("audit_check").checked = true;
                            document.getElementById("cd_check").checked = true;
                            document.getElementById("pcl_check").checked = true;
                            document.getElementById("symptom_check").checked = true;
                            document.getElementById('diagnosis_check').checked = true;
                        } else if (type === 'alabama_complete' && a_type === 'Adolescent') {
                            document.getElementById("stress_check").checked = true;
                            document.getElementById("gad2_check").checked = true;
                            document.getElementById("psc_check").checked = true;
                            document.getElementById("cd_check").checked = true;
                            document.getElementById("life_check").checked = true;
                            document.getElementById("pcl2_check").checked = true;
                            document.getElementById("phq_check").checked = true;
                            document.getElementById("symptom_check").checked = true;
                            document.getElementById("crafft_check").checked = true;
                        } else if (type === 'alabama_complete' && a_type === 'Child') {
                            document.getElementById("sdq_check").checked = true;
                            document.getElementById("stress_check").checked = true;
                            document.getElementById("pcl2_check").checked = true;
                            document.getElementById("cd_check").checked = true;
                            document.getElementById("life_check").checked = true;
                        }
                    }


                    function uncheck(type)
                    {
                        document.getElementById("sdq_check").checked = false;
                        document.getElementById("stress_check").checked = false;
                        document.getElementById("c_stress_check").checked = false;
                        document.getElementById("pp_check").checked = false;
                        document.getElementById("events_check").checked = false;
                        document.getElementById("health_check").checked = false;
                        document.getElementById("gad_check").checked = false;
                        document.getElementById("phq_check").checked = false;
                        document.getElementById("audit_check").checked = false;
                        document.getElementById("cage_check").checked = false;
                        document.getElementById("cd_check").checked = false;
                        document.getElementById("pcl_check").checked = false;
                        document.getElementById("ces_check").checked = false;
                        document.getElementById("symptom_check").checked = false;
                        document.getElementById("self_check").checked = false;
                        document.getElementById("dast_check").checked = false;
                        document.getElementById("duke_check").checked = false;
                        document.getElementById("psc_check").checked = false;
                        document.getElementById("gad2_check").checked = false;
                        document.getElementById("life_check").checked = false;
                        document.getElementById("crafft_check").checked = false;
                        document.getElementById("pcl2_check").checked = false;
                        document.getElementById("diagnosis_check").checked = false;
                        document.getElementById("diag_me_check").checked = false;
                        document.getElementById("adhd_check").checked = false;
                        document.getElementById("hypertension_check").checked = false;
                        document.getElementById("pediatric_check").checked = false;
                    }

                    function show(rad, q)
                    {
                        var rads = document.getElementsByName(rad.name);

                        document.getElementById(q).style.display = (rads[1].checked) ? 'none' : 'block';
                        document.getElementById(q).style.display = (rads[0].checked) ? 'block' : 'none';
                        document.getElementById(q).style.display = (rads[2].checked) ? 'none' : 'block';
                    }

                    function show2(rad, q)
                    {
                        var rads = document.getElementsByName(rad.name);

                        document.getElementById(q).style.display = (rads[0].checked) ? 'block' : 'none';
                        document.getElementById(q).style.display = (rads[1].checked) ? 'block' : 'none';
                        document.getElementById(q).style.display = (rads[2].checked) ? 'block' : 'none';
                        document.getElementById(q).style.display = (rads[3].checked) ? 'block' : 'none';
                        document.getElementById(q).style.display = (rads[4].checked) ? 'block' : 'none';
                    }


                </script>
                <br>
                <?php
                if ($_SESSION['grouping'] === 2 || $_SESSION['grouping'] === 6 || $_SESSION['grouping'] === 10) { //ms grhop and coastal's employees
                    echo
                    "<table border=\"1\" width = \"800\" id=\"table_select_assessment\"><td>
                    <h3> Please select an assessment type.</h3>
                    <br>
                    <div title=\"Ages 19+ years of age.\">
                    <label><input  id=\"_type\" input type=\"radio\" name=\"assessment_type\" value=\"Adult\" /> Adult </label>
                    </div> 
                    <div title=\"Ages 4-13 years of age.\" >
                    <label><input id=\"_type\" input type=\"radio\" name=\"assessment_type\" value=\"Child\" /> Child </label>
                    </div>
                    <br>
                    </td></table>";
                } else {
                    echo
                    "<table border=\"1\" width = \"800\" id=\"table_select_assessment\"><td>
                    <h3> Please select an assessment type.</h3>
                    <br>
                    <div title=\"Ages 19+ years of age.\">
                    <label><input  id=\"_type\" input type=\"radio\" name=\"assessment_type\" value=\"Adult\" /> Adult </label>
                    </div>
                    
                    <div title=\"Ages 14-18 years of age.\" >
                    <label><input id=\"_type\" input type=\"radio\" name=\"assessment_type\" value=\"Adolescent\" /> Adolescent </label>
                    </div>
                    
                    <div title=\"Ages 4-13 years of age.\" >
                    <label><input id=\"_type\" input type=\"radio\" name=\"assessment_type\" value=\"Child\" /> Child </label>
                    </div>
                    <br>
            </td></table>";
                }
                echo "<br><table border=\"1\" width = \"800\" id=\"table_contact_type\"><td>
                    <h3> Please select a patient contact type.</h3>
                    <br>
                    <div title=\"Group\">
                    <label><input  id=\"contact_type\" input type=\"radio\" name=\"contact_type\" value=\"group\" ;\"/>Group</label>
                    </div>
                    <div title=\"Phone_Call\">
                    <label><input  id=\"contact_type\" input type=\"radio\" name=\"contact_type\" value=\"phone call\" ;\"/>Phone Call</label>
                    </div>
                    <div title=\"Pt_assistance\">
                    <label><input  id=\"contact_type\" input type=\"radio\" name=\"contact_type\" value=\"patient assistance\" ;\"/>Patient Assistance</label>
                    </div>
                    <div title=\"Out_Of_Clinic\">
                    <label><input  id=\"contact_type\" input type=\"radio\" name=\"contact_type\" value=\"out of clinic\" ;\"/>Out of Clinic Visit</label>
                    </div>
                    <div title=\"Face_To_Face\">
                    <label><input  id=\"contact_type\" input type=\"radio\" name=\"contact_type\" value=\"face to face\" ;\"/>Face to Face Visit</label>
                    </div>
                    <br>
            </td></table>";
                /*       echo "<br><table border=\"1\" width = \"800\" id=\"table_visit_type\"><td>
                  <h3> Please select a visit type.</h3>
                  <br>

                  <div title=\"Comprehensive visit to include MH/BH assessments\">
                  <label><input  id=\"_visit_type\" input type=\"radio\" name=\"visit_type\" value=\"Comprehensive\" onclick=\"show(this,'assessment_selection');check('ms_ax');\"/> Initial Visit</label>
                  </div>
                  <div title=\"A follow-up visit without assessments.\" >
                  <label><input id=\"_visit_type\" input type=\"radio\" name=\"visit_type\" value=\"Follow-up\" onclick=\"show(this,'assessment_selection');check('ms_fu');\"/> Follow-up w/ assessment</label>
                  </div>
                  <div title=\"A Brief follow-up visit without assessments.\" >
                  <label><input id=\"_visit_type\" input type=\"radio\" name=\"visit_type\" value=\"Brief\" onclick=\"show(this,'assessment_selection');uncheck('brief')\"/> Follow-up w/o assessment</label>
                  </div>

                  <br>
                  </td></table> </div>"; */
                echo
                "<br><div id=\"visit_type\" style=\"display: block;\"><table border=\"1\" width = \"800\" id=\"table_visit_type\"><td>
                    <h3> Please select a visit type.</h3>
                    <br>
                    
                    <div title=\"Comprehensive visit to include MH/BH assessments\">
                    <label><input  id=\"_visit_type\" input type=\"radio\" name=\"visit_type\" value=\"initial\" onclick=\"show(this,'assessment_selection');uncheck('initial')\"/> Initial Visit</label>
                    </div>
                    <div title=\"A follow-up visit without assessments.\" >
                    <label><input id=\"_visit_type\" input type=\"radio\" name=\"visit_type\" value=\"follow-up\" onclick=\"show(this,'assessment_selection');uncheck('followup')\"/> Follow-up w/ assessment</label>
                    </div> 
                    <div title=\"A Brief follow-up visit without assessments.\" >
                    <label><input id=\"_visit_type\" input type=\"radio\" name=\"visit_type\" value=\"brief\" onclick=\"show(this,'assessment_selection');uncheck('brief')\"/> Follow-up w/o assessment</label>
                    </div>
                    <br>
            </td></table> </div>";
                ?>
                <br><div id="assessment_selection" style="display: none;">
                    <table border="1" width = "800" id="table_test_check"><td>
                            <h3> Please select from the following list of assessment instruments. Hover cursor over a selection to see details.</h3>
                            <i>If an assessment instrument is not selected, it will be shown.</i><br><br>
                            <?php
                            // Current Grouping is as follows:
                            // 1. is for MS test accounts.
                            // 2. is for the MS GRHOP
                            // 3. is for AL test account.
                            // 4. is for FL test account.
                            // 5. is for LA test account.
                            // 6. is for FNP
                            // 7. is for Student Life Success Program.
                            //******This needs to be moved into the database.*********//
                            //The various menus should be customized and read from the database and displayed based upon how the user logs in.

                            if ($_SESSION['grouping'] == 1) { //groupong = 1 is for test accounts.
                                echo "
                    <div title=\"This section contains questions pertaining to the Strengths and Difficulties Questionnaire (SDQ). It is a brief behavioural screening questionnaire about 3-16 year olds.\">
                        <label><input id=\"sdq_check\" input type=\"checkbox\" name=\"sdq_check\" value=\"1\" /> SDQ        </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's diabetes self-care behavior.\">
                        <label><input id=\"self_check\" input type=\"checkbox\" name=\"self_check\" value=\"1\" /> Self-care        </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
                        <label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" /> Stress         </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
                        <label><input id=\"c_stress_check\" input type=\"checkbox\" name=\"c_stress_check\" value=\"1\" /> Child Stressors      </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's presenting problem.\">
                        <label><input id=\"pp_check\" input type=\"checkbox\" name=\"pp_check\" value=\"1\" /> Presenting Problem      </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
                        <label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" /> Diagnosis         </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
                        <label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" /> MH Diagnosis         </label>
                    </div>
                    <div title=\"This section contains questions about what major life events the client has experienced.\">
                        <label><input id=\"events_check\" input type=\"checkbox\" name=\"events_check\" value=\"1\" /> Events         </label>
                    </div>
                     <div title=\"This section contains questions life attitudes.\">
                        <label><input id=\"life_check\" input type=\"checkbox\" name=\"life_check\" value=\"1\" /> Life Attitudes         </label>
                    </div>
                     <div title=\"This section contains the Crafft substance abuse questions.\">
                        <label><input id=\"crafft_check\" input type=\"checkbox\" name=\"crafft_check\" value=\"1\" /> Crafft Substance Abuse         </label>
                    </div>
                    <div title=\"This section asks questions about the client's current health situation.\">	
                        <label><input id=\"health_check\" input type=\"checkbox\" name=\"health_check\" value=\"1\" /> Health         </label>
                    </div>
                    <div title=\"This section asks questions about the symptoms the client is currently experiencing.\">	
                        <label><input id=\"symptom_check\" input type=\"checkbox\" name=\"symptom_check\" value=\"1\" /> PHQ-15     </label>
                    </div>
                    <div title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\">
                        <label><input id=\"gad_check\"    input type=\"checkbox\" name=\"gad_check\"    value=\"1\" /> GAD-7          </label>
                    </div>
                    <div title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\">
                        <label><input id=\"gad2_check\"    input type=\"checkbox\" name=\"gad2_check\"    value=\"1\" /> GAD-2          </label>
                    </div>
                    <div title=\"Patient Depression Questionnaire asks questions concerning depression.\">
                        <label><input id=\"phq_check\"    input type=\"checkbox\" name=\"phq_check\"    value=\"1\" /> PHQ-9          </label>
                    </div>
                    <div title=\"The Alcohol Use Disorders Identification Test (AUDIT-C) is an alcohol screen that can help identify patients who are hazardous drinkers or have active alcohol use disorders (including alcohol abuse or dependence).\">
                        <label><input id=\"audit_check\"  input type=\"checkbox\" name=\"audit_check\"  value=\"1\" /> Audit-C        </label>
                    </div>
                    <div title=\"The CAGE is a 4- item, relatively non-confrontational questionnaire for detection of alcoholism.\">
                        <label><input id=\"cage_check\"   input type=\"checkbox\" name=\"cage_check\"   value=\"1\" /> CAGE           </label>
                    </div>
                    <div title=\"The Connor-Davidson Resilience assessment asks questions concerning client resilience.\">
                        <label><input id=\"cd_check\"     input type=\"checkbox\" name=\"cd_check\"     value=\"1\" /> Connor-Davidson</label>
                    </div>
                    <div title=\"The PCL-C (civilian) asks about symptoms in relation to &quot;stressful experiences.&quot;\">
                        <label><input id=\"pcl_check\"    input type=\"checkbox\" name=\"pcl_check\"    value=\"1\" /> PCL-C          </label>
                    </div>
                    <div title=\"The PCL-C (Civilian and Abbreviated) asks about symptoms in relation to &quot;stressful experiences.&quot;\">
                        <label><input id=\"pcl2_check\"    input type=\"checkbox\" name=\"pcl2_check\"    value=\"1\" /> PCL-C (Abbreviated)          </label>
                    </div>
                    <div title=\"The CES-D is a screening test for depression and depressive disorder. \">
                        <label><input id=\"ces_check\"    input type=\"checkbox\" name=\"ces_check\"    value=\"1\" /> CES-D          </label>
                    </div>
                    <div title=\"The Pediatric Symptom Checklist-17 (PSC-17) is a psychosocial screen designed to facilitate the recognition of cognitive, emotional, and behavioral problems \">
                        <label><input id=\"psc_check\"    input type=\"checkbox\" name=\"psc_check\"    value=\"1\" /> PSC-17          </label>
                    </div>
                    <div title=\"The Drug Abuse Screen Test (DAST-10) is a 10-item, yes/no self-report instrument that has been condensed from the 28-item DAST. The DAST-10 was designed to provide a brief instrument for clinical screening and treatment evaluation and can be used with adults and older youth.\">
                        <label><input id=\"dast_check\"    input type=\"checkbox\" name=\"dast_check\"    value=\"1\" /> DAST-10          </label>
                    </div>
                    <div title=\"The Duke Health Profile (Duke) is a 17-item generic self-report standardized instrument containing six health measures (physical, mental, social, general, perceived health, and self-esteem), and four dysfunction measures (anxiety, depression, pain, and disability).\">
                        <label><input id=\"duke_check\"    input type=\"checkbox\" name=\"duke_check\"    value=\"1\" /> The Duke          </label>
                    </div>
                    <div title=\"The ADHD Symptom Checklist is an instrument consisting of the eighteen DSM-IV-TR criteria.\">
                        <label><input id=\"adhd_check\"    input type=\"checkbox\" name=\"adhd_check\"    value=\"1\" /> ADHD Self-Report Scale          </label>
                    </div>";
                            } else if ($_SESSION['grouping'] == 2 || $_SESSION['grouping'] === 10) { //grouping = 2 is for the MS GRHOP
                                echo "
                    <div title=\"This section contains questions pertaining to the Strengths and Difficulties Questionnaire (SDQ). It is a brief behavioural screening questionnaire about 3-16 year olds.\">
                        <label><input id=\"sdq_check\" input type=\"checkbox\" name=\"sdq_check\" value=\"1\" /> SDQ        </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's diabetes self-care behavior.\">
                        <label><input id=\"self_check\" input type=\"checkbox\" name=\"self_check\" value=\"1\" /> Self-care        </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
                        <label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" /> Stress         </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
                        <label><input id=\"c_stress_check\" input type=\"checkbox\" name=\"c_stress_check\" value=\"1\" /> Child Stressors      </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's presenting problem.\">
                        <label><input id=\"pp_check\" input type=\"checkbox\" name=\"pp_check\" value=\"1\" /> Presenting Problem      </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
                        <label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" /> Diagnosis         </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
                        <label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" />MH Diagnosis         </label>
                    </div>
                    <div title=\"This section contains questions about what major life events the client has experienced.\">
                        <label><input id=\"events_check\" input type=\"checkbox\" name=\"events_check\" value=\"1\" /> Events         </label>
                    </div>
                     <div title=\"This section contains questions life attitudes.\">
                        <label><input id=\"life_check\" input type=\"checkbox\" name=\"life_check\" value=\"1\" /> Life Attitudes         </label>
                    </div>
                     <div title=\"This section contains the Crafft substance abuse questions.\" style=\"display: none;\">
                        <label><input id=\"crafft_check\" input type=\"checkbox\" name=\"crafft_check\" value=\"1\" /> Crafft Substance Abuse         </label>
                    </div>
                    <div title=\"This section asks questions about the client's current health situation.\">	
                        <label><input id=\"health_check\" input type=\"checkbox\" name=\"health_check\" value=\"1\" /> Health         </label>
                    </div>
                    <div title=\"This section asks questions about the symptoms the client is currently experiencing.\" style=\"display: none;\">	
                        <label><input id=\"symptom_check\" input type=\"checkbox\" name=\"symptom_check\" value=\"1\" /> PHQ-15     </label>
                    </div>
                    <div title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\">
                        <label><input id=\"gad_check\"    input type=\"checkbox\" name=\"gad_check\"    value=\"1\" /> GAD-7          </label>
                    </div>
                    <div title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\" style=\"display: none;\">
                        <label><input id=\"gad2_check\"    input type=\"checkbox\" name=\"gad2_check\"    value=\"1\" /> GAD-2          </label>
                    </div>
                    <div title=\"Patient Depression Questionnaire asks questions concerning depression.\">
                        <label><input id=\"phq_check\"    input type=\"checkbox\" name=\"phq_check\"    value=\"1\" /> PHQ-9          </label>
                    </div>
                    <div title=\"The Alcohol Use Disorders Identification Test (AUDIT-C) is an alcohol screen that can help identify patients who are hazardous drinkers or have active alcohol use disorders (including alcohol abuse or dependence).\">
                        <label><input id=\"audit_check\"  input type=\"checkbox\" name=\"audit_check\"  value=\"1\" /> Audit-C        </label>
                    </div>
                    <div title=\"The CAGE is a 4- item, relatively non-confrontational questionnaire for detection of alcoholism.\">
                        <label><input id=\"cage_check\"   input type=\"checkbox\" name=\"cage_check\"   value=\"1\" /> CAGE           </label>
                    </div>
                    <div title=\"The Connor-Davidson Resilience assessment asks questions concerning client resilience.\" style=\"display: none;\">
                        <label><input id=\"cd_check\"     input type=\"checkbox\" name=\"cd_check\"     value=\"1\" /> Connor-Davidson</label>
                    </div>
                    <div title=\"The PCL-C (civilian) asks about symptoms in relation to &quot;stressful experiences.&quot;\">
                        <label><input id=\"pcl_check\"    input type=\"checkbox\" name=\"pcl_check\"    value=\"1\" /> PCL-C          </label>
                    </div>
                    <div title=\"The PCL-C (Civilian and Abbreviated) asks about symptoms in relation to &quot;stressful experiences.&quot;\" style=\"display: none;\">
                        <label><input id=\"pcl2_check\"    input type=\"checkbox\" name=\"pcl2_check\"    value=\"1\" /> PCL-C (Abbreviated)          </label>
                    </div>
                    <div title=\"The CES-D is a screening test for depression and depressive disorder. \">
                        <label><input id=\"ces_check\"    input type=\"checkbox\" name=\"ces_check\"    value=\"1\" /> CES-D          </label>
                    </div>
                    <div title=\"The Pediatric Symptom Checklist-17 (PSC-17) is a psychosocial screen designed to facilitate the recognition of cognitive, emotional, and behavioral problems \">
                        <label><input id=\"psc_check\"    input type=\"checkbox\" name=\"psc_check\"    value=\"1\" /> PSC-17          </label>
                    </div>
                    <div title=\"The Drug Abuse Screen Test (DAST-10) is a 10-item, yes/no self-report instrument that has been condensed from the 28-item DAST. The DAST-10 was designed to provide a brief instrument for clinical screening and treatment evaluation and can be used with adults and older youth.\">
                        <label><input id=\"dast_check\"    input type=\"checkbox\" name=\"dast_check\"    value=\"1\" /> DAST-10          </label>
                    </div>
                    <div title=\"The Duke Health Profile (Duke) is a 17-item generic self-report standardized instrument containing six health measures (physical, mental, social, general, perceived health, and self-esteem), and four dysfunction measures (anxiety, depression, pain, and disability).\">
                        <label><input id=\"duke_check\"    input type=\"checkbox\" name=\"duke_check\"    value=\"1\" /> The Duke          </label>
                    </div>
                    <div title=\"The ADHD Symptom Checklist is an instrument consisting of the eighteen DSM-IV-TR criteria.\">
                        <label><input id=\"adhd_check\"    input type=\"checkbox\" name=\"adhd_check\"    value=\"1\" /> ADHD Self-Report Scale          </label>
                    </div>";
                            } else if ($_SESSION['grouping'] == 6) { //grouping = 6 is for the MS GRHOP non social work students
                                echo "
        
                    <div title=\"This section contains questions pertaining to the Strengths and Difficulties Questionnaire (SDQ). It is a brief behavioural screening questionnaire about 3-16 year olds.\" style=\"display: none;\">
                        <label><input id=\"sdq_check\" input type=\"checkbox\" name=\"sdq_check\" value=\"1\" /> SDQ        </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's diabetes self-care behavior.\">
                        <label><input id=\"self_check\" input type=\"checkbox\" name=\"self_check\" value=\"1\" /> Self-care        </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
                        <label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" /> Stress         </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
                        <label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" /> Diagnosis         </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
                        <label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" />MH Diagnosis         </label>
                    </div>
                    <div title=\"This section contains questions about what major life events the client has experienced.\">
                        <label><input id=\"events_check\" input type=\"checkbox\" name=\"events_check\" value=\"1\" /> Events         </label>
                    </div>
                     <div title=\"This section contains questions life attitudes.\" style=\"display: none;\">
                        <label><input id=\"life_check\" input type=\"checkbox\" name=\"life_check\" value=\"1\" /> Life Attitudes         </label>
                    </div>
                    <div title=\"The ADHD Symptom Checklist is an instrument consisting of the eighteen DSM-IV-TR criteria.\">
                        <label><input id=\"adhd_check\"    input type=\"checkbox\" name=\"adhd_check\"    value=\"1\" /> ADHD Self-Report Scale          </label>
                    </div>";
                            } else { //default is everything
                                echo "
                    <div title=\"This section contains questions pertaining to the Strengths and Difficulties Questionnaire (SDQ). It is a brief behavioural screening questionnaire about 3-16 year olds.\">
                        <label><input id=\"sdq_check\" input type=\"checkbox\" name=\"sdq_check\" value=\"1\" /> SDQ        </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's diabetes self-care behavior.\">
                        <label><input id=\"self_check\" input type=\"checkbox\" name=\"self_check\" value=\"1\" /> Self-care        </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
                        <label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" /> Stress         </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
                        <label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" /> Diagnosis         </label>
                    </div>
                    <div title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
                        <label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" />MH Diagnosis         </label>
                    </div>
                    <div title=\"This section contains questions about what major life events the client has experienced.\">
                        <label><input id=\"events_check\" input type=\"checkbox\" name=\"events_check\" value=\"1\" /> Events         </label>
                    </div>
                     <div title=\"This section contains questions life attitudes.\">
                        <label><input id=\"life_check\" input type=\"checkbox\" name=\"life_check\" value=\"1\" /> Life Attitudes         </label>
                    </div>
                     <div title=\"This section contains the Crafft substance abuse questions.\">
                        <label><input id=\"crafft_check\" input type=\"checkbox\" name=\"crafft_check\" value=\"1\" /> Crafft Substance Abuse         </label>
                    </div>
                    <div title=\"This section asks questions about the client's current health situation.\">	
                        <label><input id=\"health_check\" input type=\"checkbox\" name=\"health_check\" value=\"1\" /> Health         </label>
                    </div>
                    <div title=\"This section asks questions about the symptoms the client is currently experiencing.\">	
                        <label><input id=\"symptom_check\" input type=\"checkbox\" name=\"symptom_check\" value=\"1\" /> PHQ-15     </label>
                    </div>
                    <div title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\">
                        <label><input id=\"gad_check\"    input type=\"checkbox\" name=\"gad_check\"    value=\"1\" /> GAD-7          </label>
                    </div>
                    <div title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\">
                        <label><input id=\"gad2_check\"    input type=\"checkbox\" name=\"gad2_check\"    value=\"1\" /> GAD-2          </label>
                    </div>
                    <div title=\"Patient Depression Questionnaire asks questions concerning depression.\">
                        <label><input id=\"phq_check\"    input type=\"checkbox\" name=\"phq_check\"    value=\"1\" /> PHQ-9          </label>
                    </div>
                    <div title=\"The Alcohol Use Disorders Identification Test (AUDIT-C) is an alcohol screen that can help identify patients who are hazardous drinkers or have active alcohol use disorders (including alcohol abuse or dependence).\">
                        <label><input id=\"audit_check\"  input type=\"checkbox\" name=\"audit_check\"  value=\"1\" /> Audit-C        </label>
                    </div>
                    <div title=\"The CAGE is a 4- item, relatively non-confrontational questionnaire for detection of alcoholism.\">
                        <label><input id=\"cage_check\"   input type=\"checkbox\" name=\"cage_check\"   value=\"1\" /> CAGE           </label>
                    </div>
                    <div title=\"The Connor-Davidson Resilience assessment asks questions concerning client resilience.\">
                        <label><input id=\"cd_check\"     input type=\"checkbox\" name=\"cd_check\"     value=\"1\" /> Connor-Davidson</label>
                    </div>
                    <div title=\"The PCL-C (civilian) asks about symptoms in relation to &quot;stressful experiences.&quot;\">
                        <label><input id=\"pcl_check\"    input type=\"checkbox\" name=\"pcl_check\"    value=\"1\" /> PCL-C          </label>
                    </div>
                    <div title=\"The PCL-C (Civilian and Abbreviated) asks about symptoms in relation to &quot;stressful experiences.&quot;\">
                        <label><input id=\"pcl2_check\"    input type=\"checkbox\" name=\"pcl2_check\"    value=\"1\" /> PCL-C (Abbreviated)          </label>
                    </div>
                    <div title=\"The CES-D is a screening test for depression and depressive disorder. \">
                        <label><input id=\"ces_check\"    input type=\"checkbox\" name=\"ces_check\"    value=\"1\" /> CES-D          </label>
                    </div>
                    <div title=\"The Pediatric Symptom Checklist-17 (PSC-17) is a psychosocial screen designed to facilitate the recognition of cognitive, emotional, and behavioral problems \">
                        <label><input id=\"psc_check\"    input type=\"checkbox\" name=\"psc_check\"    value=\"1\" /> PSC-17          </label>
                    </div>
                    <div title=\"The Drug Abuse Screen Test (DAST-10) is a 10-item, yes/no self-report instrument that has been condensed from the 28-item DAST. The DAST-10 was designed to provide a brief instrument for clinical screening and treatment evaluation and can be used with adults and older youth.\">
                        <label><input id=\"dast_check\"    input type=\"checkbox\" name=\"dast_check\"    value=\"1\" /> DAST-10          </label>
                    </div>
                    <div title=\"The Duke Health Profile (Duke) is a 17-item generic self-report standardized instrument containing six health measures (physical, mental, social, general, perceived health, and self-esteem), and four dysfunction measures (anxiety, depression, pain, and disability).\">
                        <label><input id=\"duke_check\"    input type=\"checkbox\" name=\"duke_check\"    value=\"1\" /> The Duke          </label>
                    </div>
                    <div title=\"The ADHD Symptom Checklist is an instrument consisting of the eighteen DSM-IV-TR criteria.\">
                        <label><input id=\"adhd_check\"    input type=\"checkbox\" name=\"adhd_check\"    value=\"1\" /> ADHD Self-Report Scale          </label>
                    </div>";
                            }
                         
							if($_SESSION['test_acc']) {
								echo "<div title=\"The Hypertension Self-care Activity Level Effects Test is\">
										<label><input id=\"hypertension_check\"    input type=\"checkbox\" name=\"hypertension_check\"    value=\"1\" /> H-SCALE          </label>
									  </div>
                        			  <div title=\"The Pediatric Healthy Lifestyles Screening if \">
										<label><input id=\"pediatric_check\"    input type=\"checkbox\" name=\"pediatric_check\"    value=\"1\" /> Pediatric Health Lifestyles          </label>
									  </div>";
							}
                            ?>
                           
                            <br>
                        <center><button onclick ="check('whandoff')" style= "height: 25px; width: 200px" type = "button" input id = "GRHOP_warm_handoff_check" name = "GRHOP_warm_handoff_check" value = "1">Warm Hand-off</button>
                        
                       <button onclick ="uncheck()" style= "height: 25px; width: 200px" type = "button" input id = "GRHOP_standard_uncheck" name = "GRHOP_standard_uncheck" value = "1">Uncheck All</button></center>

<!--                <center><h3>Optionally select a standard below.</h3></center>
<center><button title ="Select this button if you wish to take the GRHOP standard." onclick ="check('grhop')"   style= "height: 25px; width: 125px" type = "button" input id = "GRHOP_standard_check"   name = "GRHOP_standard_check" value="1">GRHOP Standard</button>
                        -->
                            <?php /* if ($_SESSION['university_id'] == 2) {    
                              echo '<button title ="Select this button if you wish to take the Alabama screener (Partial, front page only!)." onclick ="check(\'alabama_partial\')"   style= "height: 25px; width: 200px" type = "button" input id = "alabama_partial"   name = "alabama_partial" value="1">Alabama Screener (Partial)</button>
                              <button title ="Select this button if you wish to take the Alabama screener (Complete, both pages)." onclick ="check(\'alabama_complete\')"   style= "height: 25px; width: 225px" type = "button" input id = "alabama_complete"   name = "alabama_complete" value="1">Alabama Screener (Complete)</button>';
                              }
                              if ($_SESSION['university_id'] == 1) {
                              echo '<button title ="Select this button if you wish to take the Mississippi Initial Appointment Screener." onclick ="check(\'ms_ax\')"   style= "height: 25px; width: 200px" type = "button" input id = "ms_ax"   name = "ms_ax" value="1">MS Initial Appt.</button>
                              <button title ="Select this button if you wish to take the Mississippi Follow-up Screener." onclick ="check(\'ms_fu\')"   style= "height: 25px; width: 225px" type = "button" input id = "ms_fu"   name = "ms_fu" value="1">MS Follow-up</button>';
                              } */
                            ?>   
                       </td></table></div>
                <br>

                <!--Check-Box end.-->

                <br><br>
                <center>
                    <input id="submit"  type="submit" onclick="return formSubmit(form1);" value="Submit" >
                </center>	
                <div>
                    <footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
                </div>
                <center><a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"><img src="images/GRHOP.png" style="border:solid; border-color:black;" width="100" height="100" alt="G.R.H.O.P"></a></center>
        
    
</body>
</html>


