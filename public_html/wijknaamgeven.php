<?php

require_once("inc.config.php");

$arrSectorNames = array(
	'\'t Look',
	'Albion',
	'Amsterdam Zuid',
	'Battery Park',
	'Bloemenbuurt',
	'Boner Island',
	'Bowerstone',
	'Brooklyn',
	'Central Park',
	'Citroen',
	'Cobbeek',
	'College',
	'Coney Island',
	'Dijkzigt/Cool',
	'Duizend',
	'Gay\'s Paradise',
	'Geel',
	'Gestel',
	'Graveyard Grynch',
	'Hiawatta',
	'Hillesluis',
	'Ho-io',
	'Kerbstreets',
	'Kruidenbuurt',
	'LA Sweets',
	'Little Italy',
	'Little Texas',
	'Little Tokyo',
	'Lyceumkwartier',
	'Manhattan',
	'Metwijk',
	'Montevideo',
	'Newport',
	'Noordplein',
	'Northpole',
	'Nurburg',
	'Ohio',
	'Old York',
	'Ottawa',
	'Oud - Zuid',
	'Oude Westen',
	'Porters Feld',
	'Portland',
	'Potters Field',
	'Queens',
	'Red Light Distri',
	'Rio',
	'Rotterdam West',
	'Southpole',
	'Spangen',
	'Staten Island',
	'Tarwewijk',
	'Terran',
	'The 88',
	'The Backstreets',
	'The Bronx',
	'The Ghetto',
	'The Suburb',
	'Tussendijken',
	'Woensel',
	'York',
	'Zeelst',
	'Zonderwijk',
	'Zuidplein',
);
shuffle($arrSectorNames);

header("content-type: text/plain"); print_r( $arrSectorNames ); exit;

if ( isset($_POST['check']) )
{
	$q = mysql_query("SELECT id FROM $TABLE[sectors] WHERE mid='0' AND name='' ORDER BY rand(unix_timestamp()) DESC LIMIT 1") or die(mysql_error());
	$wijk_id = mysql_result($q,0,'id') or die(mysql_error());
	mysql_query("UPDATE $TABLE[sectors] SET name='$_POST[wijknaam]' WHERE id='$wijk_id'");
	echo (mysql_affected_rows()) ? "Naam van \"Wijk $wijk_id\" veranderd in \"$_POST[wijknaam]\"!" : "";
}

?>
<br>
<br>
<br>
<br>
<form method=post>
<input type=hidden name=check value=1>
Wijknaam:<br>
<input type=text name=wijknaam><br>
<br>
<input type=submit value="Opslaan">