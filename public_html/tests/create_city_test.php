<?

include("config.php");

echo $sql = "SELECT mid,maplocation FROM $TABLE[sectors] WHERE mid!='0' ORDER BY rand(unix_timestamp()) DESC LIMIT 200";
$q = mysql_query($sql) or die("<br>A: <b>".mysql_error()."</b>");

echo "<br><hr>";

$sectors = Array();
while ($i = mysql_fetch_array($q))
{
//	echo "$i[mid] -> $i[maplocation]<br>";
	$sectors[$i[mid]] = $i[maplocation];
}

sort($sectors);


foreach ($sectors AS $key => $value)
{
	echo "$key => $value<br>";
}


