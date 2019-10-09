<?php 

$s = microtime(true);
require_once('Controller.php');
require_once('MarkController.php');
require_once('../config.php');
require_once('../config/lib/dblib.php');
require_once('../config/combine/uploadfile.php');
require_once('../config/combine/config.php');
require_once('../model/Testcase.php');
require_once('../model/Job.php');
global $CFG, $DB;
// $contestid = $_POST['contestid'];
// $language = $_POST['language'];
$contestid = 1;
$language = 'php';
$db = new setup_DB($CFG, $DB);
$iotestcase = testcase($contestid, $db);
$contest = resultContest($contestid, $db);
$filename = $contest['title'];

$path = $CFG->dataroot."".$language."/".$filename.".".$language."";
$result = [
		'data'=> '',
		'time' => ''
		];
for($i = 0; $i<10; $i++) {
	$percent = percentCombineCode($language, $path, $filename, $iotestcase);
}
// $percent = percentCombineCode($language, $path, $filename, $iotestcase);
echo "result:".$percent."%";
$e = microtime(true);
$time = round($e - $s, 2) . " Sec";
echo "\ntime combine: ".$time;
?>
