<?php
	function write_stressors($c, $mysqli)
	{

  	if ($mysqli->connect_errno)
	{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
	}
	
	if($result = $mysqli->query('SELECT * FROM questions WHERE classification="stressor" AND '.$c.'=1'))
	{

            if($result->num_rows > 0 )
            {            
            	if ($c=="Child")
            	{
            		echo "<h1><center>Current Stressors</center></h1>\n
            		<p><center>Has your child experienced any of the following stressors (Mark all that apply.)</center></p>\n
            		<div id=\"current_stressors\">\n		
            		<table border=\"1\" id=\"table_stressors\">\n";
            	}
            	else
            	{
            		echo "<h1><center>Current Stressors</center></h1>\n
            		<p><center>(Mark all that apply.)</center></p>\n
            		<div id=\"current_stressors\">\n		
            		<table border=\"1\" id=\"table_stressors\">\n";	
            	}

				$ci = 0;			 
				while($row = $result->fetch_assoc()) 
				{
					if ($ci==0)
					{ 
						echo "<tr>";
					};
                                        if ($row['Sub_ID']!=30){ //item 30 is a special case and is added after the loop.
					echo "<td class=\"stress\">" . $row['question'] ."</td><td class=\"stressor_input\"><center><input type=\"checkbox\" name=\"s_" . $row['Sub_ID'] . "\" value=\"". $row['Sub_ID'] ."\" style=\"vertical-align: bottom\"/></center></td>\n";
					$_SESSION["s_" . $row['Sub_ID']] = "-1";
					$ci++;
                                        }

					if ($ci==2)
					{
						echo "</tr>"; $ci=0;
					};
					
					
				};

				echo "</table><!-- end table stressors -->\n				
				</div><!-- end div current_stressors -->\n";
		};
        }
		 $result->close();
                 if ($c == "Child") {
                    echo "<br><table id=\"psc_fu_questions\" border=\"1\">\n";       
                    echo "<table><td class=\"psc_fu_question\">";
                    echo "If there has been a stressful experience your child is re-experiencing, please describe the event.";
                    echo "<input id=\"s_30\" type=\"text\" name=\"s_30\" size=\"100\"></td>";
                    $_SESSION['s_30'] = " ";
                    echo "</td></table><br>";  
                }
        
 }

 
//This scores the continum scale of stress level. There is no cut-off for the individual stressors.
function stressors_scoring($copy, $mysqli)
	{
		require_once'constants.php';

		if ($mysqli->connect_errno)
		{
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();
		}	

		$result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="stressor" AND type = "stressor-cutoff"');
   		$row = $result->fetch_assoc(); 
		if (!array_key_exists('stress', $copy))  // If there is no stress in the array, set the value == -1. 
		{ 
	 		$copy['stress'] = -1;
		}
		
		if($copy['stress'] >= $row['cutoff_value'])
		{

		echo "<tr>";
		echo '<td><p style = "color: red; text-align: left">
		The patient shows signs of stress. 
		</p>';
		echo "SCORE: " . $copy['stress'];
		echo "/10. The cutoff is suggested to be at 6 for high stress.<br></td>";
		echo "</tr>";
		}

	};
?>