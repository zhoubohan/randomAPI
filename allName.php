<?php 

include_once('xcCommon.php');
$sql = "SELECT name FROM xcMember";
$res = $link->query($sql);
while($row = $res->fetch(PDO::FETCH_ASSOC)){
	$name[] = $row['name'];
}
$data['code'] = 1;
$data['data'] = $name;
echo json_encode($data);
exit();
