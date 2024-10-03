<?php
error_reporting(0);
session_start();
ob_start();
//--------Site URL Link-----------------

define('INCL_PATH', dirname(__FILE__) . "/");

include_once(INCL_PATH . 'sqlConnection.php');
include_once(INCL_PATH . 'site_settings.php');
include_once(INCL_PATH . 'query_functions.php');
$Q_obj = new Query_Functions;