<?php

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
if (!upload($contest, $language, $db)) {
	echo "500 Error";
} else {
	$path = $CFG->dataroot."".$language."/".$filename.".".$language."";
	$percent = percentCombineCode($language, $path, $filename, $iotestcase);
	echo $percent;
}

?>
