<?php

$link = mysql_connect('localhost', 'root', '')
    or die('Could not connect: ' . mysql_error());
echo 'Connected successfully';
echo ' ';
mysql_select_db('test') or die('Could not select database');

$result = mysql_query('select * from php_test where rec_id=4', $link);
$row = mysql_fetch_assoc($result);
echo $row['data'];
?>