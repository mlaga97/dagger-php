<?php
	$link = mysql_connect('localhost', 'root', 'password')
		or die('Could not connect: ' . mysql_error());
	//echo 'Connected successfully';
	//echo ' ';
	mysql_select_db('test') or die('Could not select database');
?>
