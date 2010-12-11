<?php

// Server info
$hostname = "localhost";
$username = "usager";
$password = "usager";
$database = "gangwars";

mysql_connect($hostname,$username,$password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());

?>
