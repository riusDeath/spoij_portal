<?php 

require_once('Controller.php');
require_once('MarkController.php');
require_once('../config.php');
require_once('../config/lib/dblib.php');
require_once('../config/combine/uploadfile.php');
require_once('../config/combine/config.php');
require_once('../model/Job.php');
require_once('../model/Grade_combine.php');

global $DB, $CFG;
$jobid = $_POST['jobid'];
$result = new setup_DB($CFG, $DB);

$result->table('grade_combine');
$grade = $result->select()->where(['jobid' => $jobid])->excuteSelect();
echo json_encode($grade);
?>