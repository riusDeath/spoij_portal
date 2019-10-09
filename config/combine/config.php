<?php 
function compilePython($path, $params) {
	chmod($path, 0777);
	$cmd = "python3 ".$path." ".$params."";
	echo $cmd;
	return shell_exec($cmd);
}

function compileJava($path, $params) {
	chmod($path, 0777);
	$cmd = "java ".$path." ".$params."";
	echo $cmd." ";
	return shell_exec($cmd);
}

function compilePHP($path, $params) {
	chmod($path, 0777);
	$cmd = "php -r \"require '".$path."'; echo main(".str_replace(' ', ',', $params).");\"";
	return shell_exec($cmd);
}

function compileCCC($path, $params) {
	chmod($path, 0777);
	$cmd = "gcc -o program ".$path;
	return shell_exec($cmd);
}

function combineCode($path, $params, $language, $class) {
	switch ($language) {
		case "php":
			return compilePHP($path, $params);
		case "java":
			return compileJava($path, $params);
		case "py":
			return compilePython($path, $params);
		default:
			// return  compileCCC($path, $params);
			break;
	}
}

?>
