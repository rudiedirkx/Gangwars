<?php

/*
	I started coding this game right before November 19th, 2003
*/

error_reporting(2047);


header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0

session_start();

include_once("inc.connect.php");

$tableprefix = "";

$ADMINPASS = "aarde";


if ( !empty($_SESSION['gangwars']['uid']) )	$UID = $_SESSION['gangwars']['uid'];
else										$UID = NULL;


define( "BASEPAGE",		basename($_SERVER['SCRIPT_NAME']) );
define( "EOL",			"\n" );


include("inc.config_values.php");

include("inc.functions.php");

?>
