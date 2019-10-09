<?php  // Moodle configuration file
unset($CFG);
unset($DB);
global $CFG, $DB, $PATH_STORAGE;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'spoj_portal';
$CFG->dbuser    = 'phpmyadmin';
$CFG->dbpass    = 'thuyvu1997';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
    'dbpersist' => 0,
    'dbport' => 3306,
    'dbsocket' => '',
    'dbcollation' => 'utf8mb4_unicode_ci',
);

$CFG->wwwroot   = 'http://localhost/spoj_portal';
$CFG->path = dirname(__FILE__);
$CFG->dataroot  = $CFG->path.'/storage/src/';

$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

$DB = mysqli_connect($CFG->dbhost, $CFG->dbuser , $CFG->dbpass, $CFG->dbname);
if (!$DB) {
    return false;
} else {
	return true;
}

?>
