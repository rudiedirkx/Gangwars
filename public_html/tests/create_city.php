<?

include("../config.php");

$success = "<font color=green>success</font><br>";
$failure = "<font color=red><b>failure</b></font><br>";


$step = ($_POST[step]) ? $_POST[step] : $step;
$engage = ($_POST[engage]) ? $_POST[engage] : $engage;



if($_POST[password] != $ADMINPASS)
{
	$step=0;
}

if($_POST[password] == $ADMINPASS && !$engage)
{
	$step=1;
}

if($_POST[password] == $ADMINPASS && $engage == 1)
{
	$step=2;
}

?>
<html>

<head>
<title>Create City - Stage <?=$step?></title>
<style>
BODY,TABLE,INPUT { font-family:Verdana;font-size:12; }
</style>
</head>

<body scroll=auto>
<?

$step = ($_POST[step]) ? $_POST[step] : $step;
// switch

switch ($step)
{
    case 1:
	// Eerste pagina (procenten)
	echo "<br>";

	?>
	<table border=1 cellpadding=2 cellspacing=0 width=30%>
	<form name=create_city method=post action=create_city.php>
	<tr><td width=50%>% Pharmacie</td><td><input type=text name=p_P value="10" size=2></td></tr>
	<tr><td>% Restaurants</td><td><input type=text name=p_R value="2" size=2></td></tr>
	<tr><td>% Arms'r'us</td><td><input type=text name=p_A value="8" size=2></td></tr>
	<tr><td>% Safehouse</td><td><input type=text name=p_S value="2" size=2></td></tr>
	<tr><td>% Telephone</td><td><input type=text name=p_T value="4" size=2></td></tr>
	<tr><td>% Hospital</td><td><input type=text name=p_H value="2" size=2></td></tr>
	<tr><td>% Way Out</td><td><input type=text name=p_W value="6" size=2></td></tr>
	<tr><td>% Mall</td><td><input type=text name=p_M value="8" size=2></td></tr>
	<tr><td>% Leeg</td><td>de rest</td></tr>
	<input type=hidden name=engage value=1><input type=hidden name=step value=2><input type=hidden name=password value="<?=$_POST[password]?>">
	<tr><td colspan=2><center><input type=submit value="Opslaan"></td></tr>
	</form>
	</table>
	<?
	break;



    case 2:
	// Tweede pagina (confirm nieuwe city maken) (heel veel hidden inputs) (engage wordt 2, step wordt 3)
	echo "<br>";

	$rest = 100-$_POST[p_P]-$_POST[p_R]-$_POST[p_A]-$_POST[p_S]-$_POST[p_T]-$_POST[p_H]-$_POST[p_W]-$_POST[p_M];
	if ($rest < 0)
	{
		die("Je procenten zijn over de 100. Dit kan niet! Ga terug!<form method=post action=create_city.php><input type=hidden name=password value=\"$_POST[password]\"><input type=submit value=\"TERUG\"></form>");
	}
	?>
	Dit zijn de instellingen die je wilt toepassen:<br>
	<br>
	<table border=1 cellpadding=2 cellspacing=0 width=30%>
	<form name=create_city method=post action=create_city.php>
	<tr><td width=50%>Pharmacie</td><td><?=round($_POST[p_P]/100*$MAX_SECTORS,0)?> sectors per Map</td></tr>
	<tr><td>Restaurants</td><td><?=round($_POST[p_R]/100*$MAX_SECTORS,0)?> sectors per Map</td></tr>
	<tr><td>Arms'r'us</td><td><?=round($_POST[p_A]/100*$MAX_SECTORS,0)?> sectors per Map</td></tr>
	<tr><td>Safehouse</td><td><?=round($_POST[p_S]/100*$MAX_SECTORS,0)?> sectors per Map</td></tr>
	<tr><td>Telephone</td><td><?=round($_POST[p_T]/100*$MAX_SECTORS,0)?> sectors per Map</td></tr>
	<tr><td>Hospital</td><td><?=round($_POST[p_H]/100*$MAX_SECTORS,0)?> sectors per Map</td></tr>
	<tr><td>Way Out</td><td><?=round($_POST[p_W]/100*$MAX_SECTORS,0)?> sectors per Map</td></tr>
	<tr><td>Mall</td><td><?=round($_POST[p_M]/100*$MAX_SECTORS,0)?> sectors per Map</td></tr>
	<tr><td>Leeg</td><td><?=round($rest/100*$MAX_SECTORS,0)?> sectors per Map</td></tr>
	<input type=hidden name=engage value=2>
	</table>
	<input type=hidden name=p_P value='<?=$_POST[p_P]/100?>'>
	<input type=hidden name=p_R value='<?=$_POST[p_R]/100?>'>
	<input type=hidden name=p_A value='<?=$_POST[p_A]/100?>'>
	<input type=hidden name=p_S value='<?=$_POST[p_S]/100?>'>
	<input type=hidden name=p_T value='<?=$_POST[p_T]/100?>'>
	<input type=hidden name=p_H value='<?=$_POST[p_H]/100?>'>
	<input type=hidden name=p_W value='<?=$_POST[p_W]/100?>'>
	<input type=hidden name=p_M value='<?=$_POST[p_M]/100?>'>
	<input type=hidden name=rest value='<?=$rest/100?>'>
	<input type=hidden name=password value="<?=$_POST[password]?>">
	<input type=hidden name=step value=3>
	<input type=hidden name=engage value=2>
	<br>
	<br>
	<font color=red><b>ALS JE OP SUBMIT DRUKT WORDEN ALLE HUIDIGE TABELLEN VERWIJDERD EN ALLE INSTELLINGEN OPNIEUW INGESTELD!<br>
	<br>
	<br>
	<input type=submit value="SUBMIT">
	</form>
	<?
	break;



    case 3:
	// Derde pagina (alle sectors worden aangemaakt - allemaal leeg)
	echo "<br>";

	echo "TRUNCATE $TABLE[sectors] - ";
	echo (@mysql_query("TRUNCATE $TABLE[sectors]")) ? $success : $failure;
	echo "<br>";

	for ($i=1;$i<=$MAX_SECTORS;$i++)
	{
		echo "CREATING MAP $i - ";
		$sql = "INSERT INTO $TABLE[sectors] (mid,maplocation,name) VALUES ('0','$i','CityPart $i')";
		echo (@mysql_query($sql)) ? $success : $failure;
		$k++;

		echo "CREATING ALL SECTORS IN MAP $i - ";
		$ok2=1;
		for ($j=1;$j<=$MAX_SECTORS;$j++)
		{
			$sql = "INSERT INTO $TABLE[sectors] (mid,maplocation) VALUES ('$i','$j')";
			$ok2 = (@mysql_query($sql)) ? $ok2 : 0;
			$k++;
		}
		echo ($ok2) ? $success : $failure;
		echo "<br>";
	}
	?>
	<br>
	<form method=post action=create_city.php>
	<input type=hidden name=p_P value='<?=$_POST[p_P]?>'>
	<input type=hidden name=p_R value='<?=$_POST[p_R]?>'>
	<input type=hidden name=p_A value='<?=$_POST[p_A]?>'>
	<input type=hidden name=p_S value='<?=$_POST[p_S]?>'>
	<input type=hidden name=p_T value='<?=$_POST[p_T]?>'>
	<input type=hidden name=p_H value='<?=$_POST[p_H]?>'>
	<input type=hidden name=p_W value='<?=$_POST[p_W]?>'>
	<input type=hidden name=p_M value='<?=$_POST[p_M]?>'>
	<input type=hidden name=rest value='<?=$rest?>'>
	<input type=hidden name=password value="<?=$_POST[password]?>">
	<input type=hidden name=step value=4>
	<input type=hidden name=engage value=2>
	<input type=submit value="VERDER"></form>
	<?
	break;



    case 4:
	// 
	echo "<br>";

//	1 Making Pharmacies
	echo "CREATING <b>PHARMACIES</b> FOR COMPLETE CITY - ";
	$ok=1;
	$n = round($MAX_SECTORS*$MAX_SECTORS*$_POST[p_P]);
	$q = mysql_query("SELECT id FROM $TABLE[sectors] WHERE mid!='0' AND merchandise='X' ORDER BY rand(unix_timestamp()) DESC LIMIT $n");
	while ($i = mysql_fetch_array($q))
	{
		$sql = "UPDATE $TABLE[sectors] SET merchandise='P' WHERE id='$i[id]'";
		$ok = (mysql_query($sql)) ? $ok : 0;
	}
	echo ($ok && mysql_num_rows($q) > 0) ? $success : $failure;
	$m = mysql_num_rows(mysql_query("SELECT id FROM $TABLE[sectors] WHERE merchandise='P'"));
	echo "CREATED #: $m<br>";
	echo "<br>";

//	2 Making Arms 'r' us
	echo "CREATING <b>ARMS 'R' US</b> FOR COMPLETE CITY - ";
	$ok=1;
	$n = round($MAX_SECTORS*$MAX_SECTORS*$_POST[p_A]);
	$q = mysql_query("SELECT id FROM $TABLE[sectors] WHERE mid!='0' AND merchandise='X' ORDER BY rand(unix_timestamp()) DESC LIMIT $n");
	while ($i = mysql_fetch_array($q))
	{
		$sql = "UPDATE $TABLE[sectors] SET merchandise='A' WHERE id='$i[id]'";
		$ok = (mysql_query($sql)) ? $ok : 0;
	}
	echo ($ok && mysql_num_rows($q) > 0) ? $success : $failure;
	$m = mysql_num_rows(mysql_query("SELECT id FROM $TABLE[sectors] WHERE merchandise='A'"));
	echo "CREATED #: $m<br>";
	echo "<br>";

//	3 Making Telephones
	echo "CREATING <b>WAYS OUT</b> FOR COMPLETE CITY - ";
	$ok=1;
	$n = round($MAX_SECTORS*$MAX_SECTORS*$_POST[p_T]);
	$q = mysql_query("SELECT id FROM $TABLE[sectors] WHERE mid!='0' AND merchandise='X' ORDER BY rand(unix_timestamp()) DESC LIMIT $n");
	while ($i = mysql_fetch_array($q))
	{
		$sql = "UPDATE $TABLE[sectors] SET merchandise='T' WHERE id='$i[id]'";
		$ok = (mysql_query($sql)) ? $ok : 0;
	}
	echo ($ok && mysql_num_rows($q) > 0) ? $success : $failure;
	$m = mysql_num_rows(mysql_query("SELECT id FROM $TABLE[sectors] WHERE merchandise='T'"));
	echo "CREATED #: $m<br>";
	echo "<br>";

//	4 Making Hospitals
	echo "CREATING <b>HOSPITALS</b> FOR COMPLETE CITY - ";
	$ok=1;
	$n = round($MAX_SECTORS*$MAX_SECTORS*$_POST[p_H]);
	$q = mysql_query("SELECT id FROM $TABLE[sectors] WHERE mid!='0' AND merchandise='X' ORDER BY rand(unix_timestamp()) DESC LIMIT $n");
	while ($i = mysql_fetch_array($q))
	{
		$sql = "UPDATE $TABLE[sectors] SET merchandise='H' WHERE id='$i[id]'";
		$ok = (mysql_query($sql)) ? $ok : 0;
	}
	echo ($ok && mysql_num_rows($q) > 0) ? $success : $failure;
	$m = mysql_num_rows(mysql_query("SELECT id FROM $TABLE[sectors] WHERE merchandise='H'"));
	echo "CREATED #: $m<br>";
	echo "<br>";

//	5 Making Community Centres
	echo "CREATING ONE <b>COMMUNITY CENTRE</b> IN EVERY CITYPART - ";
	$ok=1;
	for ($j=1;$j<=$MAX_SECTORS;$j++)
	{
		$rn = rand(1,$MAX_SECTORS);
		$sql = "UPDATE $TABLE[sectors] SET merchandise='C' WHERE mid='$j' AND maplocation='$rn'";
		$ok = (mysql_query($sql)) ? $ok : 0;
	}
	echo ($ok) ? $success : $failure;
	$m = mysql_num_rows(mysql_query("SELECT id FROM $TABLE[sectors] WHERE merchandise='C'"));
	echo "CREATED #: $m<br>";
	echo "<br>";

//	6 Making Malls
	echo "CREATING <b>MALLS</b> FOR COMPLETE CITY - ";
	$ok=1;
	$n = round($MAX_SECTORS*$MAX_SECTORS*$_POST[p_M]);
	$q = mysql_query("SELECT id FROM $TABLE[sectors] WHERE mid!='0' AND merchandise='X' ORDER BY rand(unix_timestamp()) DESC LIMIT $n");
	while ($i = mysql_fetch_array($q))
	{
		$sql = "UPDATE $TABLE[sectors] SET merchandise='M' WHERE id='$i[id]'";
		$ok = (mysql_query($sql)) ? $ok : 0;
	}
	echo ($ok && mysql_num_rows($q) > 0) ? $success : $failure;
	$m = mysql_num_rows(mysql_query("SELECT id FROM $TABLE[sectors] WHERE merchandise='M'"));
	echo "CREATED #: $m<br>";
	echo "<br>";

//	7 Making Restaurants
	echo "CREATING <b>RESTAURANTS</b> FOR COMPLETE CITY - ";
	$ok=1;
	$n = round($MAX_SECTORS*$MAX_SECTORS*$_POST[p_R]);
	$q = mysql_query("SELECT id FROM $TABLE[sectors] WHERE mid!='0' AND merchandise='X' ORDER BY rand(unix_timestamp()) DESC LIMIT $n");
	while ($i = mysql_fetch_array($q))
	{
		$sql = "UPDATE $TABLE[sectors] SET merchandise='R' WHERE id='$i[id]'";
		$ok = (mysql_query($sql)) ? $ok : 0;
	}
	echo ($ok && mysql_num_rows($q) > 0) ? $success : $failure;
	$m = mysql_num_rows(mysql_query("SELECT id FROM $TABLE[sectors] WHERE merchandise='R'"));
	echo "CREATED #: $m<br>";
	echo "<br>";

//	8 Making Safehouses
	echo "CREATING <b>MALLS</b> FOR COMPLETE CITY - ";
	$ok=1;
	$n = round($MAX_SECTORS*$MAX_SECTORS*$_POST[p_S]);
	$q = mysql_query("SELECT id FROM $TABLE[sectors] WHERE mid!='0' AND merchandise='X' ORDER BY rand(unix_timestamp()) DESC LIMIT $n");
	while ($i = mysql_fetch_array($q))
	{
		$sql = "UPDATE $TABLE[sectors] SET merchandise='S' WHERE id='$i[id]'";
		$ok = (mysql_query($sql)) ? $ok : 0;
	}
	echo ($ok && mysql_num_rows($q) > 0) ? $success : $failure;
	$m = mysql_num_rows(mysql_query("SELECT id FROM $TABLE[sectors] WHERE merchandise='S'"));
	echo "CREATED #: $m<br>";
	echo "<br>";

//	9 Making Ways Out
	echo "CREATING <b>WAYS OUT</b> FOR COMPLETE CITY - ";
	$ok=1;
	$n = round($MAX_SECTORS*$MAX_SECTORS*$_POST[p_W]);
	$q = mysql_query("SELECT id FROM $TABLE[sectors] WHERE mid!='0' AND merchandise='X' ORDER BY rand(unix_timestamp()) DESC LIMIT $n");
	while ($i = mysql_fetch_array($q))
	{
		$sql = "UPDATE $TABLE[sectors] SET merchandise='W' WHERE id='$i[id]'";
		$ok = (mysql_query($sql)) ? $ok : 0;
	}
	echo ($ok && mysql_num_rows($q) > 0) ? $success : $failure;
	$m = mysql_num_rows(mysql_query("SELECT id FROM $TABLE[sectors] WHERE merchandise='W'"));
	echo "CREATED #: $m<br>";
	echo "<br>";

	// Zijn er precies voldoende sectors aangesteld
	$zoumoeten = $rest*$MAX_SECTORS*$MAX_SECTORS-$MAX_SECTORS;
	$hoeveel = mysql_num_rows(mysql_query("SELECT id FROM $TABLE[sectors] WHERE merchandise='X' AND mid!='0'"));
	echo "CHECK: HET AANTAL LEGE SECTORS KLOPT - ";
	echo (abs($zoumoeten-$hoeveel) <= 8) ? $success : $failure;
	echo "LEEG zou moeten: $zoumoeten | LEEG zo het is: $hoeveel | VERSCHIL: ".abs($zoumoeten-$hoeveel)."<br>";

	break;



    case 5:
	// Wat blijft er nog over..?
	echo "<br>";

	// Actions

	break;



    default:
	?>
	<form name=adminpass method=post action=create_city.php>
	<input type=password name=password>
	<input type=submit value="Log In">
	</form>

	<?
}

?>

<br>
<br>
<br>
<br>

<input type=button value="FINISH" OnClick="location='./?';">