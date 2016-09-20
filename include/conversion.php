<?php


require_once 'Mysql.php';
require_once 'constants.php';
 
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

$query_responses = $mysqli->query("select old,new from conversion");

while ($response = $query_responses->fetch_assoc()){ 
    if ($query_old_exist = $mysqli->query("select * from response where pt_id = '" .hash('sha256',$response['old']). "' limit 1"  )){
//    while ($exist = $query_old_exist->fetch_assoc()){
//        echo "old: ".$response['old'] ." ". hash('sha256',$response['old']). " ";
//        echo "new: ".$response['new'] ." ". hash('sha256',$response['new']). "<br>";
//}
//    while ($exist = $query_old_exist->fetch_assoc()){
//	echo "SELECT * FROM response where pt_id = '";
 //       echo hash('sha256',$response['old']). "' or pt_id = '";
  //      echo hash('sha256',$response['new']). "'<br>";
   // } 
    while ($exist = $query_old_exist->fetch_assoc()){
	echo "update response set pt_id = '".hash('sha256',$response['new'])."' where pt_id = '". hash('sha256',$response['old'])."';<br>";
    } 
}
}
