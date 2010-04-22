<?

include("config.php");

Check_Login();
if (!$THISUSER[accepted])
	Go("./");



$title="Merchandise";
include("header.php");

?>
<br>
<?

if ($_GET[lookaround] && is_numeric($_GET[lookaround]))
{
	$ql = mysql_query("SELECT id,name,prijs FROM $TABLE[items] WHERE locatie='".$X.".".$Y."'") or die(mysql_error());
	$aantal_items_in_area = mysql_num_rows($ql);
	$p = ($aantal_items_in_area >= $QUASI_MAX_ITEMS) ? 94 : rand(1,101);
	$doel = (100-$PCT_PER_ITEM*$aantal_items_in_area)*(1+(100-$THISUSER[skill_find])/100);
	$doel = min(93,floor($doel/10)*10);

	if ($p > $doel)
	{
		// Gevonden kan worden: CC, items (equipment of onzin), cloathing, cash, andere_player, computer_player
		if ($aantal_items_in_area)
		{	$x=1;
			while ($list = mysql_fetch_assoc($ql))
			{
				$items_in_area[$x][id] = $list[id];
				$items_in_area[$x][name] = $list[name];
				$items_in_area[$x][prijs] = $list[prijs];
				$x++;
			}
			$item_num = rand(1,$aantal_items_in_area);
			echo "Je hebt gevonden:<br>".$items_in_area[$item_num][name].", ter waarde van Ä ".$items_in_area[$item_num][prijs].".";
			mysql_query("UPDATE $TABLE[items] SET locatie='u".$UID."' WHERE id='".$items_in_area[$item_num][id]."' AND locatie='".$X.".".$Y."'") or die(mysql_error());
		}
		else
		{
			echo "Je hebt echt overal gekeken en weet nu zeker dat er in deze sector niets meer ligt!";
		}
	}
	else
	{
		echo "Je hebt niets gevonden...";
	}
	mysql_query("UPDATE $TABLE[users] SET turns=turns-2, gebruikt=gebruikt+2 WHERE id='$UID'");
}
else
{

	?>

	<br>
	<b>Merchandise</b><br>
	<br>
	<font style='font-size:22px;'><b><?=$STREET[$THISSTREET[merchandise]]?></b></font><br>
	<br>
	<br>
<?


	switch ($THISSTREET[merchandise])
	{
	    case "W":
		echo "Dit is een SubWay. Alleen vanaf SubWays kan je weg uit dit stadsdeel, bijvoorbeeld om een andere gang aan te vallen of goedkoop supplies te kopen.<br><br>Op deze pagina is verder niets te doen in een SubWay.";
		break;

	    case "P":
		echo "Hier kan je spulletjes kopen voor extra energie, health. Je kan je ook laten repareren.<br>Ook hier is alles heel duur. Achterin de winkel staan de illegale dingen, niet te vertrouwen maar wel goedkoper!<br><br>Voorin:<br><br>";
		break;

	    case "M":
		echo "De buurtsuper! Voor al je huis&tuin spulletjes, eten, spelletjes, etc.<br><br>Het huidige aanbod:<br><br>";
		break;

	    case "H":
		$charachter = ($THISUSER[charachter] == 1) ? "corrupte " : "";
		echo "Hier kan je 1e klas verzorging krijgen.<br>Het nadeel van een ziekenhuis: ER WORDEN ALTIJD VRAGEN GESTELD!<br>I.p.v. het ziekenhuis kan je ook naar de Pharmacie gaan, die zou je ook kunnen helpen.<br>Ander nadeel: Ziekenhuizen zijn ONTZETTEND duur! En aangezien een $charachter ".$CHARACHTER[$THISUSER[charachter]]." niet echt een verzekering heeft...";
		break;

	    case "C":
		echo "Volgens de kaart die je hebt (is deze betrouwbaar) is er in deze straat een Community Centre.<br>Als deze nog niet in gebruik is, zou-ie niet te moeilijk te vinden moeten zijn.<br><br>Plz LookAround!";
		break;

	    case "A":
		echo "En als je wilt worden ze van jou... Ons huidige aanbod, altijd scherp geprijsd:<br><br>";
		break;

	    case "R":
		echo "Hier kan je lekker eten. Je moet wel hopen dat niemand de kok en bediening heeft omgekocht om jou om zeep te helpen met een vergifje in je eten.";
		break;

	    case "S":
		echo "In een SafeHouse zit je max 8 uur per dag veilig voor aanslagen en natuurrampen. Als je inlogt voordat er 8 uur zijn verstreken kan je je voor 16 uur niet meer schuilhouden in welke SafeHouse dan ook! Ook krijg je G……N resources en ticks tijdens je hideout!";
		break;

	    case "T":
		echo "Eindelijk een telephone!! Je kan bellen naar je maten, maar ze moeten wel opnemen. Je weet niet of ze er (online) zijn, maar het kost toch geld... Als iemand opneemt, kom je terecht in de chat. Je betaalt dan per seconde. Deze telephone heeft geen Collect Call-functie!";
		break;

	    default:
		echo "Geen Merchandise in deze straat.<br>Je kan wel LookAround om te kijken of er spulletjes liggen hier...";
		break;
	}
}



?>


<?

include("footer.php");


