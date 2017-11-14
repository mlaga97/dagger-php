<?php

//write_PSC will get all the selected gad questions and place them and the response matrix on the page.
function write_PSC($type, $mysqli) {
    global $i;

    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    if (($type == "Adult") || ($type == "Child") || ($type == "Adolescent")) {
        $query = 'SELECT * FROM questions WHERE classification="PSC-17" AND ' . $type . '=1';
    } 
    else {
        exit();
    }

    if ($result = $mysqli->query($query)) {
        if ($i == 0) {
            $i = 1;
        }
        if ($result->num_rows > 0) { //If there are questions to write, write them. Otherwise don't.
            echo "<br><hr>";
            if ($type === "Child") {
                echo "<div id=\"psc_section\"><p>Please select situation that best fits your child. (PSC-17)</p>\n";
            } else {
                echo "<div id=\"psc_section\"><p>Please select situation that best fits you. (PSC-17)</p>\n";
            }
            echo "<table id=\"psc_questions\" border=\"1\">\n";
            echo "<tr><td class=\"psc_scale_pad\"></td><td class=\"psc_scale\"><center>Never</center></td>\n";
            echo "<td class=\"psc_scale\" ><center>Sometimes</center></td>\n";
            echo "<td class=\"psc_scale\" ><center>Often</center></td></tr>\n";

            if ($result) { //we got a result from the query  
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class=\"psc_row\"";
                    if ($i % 2 == 0)
                        echo "style=\"background-color: #EFFBFB;\"";
                    echo ">";
                    //write_question($i, $row['question']);
                    echo "<td class=\"psc_question\">" . $i . ". ";
                    echo $row['question'] . "</td>\n";
                    echo "<td class=\"psc_response\" id=\"psc_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"psc_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
                    echo "<td class=\"psc_response\" id=\"psc_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"psc_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
                    echo "<td class=\"psc_response\" id=\"psc_" . $row['Sub_ID'] . "-" . "3\"><center><input type=\"radio\" name=\"psc_" . $row['Sub_ID'] . "\" value=\"2\" /></center></td>\n";
                    $_SESSION["psc_" . $row['Sub_ID']] = "-1";
                    $i++;
                    echo "</tr>\n"; //close table row.         
                }// end while
                echo "</table></div><!--end div psc_section -->\n";
            }
        }
    }
    else {
        echo "Query error!";
    }

    //Present the follow-up questions.

    if ($result = $mysqli->query('SELECT * FROM questions WHERE classification="PSC-FU" AND ' . $type . '=1')) {
        if ($i == 0) {
            $i = 1;
        };

        if ($result->num_rows > 0) { //If there are questions to write, write them. Otherwise don't.
            echo "<div id=\"psc_fu_section\"><p>PSC follow-up questions. (PSC-35)</p>\n";
            echo "<p>Note: The following questions will only be scored with an affirmative score on the previous PSC-17 questions.</p>\n";
            echo "<table id=\"psc_fu_questions\" border=\"1\">\n";
            echo "<tr><td class=\"psc_fu_scale_pad\"></td><td class=\"psc_fu_scale\"><center>Yes</center></td>\n";
            echo "<td class=\"psc_fu_scale\" ><center>No</center></td></tr>\n";

            if ($result) { //we got a result from the query  
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class=\"psc_fu_row\"";
                    if ($i % 2 == 0)
                        echo "style=\"background-color: #EFFBFB;\"";
                    echo ">";
                    //write_question($i, $row['question']);
                    echo "<td class=\"psc_fu_question\">" . $i . ". ";
                    echo $row['question'];

                    if (($row['Sub_ID'] == 3) || ($row['Sub_ID'] == 6)) {
                        echo "<input id=\"psc_fu_txt\" type=\"text\" name=\"psc_fu_" . $row['Sub_ID'] . "\"></td>";
                        $_SESSION["psc_fu_" . $row['Sub_ID']] = "";
                        echo "</td>\n";
                    } else {
                        echo "</td>\n";
                        echo "<td class=\"psc_fu_response\" id=\"psc_fu_" . $row['Sub_ID'] . "-" . "1\"><center><input type=\"radio\" name=\"psc_fu_" . $row['Sub_ID'] . "\" value=\"1\" /></center></td>\n";
                        echo "<td class=\"psc_fu_response\" id=\"psc_fu_" . $row['Sub_ID'] . "-" . "2\"><center><input type=\"radio\" name=\"psc_fu_" . $row['Sub_ID'] . "\" value=\"0\" /></center></td>\n";
                        $_SESSION["psc_fu_" . $row['Sub_ID']] = "-1";
                    }
                    $i++;
                    echo "</tr>\n"; //close table row.
                }// end while	
                echo "</table></div><!--end div psc_fu_section -->\n";
            }
        }
    } else {
        echo "Query error!";
    }
}

