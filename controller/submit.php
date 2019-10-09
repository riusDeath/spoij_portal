<?php 
$s = microtime(true);
require_once('Controller.php');
require_once('MarkController.php');
require_once('../config.php');
require_once('../config/lib/dblib.php');
require_once('../config/combine/uploadfile.php');
require_once('../config/combine/config.php');
require_once('../model/Testcase.php');
require_once('../model/Contest.php');
global $CFG, $DB;
$contestid = $_POST['contestid'];
$language = $_POST['language'];
$db = new setup_DB($CFG, $DB);
$iotestcase = testcase($contestid, $db);
$contest = resultContest($contestid, $db);
$filename = $contest['title'];
$file = $_FILES['file'];

$path = $CFG->dataroot."".$language."/".$filename.".".$language."";
$result = [
		'data'=> '',
		'time' => ''
		];
if (! move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
	array_push($result['data'], "500 Error") ;
} else {
	
	$percent = percentCombineCode($language, $path, $filename, $iotestcase);
	echo "result:".$percent."%";
	// array_push($result['data'], $percent) ;
}
$e = microtime(true);
$time = round($e - $s, 2) . " Sec";
echo "\ntime combine: ".$time;
// array_push($result['time'], $time);
// echo json_encode($result);
?>