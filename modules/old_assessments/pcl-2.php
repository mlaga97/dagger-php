<?php
//write_CD will get all the selected gad questions and place them and the response matrix on the page.
function write_pcl2($type, $mysqli)
{
	global $i;

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	

	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="PCL-C-2" AND '.$type.'=1';
		}	
	else{
		exit();
	}

	if($result = $mysqli->query($query))
	{
	if ($i == 0) {$i=1;
		};

	if($result->num_rows > 0 ) { //If there are questions to write, write them. Otherwise don't.
			echo "<br><hr>\n";
	echo "<div id=\"pcl_section\"><p>In the <b>last 30 days</b>, how much have you been bothered by the following? (PCL-C Abbreviated)</p>\n";
	echo "<table id=\"pcl_questions\" border=\"1\">\n";
	echo "<tr><td class=\"pcl_scale_pad\"></td><td class=\"pcl_scale\"><center>Not at all</center></td>\n";
	echo "<td class=\"pcl_scale\" ><center>A little bit</center></td><td class=\"pcl_scale\" ><center>Moderately</center></td>\n";
	echo "<td class=\"pcl_scale\" ><center>Quite a bit</center></td>";
	echo "<td class=\"pcl_scale\" ><center>Extremely</center></td></tr>\n";

	if ($result){ //we got a result from the query  
		while($row = $result->fetch_assoc()) {
				echo "<tr class=\"pcl_row\"";
				if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">";
				echo "<td class=\"pcl_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"pcl_response\" id=\"pcl2_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"pcl2_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"pcl_response\" id=\"pcl2_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"pcl2_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				echo "<td class=\"pcl_response\" id=\"pcl2_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"pcl2_" . $row['Sub_ID'] . "\" value=\"3\" /></center></td>\n";
				echo "<td class=\"pcl_response\" id=\"pcl2_" . $row['Sub_ID'] . "-" . "4\"><center><input type=\"radio\" name=\"pcl2_" . $row['Sub_ID'] . "\" value=\"4\" /></center></td>\n";
				echo "<td class=\"pcl_response\" id=\"pcl2_" . $row['Sub_ID'] . "-" . "5\"><center><input type=\"radio\" name=\"pcl2_" . $row['Sub_ID'] . "\" value=\"5\" /></center></td>\n";
				$_SESSION["pcl2_" . $row['Sub_ID']] = "-1";
				$i++;               

	}// end while
		echo "</tr>\n"; //close table row.
	}
	else{
		echo "Query error!";
	}
	echo "</table></div><!--end div pcl_section -->\n";
	}
}
};

function pcl2_scoring($copy, $mysqli)
{
	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	 
	$pcl_score = $copy['pcl2_1'] + $copy['pcl2_2'];
	if ($pcl_score >= 4)
	{
		echo "<tr>";
		echo '<td><p style = "color: red; text-align: left">
		As scored by the PCL-C (abbreviated), the patient shows signs of Post Traumatic Stress.
		</p>';
		echo "SCORE: " . $pcl_score;
		echo "/10. <br>The cutoff score is suggested to be 4 and greater.<br>
		Source: Lang, A.J., Stein, M.B. (2005) An abbreviated PTSD checklist for use as a screening instrument in primary care. <i>Behaviour Research and Therapy, 43</i>, 585-594.<br> This is a Government document in the public domain.</td>";
		echo "</tr>";		
	} else 
	{ if ($pcl_score > 0){
		echo "<tr>";
		echo '<td><p text-align: left">
		As scored by the PCL, the patient DOES NOT show signs of Post Traumatic Stress.
		</p>';
		echo "SCORE: " . $pcl_score;
		echo "/10. <br>The cutoff score is suggested to be 4 and greater.<br>
		Source: Lang, A.J., Stein, M.B. (2005) An abbreviated PTSD checklist for use as a screening instrument in primary care. <i>Behaviour Research and Therapy, 43</i>, 585-594.<br> This is a Government document in the public domain.</td>";
		echo "</tr>";
            }
	}
};
?>