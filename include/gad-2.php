<?php
//write_gad-2 will get all the selected gad questions and place them and the response matrix on the page.
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

	function write_gad2($type, $mysqli)
	{	
	global $i;

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}
	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="GAD-2" AND '.$type.'=1';
		}	
	else{
		exit();
		}	
	
	if($result = $mysqli->query($query))
		{
			if ($i == 0) 
			{
				$i=1;
			};							
			if($result->num_rows > 0 )
			{ 
				//If there are questions to write, write them. Otherwise don't.
				echo "<br><hr>\n";
				echo "<div id=\"gad_section\"><p>How often in the <b>past 30 Days,</b> have you ";
				echo "been bothered by the following problems? (GAD-2)</p>\n";
				echo "<table id=\"gad_questions\" border=\"1\">\n";
				echo "<tr><td class=\"gad_scale_pad\"></td><td class=\"gad_scale\"><center>Not at all</center></td>";
				echo "<td class=\"gad_scale\" ><center>Several days</center></td><td class=\"gad_scale\" ><center>Over half the days</center></td>";
				echo "<td class=\"gad_scale\" ><center>Nearly everyday</center></td></tr>\n";

				if ($result)
				{ //we got a result from the query  
				while($row = $result->fetch_assoc())   
		 		{
				echo "<tr class=\"gad_row\"" ; 
					if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">\n";
				//write_gad_question($i, $row['question']);
				echo "<td class=\"gad_question\">" . $i . ". \n"; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"gad_response\" id=\"gad2_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"gad2_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
				echo "<td class=\"gad_response\" id=\"gad2_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"gad2_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"gad_response\" id=\"gad2_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"gad2_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				echo "<td class=\"gad_response\" id=\"gad2_" . $row['Sub_ID'] . "-" . "4\"><center><input type=\"radio\" name=\"gad2_" . $row['Sub_ID'] . "\" value=\"3\" /></center></td>\n";
				$_SESSION["gad2_" . $row['Sub_ID']] = "-1";
				$i++;              

				} // end while
				echo "</tr>\n"; //close table row.
				}
				else
				{
				echo "GAD2 Query error!\n";
				}
			echo "</table></div><!-- close gad_section -->\n";


			}
	}
};

//Passing by reference if deprecated. 

function gad2_scoring($copy)
	{
	//	print_r($copy);
	require_once'constants.php';
	$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);
	if ($mysqli->connect_errno)
	{
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}	
	$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="GAD-2" AND type = "GAD-cutoff"');
    $row = $result->fetch_assoc();  
	$gad2_score = $copy['gad2_1']+$copy['gad2_2'];
	if ($gad2_score >3 )
	{ 		
		echo "<tr>";
		echo '<td><p style = "color: red; text-align: left">
		As scored by the GAD-2, the patient shows signs of Anxiety.
		</p>';
		echo "SCORE: " . $gad2_score;
		echo "/6. <br>Scoring 0–6: This assessment is a subsectioning of the larger GAD-7 assessment. Any score greater than 3 suggests anxiety or panic disorder.<br><br>";
		echo "Source: Spitzer, R. L., Kroenke, K., Williams, J. B., & Löwe, B. (2006). A brief measure for assessing generalized anxiety disorder: the GAD-7.<br>
		 Archives of internal medicine, 166(10), 1092-1097. </td> </tr>";	
	} else 
	{
		echo "<tr>";
		echo '<td><p text-align: left">
		As scored by the GAD-2, the patient DOES NOT show signs of Anxiety.
		</p>';
		echo "SCORE: " . $gad2_score;
		echo "/6. <br>Scoring 0–6: This assessment is a subsectioning of the larger GAD-7 assessment. Any score greater than 3 suggests anxiety or panic disorder.<br><br>";
		echo "Source: Spitzer, R. L., Kroenke, K., Williams, J. B., & Löwe, B. (2006). A brief measure for assessing generalized anxiety disorder: the GAD-7.<br>
		 Archives of internal medicine, 166(10), 1092-1097. </td> </tr>";
                
                //https://www.fpnotebook.com/psych/exam/GnrlzdAnxtyDsrdrScl.htm
	}
	};


?>