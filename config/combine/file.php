<?php 

function readFileCodeComdline($path_test) {
	$handle = @fopen($path_test, "r");

	$chunk = 10 * 1024 * 1024; 

	while (!feof($fh)) {
    	echo fread($handle, $chunk);
   
    	ob_flush();
	    flush();
	}
}

function writeFile($path_result) {
	chmod($path_result, 0777);
	$fresult = @fopen($path_result, "w+");
	if (!$fresult) {
	    return false ;
	} else {
	    fwrite($fresult, $result);
	}
	fclose($fresult);

	return true;
}

function compareResult($path_result, $path_output) {
	if (filesize($path_result) !== filesize($path_output)) {
		return false;
	}
	$fpout = file($path_output);
	$fresults = file($path_result) ;
	if (($fpout <=> $fresults) != 0) {
		return false;
	}
	fclose($fpout);
	fclose($fresults);
	
	return true ;
}

?>
