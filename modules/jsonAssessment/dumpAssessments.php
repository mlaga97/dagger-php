<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/include/dagger.php';
	global $log, $mysqli, $today;
	allowPrevious(true, '/dumpAssessments.php');

	// Disable error messages
	error_reporting(0);

	/******************************************************************************
	*******************************************************************************
	******************************************************************************/

	// Obtained from https://stackoverflow.com/a/9776726
	function prettyPrint( $json ) {
		$result = '';
		$level = 0;
		$in_quotes = false;
		$in_escape = false;
		$ends_line_level = NULL;
		$json_length = strlen( $json );

		for( $i = 0; $i < $json_length; $i++ ) {
			$char = $json[$i];
			$new_line_level = NULL;
			$post = "";
			if( $ends_line_level !== NULL ) {
				$new_line_level = $ends_line_level;
				$ends_line_level = NULL;
			}
			if ( $in_escape ) {
				$in_escape = false;
			} else if( $char === '"' ) {
				$in_quotes = !$in_quotes;
			} else if( ! $in_quotes ) {
				switch( $char ) {
					case '}': case ']':
						$level--;
						$ends_line_level = NULL;
						$new_line_level = $level;
						break;

					case '{': case '[':
						$level++;
					case ',':
						$ends_line_level = $level;
						break;

					case ':':
						$post = " ";
						break;

					case " ": case "\t": case "\n": case "\r":
						$char = "";
						$ends_line_level = $new_line_level;
						$new_line_level = NULL;
						break;
				}
			} else if ( $char === '\\' ) {
				$in_escape = true;
			}
			if( $new_line_level !== NULL ) {
				$result .= "\n".str_repeat( "\t", $new_line_level );
			}
			$result .= $char.$post;
		}

		return $result;
	}

	/******************************************************************************
	*******************************************************************************
	******************************************************************************/

	header('Content-Type: application/json');

	require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/jsonAssessment/jsonAssessment.php');

	global $questionClasses, $responseClasses, $scoreClasses, $jsonAssessments;
	echo(prettyPrint(json_encode($jsonAssessments)));
?>
