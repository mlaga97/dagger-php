<?php

  // TODO: Rewrite this in a much more generic way
  function paginate($parameters) {
    global $mysqli;

    $paginate = false;

    $page = 1;
    if(array_key_exists('page', $parameters)) {
      $paginate = true;
      $page = $mysqli->real_escape_string($parameters['page']);
    }

    $count = 10;
    if(array_key_exists('count', $parameters)) {
      $paginate = true;
      $count = $mysqli->real_escape_string($parameters['count']);
    }

    $offset = ($page - 1) * $count;

    if($paginate) {
      return ' LIMIT ' . $offset . ', ' . $count;
    } else {
      return '';
    }
  }

?>
