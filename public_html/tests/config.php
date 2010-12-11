<?

error_reporting(2039);


header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0

session_start();


// Server info
$hostname = "localhost";
$username = "root";
$password = "nasjarules";
$database = "gangwars";

$tableprefix = "_";

$ADMINPASS = "aarde";

mysql_connect($hostname,$username,$password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());


include("config_values.php");

include("functions.php");