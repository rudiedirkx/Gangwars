<?

$totaal = pow(12,2);
$regel = 12;
$num = 1/$regel;

// $current = ($_COOKIE[iid]) ? $_COOKIE[iid] : 1;
/**/
if ($_COOKIE[iid])
{
	$ep = explode("|",$_COOKIE[iid]);
	$current = $ep[0];
	$used = $ep[1];
	$newused = $used+1;
}
else
{
	$current=1;
	$used=0;
	$newused=1;
}
/**/

$c=$current;
$r=$regel;

$iid = $_GET[iid];

if ($iid)
{
	if ((($c == $iid+1) || ($c == $iid-1) || ($c == $iid-$r) || ($c == $iid+$r)) && ($iid <= $totaal))
	{
		$value = $iid."|".$newused;
		setCookie("iid",$value);

		// $used = $_COOKIE[used]+1;
		// SetCookie("used",$used,time()+120);
		// SetCookie("iid",$iid,time()+120);
		Header("Location: showmap.php?msg=Deze verplaatsing is TOEGESTAAN!");
		exit;
	}
	else
	{
		Header("Location: showmap.php?msg=Deze verplaatsing is ILLEGAAL!");
		exit;
	}
}
?>
<title>MapTest</title>

<font face=Verdana size=1>

<?=$_COOKIE[iid]?><br>
<br>

<table border=0 cellpadding=0 cellspacing=0 style="border:solid 1px #000000;"><tr><td bgcolor=green>
<?
for ($i=1;$i<=$totaal;$i++)
{
	$p = ($current == $i) ? "extra" : "normal";

	echo "<a href=showmap.php?iid=$i><img src='$p.jpg' alt='$i' border=0></a>";

	if (floor($num*$i) == ceil($num*$i))
		echo "<br>\n";
}

?></td></tr></table>
Je hebt al <?=$used?> turns gebruikt!<br>
<br>
<br>
<br>

<?=$_GET[msg]?>