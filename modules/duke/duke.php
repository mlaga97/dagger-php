<?php
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