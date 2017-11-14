<?php

//write_gad will get all the selected gad questions and place them and the response matrix on the page.
/*
 * Maximum score = 21.
 * Scoring is as follows:
 * score: Depression/Serverity: 	
 * 0-5: 		none: 				
 * 6-10: 	mild: 				
 * 11-15: 	moderate: 			
 * 15-21:	severe				
 *
 * Further evaluation is recommended for a score of 10 or greater.
 * 
 */

function write_self($type, $mysqli) {
    global $i;

    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")) {
        $query = 'SELECT * FROM questions WHERE classification="self-care" AND ' . $type . '=1 and Sub_ID<18 order by Sub_ID';
    } else {
        exit();
    }

    if ($result = $mysqli->query($query)) {
        if ($i == 0) {
            $i = 1;
        };
        if ($result->num_rows > 0) {
            //If there are questions to write, write them. Otherwise don't.
            echo "<br><hr>\n";
            echo "<div id=\"self_section\"><p><center>Diabetes Self-Care Activities</center></p>";
            echo "<table id=\"self_questions\" border=\"1\">";
            echo "<tr><th></th><th colspan=\"8\">Number of Days</th></tr>";
            echo "<tr style=\"background-color: #FFFFCC;\">";
            echo "<td class=\"self_scale_pad\"><center>Diet</center></td>";
            echo "<td class=\"self_scale\" ><center>0</center></td>";
            echo "<td class=\"self_scale\" ><center>1</center></td>";
            echo "<td class=\"self_scale\" ><center>2</center></td>";
            echo "<td class=\"self_scale\" ><center>3</center></td>";
            echo "<td class=\"self_scale\" ><center>4</center></td>";
            echo "<td class=\"self_scale\" ><center>5</center></td>";
            echo "<td class=\"self_scale\" ><center>6</center></td>";
            echo "<td class=\"self_scale\" ><center>7</center></td></tr>\n";

            if ($result) { //we got a result from the query  
                while ($row = $result->fetch_assoc()) {
                    if ($row['Sub_ID'] == 6) {
                        echo "<tr style=\"background-color: #FFFFCC;\">";
                        echo "<td class=\"self_scale_pad\"><center>Medications</center></td>";
                        echo "<td class=\"self_scale\" ><center>0</center></td>";
                        echo "<td class=\"self_scale\" ><center>1</center></td>";
                        echo "<td class=\"self_scale\" ><center>2</center></td>";
                        echo "<td class=\"self_scale\" ><center>3</center></td>";
                        echo "<td class=\"self_scale\" ><center>4</center></td>";
                        echo "<td class=\"self_scale\" ><center>5</center></td>";
                        echo "<td class=\"self_scale\" ><center>6</center></td>";
                        echo "<td class=\"self_scale\" ><center>7</center></td></tr>\n";
                    } elseif ($row['Sub_ID'] == 9) {
                        echo "<tr style=\"background-color: #FFFFCC;\">";
                        echo "<td class=\"self_scale_pad\"><center>Blood Sugar Testing</center></td>";
                        echo "<td class=\"self_scale\" ><center>0</center></td>";
                        echo "<td class=\"self_scale\" ><center>1</center></td>";
                        echo "<td class=\"self_scale\" ><center>2</center></td>";
                        echo "<td class=\"self_scale\" ><center>3</center></td>";
                        echo "<td class=\"self_scale\" ><center>4</center></td>";
                        echo "<td class=\"self_scale\" ><center>5</center></td>";
                        echo "<td class=\"self_scale\" ><center>6</center></td>";
                        echo "<td class=\"self_scale\" ><center>7</center></td></tr>\n";
                    } elseif ($row['Sub_ID'] == 11) {
                        echo "<tr style=\"background-color: #FFFFCC;\">";
                        echo "<td class=\"self_scale_pad\"><center>Exercise</center></td>";
                        echo "<td class=\"self_scale\" ><center>0</center></td>";
                        echo "<td class=\"self_scale\" ><center>1</center></td>";
                        echo "<td class=\"self_scale\" ><center>2</center></td>";
                        echo "<td class=\"self_scale\" ><center>3</center></td>";
                        echo "<td class=\"self_scale\" ><center>4</center></td>";
                        echo "<td class=\"self_scale\" ><center>5</center></td>";
                        echo "<td class=\"self_scale\" ><center>6</center></td>";
                        echo "<td class=\"self_scale\" ><center>7</center></td></tr>\n";
                    } elseif ($row['Sub_ID'] == 13) {
                        echo "<tr style=\"background-color: #FFFFCC;\">";
                        echo "<td class=\"self_scale_pad\"><center>Foot Care</center></td>";
                        echo "<td class=\"self_scale\" ><center>0</center></td>";
                        echo "<td class=\"self_scale\" ><center>1</center></td>";
                        echo "<td class=\"self_scale\" ><center>2</center></td>";
                        echo "<td class=\"self_scale\" ><center>3</center></td>";
                        echo "<td class=\"self_scale\" ><center>4</center></td>";
                        echo "<td class=\"self_scale\" ><center>5</center></td>";
                        echo "<td class=\"self_scale\" ><center>6</center></td>";
                        echo "<td class=\"self_scale\" ><center>7</center></td></tr>\n";
                    } 
                    echo "<tr class=\"self_row\"";
                    if ($i % 2 == 0)
                        echo "style=\"background-color: #EFFBFB;\"";
                    echo ">\n";
                    //write_gad_question($i, $row['question']);
                    echo "<td class=\"self_question\">" . $i . ". \n";
                    echo $row['question'] . "</td>\n";
                    echo "<td class=\"self_response\" id=\"self_" . $row['Sub_ID'] . "-" . "0\"><center><input type=\"radio\" name=\"self_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
                    echo "<td class=\"self_response\" id=\"self_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"self_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
                    echo "<td class=\"self_response\" id=\"self_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"self_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
                    echo "<td class=\"self_response\" id=\"self_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"self_" . $row['Sub_ID'] . "\" value=\"3\" /></center></td>\n";
                    echo "<td class=\"self_response\" id=\"self_" . $row['Sub_ID'] . "-" . "4\"><center><input type=\"radio\" name=\"self_" . $row['Sub_ID'] . "\" value=\"4\" /></center></td>\n";
                    echo "<td class=\"self_response\" id=\"self_" . $row['Sub_ID'] . "-" . "5\"><center><input type=\"radio\" name=\"self_" . $row['Sub_ID'] . "\" value=\"5\" /></center></td>\n";
                    echo "<td class=\"self_response\" id=\"self_" . $row['Sub_ID'] . "-" . "6\"><center><input type=\"radio\" name=\"self_" . $row['Sub_ID'] . "\" value=\"6\" /></center></td>\n";
                    echo "<td class=\"self_response\" id=\"self_" . $row['Sub_ID'] . "-" . "7\"><center><input type=\"radio\" name=\"self_" . $row['Sub_ID'] . "\" value=\"7\" /></center></td>\n";                    
                    $_SESSION["self_" . $row['Sub_ID']] = "-1";
                    $i++;
                } // end while
                echo "</tr>\n"; //close table row.
                //echo "</table></div><!-- close gad_section -->\n";
                echo "</table>\n";
            
                //Need to add the smoking questions.
            echo "<br>\n";
            //echo "<div id=\"self_section_smoking\">";
            echo "<table id=\"self_questions_smoking\">";
            echo "<tr style=\"background-color: #FFFFCC;\">";
            echo "<td></td><td class=\"self_scale_pad\"><center>Smoking</center></td>";
            echo "<td class=\"self_scale\" ><center>No</center></td>";
            echo "<td class=\"self_scale\" ><center>Yes</center></td>";
            echo "<tr class=\"self_row\"";
                    if ($i % 2 == 0)
                        echo "style=\"background-color: #EFFBFB;\"";
                    
                    echo ">\n";
                    //write_gad_question($i, $row['question']);
                    echo "<td class=\"self_question\">" . $i . ". \n";  
                    $i++;
            echo "<td>Have you smoked a cigarette - even one puff - during the last SEVEN DAYS?</td>";
            echo "<td class=\"self_response\" id=\"self_18-0\"><center><input type=\"radio\" name=\"self_18\" value=\"0\" /></center></td>\n";
            echo "<td class=\"self_response\" id=\"self_18-1\"><center><input type=\"radio\" name=\"self_18\" value=\"1\" /></center></td>\n";
            echo "</tr></table>\n"; //close table row.
            echo "<table id=\"self_questions_smoking\">";          
            echo "<tr class=\"self_row\"";
                    if ($i % 2 == 0)
                        echo "style=\"background-color: #EFFBFB;\"";
                    
                    echo ">\n";
                    
                    echo "<td class=\"self_question\">" . $i . ". \n"; 
                    $_SESSION['self_18'] = "-1";
                    $i++;
            echo "<td>If yes, how many cigarettes did you smoke on an average day?</td>";
            echo "<td class=\"self_response\" id=\"self_19-0\"><center><input type=\"input\" name=\"self_19\" /></center></td>\n";
            echo "</tr></table>\n"; //close table row.     
            echo "<table id=\"self_questions_smoking\">";
            
            echo "<tr style=\"background-color: #FFFFCC;\">";
            echo "<td></td><td class=\"self_scale_pad\"><center></center></td>";
            echo "<td class=\"self_scale\" ><center>No</center></td>";
            echo "<td class=\"self_scale\" ><center>Yes</center></td>";
            echo "<tr class=\"self_row\"";
                    if ($i % 2 == 0)
                        echo "style=\"background-color: #EFFBFB;\"";
                    
                    echo ">\n";
                    echo "<td class=\"self_question\">" . $i . ". \n"; 
                    $_SESSION['self_19'] = "-1";
                    $i++;
            echo "<td>At your last doctor's visit, did anyone ask you about your smoking status?</td>";
            echo "<td class=\"self_response\" id=\"self_20-0\"><center><input type=\"radio\" name=\"self_20\" value=\"0\" /></center></td>\n";
            echo "<td class=\"self_response\" id=\"self_20-1\"><center><input type=\"radio\" name=\"self_20\" value=\"1\" /></center></td>\n";
            echo "</tr></table>\n"; //close table row.
            
            echo "<table id=\"self_questions_smoking\">";
            echo "<tr style=\"background-color: #FFFFCC;\">";
            echo "<td></td><td class=\"self_scale_pad\"><center></center></td>";
            echo "<td class=\"self_scale\" ><center>No</center></td>";
            echo "<td class=\"self_scale\" ><center>Yes</center></td><td></td>";
            echo "<td class=\"self_scale\" ><center>Do Not Smoke</center></td>";
            echo "<tr class=\"self_row\"";
                    if ($i % 2 == 0)
                        echo "style=\"background-color: #EFFBFB;\"";         
                    echo ">\n";
                    //write_gad_question($i, $row['question']);
                     echo "<td class=\"self_question\">" . $i . ". \n"; 
                    $_SESSION['self_20'] = "-1";  
                    $i++;
            echo "<td>If you smoke, at your last doctor's visit did anyone counsel you about stopping smoking or offer to refer you to a stop-smoking program?</td>";
            echo "<td class=\"self_response\" id=\"self_21-0\"><center><input type=\"radio\" name=\"self_21\" value=\"0\" /></center></td>\n";
            echo "<td class=\"self_response\" id=\"self_21-1\"><center><input type=\"radio\" name=\"self_21\" value=\"1\" /></center></td><td></td>\n";
            echo "<td class=\"self_response\" id=\"self_21-1\"><center><input type=\"radio\" name=\"self_21\" value=\"2\" /></center></td>\n";
            echo "</tr></table>\n"; //close table row.
            
            echo "<table id=\"self_questions_smoking\">";
            echo "<tr style=\"background-color: #FFFFCC;\">";
            echo "<td></td><td class=\"self_scale_pad\"><center></center></td>";
            echo "<td class=\"self_scale\" ><center>>2 yrs or never</center></td>";
            echo "<td class=\"self_scale\" ><center>1-2 yrs ago</center></td>";
            echo "<td class=\"self_scale\" ><center>4-12 months ago</center></td>";
            echo "<td class=\"self_scale\" ><center>1-3 months ago</center></td>";
            echo "<td class=\"self_scale\" ><center>Within the last month</center></td>";
            echo "<td class=\"self_scale\" ><center>Today</center></td>";
            echo "<tr class=\"self_row\"";
                    if ($i % 2 == 0)
                        echo "style=\"background-color: #EFFBFB;\"";
                    
                    echo ">\n";
                    //write_gad_question($i, $row['question']);
                    echo "<td class=\"self_questions_smoking_time\">" . $i . ". \n";  
                     $_SESSION['self_21'] = "-1";
                    $i++;
            echo "<td>When did you last smoke a cigarette?</td>";
            echo "<td class=\"self_response\" id=\"self_22-0\"><center><input type=\"radio\" name=\"self_22\" value=\"0\" /></center></td>\n";
            echo "<td class=\"self_response\" id=\"self_22-1\"><center><input type=\"radio\" name=\"self_22\" value=\"1\" /></center></td>\n";
            echo "<td class=\"self_response\" id=\"self_22-2\"><center><input type=\"radio\" name=\"self_22\" value=\"2\" /></center></td>\n";
            echo "<td class=\"self_response\" id=\"self_22-3\"><center><input type=\"radio\" name=\"self_22\" value=\"3\" /></center></td>\n";
            echo "<td class=\"self_response\" id=\"self_22-4\"><center><input type=\"radio\" name=\"self_22\" value=\"4\" /></center></td>\n";
            echo "<td class=\"self_response\" id=\"self_22-5\"><center><input type=\"radio\" name=\"self_22\" value=\"5\" /></center></td>\n";
            echo "<tr class=\"self_row\"";
                    if ($i % 2 == 0)
                        echo "style=\"background-color: #EFFBFB;\"";
                    echo ">\n";
               
                     $_SESSION['self_22'] = "-1";
                    $i++;
            echo "</tr></table></div>\n"; //close table row.
            
            }
            else {
                echo "Self Query error!\n";
            }
            
    }
}

}

