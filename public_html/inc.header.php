<?php

if ( !empty($_GET['set']) )
{
	mysql_query("TRUNCATE ".$TABLE['timer'].";");
	$time = time();
	mysql_query("INSERT INTO ".$TABLE['timer']." (spelbegin, laatste) VALUES (".$time.", ".$time.");");
	mysql_query("UPDATE ".$TABLE['users']." SET turns_left=2000");

	Header("Location: ".basename($_SERVER['SCRIPT_NAME'])."");
	exit;
}


/**/
$qTimer = mysql_query("SELECT * FROM ".$TABLE['timer']." LIMIT 1;") or die(mysql_error());
$t = mysql_fetch_array($qTimer) or die(mysql_error());
$oud = $t['laatste'];
$nu = time();
$p = floor(($nu-$oud)/($TICK_LENGTH));
if ($p>0)
{
	require_once("inc.ticker.php");
}
$t = mysql_fetch_array(mysql_query("SELECT * FROM $TABLE[timer] WHERE id='1'"));
$oud = $t['laatste'];
$timeleft = ($TICK_LENGTH)-($nu-$oud);
/**/


$time=time();
mysql_query("UPDATE ".$TABLE['users']." SET lastaction = ".$time." WHERE id = '".$UID."';");

$qSector = mysql_query("SELECT * FROM ".$TABLE['sectors']." WHERE map_id = '".$THISUSER['sector_map_id']."' AND map_location = '".$THISUSER['sector_map_location']."';") or die(mysql_error());
$THISSTREET = mysql_fetch_assoc($qSector);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>

<head>
<title>Gangwars &#155;&#155; <?php echo $title; ?></title>
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/menu.css">
<script type="text/javascript">
<!--//
var myi = <?php echo $timeleft; ?>;

function rmyx()
{
	myi = myi - 1;
	if (myi <= 0)
	{
		myi = <?php echo $TICK_LENGTH; ?>;
	}
	document.getElementById('secondsleft').innerHTML = myi;
	setTimeout("rmyx();",1000);
}

function CH(tr, mode)
{
	if (mode == 0)
	{
		out = tr.className;
		tr.className = 'over';
	}
	else
	{
		tr.className = out;
	}
}

/*
	setTimeout("rmyx();",1000);
*/

//-->
</script>
</head>

<body bgcolor="green">
<table border="1" width="900" height="550" cellpadding="0" cellspacing="0" align="center">
	<tr> 
		<td class="banner" align="center" colspan="3" height="110">B A N N E R</td>
	</tr>

	<tr>
		<td colspan="3">
			<table width="100%" border="0" cellspacing="0" cellpadding="5">
				<tr>
					<td width="25%"><?php echo !empty($_SESSION['gangwars']['login'])?"Player: <b>".$THISUSER['charachtername']."</b>":"<i>Niet ingelogd</i>"; ?></td>
					<td width="25%"><?php echo !empty($_SESSION['gangwars']['login'])?"Turns: <b>".$THISUSER['turns_left']."</b> / Gebruikt: <b>".$THISUSER['turns_used']."</b>":"<i>Niet ingelogd</i>"; ?></td>
					<td width="25%">Spel bezig:<br><b><?php echo Verschil_In_Datum($t['spelbegin'],time()); ?></td>
					<td width="25%">Voorbij: <b><?php echo floor((time()-$t['spelbegin'])/$TICK_LENGTH); ?> ticks</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td width="150" align="center"><b>Usermenu</b></td>
		<td width="600">
			<table border="0" cellpadding="0" cellspacing="0" height="20" width="100%">
				<tr>
					<td width="25%" align="center"><a href="./?">Home</a></td>
					<td width="25%" align="center"><a href="/www/nieuwforum/">Forum</a></td>
					<td width="25%" align="center"><a href="settings.php?">Game Settings</a></td>
					<td width="25%" align="center"><?php echo (!$UID)?"<a href=\"aanmelden.php?\">Registreer":"<a href=\"preferences.php?\">Preferences"; ?></a></td>
				</tr>
			</table>
		</td>
		<td width="150" align="center"><b>Latest News</b></td>
	</tr>

	<tr>
		<td rowspan="3" valign="top" width="150" background="images/usermenu.jpg" height="400">
			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				<tr valign="middle" height="57">
					<td><font color="black"><center><b><?php echo !$THISUSER['accepted'] && $UID ? 'Je zit in de wachtkamer van het spel, sissy!' : "&nbsp;"; ?></td>
				</tr>
				<tr>
					<td height="76">&nbsp;</td>
				</tr>
				<tr>
					<td><?php require_once("inc.usermenu.php"); ?></td>
				</tr>
			</table>
		</td>
		<td rowspan="4" colspan="1" width="750" valign="top" style="overflow:auto;" align="center">

<!-- EINDE HEADER.PHP -->


