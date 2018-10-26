<?php

  $router->map('OPTIONS', '/statistics', function() {
    jsonResponse(array(
      '/' => '',
    ));
  });

  // TODO: Replace this entirely, or at least fix it.
  $router->map('GET', '/statistics/user', function() {
    global $mysqli;
    $output = array();

    $userID = $_SESSION['user_id'];

    $query = "SELECT "; 
    $query .= "DATE_FORMAT(CURDATE(), '%W, %b %d, %Y') AS 'today', ";
    $query .= "WEEK(CURDATE(), 3) AS 'weekNumber', ";
    $query .= "DATE_FORMAT((curdate() - INTERVAL((WEEKDAY(curdate()))) DAY), '%W, %b %d') as 'weekStartDate', ";
    $query .= "DATE_FORMAT((curdate() - INTERVAL((WEEKDAY(curdate()))-6) DAY), '%W, %b %d') as 'weekEndDate', ";
    $query .= "SUM(JSON_CONTAINS(assessment_responses, '\"appointment\"', '$.mihdp.activityType')) as 'appointmentCount', ";
    $query .= "SUM(JSON_CONTAINS(assessment_responses, '\"warmHandOff\"', '$.mihdp.activityType')) as 'warmHandoffCount', ";
    $query .= "SUM(JSON_CONTAINS(assessment_responses, '\"hchScreening\"', '$.mihdp.activityType')) as 'hchCount', ";
    $query .= "COUNT(*) AS 'recordCount' ";
    $query .= "FROM msihdp.json_response WHERE user_id = '" . $userID . "' AND (WEEK(visit_date, 3) = WEEK(CURDATE(), 3));";

    // TODO: USE PREPARED STATEMENTS TO AVOID SQL INJECTION
    if($result = $mysqli->query($query)) {
      $row = $result->fetch_assoc();
      jsonResponse($row);
    } else {
      echo $mysqli->error;
    }

  });

?>
