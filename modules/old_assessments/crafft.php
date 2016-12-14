<?php
/*
* Maximum score = none.
* Scoring is as follows:
* 
* Two (2) or more affirmative responses indicates the client is a problem drinker.
*/
	function write_crafft($type, $mysqli)
	{
	global $i;

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	

	if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE (classification="CRAFFT-A" or classification="CRAFFT-B") AND '.$type.'=1' ;
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
			echo "<div id=\"crafft_section\"><p>Please answer yes or no for the following questions. (Crafft-a/b)</p>\n";
			echo "<p>During the <b>last twelve months</b> have you:</p>\n";
			echo "<table id=\"crafft_questions\" border=\"1\">\n";
			echo "<tr><td class=\"crafft_scale_pad\"></td><td class=\"crafft_scale\"><center>Yes</center></td>\n";
			echo "<td class=\"crafft_scale\" ><center>No</center></td></tr>\n";

			if ($result){ //we got a result from the query  
				while($row = $result->fetch_assoc()) {
					echo "<tr class=\"crafft_row\" ";
                                        if ($i%2 == 0){
                                            echo "style=\"background-color: #EFFBFB;\"";
                                        } 	
                                        echo ">\n";
					echo "<td class=\"crafft_question\">" . $i . ". "; 
					echo $row['question'] . "</td>\n";           
					echo "<td class=\"crafft_response\" id=\"crafft_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"crafft_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
					echo "<td class=\"crafft_response\" id=\"crafft_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"crafft_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
					$_SESSION["crafft_" . $row['Sub_ID']] = -1;
					$i++;              

		}// end while
			echo "</tr>\n"; //close table row.
		}
		else{
			echo "Crafft Query error!";
		}
		echo "</table></div><!--end div crafft_section -->\n";
	}
}
}

function crafft_scoring($copy, $mysqli){
    if (($copy['crafft_1']>0) || ($copy['crafft_2'] > 0) || ($copy['crafft_3'] > 0)){
        echo "<tr>";
	echo '<td><p style = "color: red; text-align: left">As documented by the Crafft, the patient shows signs of substance abuse.</p>';
	echo "&copy; Children’s Hospital Boston, 2009. This form may be reproduced in its exact form for use in clinical settings, courtesy of the Center for Adolescent Substance Abuse Research, Children’s
        Hospital Boston, 300 Longwood Ave, Boston, MA 02115, U.S.A., (617) 355-5433, www.ceasar.org</td> </tr>";
    }
    
}
?>