<?php
/*
 |credentials for database
*/
$dbhost="localhost";
$dbname="cy_test";
$dbuser="root";
$dbpass="";

/*
 |  constant for web path
*/
define('_WEB_PATH',"http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']));
