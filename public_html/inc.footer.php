<?php

/*
	inc.footer.php
*/

$g = time()-120;
$qUser = mysql_query("SELECT id FROM ".$TABLE['users']." WHERE lastaction >= ".$g.";") or die(mysql_error());
$iOnline = mysql_num_rows($qUser);

?>
<!-- BEGIN FOOTER.PHP -->

</td>
<td height=140 valign=top class='td tdr' background="images/newsflash.jpg"><center><br>
<font color=#000000>

<?php

require_once("newsflash.php");

?>

</td>
</tr>

<tr height=20><td class='td tdr' background="images/login_title.jpg"><center><b><?php echo !empty($_SESSION['gangwars']['login'])?"<a style='color:#ffffff;' href=\"login.php?logout=1\">Log Out</a>":"Log In"; ?></td></tr>

<tr valign=top height=240>
<td class='td tdr' background="images/login.jpg"><center><br>
<font color=#000000>

<?php

require_once("login_check.php");

?>

</td>
</tr>

<tr height=400>
<td bgcolor=white background="images/usermenu_naaronder.jpg">&nbsp;</td>
<!-- Nog steeds het midden -->
<td bgcolor=white background="images/rechtsemenu_naaronder.jpg">&nbsp;</td>
</tr>

<tr valign=middle>
<td class='td'>&nbsp;</td>
<td height=20 style="border-top:solid 1px #ffffff;"><table border=0 cellpadding=0 cellspacing=0 width=100%><tr valign=middle><td width=50%><center><b><?php echo $iOnline; ?> player(s)</b> online</td><td width=50%><center>Volgende tick: <b><font id='secondsleft'><?php echo $timeleft; ?></font> s.</td></tr></table></td>
<td class='td' rowspan=2><center><a href="opzet/uitleg_en.html" target=_blank>About & Manual & Tips</td>
</tr>

<tr>
<td class='td tdb'>&nbsp;</td>
<td height=20 class='tdb' style="border-top:solid 1px #ffffff;"><center>
This game is a freesource game // Copying and changing is allowed // disclaimer // <a href="http://www.mpogd.com" target=_blank>Check out MPOGD</a>
</td>
</tr>
</table>

<br>
<br>

<?php echo !empty($_GET['msg']) ? "<table width=900 border=1 cellspacing=0 cellpadding=5>
<tr><td bgcolor=#ffffff><font color=black><center><font color='".$_GET['color']."' style='font-size:12;'>".stripslashes($_GET['msg'])."<br></td></tr>
</table><br>":""; ?>

<table border=0 cellpadding=2 cellspacing=0 width=900 bgcolor=#111111>
<tr><td style='border:solid 1px #444444;border-bottom:none;'><center><b>INFORMATION</b></td></tr>
<tr><td style='border:solid 1px #444444;'>
<table border=0 cellpadding=4 cellspacing=0 width=900 class='information'><tr valign=><td height=1 class='information'>
<center>
<?php

$szPageName = basename($_SERVER['SCRIPT_NAME']);
if ( false !== ($pos=strrpos($szPageName, ".")) )
{
	$szPageName = substr($szPageName, 0, $pos);
}

echo $szPageName;

switch ( $szPageName )
{
	case 'index':
		echo "This is your overview. This page contains all basic information you'll need when you're not performing any actions. You can see your status, potential attackers, defense, your location, etc. You can always see the amount of ticks you have left.";
	break;

	case 'personalfinance':
		echo "Your entire financial status. You can donate money, drop money, sometimes send it to someone else and ofcourse is this the bribing HQ.<br>You will be visiting this page alot!";
	break;

	case 'citymap':
		echo "Je kan alleen weg uit een Wijk als je op een METROSTATION staat. Een station is te herkennen aan de W van Way-out. Ga naar het BUSSTATION en loop naar een straat met W! Daar is een METROSTATION en vanaf daar kun je de METRO nemen, of op de kaart kijken om naar een volgende wijk te lopen.";
	break;

	case 'merchandise':
		echo "The chance of finding an item or person in a street depends on a few factors: your finding skill, the amount of items in the region (chance is 100% if over 15 items) and a random factor P (1-100). Example: If a region has 11 items and your finding skill is 100%, P must be 32 or higher -> easy! Same factors, only your finding skill is 40%, P must be 60% higher (51)! The chance you need can never be over 93.8, even if there is only 1 item in the region and your finding skill is 0% (originally you'd need P to be 187.6 -> impossible).";
	break;

	case '':
		echo "";
	break;

	case '':
		echo "";
	break;

	case '':
		echo "";
	break;

	case '':
		echo "";
	break;

	case '':
		echo "";
	break;

	case '':
		echo "";
	break;

	case '':
		echo "";
	break;

	case '':
		echo "";
	break;

	default:
		echo "There is no Info-section for this page.";
	break;
}

?><br>For more info, there is always <a href="opzet/uitleg_nl.html">the Manual</a>.</td>
</tr></table>
</td></tr></table>

</body>


</html>


