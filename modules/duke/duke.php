<?php
//write_CD will get all the selected gad questions and place them and the response matrix on the page.
function write_duke($type, $mysqli)
{
	global $i;
	$first = TRUE;
	
	if ($mysqli->connect_errno)
	{
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}

	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="DUKE-G" AND '. $type .'=1';
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
	{ //If there are questions to write, write them. Otherwise don't.
		echo "<br><hr>";
		$first = FALSE;
		echo "<div id=\"duke_general_section\">";
		echo "<p><center><h1>Duke Health Profile (The Duke)</h1></center>";
		echo "<center>Copyright &#169; 1989-2005 by the Department of Community and Family Medicine.";
		echo "<br>Duke University Medical Center, Durham, NC, USA </center>";
		if ($type === "Child")
		{
			echo "<p>Please select situation that best fits your child.</p>\n";
		} 
		else
		{
			echo "<p>Please select situation that best fits you.</p>\n";
		}
		echo "<table id=\"duke_questions\" border=\"1\">\n";
		echo "<tr><td class=\"duke_scale_pad\"></td><td class=\"duke_scale\"><center>Yes, describes me exactly.</center></td>\n";
		echo "<td class=\"duke_scale\" ><center>Somewhat describes me.</center></td>\n";
		echo "<td class=\"duke_scale\" ><center>No, doesn't describe me at all.</center></td></tr>\n";

	if ($result)
	{ //we got a result from the query  
		while($row = $result->fetch_assoc()) 
		{
				echo "<tr class=\"duke_row\"";
				if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">";
				//write_question($i, $row['question']);
				echo "<td class=\"duke_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";  
				// Some questions have reverse scoring.
				if (($row['Sub_ID'] === '2') || ($row['Sub_ID'] === '4') || ($row['Sub_ID'] === '5') || ($row['Sub_ID'] === '15') || ($row['Sub_ID'] === '16'))
				{         
					echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
					echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
					echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				}
				else
				{
					echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
					echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
					echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";	
				}
				$_SESSION["duke_" . $row['Sub_ID']] = "-1";
				$i++;     
				echo "</tr>\n"; //close table row.         
		}// end while
		echo "</table></div><!--end div duke_general_section -->\n";
	}
	}
	}
	else
	{
		echo "Duke Query error!";
	}


	if($result = $mysqli->query('SELECT * FROM questions WHERE classification="DUKE-T" AND '.$type.'=1'))
	{
		if ($i == 0) 
		{
			$i=1;
		};
	if($result->num_rows > 0 ) 
	{ //If there are questions to write, write them. Otherwise don't.
		if ($first){
			echo "<br><hr>";
			$first = FALSE;
		}
		echo "<div id=\"duke_physical_section\">";
		if ($type === "Child")
		{
			echo "<p>TODAY would your child have any physical trouble or difficulty:</p>\n";
		} 
		else
		{
			echo "<p>TODAY would you have any physical trouble or difficulty:</p>\n";
		}
		echo "<table id=\"duke_physical_questions\" border=\"1\">\n";
		echo "<tr><td class=\"duke_scale_pad\"></td><td class=\"duke_scale\"><center>None</center></td>\n";
		echo "<td class=\"duke_scale\" ><center>Some</center></td>\n";
		echo "<td class=\"duke_scale\" ><center>A Lot</center></td></tr>\n";

	if ($result)
	{ //we got a result from the query  
		while($row = $result->fetch_assoc()) 
		{
				echo "<tr class=\"duke_row\"";
				if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">";
				//write_question($i, $row['question']);
				echo "<td class=\"duke_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
				$_SESSION["duke_" . $row['Sub_ID']] = "-1";
				$i++;     
				echo "</tr>\n"; //close table row.         
		}// end while
		echo "</table></div><!--end div duke_physical_section -->\n";
	}
	}
	}
	else
	{
		echo "Query error!";
	}

	if($result = $mysqli->query('SELECT * FROM questions WHERE classification="DUKE-W" AND '.$type.'=1'))
	{
		if ($i == 0) 
		{
			$i=1;
		};
	if($result->num_rows > 0 ) 
	{ //If there are questions to write, write them. Otherwise don't.
		if ($first){
			echo "<br><hr>";
			$first = FALSE;
		}
		echo "<div id=\"duke_week_section\">";
		if ($type === "Child")
		{
			echo "<p>DURING THE PAST WEEK: How much trouble has your child had with:</p>\n";
		} 
		else
		{
			echo "<p>DURING THE PAST WEEK: How much trouble have you had with:</p>\n";
		}
		echo "<table id=\"duke_week_questions\" border=\"1\">\n";
		echo "<tr><td class=\"duke_scale_pad\"></td><td class=\"duke_scale\"><center>None</center></td>\n";
		echo "<td class=\"duke_scale\" ><center>Some</center></td>\n";
		echo "<td class=\"duke_scale\" ><center>A Lot</center></td></tr>\n";

	if ($result)
	{ //we got a result from the query  
		while($row = $result->fetch_assoc()) 
		{
				echo "<tr class=\"duke_row\"";
				if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">";
				//write_question($i, $row['question']);
				echo "<td class=\"duke_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
				$_SESSION["duke_" . $row['Sub_ID']] = "-1";
				$i++;     
				echo "</tr>\n"; //close table row.         
		}// end while
		echo "</table></div><!--end div duke_week_section -->\n";
	}
	}
	}
	else
	{
		echo "Query error!";
	}

	if($result = $mysqli->query('SELECT * FROM questions WHERE classification="DUKE-SW" AND '.$type.'=1'))
	{
		if ($i == 0) 
		{
			$i=1;
		};
	if($result->num_rows > 0 ) 
	{ //If there are questions to write, write them. Otherwise don't.
		if ($first){
			echo "<br><hr>";
			$first = FALSE;
		}
		echo "<div id=\"duke_social_section\">";
		if ($type === "Child")
		{
			echo "<p>DURING THE PAST WEEK: How often did your child:</p>\n";
		} 
		else
		{
			echo "<p>DURING THE PAST WEEK: How often did you:</p>\n";
		}
		echo "<table id=\"duke_social_questions\" border=\"1\">\n";
		echo "<tr><td class=\"duke_scale_pad\"></td><td class=\"duke_scale\"><center>None</center></td>\n";
		echo "<td class=\"duke_scale\" ><center>Some</center></td>\n";
		echo "<td class=\"duke_scale\" ><center>A Lot</center></td></tr>\n";

	if ($result)
	{ //we got a result from the query  
		while($row = $result->fetch_assoc()) 
		{
				echo "<tr class=\"duke_row\"";
				if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">";
				//write_question($i, $row['question']);
				echo "<td class=\"duke_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				$_SESSION["duke_" . $row['Sub_ID']] = "-1";
				$i++;     
				echo "</tr>\n"; //close table row.         
		}// end while
		echo "</table></div><!--end div duke_social_section -->\n";
	}
	}
	}
	else
	{
		echo "Query error!";
	}

	if($result = $mysqli->query('SELECT * FROM questions WHERE classification="DUKE-LW" AND '.$type.'=1'))
	{
		if ($i == 0) 
		{
			$i=1;
		};
	if($result->num_rows > 0 ) 
	{ //If there are questions to write, write them. Otherwise don't.
		if ($first){
			echo "<br><hr>";
			$first = FALSE;
		}
		echo "<div id=\"duke_living_section\">";
		if ($type === "Child")
		{
			echo "<p>DURING THE PAST WEEK: How often did your child:</p>\n";
		} 
		else
		{
			echo "<p>DURING THE PAST WEEK: How often did you:</p>\n";
		}
		echo "<table id=\"duke_living_questions\" border=\"1\">\n";
		echo "<tr><td class=\"duke_scale_pad\"></td><td class=\"duke_scale\"><center>None</center></td>\n";
		echo "<td class=\"duke_scale\" ><center>1-4 Days</center></td>\n";
		echo "<td class=\"duke_scale\" ><center>5-7 Days</center></td></tr>\n";

	if ($result)
	{ //we got a result from the query  
		while($row = $result->fetch_assoc()) 
		{
				echo "<tr class=\"duke_row\"";
				if ($i%2 == 0) 
						echo "style=\"background-color: #EFFBFB;\"";
				echo ">";
				//write_question($i, $row['question']);
				echo "<td class=\"duke_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"duke_response\" id=\"duke_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"duke_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
				$_SESSION["duke_" . $row['Sub_ID']] = "-1";
				$i++;     
				echo "</tr>\n"; //close table row.         
		}// end while
		echo "</table></div><!--end div duke_living_section -->\n";
	}
	}
	}
	else
	{
		echo "DUKE Query error!";
	}
};

