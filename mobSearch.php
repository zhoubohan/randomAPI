<?php

include_once('xcCommon.php');
	$name = trim($_GET['name']);
	//查询对应得号码
	$idSql = "SELECT id,name FROM xcmember WHERE name LIKE '%".$name."%'";
	$idRes = $link->query($idSql);
	while ($idRow = $idRes->fetch(PDO::FETCH_ASSOC)) {
		$ids[] = $idRow['id'];
		$names[$idRow['id']] = $idRow['name'];
	}
if(count($ids) > 0) {
        //查询已开奖的奖项的中奖ID
        $luckIdsSql = "SELECT sentId,level FROM 2018_setp4 WHERE isActive = 1";
        $luckIdsRes = $link->query($luckIdsSql);
        while ($luckIdsRow = $luckIdsRes->fetch(PDO::FETCH_ASSOC)) {
            $luckIds[] = $luckIdsRow['sentId'];
            $luckList[$luckIdsRow['sentId']] = $luckIdsRow['level'];
        }
        $resIds = array_intersect($ids,$luckIds);
if(count($resIds) > 0) {
            foreach ($resIds as $val) {
                $resList[$val] = $luckList[$val]; 
            }
	foreach($resList as $k => $v){
		$res[$v][] = $names[$k];
	}
	ksort($res);
	foreach ($res as $k => $val) {
		foreach ($val as $v ) {
			$data[] = $v."获得了".$presentConf[$k]['levelName'];
		}
	}
	$returnData['code'] = 1;
	$returnData['data'] = $data;	
        }else {
            $returnData['code'] = 0;
	  $returnData['msg'] = "没有中奖";
        }
    }else {
        $returnData['code'] = 2;
	$returnData['msg'] = "查无此人";
    }
echo json_encode($returnData);
exit();
