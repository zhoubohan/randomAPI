<?php 

include_once('xcCommon.php');

$level = intval(trim($_GET['l']));

$num = $presentConf[$level]['count'];
$presentFile = 'xcPrize/'.$level.'_prize.data';
if (!file_exists($presentFile)) {
	$existIds = getExistIds();	
	$randomRes = getRandom(1,$joinAllCount,$num);
	$randomInfo = explode(', ', $randomRes);
	$jiaoji =  array_intersect($randomInfo,$existIds);
	if (count($jiaoji) < 1) {
		$insertSql = "INSERT INTO `2018_setp4`(level, sentId, sentDatetime) VALUES";
		foreach ($randomInfo as $val) {
			$insertSql .= "('".$level."', '".$val."', '".date('Y-m-d H:i:s',time())."'),";
		}
		$insertSql = rtrim($insertSql, ',');
		$link->query($insertSql);
		file_put_contents($presentFile, json_encode($randomInfo));	
	}else {
		$lenth = count($jiaoji);
		foreach ($jiaoji as $key => $val) {
			unset($randomInfo[$key]);
		}
		$insertSql = "INSERT INTO `2018_setp4`(level, sentId, sentDatetime) VALUES";
		foreach ($randomInfo as $val) {
			$insertSql .= "('".$level."', '".$val."', '".date('Y-m-d H:i:s',time())."'),";
		}
		$insertSql = rtrim($insertSql, ',');
		$link->query($insertSql);
		$diff = Array();
		$diffLen = 0;	
		while ($diffLen < $lenth){
			$lucky = getInt($joinAllCount);
			$ids = getExistIds();
			if (in_array($lucky, $ids)) {
				$diffLen = $diffLen;
			}else {
				$diff[] = $lucky;
				$randomInfo[] = $lucky;
				$diffLen++;
			}
		}	
		if ($diffLen == $lenth) {
			$diffSql = "INSERT INTO `2018_setp4`(level, sentId, sentDatetime) VALUES";
			foreach ($diff as $val) {
				$diffSql .= "('".$level."', '".$val."', '".date('Y-m-d H:i:s',time())."'),";
			}
			$diffSql = rtrim($diffSql, ',');
			$link->query($diffSql);	
			file_put_contents($presentFile, json_encode($randomInfo));	
		}
	}	
}

function getExistIds()
{
	global $link;
	$selectSql = "SELECT sentId FROM `2018_setp4`";
	$existIdRes = $link->query($selectSql);
	$existIds = array();
	while ($existIdRow = $existIdRes->fetch(PDO::FETCH_ASSOC)) {
		$existIds[] = $existIdRow['sentId'];
	}
	return $existIds;
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

function getRandom($min = 1, $max = 1000, $num)
{
	$params = array(
		'sets' => 1,
		'min' => $min,
		'max' => $max,
		'num' => $num,
		'commas' => 'on',
		'sort' => 'on',
		'order' => 'index',
		'format' => 'plain',
		'rnd' => 'new'
	);

	$paramsStr = http_build_query($params);

	$ch = curl_init();
	$url = 'https://www.random.org/integer-sets/?'.$paramsStr;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$randomInfo = curl_exec($ch);
	curl_close($ch);
	
	return $randomInfo;
}

