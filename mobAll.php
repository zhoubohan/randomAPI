<?php

include_once('xcCommon.php');
    $sql = 'SELECT s.sentId,s.level,m.name FROM 2018_setp4 s inner join xcmember m on s.sentId = m.id  WHERE s.isActive = 1';
    $res = $link->query($sql);
    while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    	 $data[$presentConf[$row['level']]['levelName']][] = $row['name']; 
    }
$conf = Array(
	'特等奖' => 0,
	'一等奖' => 1,
	'二等奖' => 2,
	'三等奖' => 3,
	'四等奖' => 4,
	'五等奖' => 5,
	'六等奖' => 6
);
foreach ($data as $k => $v) {
	$returnData[$conf[$k]] = $v; 
}
ksort($returnData);
if(count($returnData) > 0) {
	$throwData['code'] = 1;
	$throwData['data'] = $returnData;
}else {
	$throwData['code'] = 0;
	$throwData['msg'] = '抽奖未开始';
}
echo json_encode($throwData);
exit();
