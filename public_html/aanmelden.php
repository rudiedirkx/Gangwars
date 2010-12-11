<?php

include("config.php");

if ( !empty($UID) )
	Go("./?msg=Je hebt al een account!");


if ($_GET[mode] == "activation" && $_GET[code] && $_GET[username])
{
	$q=mysql_query("SELECT * FROM $TABLE[users] WHERE username='$_GET[username]' AND activationcode='$_GET[code]'");
	$i = mysql_fetch_array($q);
	if (mysql_num_rows($q))
	{
		mysql_query("UPDATE $TABLE[users] SET activationcode='' WHERE username='$_GET[username]' AND id='$i[id]'");

		Go("./?msg=Je account is geactiveerd.&username=$_GET[username]");
	}
	else
	{
		Go("./?msg=Je account is al geactiveerd of deze data is fout.");
	}
}

if ($_POST[check] == 1)
{
	$usr = $_POST[username];
	$eml = $_POST[email];
	$pwd = md5($_POST[password]);

print_r($_POST);

	if (!($usr && $eml && trim($usr)))
	{
		Go("?msg=Je hebt niet alles ingevuld!&usr=$usr&eml=$eml");
	}
	if ($usr == "iedereen" || $usr == "niemand" || ereg("admin",strtolower($usr)) || ereg("rudie",strtolower($usr)) || mysql_num_rows(mysql_query("SELECT * FROM $TABLE[users] WHERE username='$usr'")))
	{
		Go("?msg=Deze <b>gebruikersnaam</b> is al in gebruik!&eml=$eml");
	}
	if (mysql_num_rows(mysql_query("SELECT * FROM $TABLE[users] WHERE email='$eml'")))
	{
		Go("?msg=Dit <b>emailadres</b> is al in gebruik!&eml=$eml&usr=$usr");
	}
	if (strlen($usr) < 2 || strlen($usr) > 15)
	{
		Go("?msg=Deze <b>gebruikersnaam</b> is invalid.Minimaal 4 en maximaal 15 tekens lang!&eml=$eml");
	}
	if (!Goede_Gebruikersnaam($usr))
	{
		Go("?msg=Deze <b>gebruikersnaam</b> is invalid.Alleen letters&Cijfers mogelijk!&eml=$eml");
	}
	if (!preg_match("/(?i)^([a-z0-9._-])+@([a-z0-9.-])+\.([a-z0-9]){2,4}$/",$eml))
	{
		Go("?msg=Je <b>emailadres</b> is niet juist!&usr=$usr");
	}

	$activationcode = Create_Password(14);
	$l1 = rand(1,$MAX_SECTORS);
	$l2 = rand(1,$MAX_SECTORS);
	mysql_query("INSERT INTO $TABLE[users] (username,password,email,activationcode,charachter,charachtername,turns,location_city,location_citypart) VALUES ('$usr','$pwd','$eml', '$activationcode', '$_POST[charachter]', '$_POST[charachtername]', '$TICKS_START','$l1','$l2')") or die (mysql_error());

	$mailtje = File_To_String("include/mailtje.txt");
	$mailtje = str_replace("[username]",$usr,$mailtje);
	$mailtje = str_replace("[password]",$_POST[password],$mailtje);
	$mailtje = str_replace("[code]",$activationcode,$mailtje);
	$url = "http://".$_SERVER[HTTP_HOST].$_SERVER[PHP_SELF]."?mode=activation&code=$activationcode&username=$usr";
	$mailtje = str_replace("[url]",$url,$mailtje);
	@mail($eml,"Nieuwe account voor GangWars - Informatie",$mailtje,"From: Vibage.com GANGWARS REGISTRATIE<vibage@vibage.com>\r\nContent-type: text/html; charset=iso-8859-1\r\n");

	Go("./?msg=Je hebt jezelf succesvol aangemeld. Er is een e-mail verstuurd met activatiedata.");
}

$title="Aanmelden";
include("header.php");

?>

<br>
Aanmelden<br>
<br>
<br>

<table border=0 cellpadding=0 cellspacing=0 width=250>
<form name=aanmelden method=post action=aanmelden.php><input type=hidden name=check value=1>
<tr><td><center>

Gebruikersnaam:<br>
<input type=text name=username value="<?=$_GET[usr]?>" maxlength=20><br>
<br>

Wachtwoord:<br>
<input type=password name=password><br>
<br>

Emailadres:<br>
<input type=text name=email value="<?=$_GET[eml]?>"><br>
<br>

Charachtername:<br>
<input type=text name=charachtername maxlength=16><br>
<br>

Charachter:<br>
<select name=charachter><option value='1'>Businessman<option value='2'>Computernerd<option value='3'>Hitman<option value='4'>Junkie<option value='5'>SWAT</select><br>
<br>

<br>
<input type=submit value="Aanmelden">

</td></tr>
</form></table>

<?

include("footer.php");


