<?php
//write_symptoms will get all the selected symptoms and place them and the response matrix on the page.
function write_symptoms($type, $mysqli)
{
	global $i;

	//print_r($_SESSION);

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	

	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
		$query = 'SELECT * FROM questions WHERE classification="symptom" AND '.$type.'=1';
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

	if($result->num_rows > 0 ) { //If there are questions to write, write them. Otherwise don't.
			echo "<br><hr>\n";
	if ($type=="Child"){
		echo "<div id=\"symptoms_section\"><p>Please rate how often your child experiences the following symptoms: (PHQ-15)</p>\n";
	}
	else{
			echo "<div id=\"symptoms_section\"><p>Please rate how often you experiences the following symptoms: (PHQ-15)</p>\n";
	}
	echo "<table id=\"symptoms_questions\" border=\"1\">\n";
	echo "<tr class=\"symptoms_row\"";
	echo ">";
	echo "<td class=\"symptoms_scale_pad\"></td><td class=\"symptoms_scale\"><center>Not bothered at all</center></td>\n";
	echo "<td class=\"symptoms_scale\" ><center>Bothered a little</center></td>\n";
	echo "<td class=\"symptoms_scale\" ><center>Bothered a lot</center></td>";
	echo "</tr>\n";

	if ($result){ //we got a result from the query  
		while($row = $result->fetch_assoc()) {
				echo "<tr class=\"symptoms_row\"";
				if ($i%2 == 0) 
					echo " style=\"background-color: #EFFBFB;\"";
				echo ">";
				echo "<td class=\"symptoms_question\">" . $i . ". "; 
				echo $row['question'] . "</td>\n";           
				echo "<td class=\"symptoms_response\" id=\"symptom_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"symptom_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
				echo "<td class=\"symptoms_response\" id=\"symptom_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"symptom_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
				echo "<td class=\"symptoms_response\" id=\"symptom_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"symptom_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
				$_SESSION["symptom_" . $row['Sub_ID']] = "-1";
				$i++;           

	}// end while
		echo "</tr>\n"; //close table row.
	}
	else{
		echo "Query error!";
	}
	echo "</table></div><!--end div symptoms_section -->\n";
}
}
};

?>