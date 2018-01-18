<?php
	//This scores the continum scale of stress level. There is no cut-off for the individual stressors.
	function pp_scoring($copy, $mysqli)
	{		
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
