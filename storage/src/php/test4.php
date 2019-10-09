<?php

function regexEmail($name, $config ) {
    return $name."".$config ;
}
function main($name, $config) {
    return regexEmail($name, $config);
}
?>
