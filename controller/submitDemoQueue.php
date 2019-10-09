<?php 
require_once('Controller.php');
require_once('MarkController.php');
require_once('../config.php');
require_once('../config/lib/dblib.php');
require_once('../config/combine/uploadfile.php');
require_once('../config/combine/config.php');
require_once('../model/Testcase.php');
require_once('../model/Contest.php');
require_once('../model/Job.php');
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
	echo -1;
} else {
	
	$data = [
			'userid' => 1,
	 		'language' => $language,
			'storage' => $path,
			'payload' => 'compile code',
			'contestid' => $contestid
		];
	$db->setTable(new Job());
	$jobid = $db->insert($data)->excuteGetId();
	echo $jobid;
}

// $path = dirname(__FILE__).'/workerjob.php';
// chmod($path, 0777);
// $cmd = "nohup  php -f ".$path." > /dev/null &";
// $cmd = "nohup  php -f ".$path." ".$jobid." > /dev/null &";
// exec($cmd);

?>