function psc_scoring($copy, $mysqli) {
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    $result = $mysqli->query('SELECT cutoff_value FROM scoring WHERE name ="PSC-17" AND type = "PSC-cutoff"');
    $row = $result->fetch_assoc();
    $psc_score = $copy['psc_1'] + $copy['psc_2'] + $copy['psc_3'] + $copy['psc_4'] + $copy['psc_5'] + $copy['psc_6'] + $copy['psc_7'] + $copy['psc_8'] + $copy['psc_9'] + $copy['psc_10'] +
            $copy['psc_11'] + $copy['psc_12'] + $copy['psc_13'] + $copy['psc_14'] + $copy['psc_15'] + $copy['psc_16'] + $copy['psc_17'] + $copy['psc_18'] + $copy['psc_19'] + $copy['psc_20'] + $copy['psc_21'] + $copy['psc_22'] + $copy['psc_23'] + $copy['psc_24'] + $copy['psc_25'] + $copy['psc_26'] + $copy['psc_27'] + $copy['psc_28'] + $copy['psc_29'] + $copy['psc_30'] + $copy['psc_31'];

    if ($psc_score >= $row['cutoff_value']) {
        echo "<tr>";
        echo '<td><p style = "color: red; text-align: left"> As scored by the PSC-17, a score of 15 or higher suggests the presence of significant behavioral or emotional problems. ';
        echo $psc_score;
        echo "/34. The cutoff score is suggested to be 15.<br></td>";
        echo "</tr>";
    } else {
        echo "<tr>";
        echo '<td><p text-align: left"> As scored by the PSC-17, a score of 15 or higher suggests the presence of significant behavioral or emotional problems. ';
        echo $psc_score;
        echo "/34. The cutoff score is suggested to be 15.<br></td>";
        echo "</tr>";
    }
    if (($copy['psc_fu_1'] == 1) || ($copy['psc_fu_4'] == 1)) {
        echo "<tr>";
        echo '<td><p style = "color: red; text-align: left">';
        echo "The client or parent reported the existence of emotional or behavioral problems for which they need help. ";
        echo "</tr>";
    } else {
        echo "<tr>";
        echo '<td><p text-align: left">';
        echo "The client or parent DID NOT report the existence of emotional or behavioral problems for which they need help. ";
        echo "</tr>";
    }
    if (($copy['psc_fu_2'] == 1) || ($copy['psc_fu_5'] == 1)) {
        echo "<tr>";
        echo '<td><p style = "color: red; text-align: left">';
        echo "The client or parent reported a desire for services to help with those problems. ";
        if (($copy['psc_fu_3'] != "")) {
            echo 'Specifically, ' . $copy['psc_fu_3'] . '.';
        }
        if ($copy['psc_fu_6'] != "") {
            echo 'Specifically, ' . $copy['psc_fu_6'] . '.';
        }
        echo "</tr>";
    } else {
        echo "<tr>";
        echo '<td><p text-align: left">';
        echo "The client or parent DID NOT report a desire for services to help with those problems. ";
        echo "</tr>";
    }
    
    $internalizing =  $copy['psc_2'] +  $copy['psc_6'] +  $copy['psc_9'] + $copy['psc_15'];

    $attention= $copy['psc_1'] + $copy['psc_3'] + $copy['psc_7'] + $copy['psc_13'] + $copy['psc_17'];

    $externalizing= $copy['psc_4'] + $copy['psc_5'] + $copy['psc_8'] + $copy['psc_12'] + $copy['psc_14'] + $copy['psc_16'] ;

    if (($internalizing >= 5)&&($copy['psc_2'] > -1) && ($copy['psc_6']> -1) &&  ($copy['psc_9']> -1) && ($copy['psc_15']> -1)){
        echo"<p>The patient had an affirmative internalizing sub-score of ".$internalizing.".</p>";
    }
    if (($attention>=7)&& ($copy['psc_1']> -1) && ($copy['psc_3']> -1) && ($copy['psc_7']> -1) && ($copy['psc_13']> -1) && ($copy['psc_17']> -1)){
        echo"<p>The patient had an affirmative attention sub-score of ".$attention.".</p>";
    }
    if(($externalizing >= 7)&&($copy['psc_4']> -1)&& ($copy['psc_5']> -1) && ($copy['psc_8']> -1) && ($copy['psc_12']> -1) && ($copy['psc_14']> -1) && ($copy['psc_16']> -1)){
        echo"<p>The patient had an affirmative externalizing sub-score of ".$externalizing.".</p>";
    }
}
    
?>