//Passing by reference if deprecated. 

function self_scoring($copy, $mysqli) {
    //////////////////////////////////Print our self-care////////////////////////////////////////////////
//    print_r($copy);

	if($copy['self_check'] == 1)
	{
	$n = 1;
	$first = 0;
	$count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'self-care'");
	$count_no = $count->fetch_assoc();
	while($n <= $count_no['num'])
	{	
		if($copy['self_' .$n] > -1)
		{
			$first++;
			if($first == 1)
			{
				echo "<br/>";
				echo "<b>The responses for the self-care questions are as follows:</b> "; 
				echo "<br/>";
			}
			$result = $mysqli->query("SELECT question from questions where classification = 'self-care' and Sub_ID =  $n");
			$row = $result->fetch_assoc();
                        if ($copy['self_'.$n] != -1){
                            if (($n>17) && ($n!=19) && ($n!=22)){
                                if ($copy['self_'.$n] == 0) {
                                    $copy['self_'.$n]= "No";
                                } elseif ($copy['self_'.$n] == 1) {
                                    $copy['self_'.$n] = "Yes";
                                } elseif ($copy['self_'.$n] == 3){
                                    $copy['self_'.$n] = "Do Not Smoke"; 
                                }
                            }
                            if ($n==19){
                                if ($copy['self_18'] == "No"){ //They answered no to smoking therefore any response is wrong.
                                     $copy['self_'.$n] = "None";
                                }
                            }
                            if ($n==22){                 
                                if ($copy['self_'.$n] == 0) {
                                    $copy['self_'.$n] = ">2 yrs or never";
                                } elseif ($copy['self_'.$n] == 1) {
                                    $copy['self_'.$n] = "1-2 yrs ago";
                                } elseif ($copy['self_'.$n] == 2){
                                    $copy['self_'.$n] = "4-12 months ago";
                                } elseif ($copy['self_'.$n] == 3){
                                    $copy['self_'.$n] = "1-3 months ago";
                                } elseif ($copy['self_'.$n] == 4){
                                    $copy['self_'.$n] = "Within the last month";
                                } elseif ($copy['self_'.$n] == 5){
                                    $copy['self_'.$n] = "Today";
                                }
                            }

                            if ($n == 19){ 
                               if ($copy['self_18'] != "No")
                                  echo $row['question'] . ": " . $copy['self_'.$n];
                            } else {
                                 echo $row['question'] . ": " . $copy['self_'.$n];
                            }
                            echo "<br/>";
                        }
		}
               // print_r($copy); echo "<br>";
		$n++;
	}
	echo "<br>";
}}	
?>