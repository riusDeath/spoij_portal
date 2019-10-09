<?php 

function view($url) {
	header("Location: ..\\views\\".$url.".php", true, 301);
}

function redirect($url) {
	$link = "..\\views\\".$url.".php";
	return $link;
}

?>
