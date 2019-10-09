<?php 
require_once('DatabaseQueue.php');
require_once('../../config.php');
require_once('../lib/dblib.php');
require_once('../../model/Job.php');	
global $DB, $CFG;
$db = new setup_DB($CFG, $DB);
$data = [
		'data' => $path,
		'payload' => 'compile code',
	];
$db->setTable(new Job());
$db->insert($data)->excute();

?>
