<?php

require("inc.config.php");

Check_Login();
if ( !$THISUSER['accepted'] )
{
	Go("./");
}


/*
Hoeveel turns er nodig zijn om te travellen:
$plekken -> hoeveel plaatsen je moet travellen, dit gaat zo kort mogelijk

*/

$sql = "SELECT * FROM $TABLE[sectors] WHERE mid='0' AND maplocation='".$THISUSER['location_city']."';";
$thismap = mysql_fetch_array(mysql_query($sql));

if ( isset($_GET['action']) && $_GET['action'] == "move" )
{
	$r = $MAP_WIDTH;
	$totaal = $MAX_SECTORS;
	$c = $THISUSER['location_citypart'];
	$iid = $_GET['street_id'];

	$turns_needed = ($_GET['transport'] == "walk") ? 4 : rand(2,6);
	if ($THISUSER['turns']>=$turns_needed && ($c==$iid+1 || $c==$iid-1 || $c==$iid-$r || $c==$iid+$r) && $iid<=$totaal && !(ceil($c/$r)==floor($c/$r) && ceil(($iid-1)/$r)==floor(($iid-1)/$r)) && !(ceil(($c-1)/$r)==floor(($c-1)/$r) && $iid==$c-1))
	{
		// Move is goed
		mysql_query("UPDATE $TABLE[users] SET location_citypart='".$iid."', turns=turns-".$turns_needed.",gebruikt=gebruikt+".$turns_needed." WHERE id='".$UID."' AND turns>".$turns_needed.";");

		if(!stristr("-".$THISUSER['maphistory'],";".$THISUSER['location_city'].".".$iid.";"))
		{
			$nmh = $THISUSER['maphistory'].";".$THISUSER['location_city'].".".$iid.";";
			mysql_query("UPDATE $TABLE[users] SET maphistory='".$nmh."' WHERE id='".$UID."';");
		}

		Go("?color=green&msg=Je hebt ".$turns_needed." turns gebruikt. Je bent veilig aangekomen");
	}
	else if ($c==$iid)
	{
		// Je bent hier al: location_city.location_citypart
		Go("?");
	}
	else if ($THISUSER['turns']<$turns_needed)
	{
		// Je bent hier al: location_city.location_citypart
		Go("?color=red&msg=Je hebt niet genoeg turns!");
	}
	else
	{
		// Move kan niet
		Go("?color=red&msg=Je kan deze move niet maken. Je moet naar een zijstraat!");
	}
}


$title="Bus Station";
require("inc.header.php");

?>

<br>
<b>Wijk "<?php echo $thismap['name']; ?>"</b><br>
<br>
Where do you want to go..?<br>
<br>
<br>

<form name=transport><select name=transport style='text-align:center;width:<?php echo 20*$MAP_WIDTH+2?>;'><option value='bus' SELECTED>TAKE BUS<option value='walk'>WALK</select></form>

<table border=0 cellpadding=0 cellspacing=0 width=<?php echo 20*$MAP_WIDTH?> height=<?php echo 20*$MAP_WIDTH?> style='border:solid 1px #ffffff;'>
<tr valign=middle height=20>
<?

$i=0;
$m = mysql_query("SELECT * FROM $TABLE[sectors] WHERE mid='".$THISUSER['location_city']."' ORDER BY maplocation ASC");
while ($mi = mysql_fetch_array($m))
{
	$i++;

	$r = $MAP_WIDTH;
	$totaal = $MAX_SECTORS;
	$c = $THISUSER['location_citypart'];
	$iid = $i;
	$mogelijk = (($c==$iid+1 || $c==$iid-1 || $c==$iid-$r || $c==$iid+$r) && $iid<=$totaal && !(ceil($c/$r)==floor($c/$r) && ceil(($iid-1)/$r)==floor(($iid-1)/$r)) && !(ceil(($c-1)/$r)==floor(($c-1)/$r) && $iid==$c-1)) ? 1 : 0;

	// j=Ja n=Nee; Als dit Ja is, bevindt de gebruiker zich in deze straat
	$current = ($i == $THISUSER['location_citypart']) ? "j" : "n";
	// Als vooruitkijken AAN is, kan je heel de map zien (al dan niet Unexplored), als het UIT is kan je alleen de vakjes zien waar je naartoe kan
	$vuks = ($VOORUITKIJKEN || $iid==$c) ? " " : ""; // vuks = VoorUitKijkSpatie
	

	$locatie_nu = ";".$THISUSER['location_city'].".".$i.";";
	if (stristr("-".$THISUSER['maphistory'],$locatie_nu) || $ALWAYS_SHOW_MAP)
	{
		echo "<td width=20><center><img".(($mogelijk)?" OnClick=\"location='?action=move&street_id=$i&transport='+document.transport.transport.value;\" style='cursor:pointer;' ":$vuks)."src=\"imgs/sector_".$mi['merchandise']."_".$current.".bmp\" width=20 height=20 title=\"".strtoupper($STREET[$mi['merchandise']])."\" border=0></td>";
	}
	else
	{
		echo "<td width=20><center><img".(($mogelijk)?" OnClick=\"location='?action=move&street_id=$i&transport='+document.transport.transport.value;\" style='cursor:pointer;' ":$vuks)."src=\"imgs/sector_unexplored_".$current.".bmp\" width=20 height=20 title=\"Unexplored\" border=0></td>";
	}
	echo (ceil($i/$MAP_WIDTH) == floor($i/$MAP_WIDTH) && $i!=$MAX_SECTORS) ? "</tr><tr valign=middle height=20>" : "";
}

?>
</tr>
</table>
<br>
<br>
Je kan lopen of met de bus. Dat moet je eerst kiezen! Default is met de bus. Met de bus doe je er tussen de 2 en 6 turns over (2 min, 6 max), lopend doe je het altijd in 4 turns.



<?

require("inc.footer.php");


