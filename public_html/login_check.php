<?php

$score=0;

if ( !empty($_SESSION['gangwars']['login']) )
{
	// Logged In

	echo 'Je Score:<br>';
	echo '<b>'.$score.'</b><br>';
	echo '<br>';

	echo 'Charachter:<br>';
	echo '<b>' . $CHARACHTER[$THISUSER['charachter_id']] . '</b><br>';
	echo '<br>';

	echo 'Gang:<br>';
	if ( $THISUSER['gang_id'] )
	{
		$qGang = mysql_query("SELECT name FROM gangs WHERE id = '".$THISUSER['gang_id']."';") or die(mysql_error());
		$szGang = mysql_result($qGang, 0);
		echo '<a href="gang.php">'.$szGang.'</a>';
	}
	else
	{
		echo '<i>Geen</i>';
	}
}
else
{
	// Not Logged In
	?>

<form name="login" method="post" action="login.php">
<input type=hidden name=check value=1>

Username<br>
<input type=text name=usr autocomplete=off style='width:120px;background:transparent;border:solid 1px #ffffff;' value="<?php echo isset($_GET['username']) ? $_GET['username'] : ''; ?>"><br>
<br>
Password<br>
<input type=password name=pwd autocomplete=off style='width:120px;background:transparent;border:solid 1px #ffffff;'><br>
<br>
<br>
<input type=submit value="Log In" style='width:120px;'>
</form>

	<?php

}

?>