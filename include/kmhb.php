<?php
/*
* Maximum score = none.
* Scoring is as follows:
* 
* Two (2) or more affirmative responses indicates the client is a problem drinker.
*/
	function write_kmhb($type, $mysqli)
	{
		
	global $i;

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	
	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="KMHB" AND '.$type.'=1';
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
			echo "<div id=\"kmhb_section\"><p>Please answer yes or no for the following questions. (adapted from Keenan-Miller, Hammen, & Brennan, 2007)</p>\n";
			echo "<table class = \kmhb\" id=\"kmhb_questions\" border=\"1\">\n";
			echo "<tr><td class=\"kmhb_scale_pad\"></td><td class=\"kmhb_scale\"><center>Yes</center></td>\n";
			echo "<td class=\"kmhb_scale\" ><center>No</center></td></tr>\n";

			if ($result){ //we got a result from the query  
				while($row = $result->fetch_assoc()) {
					echo "<tr class=\"kmhb_row\">";
					//write_gad_question($i, $row['question']);
					echo "<td class=\"kmhb_question\">" . $i . ". "; 
					echo $row['question'] . "</td>\n";           
					echo "<td class=\"kmhb_response\" id=\"kmhb_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"kmhb_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
					echo "<td class=\"kmhb_response\" id=\"kmhb_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"kmhb_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
					if ($row['id'] == '93'){
							echo "<tr><td colspan = 3 class=\"kmhb_supplimental\"><label for=\"supp_1\">If you answered yes to question ". $i .", what conditions/symptoms?</label><p><input type=\"text\" name=\"supp_1\"></p></td>";
						}
					if ($row['id'] == '94'){
						echo "<tr><td colspan = 3 class=\"kmhb_supplimental\"><label for=\"supp_1\">If you answered yes to question ". $i .", are there any services that you would like to receive for these problems? </label><p><input type=\"text\" name=\"supp_1\"></p></td>";
					}
					$_SESSION["kmhb_" .$row['Sub_ID']] = "-1";
					$i++;
		               

		}// end while
			echo "</tr>\n"; //close table row.
		}
		else{
			echo "Query error!";
		}
		echo "</table></div><!--end div kmhb_section -->\n";
		
	}
}
};
?>