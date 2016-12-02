<?php
	$mysqli = dbOpen();

	$id_search = $_SESSION ['search_select'];
	$query_search_results = $mysqli->query ( "SELECT * FROM response WHERE id = $id_search" );
	$copy = $query_search_results->fetch_assoc ();

	$regexp = "/duke*/";
	$regexp1 = "/cd_*/";
	$regexp2 = "/self_*/";
	$regexp3 = "/value*/"; // chronic health stuff.
	$regexp4 = "/phq_*/";
	$regexp5 = "/adhd_*/";
	foreach ( $copy as $key => $value ) {
		if ((! preg_match ( $regexp, $key )) && (! preg_match ( $regexp1, $key )) && (! preg_match ( $regexp2, $key )) && (! preg_match ( $regexp3, $key )) && (! preg_match ( $regexp4, $key )) && (! preg_match ( $regexp5, $key ))) { // exclude the duke responses from the zeroing.
			if ($value == '-1') {
				$copy[$key] = 0;
			}
		}
	}

	include 'include/hypertension.php';

	if($_SESSION['hypertension_check'] == 1) {
		hypertension_scoring($copy, $mysqli);
	}
?>