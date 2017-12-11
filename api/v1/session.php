<?php

	$globalAPIContext['methods']['/api/v1/session'] = function($subURI, $context, $method, $getVars, $postVars) {
		$context['response'] = $_SESSION;
		return $context;
	};

?>

