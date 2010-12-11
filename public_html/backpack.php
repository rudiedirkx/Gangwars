<?php

require("inc.config.php");

Check_Login();

$title="Rugzak";
require("inc.header.php");

?>

<br>
<b>Rugzak</b><br>
<br>
Je hebt het volgende in je rugzak:<br>
<br>
<table border=0 cellpadding=2 cellspacing=0 width=80%>
<?php

$l = "u".$UID;
$i=1;
$rugzak = mysql_query("SELECT *,COUNT(name) AS aantal FROM $TABLE[items] WHERE locatie='$l' AND (gewicht>0 || ruimte>0) GROUP BY name") or die(mysql_error());

?>
<tr>
	<td style="border-bottom:solid 1px white;" align="center"><b>#</b></td>
	<td width="25%" style="border-bottom:solid 1px white;"><b>Name</b></td>
	<td style="border-bottom:solid 1px white;" align="right"><b>Aantal (<?php echo $MAX_AANTAL[$THISUSER['charachter']]; ?>)</b></td>
	<td style="border-bottom:solid 1px white;" align="right"><b>Gewicht (<?php echo $MAX_GEWICHT[$THISUSER['charachter']]; ?>)</b></td>
	<td style="border-bottom:solid 1px white;" align="right"><b>Ruimte (<?php echo $MAX_RUIMTE[$THISUSER['charachter']]; ?>)</b></td>
	<td style="border-bottom:solid 1px white;" align="right"><b>Prijs&nbsp;</b></td>
</tr>
<?php

$geld = $aantal = 0;
while ($r = mysql_fetch_assoc($rugzak))
{
	$explodename = explode(" ",$r['name']);
	$explain = strtolower($explodename[0]);
	echo "<tr>".EOL;
	echo "<td width=1>&nbsp;".$i++."&nbsp;</td>".EOL;
	echo "<td><a href=\"?explain=".$explain."\"><b>".$r['name']."</td>".EOL;
	echo "<td align=\"right\">".$r['aantal']."</td>".EOL;
	echo "<td align=\"right\">" . ( 1<$r['aantal'] ? $r['aantal']."*".$r['gewicht']." = ".($r['gewicht']*$r['aantal']) : $r['gewicht'] ) . "</td>".EOL;
	echo "<td align=\"right\">" . ( 1<$r['aantal'] ? $r['aantal']."*".$r['ruimte']." = ".($r['ruimte']*$r['aantal']) : $r['ruimte'] ) . "</td>".EOL;
	echo "<td align=\"right\">€ ".$r['prijs']." p.p.&nbsp;</td>".EOL;
	echo "</tr>".EOL;
	$geld += $r['prijs'];
	$aantal += $r['aantal'];
}

?>
<tr>
	<td style="border-top:solid 1px white;" colspan="2">&nbsp;Totaal:</td>
	<td style="border-top:solid 1px white;" align="right"><b><?php echo $aantal; ?></td>
	<td style="border-top:solid 1px white;" align="right"><b><?php echo $GEWICHT; ?></td>
	<td style="border-top:solid 1px white;" align="right"><b><?php echo $RUIMTE; ?></td>
	<td style="border-top:solid 1px white;" align="right"><!--<b>€ <?php echo $geld; ?>-->&nbsp;</td>
</tr>
</table>
<br>
<br>
<br>
<?php

if ( !empty($_GET['explain']) )
{
	echo "<table border=0 cellpadding=2 cellspacing=0 width=80%>";
	switch ($_GET['explain'])
	{
		case 'gsm':
			echo "<tr><td style='border:solid 1px white;border-bottom:none;'><b>About: &quot;GSM&quot;</td></tr><tr><td style='border:solid 1 white;'>Je kan met je GSM altijd bellen! Hiervoor heb je een telefoonnummer nodig. Het is echter wel net zoals bij een echte verbinding, dat de ontvanger op moet nemen. Als de ontvanger niet op neemt, is er geen gesprek!";
		break;

		case 'laptop':
			echo "<tr><td style='border:solid 1px white;border-bottom:none;'><b>About: &quot;LAPTOP&quot;</td></tr><tr><td style='border:solid 1 white;'>Met je laptop kan je altijd berichten sturen naar je maten of naar een andere gang. Je kan alleen berichten sturen naar een laptop of een desktop. Je hebt wel een telefoonnummer nodig.";
		break;

		case 'duikersmes':
			echo "<tr><td style='border:solid 1px white;border-bottom:none;'><b>About: &quot;DUIKERSMES&quot;</td></tr><tr><td style='border:solid 1 white;'>Een duikersmes is, zoals elk mes, een van de primitiefste wapens. Een voordeel is dat het niet erg duur is en je geen ammo nodig hebt. Een mes zoals deze kan, bij voldoende skill, heel erg dodelijk zijn!";
		break;
	}
	echo "</td></tr></table>";
}


require("inc.footer.php");

?>