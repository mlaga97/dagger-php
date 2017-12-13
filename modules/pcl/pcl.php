<?php
//write_CD will get all the selected gad questions and place them and the response matrix on the page.
function pcl_scoring($copy, $mysqli)
{
	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}	
	$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="PCL-C" AND type = "PCL-cutoff"');
    $row = $result->fetch_assoc(); 
	$pcl_score = $copy['pcl_1'] + $copy['pcl_2'] + $copy['pcl_3'] + $copy['pcl_4'] + $copy['pcl_5'] + $copy['pcl_6'] + $copy['pcl_7'] + $copy['pcl_8'] + $copy['pcl_9'] + $copy['pcl_10'] + 
	             $copy['pcl_11'] + $copy['pcl_12'] + $copy['pcl_13'] + $copy['pcl_14'] + $copy['pcl_15'] + $copy['pcl_16']  + $copy['pcl_17'];
	if ($pcl_score >= $row['cutoff_value'])
	{
		echo "<tr>";
		echo '<td><p style = "color: red; text-align: left">
		As scored by the PCL, the patient shows signs of Post Traumatic Stress.
		</p>';
		echo "SCORE: " . $pcl_score;
		echo "/85. <br>The cutoff score is suggested to be between 45 - 50 for civilian mental health facilities.<br>
		Source: Weathers, Litz, Huska, & Keane National Center for PTSD - Behavioral Science Division.<br> This is a Government document in the public domain.</td>";
		echo "</tr>";		
		// possible 85, cutoff is suggested at 45-50 for civilian mental health facilities. 
	} else 
	{
		echo "<tr>";
		echo '<td><p text-align: left">
		As scored by the PCL, the patient DOES NOT show signs of Post Traumatic Stress.
		</p>';
		echo "SCORE: " . $pcl_score;
		echo "/85. <br>The cutoff score is suggested to be between 45 - 50 for civilian mental health facilities.<br>
		Source: Weathers, Litz, Huska, & Keane National Center for PTSD - Behavioral Science Division.<br> This is a Government document in the public domain.</td>";
		echo "</tr>";		
		// possible 85, cutoff is suggested at 45-50 for civilian mental health facilities. 
	}
};
?>
