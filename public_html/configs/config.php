<?php

require(dirname(__FILE__).'/../inc.config.php');
return;

/*
	I started coding this game right before November 19th, 2003
*/

error_reporting(2047);


header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0

session_start();


// Server info
$hostname = "localhost";
$username = "gangwars";
$password = "nasjarules";
$database = "gangwars";

$tableprefix = "_";

$ADMINPASS = "aarde";

mysql_connect($hostname,$username,$password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());

if ( !empty($_SESSION['gangwars']['uid']) )	$UID = $_SESSION['gangwars']['uid'];
else										$UID = NULL;


include("config_values.php");

include("functions.php");

?>
