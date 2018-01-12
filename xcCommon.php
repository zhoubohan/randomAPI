<?php 
header("Content-type:text/html;charset=utf-8");
error_reporting(E_ALL);
session_start();
ob_start();

$config['db']['username'] = 'baseDataUser';
$config['db']['password'] = '4kAcC}7337PE';
$config['db']['dbname'] = 'basedata';
$config['db']['host'] = '172.19.2.5';

// $config['db']['username'] = 'root';
// $config['db']['password'] = '';
// $config['db']['dbname'] = 'nianhui';
// $config['db']['host'] = 'localhost';
$link = new PDO('mysql:host='.$config['db']['host'].";dbname=".$config['db']['dbname'],$config['db']['username'],$config['db']['password']);
$link->query('set names utf-8');
$joinAllCount = 900;

$presentConf[0] = array(
	'level' => 0, 'levelName' => '特等奖', 'count' => '2', 'cut' => 10,
);
$presentConf[1] = array(
	'level' => 1, 'levelName' => '一等奖', 'count' => '2', 'cut' => 10, 
);
$presentConf[2] = array(
	'level' => 2, 'levelName' => '二等奖', 'count' => '10', 'cut' => 10, 
);
$presentConf[3] = array(
	'level' => 3, 'levelName' => '三等奖', 'count' => '20', 'cut' => 10, 
);
$presentConf[4] = array(
	'level' => 4, 'levelName' => '四等奖', 'count' => '30', 'cut' => 10, 
);
$presentConf[5] = array(
	'level' => 5, 'levelName' => '四等奖', 'count' => '20', 'cut' => 10,
);
$presentConf[6] = array(
	'level' => 6, 'levelName' => '五等奖', 'count' => '40', 'cut' => 10,
);
$presentConf[7] = array(
	'level' => 7, 'levelName' => '五等奖', 'count' => '40', 'cut' => 10,
);
$presentConf[8] = array(
	'level' => 8, 'levelName' => '六等奖', 'count' => '50', 'cut' => 10,
);
$presentConf[9] = array(
	'level' => 9, 'levelName' => '六等奖', 'count' => '50', 'cut' => 10,
);
