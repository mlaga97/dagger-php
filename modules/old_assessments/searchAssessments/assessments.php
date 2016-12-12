<?php
	$mysqli = dbOpen();

	$membership = new Membership ();

	if ($_POST && ! empty ( $_POST ['pt_id'] )) {
		$_SESSION ['pt_id'] = $_POST ['pt_id'];
		$info_store = strtolower ( $_SESSION ['pt_id'] );
		$info_store = hash ( 'sha256', $info_store );
		$id_store = $_SESSION ['user_id'];

		// Generate request using tag list
		// TODO: Determine why the following line is not a suitable substitute.
		//$query_clinic = "SELECT * FROM response, clinic where pt_id = '$info_store' AND clinic.id = response.clinic_id AND clinic_id IN(select clinic_id FROM groups where user_id = '$id_store')order by response.id  DESC";
    	$query_clinic = "SELECT response.pt_id, response.id, response.date, clinic.name";
    	foreach(getConfigKey("edu.dagger.main.searchAssessment.tags") as $key => $value) {
    		$query_clinic = $query_clinic . ', response.' . $key;
    	}
    	$query_clinic = $query_clinic . " FROM response, clinic where pt_id = '$info_store' AND clinic.id = response.clinic_id AND clinic_id IN(select clinic_id FROM groups where user_id = '$id_store')order by response.id  DESC";

		// We're going to make the above query into the one below.
		$query_contact = "SELECT contact_activity.pt_id, (select users.name from users where users.id = contact_activity.user_id) as name, contact_activity.id, contact_activity.contact_date, contact_activity.entry_date, contact_activity.contact_type, contact_activity.contact_outcome, contact_activity.outcome_other, contact_activity.contact_reason, contact_activity.reason_other, contact_activity.clinic_id, contact_activity.contact_time, contact_activity.group_other FROM contact_activity where pt_id = '$info_store' AND contact_activity.clinic_id IN(select clinic_id FROM groups where user_id = '$id_store')order by contact_activity.contact_date  DESC";

		$info = $mysqli->query ( $query_clinic );
		$contact_info = $mysqli->query ( $query_contact );
		echo "<table border = \"0\"><td>";
		echo "<tr>";
		$first = 0;

		global $row;
		while ( $row = $info->fetch_assoc () ) {
			if (($first === 0) && ($_SESSION ['admin'] == 1)) {
				echo $row ['pt_id'];
				echo "</tr><tr>";
				$first ++;
			}
			echo "<td>";
			echo "<input type =\"radio\" input id = \"id\" name =\"search_select\"  value=\"" . $row ['id'] . "\">";
			echo "</td>";

			echo "<td>";
			print_r ( $row ['name'] );
			echo "</td>";

			echo "<td>";
			echo "<p style = color:blue>";
			echo $row ['date'];
			echo "</p>";
			echo "</td>";

			echo "<td>";
			echo "<p style = color:red>";

			foreach(getConfigKey("edu.dagger.main.searchAssessment.tags") as $key => $value) {
				if($row[$key] == 1) {
					echo $value . ' ';
				}
			}

			echo "</p>";
			echo "</td>";
			echo "</tr>";
		}
		echo "</table><br>";
		echo "<button onclick =\"search_select(form2);\" type =\"submit\" style = \"height: 25px; width: 100px\">View</button>";
		echo "<br>";
		echo "<br></form>";

		echo "<br><center><h1>Select trend options below.</h1></center>";
		echo '<span class="class1">
	        <ul>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_gad.php" target ="_blank" >GAD-7</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_phq.php" target ="_blank" >PHQ-9</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_pcl-c.php" target ="_blank" >PCL-C</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_audit.php" target ="_blank">AUDIT-C</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_cage.php" target ="_blank">CAGE</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_psc.php" target ="_blank">PSC-17</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_ces.php" target ="_blank">CES-D</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_dast.php" target ="_blank">DAST-10</a></li>
	        </ul>
	        <p>
	        Please note: <ol><li>If there are no scorable assessments, there will be no trend graphic presented.</li> 
	        <li>Only scorable responses will be shown on the trend.</li><li> The trend graphic will 
	        be shown in a separate browser tab.</li><li>Trending requires at least two (2) scorable responses.</li>
	        <li>Time progresses from left to right. In otherwords, scores to the left of the trend are OLDER than those on the right. This
	        holds true even if multiple assessments were given on the same date.</li>
	        <li>The date format is YYYY/MM/DD</li></ol>
	        </p>';
		echo "<br><center><h1>Select The Duke trend options below.</h1></center>";
		echo '<ul>  
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_bar.php" target ="_blank">Composite (Bar)</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_line.php" target ="_blank">Composite (Line)</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_physical.php" target ="_blank">Physical</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_mental.php" target ="_blank">Mental</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_social.php" target ="_blank">Social</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_general.php" target ="_blank">General</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_perceived.php" target ="_blank">Perceived</a></li><br><br>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_self-esteem.php" target ="_blank">Self-Esteem</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_anxiety.php" target ="_blank">Anxiety</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_depression.php" target ="_blank">Depression</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_anxiety-depression.php" target ="_blank">Anxiety-Depression</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_pain.php" target ="_blank">Pain</a></li>
	        <li style = "display:inline;"><a href="/include/pChart/trend/trend_duke_disability.php" target ="_blank">Disability</a></li>
	        </ul>
	        </span>
	        <p>
	        Please note: <ol><li>The notes in the above trending section are applicable to this section.</li>
	        <li>The composite options will trend all the sub-scores on a single trend. This yields a very busy trend.</li>
	        <li>On composite trends, a \'-1\' on the trend indicates that the sub-score could not be calculated. These dates are omitted
	        when a single item is trended.</li> 
	        <li>The remaining choices yield the individual sub-score on a single trend.</li></ol>
	        </p>';
	} else {
		echo '<p style = "color: red; text-align: left">Please enter a patient ID.</p><br><br>';
	}
?>
