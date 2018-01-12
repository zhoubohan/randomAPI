<?php

include_once('xcCommon.php');

$level = $_GET['level'];
$result = Array();

    $sql = "SELECT sentId FROM 2018_setp4 WHERE level = '".$level."'";
$res = $link->query($sql);
    while ($row = $res->fetch(PDO::FETCH_ASSOC)){
	$ids[] = $row['sentId'];
	}
$s = "SELECT * FROM xcMember WHERE id IN (".join(',',$ids).");";
$r = $link->query($s);
while ($o = $r->fetch(PDO::FETCH_ASSOC)) {
	$result[] = $o['name'];
}
	if(count($result) > 0) {
		$upSql = "UPDATE 2018_setp4 SET isActive = 1 WHERE level = '".$level."'";
		$link->query($upSql);
		$throwData['code'] = 1;	
		$throwData['data'] = $result;
		echo json_encode($throwData);
		exit();
	}	
    
   