function duke_scoring( $copy, $mysqli)
{
	$error_message = "Unable to score subsection";
	$need_to_print_score = false;
	$physical_score = "Not Scored";
	$mental_score = "Not Scored";
	$social_score = "Not Scored";
	
if (($copy['duke_8']  != '') && ($copy['duke_8'] != '-1') && 
	($copy['duke_9']  != '') && ($copy['duke_9'] != '-1') && 
	($copy['duke_10'] != '') && ($copy['duke_10']!= '-1') && 
	($copy['duke_11'] != '') && ($copy['duke_11']!= '-1') && 
	($copy['duke_12'] != '') && ($copy['duke_12']!= '-1'))
	{
		$physical_score = ($copy['duke_8']+ $copy['duke_9']+ $copy['duke_10']+ $copy['duke_11']+ $copy['duke_12']) * 10;
		$need_to_print_score = true;
	}
else
	{
		$physical_score = $error_message;
	}

if (($copy['duke_1'] != '') && ($copy['duke_1']!= '-1') && 
	($copy['duke_4'] != '') && ($copy['duke_4']!= '-1') && 
	($copy['duke_5'] != '') && ($copy['duke_5']!= '-1') && 
	($copy['duke_13']!= '') && ($copy['duke_13']!= '-1') && 
	($copy['duke_14']!= '') && ($copy['duke_14']!= '-1'))
	{
		$mental_score = ($copy['duke_1']+ $copy['duke_4']+ $copy['duke_5']+ $copy['duke_13']+ $copy['duke_14']) * 10;
		$need_to_print_score = true;
	}
else
	{
		$mental_score = $error_message;
	}

if (($copy['duke_2']  != '')  && ($copy['duke_2']  != '-1') && 
	($copy['duke_6']  != '')  && ($copy['duke_6']  != '-1') && 
	($copy['duke_7']  != '')  && ($copy['duke_7']  != '-1') && 
	($copy['duke_15'] != '')  && ($copy['duke_15'] != '-1') && 
	($copy['duke_16'] != '')  && ($copy['duke_16'] != '-1')) 
	{
		$social_score = ($copy['duke_2']+ $copy['duke_6']+ $copy['duke_7']+ $copy['duke_15']+ $copy['duke_16']) * 10;
		$need_to_print_score = true;
	} 
else 
	{
		$social_score = $error_message;
	}

if ((is_numeric($physical_score)) && (is_numeric($mental_score)) && (is_numeric($social_score))) 
	{
		$general_health_score = ($physical_score + $mental_score + $social_score )/ 3;
		$need_to_print_score = true;
	} 
else 
	{
		$general_health_score = $error_message;
	}

if (($copy['duke_3'] != '') && ($copy['duke_3'] != '-1')) 
	{
		$perceived_health_score = $copy['duke_3'] * 50;
		$need_to_print_score = true;
	} 
else 
	{
		$perceived_health_score = $error_message;
	}

if (($copy['duke_1']!= '') && ($copy['duke_1']!= '-1') && 
	($copy['duke_2']!= '') && ($copy['duke_2']!= '-1') && 
	($copy['duke_4']!= '') && ($copy['duke_4']!= '-1') && 
	($copy['duke_6']!= '') && ($copy['duke_6']!= '-1') && 
	($copy['duke_7']!= '') && ($copy['duke_7']!= '-1')) 
	{
		$self_esteem_score = ($copy['duke_1'] + $copy['duke_2'] + $copy['duke_4'] + $copy['duke_6'] + $copy['duke_7']) * 10;
		$need_to_print_score = true;
	} 
	else 
	{
		$self_esteem_score = $error_message;
	}


if (($copy['duke_2']!= '')  && ($copy['duke_2'] != '-1') && 
	($copy['duke_5']!= '')  && ($copy['duke_5'] != '-1') && 
	($copy['duke_7']!= '')  && ($copy['duke_7'] != '-1') && 
	($copy['duke_10']!= '') && ($copy['duke_10']!= '-1') && 
	($copy['duke_12']!= '') && ($copy['duke_12'] != '-1') &&
	($copy['duke_14']!= '') && ($copy['duke_14'] != '-1')) 
{
	$anxiety_score = 0;

	switch ($copy['duke_2']) {
		case '0':
		$anxiety_score = $anxiety_score + 2;
		break;

		case '1':
		$anxiety_score = $anxiety_score + 1;
		break;
	} 
	switch ($copy['duke_5']) {
		case '0':
		$anxiety_score = $anxiety_score + 2;
		break;

		case '1':
		$anxiety_score = $anxiety_score + 1;
		break;
	} 
	switch ($copy['duke_7']) {
		case '0':
		$anxiety_score = $anxiety_score + 2;
		break;

		case '1':
		$anxiety_score = $anxiety_score + 1;
		break;
	} 
	switch ($copy['duke_10']) {
		case '0':
		$anxiety_score = $anxiety_score + 2;
		break;

		case '1':
		$anxiety_score = $anxiety_score + 1;
		break;
	} 
	switch ($copy['duke_12']) {
		case '0':
		$anxiety_score = $anxiety_score + 2;
		break;

		case '1':
		$anxiety_score = $anxiety_score + 1;
		break;
	} 
	switch ($copy['duke_14']) {
		case '0':
		$anxiety_score = $anxiety_score + 2;
		break;

		case '1':
		$anxiety_score = $anxiety_score + 1;
		break;
	} 
	$anxiety_score = $anxiety_score * 8.333;
	$need_to_print_score = true;
}
else
{
	$anxiety_score = $error_message;
}

if (($copy['duke_4']!= '')  && ($copy['duke_4']!= '-1') && 
	($copy['duke_5']!= '')  && ($copy['duke_5']!= '-1') && 
	($copy['duke_10']!= '') && ($copy['duke_10']!= '-1') && 
	($copy['duke_12']!= '') && ($copy['duke_12']!= '-1') && 
	($copy['duke_13']!= '') && ($copy['duke_13']!= '-1'))
{

 $depression_score =0;

 switch ($copy['duke_4']) {
 	case '0':
 		$depression_score = $depression_score + 2;
 		break;

 	case '1':
 		$depression_score = $depression_score + 1;
 		break;	
 }
 switch ($copy['duke_5']) {
 	case '0':
 		$depression_score = $depression_score + 2;
 		break;

 	case '1':
 		$depression_score = $depression_score + 1;
 		break;	
 }
 switch ($copy['duke_10']) {
 	case '0':
 		$depression_score = $depression_score + 2;
 		break;

 	case '1':
 		$depression_score = $depression_score + 1;
 		break;	
 }
 switch ($copy['duke_12']) {
 	case '0':
 		$depression_score = $depression_score + 2;
 		break;

 	case '1':
 		$depression_score = $depression_score + 1;
 		break;	
 }
 switch ($copy['duke_13']) {
 	case '0':
 		$depression_score = $depression_score + 2;
 		break;

 	case '1':
 		$depression_score = $depression_score + 1;
 		break;	
 }
 $depression_score = $depression_score * 10;
 $need_to_print_score = true;
}
else
{
	$depression_score = $error_message;
}

if( ($copy['duke_4']!= '')  && ($copy['duke_4'] != '-1') && 
	($copy['duke_5']!= '')  && ($copy['duke_5'] != '-1') && 
	($copy['duke_7']!= '')  && ($copy['duke_7'] != '-1') && 
	($copy['duke_10']!= '') && ($copy['duke_10']!= '-1') && 
	($copy['duke_12']!= '') && ($copy['duke_12']!= '-1')&& 
	($copy['duke_13']!= '') && ($copy['duke_13']!= '-1') && 
	($copy['duke_14']!= '') && ($copy['duke_14']!= '-1'))
{

 $Duke_AD_score = 0;

	switch ($copy['duke_4']) {
 		case '0':
 			$Duke_AD_score = $Duke_AD_score + 2;
 			break;

 		case '1':
 			$Duke_AD_score = $Duke_AD_score + 1;
 			break;	
 	}
 	switch ($copy['duke_5']) {
 		case '0':
 			$Duke_AD_score = $Duke_AD_score + 2;
 			break;

 		case '1':
 			$Duke_AD_score = $Duke_AD_score + 1;
 			break;	
 	}
 	switch ($copy['duke_7']) {
 		case '0':
 			$Duke_AD_score = $Duke_AD_score + 2;
 			break;

 		case '1':
 			$Duke_AD_score = $Duke_AD_score + 1;
 			break;	
 	}
 	switch ($copy['duke_10']) {
 		case '0':
 			$Duke_AD_score = $Duke_AD_score + 2;
 			break;

 		case '1':
 			$Duke_AD_score = $Duke_AD_score + 1;
 			break;	
 	}
 	switch ($copy['duke_12']) {
 		case '0':
 			$Duke_AD_score = $Duke_AD_score + 2;
 			break;

 		case '1':
 			$Duke_AD_score = $Duke_AD_score + 1;
 			break;	
 	}
 	switch ($copy['duke_13']) {
 		case '0':
 			$Duke_AD_score = $Duke_AD_score + 2;
 			break;

 		case '1':
 			$Duke_AD_score = $Duke_AD_score + 1;
 			break;	
 	}
 	switch ($copy['duke_14']) {
 		case '0':
 			$Duke_AD_score = $Duke_AD_score + 2;
 			break;

 		case '1':
 			$Duke_AD_score = $Duke_AD_score + 1;
 			break;	
 	}
 	$Duke_AD_score = $Duke_AD_score * 7.143;
 	$need_to_print_score = true;
}
else
{
	$Duke_AD_score = $error_message;
}

if(($copy['duke_11'] != '') && ($copy['duke_11'] != '-1'))
{
 	$pain_score = 0;

 	switch ($copy['duke_11']) {
 		case '0':
 			$pain_score = $pain_score + 2;
 			break;

 		case '1':
 			$pain_score = $pain_score + 1;
 			break;	
 	}
 	$pain_score = $pain_score * 50;
 	$need_to_print_score = true;
}
else
{
	$pain_score = $error_message;
}

if(($copy['duke_17'] != '') && ($copy['duke_17'] != '-1'))
{
 	$disability_score = 0;

 	switch ($copy['duke_17']) {
 		case '0':
 			$disability_score = $disability_score + 2;
 			break;

 		case '1':
 			$disability_score = $disability_score + 1;
 			break;	
                    
 	}
 	$disability_score = $disability_score * 50;
 	$need_to_print_score = true;
}
else
{
	$depression_score = $error_message;
}

if ($need_to_print_score) { //need_to_print_score is true if any section of the assessment is scored.
	echo '<tr><td>';
	echo "<p><center><h1>Duke Health Profile (The Duke)</h1></center>";
	echo "<center>Copyright &#169; 1989-2005 by the Department of Community and Family Medicine.";
	echo "<br>Duke University Medical Center, Durham, NC, USA </center>";
	echo 'Physical Health Score: ' . $physical_score . '.<br>' ;
	echo 'Mental Health Score: '. $mental_score . '.<br>';
	echo 'Social Health Score: ' . $social_score . '.<br>';
	echo 'General Health Score: ' . $general_health_score . '.<br>';
	echo 'Perceived Health Score: ' . $perceived_health_score . '.<br>';
	echo 'Self-Esteem Score: ' . $self_esteem_score . '.<br>';
	echo 'Anxiety Score: ' . $anxiety_score . '.<br>';
	echo 'Depression Score: ' . $depression_score . '.<br>';
	echo 'Anxiety-Depression (Duke-AD) Score: ' . $Duke_AD_score . '.<br>';
	echo 'Pain Score: ' . $pain_score . '.<br>';
	echo 'Disability Score: ' . $disability_score . '.<br>';
	echo '</td></tr>';
	} 
	else
	{
	echo '<tr><td>';
	echo "<p><center><h1>Duke Health Profile (The Duke)</h1></center>";
	echo "<center>Copyright &#169; 1989-2005 by the Department of Community and Family Medicine.";
	echo "<br>Duke University Medical Center, Durham, NC, USA </center>";
	echo '<br><br>The assessment was not scored due to incomplete responses.<br>';
	echo '</td></tr>';
	}
};
?>