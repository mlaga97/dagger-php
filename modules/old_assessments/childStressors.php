<?php

	function write_childStressors($c, $mysqli) {
		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		$sub_class = $mysqli->query('SELECT distinct(sub_classification) FROM msihdp.questions where child =1 and classification like "%stressor%" and sub_classification is not null');
		$first = 1;
		while($d = $sub_class->fetch_assoc()) {
			if($result = $mysqli->query('SELECT * FROM questions WHERE classification="stressor" AND sub_classification= "' . $d['sub_classification'] . '" and ' .$c.'=1 order by sub_ordering' )) {
				if($result->num_rows > 0 ) {
					echo'<div id=\"current_stressors\"> ';
					if (($c=="Child") and ($first == 1)) {
						echo "<h3>Child Stressors</h3>\n
						<p><center>Has your child experienced any of the following stressors (Mark all that apply.)</center></p>\n
						<table width=\"800px\" border=\"1\" class=\"c_stress\" id=\"table_c_stressors_" . $d['sub_classification'] ."\">\n";
					} else {
						echo "<table width=\"800px\"  border=\"1\"  class=\"c_stress\"  id=\"table_c_stressors_". $d['sub_classification'] ."\">\n";
					}
					$first = 0;
					echo '<tr><th class="tdtopic" colspan="6">' .$d['sub_classification'] .'</th></tr>';
					$ci = 0;
					while($row = $result->fetch_assoc()) {
						if ($ci==0) {
							echo "<tr>";
						};
						if ($row['Sub_ID']!=30){
							//item 30 is a special case and is added after the loop.
							echo "<td class=\"c_stress\">" . $row['question'] ."</td><td class=\"stressor_input\"><center><input type=\"checkbox\" name=\"s_" . $row['Sub_ID'] . "\" value=\"". $row['Sub_ID'] ."\" style=\"vertical-align: bottom\"/></center></td>\n";
							$_SESSION["s_" . $row['Sub_ID']] = "-1";
							$ci++;
						}
						if ($ci==2) {
							echo "</tr>"; $ci=0;
						};
					};
					echo "</table></div>";
				};
			}
			$result->close();
		}
	}

?>
