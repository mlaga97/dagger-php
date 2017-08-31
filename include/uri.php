<?php

function getURIPath($uri) {
	$splitURI = explode('?', $uri);
	return $splitURI[0];
}

function explodeURI($uri) {
	$path = explode('/', getURIPath($uri));

	// Get rid of blank first element
	array_shift($path);

	return $path;
}
