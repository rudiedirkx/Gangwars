<?php

if ( !empty($_SESSION['gangwars']['login']) )
{
	if ( $THISUSER['accepted'] )
	{
		$menu = Array(
			"general" => Array(
				Array( "overview",				"./"),
				Array( "finances",				"personalfinance.php"),
				Array( "equipment",				"equipment.php"),
				Array( "backpack",				"backpack.php"),
				Array( "relations",				"relations.php"),
				Array( "communication",			"communicate.php"),
				Array( "gang info",				"gang.php") ),
			"locations" => Array(
				Array( "community center",		"communitycenter.php"),
				Array( "personal hideout",		"personalhideout.php"),
				Array( "metro station",			"citymap.php"),
				Array( "bus stop",				"thismap.php") ),
			"current position" => Array(
				Array( "merchandise",			"merchandise.php"),
				Array( "look around",			"merchandise.php?lookaround=1") ) );

	}
	else
	{
		$menu = Array(
			"general" => Array(
				Array( "overview",				"./"),
				Array( "finances",				"personalfinance.php"),
				Array( "equipment",				"equipment.php"),
				Array( "backpack",				"backpack.php") ),
			"contacts" => Array(
				Array( "chatbox",				"chatbox.php"),
				Array( "new gang",				"newgang.php"),
				Array( "telepathy",				"telepathy.php"),
				Array( "advertise 4 gang",		"advertise4gang.php") ),
			"business" => Array(
				Array( "make money",			"makemoney.php"),
				Array( "look around",			"spendmoney.php"),
				Array( "advertise 4 services",	"advertise4services.php") ) );

	}

	/** PRINT MENU **/
	echo '<ul id="usermenu">'.EOL;
	foreach ( $menu AS $title => $regels )
	{
		$hid = strtolower(str_replace(" ","",$title));
		echo '	<li class="title">'.$title.'</li>'.EOL;
		echo '	<ul>'.EOL;
		foreach ( $regels AS $regel )
		{
			echo '		<li><a href="'.$regel[1].'">'.$regel[0].'</a></li>'.EOL;
		}
		echo '	</ul>'.EOL;
	}
	echo '</ul>'.EOL;
}

?>