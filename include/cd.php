<?php
//write_CD will get all the selected gad questions and place them and the response matrix on the page.
function write_CD($type,$mysqli)
{
	global $i;

  	if ($mysqli->connect_errno) //This function checks to see if the database connection failed.
	{
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();
	}	
	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="CD-RISC" AND '.$type.'=1';
		}	
	else{
		exit();
		}

	if ($result = $mysqli->query($query))
	{
		if ($i == 0) 
		{
			$i = 1;
		};

		if ($result->num_rows > 0 ) //If there are questions to write, write them. Otherwise don't.
		{ 
			echo "<br><hr>\n";
			if ($type === 'Child')
			{
				echo "<div id=\"cd_section\"><p>How true are the following statements for your child? (Connor-Davidson Resilience Scale)</p>\n";
			}
			else
			{
				echo "<div id=\"cd_section\"><p>How true are the following statements? (Connor-Davidson Resilience Scale)</p>\n";
			}
			echo "<table id=\"cd_questions\" border=\"1\">\n";
			echo "<tr><td class=\"cd_scale_pad\"></td>";
			echo "<td class=\"cd_scale\"><center>Not true</center></td>\n";
			echo "<td class=\"cd_scale\" ><center>Rarely true</center></td>\n";
			echo "<td class=\"cd_scale\" ><center>Sometimes true</center></td>\n";
			echo "<td class=\"cd_scale\" ><center>Often true</center></td>\n";
			echo "<td class=\"cd_scale\" ><center>True nearly all of the time</center></td></tr>\n";

			if ($result)
			{ //we got a result from the query  
				while($row = $result->fetch_assoc())
		 		{
					echo "<tr class=\"cd_row\"";
					if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
					echo ">";
					//write_gad_question($i, $row['question']);
					echo "<td class=\"cd_question\">" . $i . ". "; 
					echo $row['question'] . "</td>\n";           
					echo "<td class=\"cd_response\" id=\"cd_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"cd_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
					echo "<td class=\"cd_response\" id=\"cd_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"cd_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
					echo "<td class=\"cd_response\" id=\"cd_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"cd_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
					echo "<td class=\"cd_response\" id=\"cd_" . $row['Sub_ID'] . "-" . "4\"><center><input type=\"radio\" name=\"cd_" . $row['Sub_ID'] . "\" value=\"3\" /></center></td>\n";
					echo "<td class=\"cd_response\" id=\"cd_" . $row['Sub_ID'] . "-" . "5\"><center><input type=\"radio\" name=\"cd_" . $row['Sub_ID'] . "\" value=\"4\" /></center></td>\n";
					$_SESSION["cd_" . $row['Sub_ID']] = -1;
					$i++;             

				} // end while
				echo "</tr>\n"; //close table row.
			}

			else
			{
				echo "CD Query error!";
			}
			echo "</table></div><!--end div cd_section -->\n";
		}
	}		
};

function cd_scoring($type, $copy, $mysqli){

	$need_to_print_scoring = false;
	if ($mysqli->connect_errno)
	{
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();
	}		
	$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="CD-RISC" AND type = "CD-cutoff"');
    $row = $result->fetch_assoc(); 
    if ($type === 'Child')
    {
    	if (($copy['cd_3']!= '-1') && ($copy['cd_3']!= '') && ($copy['cd_4'] != '-1') && ($copy['cd_4'] != ''))
    	{
    		$cd_score = $copy['cd_3']+$copy['cd_4'];
                if ($cd_score >= 0){
    		$need_to_print_scoring = true;
                }
    	}    	
    }
    else
    {
    	if (($copy['cd_1'] != '-1') && ($copy['cd_2'] != '-1') && ($copy['cd_1'] != '') && ($copy['cd_2'] != '')) 
    	{
    		$cd_score = $copy['cd_1']+$copy['cd_2'];
    		if ($cd_score >= 0){
    		$need_to_print_scoring = true;
                }
    	}    	
    }  
    if (($cd_score <= $row['cutoff_value']) && ($need_to_print_scoring == true)){		
		echo "<tr>";
		if ($type === 'Child')
		{
			echo '<td><p style = "color: red; text-align: left">
			As scored by the Connor-Davidson Resilience Scale, 
			The Child shows signs of low resilience. 
			</p>';
		}
		else
		{
			echo '<td><p style = "color: red; text-align: left">
			As scored by the Connor-Davidson Resilience Scale, 
			The patient shows signs of low resilience. 
			</p>';
		}			
		echo "SCORE: " . $cd_score;
		echo "/10. The cutoff is suggested to be at 4 or below for low resilience.<br></td>";
		echo "</tr>";
	} 
	else
	{ if ($need_to_print_scoring == true){
		echo "<tr>";
		if ($type === 'Child')
		{
			echo '<td><p text-align: left">
			As scored by the Connor-Davidson Resilience Scale, 
			The Child DOES NOT show signs of low resilience. 
			</p>';
		}
		else
		{
			echo '<td><p red; text-align: left">
			As scored by the Connor-Davidson Resilience Scale, 
			The patient DOES NOT show signs of low resilience. 
			</p>';
		}			
		echo "SCORE: " . $cd_score;
		echo "/10. The cutoff is suggested to be at 4 or below for low resilience.<br></td>";
		echo "</tr>";
        }
	}
};
?>