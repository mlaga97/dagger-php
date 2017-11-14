<?php

	function write_diag_me($type, $mysqli) {
		global $i;

		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}

		if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")){
			$query = 'SELECT * FROM questions WHERE classification="Diag_me" AND '. $type .'=1';
		} else {
			exit();
		}

		if($result = $mysqli->query($query)) {
			if ($i == 0) {
				$i=1;
			};
			if($result->num_rows > 0 ) { //If there are questions to write, write them. Otherwise don't.
				echo "<br><hr>\n";
				echo "<div id=\"diag_me_section\">\n";
				echo "<table id=\"diag_me_questions\" border=\"1\">\n";
				echo "<tr><td colspan=\"1\"><center><b>Past and/or current mental diagnosis.</b></center></td><td colspan=\"2\"><p><center>Came today because of this?</center></p></td>";
				echo "<td colspan=\"5\"><p><center>Discomfort/Stress Level due to this issue?</center></p></td></tr>";
				echo "<tr><td colspan=\"3\"></td>\n";
				echo "<td class=\"cage_scale\" colspan=\"5\"><center>None <--------> Overwhelming</center></td></tr>\n";
				echo "<tr><td class=\"cage_scale_pad\"></td><td><center>Yes</center></td>\n";
				echo "<td><center>No</center></td>\n";
				echo "<td><center>1</center></td>\n";
				echo "<td><center>2</center></td>\n";
				echo "<td><center>3</center></td>\n";
				echo "<td><center>4</center></td>\n";
				echo "<td><center>5</center></td></tr>\n";
				if ($result) { //we got a result from the query
					while($row = $result->fetch_assoc())
					{
						echo "<tr class=\"cage_row\"";
						if ($i%2 == 0)
							echo "style=\"background-color: #EFFBFB;\"";
							echo ">";
							echo "<td class=\"cage_question\">" . $i . ". ";
							echo $row['question'] . "</td>\n";
							echo "<td class=\"cage_response\" id=\"diag_me_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"diag_me_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
							echo "<td class=\"cage_response\" id=\"diag_me_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"diag_me_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
							echo "<td class=\"cage_response\" id=\"diag_me_" . $row['Sub_ID'] . "_3\"><center><input type=\"radio\" name=\"diag_me_" . $row['Sub_ID'] . "_3\" value=\"0\" /></center></td>\n";
							echo "<td class=\"cage_response\" id=\"diag_me_" . $row['Sub_ID'] . "_3\"><center><input type=\"radio\" name=\"diag_me_" . $row['Sub_ID'] . "_3\" value=\"1\" /></center></td>\n";
							echo "<td class=\"cage_response\" id=\"diag_me_" . $row['Sub_ID'] . "_3\"><center><input type=\"radio\" name=\"diag_me_" . $row['Sub_ID'] . "_3\" value=\"2\" /></center></td>\n";
							echo "<td class=\"cage_response\" id=\"diag_me_" . $row['Sub_ID'] . "_3\"><center><input type=\"radio\" name=\"diag_me_" . $row['Sub_ID'] . "_3\" value=\"3\" /></center></td>\n";
							echo "<td class=\"cage_response\" id=\"diag_me_" . $row['Sub_ID'] . "_3\"><center><input type=\"radio\" name=\"diag_me_" . $row['Sub_ID'] . "_3\" value=\"4\" /></center></td>\n";
							$_SESSION["diag_me_" . $row['Sub_ID']] = -1;
							$_SESSION["diag_me_" . $row['Sub_ID'] . "_3"]  = -1;
							$i++;
					}
					echo "</tr>\n"; //close table row.
				} else {
					echo "MENTAL DIAGNOSIS Query error!";
				}
				echo "</table></div><!--end div cage_section -->\n";
			}
		}
	};

?>