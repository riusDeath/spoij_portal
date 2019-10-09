<?php 

function readFileCodeComdline($path, $path_test) {
	$fp = @fopen($path_test, "r");

	$array_input[] = "";
	$char = '';
	if (!$fp) {
	    return false;
	} else {
	     while(!feof($fp))
	    {
	    	$char .= fgetc($fp).trim();
	    }
	}
	$cmd = "php -r \"require '".$path."'; echo main(".$char.");\"";
	$output = shell_exec ($cmd);
	echo $cmd;
	return $output;
}

function writeResultInFile($path_result, $result) {
	chmod($path_result, 0777);
	$fresult = @fopen($path_result, "w+");
	if (!$fresult) {
	    echo ' Mở file result.txt không thành công';
	    return false ;
	} else {
	    fwrite($fresult, $result);
	}
	 
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
	return true ;
}

?>
