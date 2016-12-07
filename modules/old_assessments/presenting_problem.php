<?php
	function write_presenting_problem($c, $mysqli)
	{
       
  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}
	
	if($result = $mysqli->query('SELECT * FROM questions WHERE classification="pres_prob" AND '.$c.'=1'))
	{

            if($result->num_rows > 0 )
            {            
            	if ($c=="Child")
            	{
            		echo "<h1><center>Presenting Problem</center></h1>\n
            		<div id=\"presenting_problem\">\n		
            		<table width=\"800px\" border=\"1\" id=\"table_presenting_problem\">\n
                        <tr><th colspan=\"12\" class=\"tdtopic\"><b>What is the child/teen/family's main concern?</b></th></tr>";
            	}
            	else
            	{
            		echo "<h1><center>Presenting Problem</center></h1>         		
            		<div id=\"presenting_problem\">\n		
            		<table width=\"800px\" border=\"1\" id=\"table_presenting_problem\">\n
                        <tr><th colspan=\"12\" class=\"tdtopic\"><b>What is your main concern?</b></th></tr>";	
            	}

				$ci = 0;			 
				while($row = $result->fetch_assoc()) 
				{
					if ($ci==0)
					{ 
						echo "<tr>";
					};
                                       
					echo "<td class=\"presenting_problem\">" . $row['question'] ."</td><td class=\"stressor_input\"><center><input type=\"radio\" name=\"pp\"  value=\"". $row['question'] ."\" style=\"vertical-align: bottom\"/></center></td>\n";
					$_SESSION["pp"] = "";
					$ci++;
                                        

					if ($ci==2)
					{
						echo "</tr>"; $ci=0;
					};
					
					
				};

				echo "</table><!-- end table presenting problem -->\n				
				</div><!-- end div presenting problem-->\n";
		};
        }
		 $result->close();
                 
                
                echo "<br>"; 
                echo    '<table width="800px" border="1" id="table_pp_time">
                            <tr><th colspan="12" class="tdtopic"><b>How long has this been a problem?</b></th></tr>
                            <tr><td class="pro">Less than 30 days.</td><td class="demo_input"><center><input type="radio" name="pp_time"  value="1-3 months"/></center></td>
                                <td class="pro">1-3 months.</td><td class="demo_input"><center><input type="radio" name="pp_time"  value="3-6 months" /></center></td>
                                <td class="pro">3-6 months.</td><td class="demo_input"><center><input type="radio" name="pp_time"  value="6-9 months"/></center></td>
                                <td class="pro">6-12 months.</td><td class="demo_input"><center><input type="radio" name="pp_time"  value="9-12 months"/></center></td>
                                <td class="pro">More than 1 year.</td><td class="demo_input"><center><input type="radio" name="pp_time"  value="more than 1 year"/></center></td> 
                            </tr>
                        </table>';
                
                
                echo "<br>"; 
                echo    '<table width="800px" border="1" id="table_pp_fam_dist">
                        <tr><th colspan="12" class="tdtopic"><b>Does the problem upset or distress the child/teen/family?</b></th></tr>
                        <tr><td class="pro">Not at all.</td><td class="demo_input"><center><input type="radio" name="pp_fam_dist"  value="Not at all."/></center></td>
                        <td class="pro">Only a little.</td><td class="demo_input"><center><input type="radio" name="pp_fam_dist"  value="Only a little." /></center></td>
                        <td class="pro">A medium amount.</td><td class="demo_input"><center><input type="radio" name="pp_fam_dist"  value="A medium amount."/></center></td>
                        <td class="pro">A great deal.</td><td class="demo_input"><center><input type="radio" name="pp_fam_dist"  value="A great deal."/></center></td>
                        
                        </tr></table>';
        
                echo "<br>";
                echo    '<table width="800px" border="1" id="table_pp_area">
                        <tr><th colspan="12" class="tdtopic"><b>Does the problem interfere with the child\'s everyday activities?</b></th></tr>
                        <tr><td class="interfere_input"><center>Area</center></td>
                            <td class="interfere_input"><center>Not at all</center></td>
                            <td class="interfere_input"><center>Only a little</center></td>
                            <td class="interfere_input"><center>A moderate amount</center></td>
                            <td class="interfere_input"><center>A great deal</center></td>
                        </tr>
                        <tr><td class="pro">Home life.</td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_home"  value="not at all"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_home"  value="only a little"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_home"  value="a moderate amount"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_home"  value="a great deal"/></center></td>
                        </tr>
                        <tr><td class="pro">Friendships.</td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_friendship"  value="not at all"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_friendship"  value="only a little"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_friendship"  value="a moderate amount"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_friendship"  value="a great deal"/></center></td>
                        </tr>
                        <tr><td class="pro">School.</td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_school"  value="not at all"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_school"  value="only a little"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_school"  value="a moderate amount"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_school"  value="a great deal"/></center></td>
                        </tr>
                        <tr><td class="pro">Leisure activites.</td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_leisure"  value="not at all"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_leisure"  value="only a little"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_leisure"  value="a moderate amount"/></center></td>
                            <td class="interfere_input"><center><input type="radio" name="interfere_area_leisure"  value="a great deal"/></center></td>
                        </tr> 
                        </table>';
                
                echo "<br>";
                 
                echo    '<table width="800px" border="1" id="table_pp_steps">
                        <tr><th colspan="12" class="tdtopic"><b>What steps has the child/teen/family taken to deal with the presenting problem?</b></th></tr>
                        <tr>
                            <td class="pro">Parenting classes.</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_classes"  value="1"/></center></td>
                            <td class="pro">Tutoring.</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_tutoring"  value="1"/></center></td>
                        </tr>
                        <tr>
                            <td class="pro">
                                <table  border="0" id="table_pp_steps_subtable">
                                <tr><td  colspan="2"> Mental health treatment.</td></tr>
                                <tr>
                                    <td class="pro_sub">Individual</td><td class="demo_input"><input type="checkbox" name="pp_steps_mh_individual"  value="1"/></td>
                                </tr>
                                <tr>
                                    <td class="pro_sub">Family</td><td class="demo_input"><input type="checkbox" name="pp_steps_mh_family"  value="1"/></td>
                                </tr>
                                <tr>
                                    <td class="pro_sub">School</td><td class="demo_input"><input type="checkbox" name="pp_steps_mh_school"  value="1"/></td>
                                </tr>
                                <tr>
                                    <td class="pro_sub">Inpatient</td><td class="demo_input"><input type="checkbox" name="pp_steps_inpatient"  value="1"/></td>
                                </tr>
                                </table>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>

                            
                        </tr>
                        <tr>
                            <td class="pro">Individual education plan (IEP).</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_IEP"  value="1"/></center></td>
                            <td class="pro">Speech therapy.</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_speech"  value="1"/></center></td>
                        </tr>
                        <tr>
                            <td class="pro">DHS involvement.</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_DHS"  value="1"/></center></td>
                            <td class="pro">Law enforcement involvement/youth court.</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_law"  value="1"/></center></td>
                        </tr>
                        <tr>
                            <td class="pro">Extracurricular activities.</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_extracurricular"  value="1"/></center></td>
                            <td class="pro">Community involvement (volunteer involvement)</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_volunteer"  value="1"/></center></td>
                        </tr>
                        <tr>
                            <td class="pro">Health care specialist involvement.</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_healthcare"  value="1"/></center></td>
                            <td class="pro">Religious/spiritual involvement.</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_religious"  value="1"/></center></td>
                        </tr>
                        <tr>
                            <td class="pro">Mentoring program.</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_mentoring"  value="1"/></center></td>
                            <td class="pro">Counseling</td><td class="demo_input"><center><input type="checkbox" name="pp_steps_counseling"  value="1"/></center></td>
                        </tr>
                        </table>';
                
                
                
                
                
 }

	//This scores the continum scale of stress level. There is no cut-off for the individual stressors.
	function pp_scoring($copy, $mysqli)
	{
            require_once'../../include/constants.php';

		
		if ((array_key_exists('pp', $copy))&&($copy['pp']!=""))  // If there is no stress in the array, set the value == -1. 
		{ 
	 		echo "<p><h1>Presenting Problem</h1></p><p>The child reports the following presenting problem: \"".$copy['pp'] ."\" ";
                        if ($copy['pp_time']!=""){
                            echo " with a duration of \"" . $copy['pp_time'] ."\" "; 
                        }
                        if ($copy['pp_fam_dist']!=""){
                            " with a distress of \"" . $copy['pp_fam_dist'] ."\".";
                        }
                        echo "</p>";

		
                        if (($copy['interfere_area_home'] !="")||($copy['interfere_area_school']!="")||($copy['interfere_area_leisure']!="")||($copy['interfere_area_friendship']!="")){
                            echo "<p>The child reports the problem interferes with their</p>";
                            echo "<ul>";
                            if ($copy['interfere_area_home'] !=""){
                                 echo "<li>Home life ".$copy['interfere_area_home']."</li>";
                            }
                            if ($copy['interfere_area_friendship'] !=""){
                                 echo "<li>Friendships ".$copy['interfere_area_friendship']."</li>";
                            }
                            if ($copy['interfere_area_school'] !=""){
                                 echo "<li>School ".$copy['interfere_area_school']."</li>";
                            }
                            if ($copy['interfere_area_leisure'] !=""){
                                 echo "<li>Leisure ".$copy['interfere_area_leisure']."</li>";
                            }
                            
                            echo "</ul>";
                        }
                         
                        if (($copy['pp_steps_classes'] == 1)||($copy['pp_steps_tutoring'] == 1)||($copy['pp_steps_mh_individual'] == 1)||
                                ($copy['pp_steps_mh_family'] == 1)||($copy['pp_steps_mh_school'] == 1)||($copy['pp_steps_mh_inpatient'] == 1)||
                                ($copy['pp_steps_IEP'] == 1)||($copy['pp_steps_speech'] == 1)||($copy['pp_steps_DHS'] == 1)||
                                ($copy['pp_steps_law'] == 1)||($copy['pp_steps_extracurricular'] == 1)||($copy['pp_steps_volunteer'] == 1)||
                                ($copy['pp_steps_healthcare'] == 1)||($copy['pp_steps_volunteer'] == 1)||($copy['pp_steps_religious'] == 1)||
                                ($copy['pp_steps_mentoring'] == 1)||($copy['pp_steps_counseling'] == 1)){
                            
                        echo "The child reports the followning steps have been taken by the child/teen/family to deal with the presenting problem: ";
                        echo "<ul>";
                        if ($copy['pp_steps_classes'] == 1){
                            echo "<li>Parenting Classes</li>";
                        }
                        if ($copy['pp_steps_tutoring'] == 1){
                            echo "<li>Tutoring</li>";
                        }
                        if ($copy['pp_steps_mh_individual'] == 1){
                            echo "<li>Individual mental health treatment</li>";
                        }
                        if ($copy['pp_steps_mh_family'] == 1){
                            echo "<li>Family mental health treatment</li>";
                        }
                        if ($copy['pp_steps_mh_school'] == 1){
                            echo "<li>Mental health treatment in a school setting</li>";
                        }
                        if ($copy['pp_steps_mh_inpatient'] == 1){
                            echo "<li>Individual mental health treatment in an inpatient setting</li>";
                        }
                        if ($copy['pp_steps_IEP'] == 1){
                            echo "<li>Individual education plan (IEP)</li>";
                        }
                        if ($copy['pp_steps_speech'] == 1){
                            echo "<li>Speech therapy</li>";
                        }
                        if ($copy['pp_steps_DHS'] == 1){
                            echo "<li>DHS involvement</li>";
                        }
                        if ($copy['pp_steps_law'] == 1){
                            echo "<li>Law enforcement involvement</li>";
                        }
                        if ($copy['pp_steps_extracurricular'] == 1){
                            echo "<li>Extracurricular activities</li>";
                        }
                        if ($copy['pp_steps_volunteer'] == 1){
                            echo "<li>Community involvement (volunteer involvement)</li>";
                        }
                        if ($copy['pp_steps_healthcare'] == 1){
                            echo "<li>Health care specialist involvement</li>";
                        }
                        if ($copy['pp_steps_volunteer'] == 1){
                            echo "<li>Individual education plan (IEP)</li>";
                        }
                        if ($copy['pp_steps_religious'] == 1){
                            echo "<li>Religious/spiritual involvement</li>";
                        }
                        if ($copy['pp_steps_mentoring'] == 1){
                            echo "<li>Mentoring program</li>";
                        }
                        if ($copy['pp_steps_counseling'] == 1){
                            echo "<li>Counseling</li>";
                        }
                        echo "</ul>";              
                    }
                }
	};
?>
