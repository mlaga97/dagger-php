<?php

// TODO: Make not use http
// TODO: Pass method and GET and POST variables
function daggerAPI($uri, $method = 'GET', $getVars = array(), $postVars = array()) {
	return json_decode(file_get_contents('http://localhost' . $uri), true);
}

?>
