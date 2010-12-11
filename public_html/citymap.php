<?

include("config.php");

Check_Login();

if ( !$THISUSER['accepted'] )
	Go("./");


$thissector = mysql_fetch_array(mysql_query("SELECT * FROM $TABLE[sectors] WHERE mid='$THISUSER[location_city]' AND maplocation='$THISUSER[location_citypart]'"));

if ( isset($_GET['action']) && $_GET['action'] == "move" && $thissector['merchandise'] == "W")
{
	$nu_h = $THISUSER['location_city']-floor($THISUSER['location_city']/$MAP_WIDTH)*$MAP_WIDTH;	$nu_h = ($nu_h) ? $nu_h : 8;
	$nu_v = ceil($THISUSER['location_city']/$MAP_WIDTH);					$nu_v = ($nu_v) ? $nu_v : 8;
	$naar_h = $_GET['city_id']-floor($_GET['city_id']/$MAP_WIDTH)*$MAP_WIDTH;			$naar_h = ($naar_h) ? $naar_h : 8;
	$naar_v = ceil($_GET['city_id']/$MAP_WIDTH);						$naar_v = ($naar_v) ? $naar_v : 8;
	$afstand = (abs($nu_h-$naar_h)+abs($nu_v-$naar_v));
	$turns_needed = ($_GET['transport'] == "hitch") ? $afstand+3 : rand($afstand,$afstand+6);
	if ($THISUSER['turns']>=$turns_needed && $THISUSER['location_city'] != $_GET['city_id'])
	{
		$lcp = rand(1,64); // lcp = Location CityPart
		$nmh = $THISUSER['maphistory'].';'.$_GET['city_id'].".$lcp;";
		mysql_query("UPDATE $TABLE[users] SET location_city='".$_GET['city_id']."', location_citypart='".$lcp."', turns=turns-".$turns_needed.", gebruikt=gebruikt+".$turns_needed.", maphistory='".$nmh."' WHERE id='".$UID."';") or die(mysql_error());
	}

	Go("thismap.php");
}

$title="Metro Station";
include("header.php");


?>

<br>
<b>Metro Station: Citymap</b><br>
<br>
Where do you want to go..?<br>
<br>
<br>

<form name=transport><select name=transport style='text-align:center;width:<?php echo 20*$MAP_WIDTH+2; ?>;'><option value='metro' SELECTED>TAKE METRO<option value='hitch'>HITCH</select></form>

<table border="0" cellpadding="0" cellspacing="0" width=<?php echo 20*$MAP_WIDTH; ?> height=<?php echo 20*$MAP_WIDTH; ?> style="border:solid 1px #ffffff;">
<tr valign=middle<?php echo ($thissector['merchandise'] == "W")?" height=20":""; ?>><?

$i=0;
$m = mysql_query("SELECT * FROM $TABLE[sectors] WHERE mid='0' ORDER BY maplocation");
while ($mi = mysql_fetch_array($m))
{
	$i++;

	$img = ($mi['maplocation'] == $THISUSER['location_city']) ? "extra" : "normal";

	if ($thissector['merchandise'] == "W")
	{
		echo "<td width=20><center><img OnClick=\"location='?action=move&city_id=".$i."&transport='+document.transport.transport.value;\" style='cursor:pointer;' src=\"imgs/".$img.".jpg\" width=20 height=20".((stristr("-".$THISUSER['maphistory'],";".$i."."))?" title=\"".$mi['name']."\"":"")." border=0></td>";
	}
	else
	{
		echo "<td style='font-size:12;'><center>Je <b>MOET</b> naar een STATION om op de METRO te stappen! En als je hebt besloten te lopen naar je volgende wijk, moet je toch naar een STATION om op de kaart te kijken...</td>";
		break;
	//	echo "<td width=20><center><img src=\"imgs/$img.jpg\" width=20 height=20 title=\"$mi[name]\" border=0></td>";
	}

	echo (ceil($i/$MAP_WIDTH) == floor($i/$MAP_WIDTH) && $i != $MAX_SECTORS) ? "</tr>\n<tr valign=middle height=20>" : "";
	
}

?>
</tr>
</table>


<?

include("footer.php");


