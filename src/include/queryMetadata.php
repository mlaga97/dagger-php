<?php

function queryMetadata($parameters, $data) {
  $queryID = $_GET['queryID'];

  if ($queryID) {
    jsonResponse([
      queryID => $queryID,
      params => $_GET,
      data => $data,
    ]);
  } else {
    // TODO: Deprecate
    jsonResponse($data);
  }
}

?>
