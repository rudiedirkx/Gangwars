<?

// Variables
$tick_length = 10;
$tpt = 1;

mysql_connect("localhost","rudie","nasjarulez");
mysql_select_db("tests");


/**/

$t = mysql_fetch_array(mysql_query("SELECT * FROM _timer"));

$oud = $t[laatste];
$nu = time();

$p = floor(($nu-$oud)/($tick_length));
echo '$p = '.$p;


if ($p>0)
{
	$nieuw = $oud + $tick_length*$p;
	mysql_query("UPDATE _timer SET laatste='$nieuw'");

	$c = $tpt*$p;
	mysql_query("UPDATE _users SET turns=turns+$c");
}


/* ** */


$t = mysql_fetch_array(mysql_query("SELECT * FROM _timer WHERE id='1'"));
$oud = $t[laatste];
$timeleft = ($tick_length)-($nu-$oud);

/**/

$p = floor(($nu-$oud)/($tick_length));

$user = mysql_fetch_array(mysql_query("SELECT * FROM _users WHERE id='1'"));

?>
<html>

<head>
<title>TimerTest</title>
<style>
BODY,TABLE,INPUT { font-family:Verdana;font-size:11px; }
</style>
<script>
var myi = <?=$timeleft?>;
setTimeout("rmyx();",1000);

function rmyx()
{
	myi = myi - 1;
	if (myi <= 0)
	{
		myi = <?=($tick_length)?>;
	}
	document.getElementById('secondsleft').innerHTML = myi;
	setTimeout("rmyx();",1000);
}
</script>
</head>

<body scroll=auto>

<br>
<b><font color=red><?=$_GET[msg]?></font></b><br>
<br>
<br>

Username<br>
<b><?=$user[usr]?></b><br>
<br>

Turns<br>
<b><?=$user[turns]?></b><br>
<br>

Tijd tot volgende tick<br>
<!-- <?=$timeleft?> s.<br> -->
&raquo;&raquo; <a id=secondsleft><?=$timeleft?></a> s.<br>
<br>

<br>
<br>
<br>

<?='$p = '.$p?>


