<?php 

require_once('Controller.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/config.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/config/lib/dblib.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/config/combine/uploadfile.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/config/combine/config.php');
require_once('/var/www/html/Portal_Spoij/spoj_portal/model/Testcase.php');
require_once('var/www/html/Portal_Spoij/spoj_portal/model/Contest.php');

function testcase($contestid, $db) {
	$db->setTable(new Testcase());
	$testcase = ($db->select()->where(['contestid' => $contestid, 'AND status' => 1])->excuteSelect());
	$iotestcase = [
		"input" => [],
		"output" => []
	];
	foreach ($testcase as $key => $value) {
		array_push($iotestcase['input'], $value['input']);
		array_push($iotestcase['output'], $value['output']);
	}
	return $iotestcase;
}

function upload($filename, $language, $db) {
	$path = "../storage/src/".$language."/".$filename.".".$language."";
	if (!uploadFile($path)) {
		return false;
	}
	return true;
}

function resultContest($contestid, $db) {
	$db->setTable(new Contest());
	$contest = $db->find($contestid)->excuteSelect()[0];
	return $contest;
}


function percentCombineCode($language, $path, $filename, $iotestcase) {
	if (sizeof($iotestcase) == 0) {
		return 0;
	}
	$pass = 0;
	$results = [];
	foreach ($iotestcase['input'] as $key => $value) {
		$result = combineCode($path, $iotestcase['input'][$key], $language, $filename);
		echo "\nresult combine: ".$result."abc\n";
		echo "testcase output: ".$iotestcase['output'][$key]."abc\n";
		array_push($results, $result);
		if ($iotestcase['output'][$key] == $result) {
			$pass ++;
		}
	}
	echo $pass ;

	$percent = $pass/sizeof($iotestcase['input'])*100;
	return $percent;
}

function sizeTestcase($testcase) {
	if (count($testcase) == 0)
		return false;
	return true;
}

?>