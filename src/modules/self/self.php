<?php

//write_gad will get all the selected gad questions and place them and the response matrix on the page.
/*
 * Maximum score = 21.
 * Scoring is as follows:
 * score: Depression/Serverity: 	
 * 0-5: 		none: 				
 * 6-10: 	mild: 				
 * 11-15: 	moderate: 			
 * 15-21:	severe				
 *
 * Further evaluation is recommended for a score of 10 or greater.
 * 
 */
//Passing by reference if deprecated. 

function self_scoring($copy, $mysqli) {
    //////////////////////////////////Print our self-care////////////////////////////////////////////////
//    print_r($copy);

	if($copy['self_check'] == 1)
	{
	$n = 1;
	$first = 0;
	$count = $mysqli->query("SELECT COUNT(id) as num FROM questions WHERE classification= 'self-care'");
	$count_no = $count->fetch_assoc();
	while($n <= $count_no['num'])
	{	
		if($copy['self_' .$n] > -1)
		{
			$first++;
			if($first == 1)
			{
				echo "<br/>";
				echo "<b>The responses for the self-care questions are as follows:</b> "; 
				echo "<br/>";
			}
			$result = $mysqli->query("SELECT question from questions where classification = 'self-care' and Sub_ID =  $n");
			$row = $result->fetch_assoc();
                        if ($copy['self_'.$n] != -1){
                            if (($n>17) && ($n!=19) && ($n!=22)){
                                if ($copy['self_'.$n] == 0) {
                                    $copy['self_'.$n]= "No";
                                } elseif ($copy['self_'.$n] == 1) {
                                    $copy['self_'.$n] = "Yes";
                                } elseif ($copy['self_'.$n] == 3){
                                    $copy['self_'.$n] = "Do Not Smoke"; 
                                }
                            }
                            if ($n==19){
                                if ($copy['self_18'] == "No"){ //They answered no to smoking therefore any response is wrong.
                                     $copy['self_'.$n] = "None";
                                }
                            }
                            if ($n==22){                 
                                if ($copy['self_'.$n] == 0) {
                                    $copy['self_'.$n] = ">2 yrs or never";
                                } elseif ($copy['self_'.$n] == 1) {
                                    $copy['self_'.$n] = "1-2 yrs ago";
                                } elseif ($copy['self_'.$n] == 2){
                                    $copy['self_'.$n] = "4-12 months ago";
                                } elseif ($copy['self_'.$n] == 3){
                                    $copy['self_'.$n] = "1-3 months ago";
                                } elseif ($copy['self_'.$n] == 4){
                                    $copy['self_'.$n] = "Within the last month";
                                } elseif ($copy['self_'.$n] == 5){
                                    $copy['self_'.$n] = "Today";
                                }
                            }

                            if ($n == 19){ 
                               if ($copy['self_18'] != "No")
                                  echo $row['question'] . ": " . $copy['self_'.$n];
                            } else {
                                 echo $row['question'] . ": " . $copy['self_'.$n];
                            }
                            echo "<br/>";
                        }
		}
               // print_r($copy); echo "<br>";
		$n++;
	}
	echo "<br>";
}}	
?>
