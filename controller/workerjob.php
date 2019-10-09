<?php 
$s = microtime(true);
require_once('/var/www/html/Portal_Spoij/spoj_portal/controller/Controller.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/controller/MarkController.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/config.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/config/lib/dblib.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/config/combine/uploadfile.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/config/combine/config.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/model/Testcase.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/model/Job.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/model/Grade_combine.php');
global $CFG, $DB;
$db = new setup_DB($CFG, $DB);
$db->setTable(new Job());
$job = $db->select()->excuteSelect()[0];
$contestid = $job['contestid'];
$language = $job['language'];
$iotestcase = testcase($contestid, $db);
$contest = resultContest($contestid, $db);
$filename = $contest['title'];

$path = $job['storage'];

$result = [
		'data'=> '',
		'time' => ''
		];
$percent = percentCombineCode($language, $path, $filename, $iotestcase);

$e = microtime(true);
$time = round($e - $s, 2) . " Sec";

$db->setTable(new Grade_combine());

$grade = [
	'userid' => 1,
	'contestid' => $contestid,
	'grade' => $percent,
	'time_combine' => $time,
	'language' => $language,
	'jobid' => $job['id'],
	'code' => 'code'
];
$db->insert($grade)->excute();

$db->table('jobs')->delete($job['id'])->excute();
?>
