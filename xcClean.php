<?php
include_once('xcCommon.php');
$allIds = Array();
$allIdsSql = "SELECT presentId,sentId FROM 2018_setp4";
$allIdsRes = $link->query($allIdsSql);
while ($allIdsRow = $allIdsRes->fetch(PDO::FETCH_ASSOC)){
	$allIds[$allIdsRow['presentId']] = $allIdsRow['sentId'];
}
$idsSql = "SELECT count(*) AS total,presentId FROM 2018_setp4 GROUP BY sentId";
$idsRes = $link->query($idsSql);
while ($idsRow = $idsRes->fetch(PDO::FETCH_ASSOC)){
    if ($idsRow['total'] > 1) {
        $newId = getInt($joinAllCount);
        if (!in_array($newId, $allLuckIds)) {
            $upSql = "UPDATE 2018_setp4 SET sentId = '".$newId."' WHERE presentId = '".$idsRow['presentId']."';";
            $link->query($upSql);
        }
	
        
    }
}
$flag = Array();
$flagRes = $link->query($idsSql);
while ($flagRow = $flagRes->fetch(PDO::FETCH_ASSOC)) {
	$flag[] = $r;
}

if(count($flag) == 264) {
	print_r('清理完成');
}

function getInt($num)
{
        $getUrl = "https://www.random.org/integers/?num=1&min=1&max=".$num."&col=1&base=10&format=plain&rnd=new";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $int = curl_exec($ch);
        curl_close($ch);
        return $int;
}
