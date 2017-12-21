<?php
function life_scoring($copy, $mysqli){

    if (($copy['life_1'] ==1)||($copy['life_2'] ==1)||($copy['life_3'] ==1)){ //if there was a positive response to any of the yes/no questions
            echo "<div>As documented in the Life Attitudes Schedule, note the following issues:</div>";
            echo "<span style=\"color:red\">";
        if ($copy['life_1'] ==1){

            echo "<p>The client noted a desire to kill him or herself.</p>";
        }
        if ($copy['life_2'] ==1){
            echo "<p>The client noted a desire to kill him or herself.</p>";
            if ($copy['life_4'] !=""){
                echo " The client documented the following explaination: ".$copy['life_4'];
            }
        }
        if ($copy['life_3'] ==1){
            echo "<p>The client noted a desire to hurt him or herself.</p>";
            if ($copy['life_5'] !=""){
                echo " The client documented the following explaination: ".$copy['life_5'];
            }
        }
    }
    echo "</span>";
}
?>
