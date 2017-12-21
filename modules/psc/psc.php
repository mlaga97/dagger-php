<?php
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
