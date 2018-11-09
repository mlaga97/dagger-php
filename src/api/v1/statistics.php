<?php

  $router->map('OPTIONS', '/statistics', function() {
    jsonResponse([
      '/user' => 'Get user statistics.',
    ]);
  });

  // TODO: Replace this entirely, or at least fix it.
  $router->map('GET', '/statistics/user', function() {
    global $mysqli;
    $output = [];

    $userID = $_SESSION['user_id'];

    $query = "SELECT ";
    $query .= "DATE_FORMAT(CURDATE(), '%W, %b %d, %Y') AS 'thisWeek_today', ";
    $query .= "WEEK(CURDATE(), 3) AS 'thisWeek_weekNumber', ";
    $query .= "DATE_FORMAT((curdate() - INTERVAL((WEEKDAY(curdate()))) DAY), '%W, %b %d') as 'thisWeek_weekStartDate', ";
    $query .= "DATE_FORMAT((curdate() - INTERVAL((WEEKDAY(curdate()))-6) DAY), '%W, %b %d') as 'thisWeek_weekEndDate', ";
    $query .= "SUM(CASE WHEN (WEEK(visit_date, 3) = WEEK(CURDATE(), 3) AND JSON_CONTAINS(assessment_responses, '\"appointment\"', '$.mihdp.activityType')) THEN 1 ELSE 0 END) AS 'thisWeek_appointmentCount', ";
    $query .= "SUM(CASE WHEN (WEEK(visit_date, 3) = WEEK(CURDATE(), 3)) THEN JSON_CONTAINS(assessment_responses, '\"warmHandOff\"', '$.mihdp.activityType') ELSE 0 END) AS 'thisWeek_warmHandoffCount', ";
    $query .= "SUM(CASE WHEN (WEEK(visit_date, 3) = WEEK(CURDATE(), 3)) THEN JSON_CONTAINS(assessment_responses, '\"hchScreening\"', '$.mihdp.activityType') ELSE 0 END) AS 'thisWeek_hchCount', ";
    $query .= "COUNT(CASE WHEN (WEEK(visit_date, 3) = WEEK(CURDATE(), 3)) THEN 1 ELSE NULL END) AS 'thisWeek_recordCount', ";
    $query .= "DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 WEEK), '%W, %b %d, %Y') AS 'lastWeek_today', ";
    $query .= "WEEK((DATE_SUB(CURDATE(), INTERVAL 1 WEEK)), 3) AS 'lastWeek_weekNumber', ";
    $query .= "DATE_FORMAT((DATE_SUB(CURDATE(), INTERVAL 1 WEEK) - INTERVAL((WEEKDAY(DATE_SUB(CURDATE(), INTERVAL 1 WEEK)))) DAY), '%W, %b %d') as 'lastWeek_weekStartDate', ";
    $query .= "DATE_FORMAT((DATE_SUB(CURDATE(), INTERVAL 1 WEEK) - INTERVAL((WEEKDAY(DATE_SUB(CURDATE(), INTERVAL 1 WEEK)))-6) DAY), '%W, %b %d') as 'lastWeek_weekEndDate', ";
    $query .= "SUM(CASE WHEN (WEEK(visit_date, 3) = WEEK((DATE_SUB(CURDATE(), INTERVAL 1 WEEK)), 3)) THEN JSON_CONTAINS(assessment_responses, '\"appointment\"', '$.mihdp.activityType') ELSE 0 END) AS 'lastWeek_appointmentCount', ";
    $query .= "SUM(CASE WHEN (WEEK(visit_date, 3) = WEEK((DATE_SUB(CURDATE(), INTERVAL 1 WEEK)), 3)) THEN JSON_CONTAINS(assessment_responses, '\"warmHandOff\"', '$.mihdp.activityType') ELSE 0 END) AS 'lastWeek_warmHandoffCount', ";
    $query .= "SUM(CASE WHEN (WEEK(visit_date, 3) = WEEK((DATE_SUB(CURDATE(), INTERVAL 1 WEEK)), 3)) THEN JSON_CONTAINS(assessment_responses, '\"hchScreening\"', '$.mihdp.activityType') ELSE 0 END) AS 'lastWeek_hchCount', ";
    $query .= "COUNT(CASE WHEN (WEEK(visit_date, 3) = WEEK((DATE_SUB(CURDATE(), INTERVAL 1 WEEK)), 3)) THEN 1 ELSE NULL END) AS 'lastWeek_recordCount' ";
    $query .= "FROM msihdp.json_response WHERE user_id = '" . $userID . "' AND ((WEEK(visit_date, 3) = WEEK(CURDATE(), 3)) OR (WEEK(visit_date, 3) = WEEK((DATE_SUB(CURDATE(), INTERVAL 1 WEEK)), 3)));";

    // TODO: USE PREPARED STATEMENTS TO AVOID SQL INJECTION
    if($result = $mysqli->query($query)) {
      $row = $result->fetch_assoc();
      jsonResponse($row);
    } else {
      echo $mysqli->error;
    }

  });

?>
