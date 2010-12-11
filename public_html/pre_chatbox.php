<?

include("config.php");

Check_Login();
if ($THISUSER[accepted])
	Go("./");

if ($_GET[mode] == "chat")
{
	$vanaf = max(0,mysql_num_rows(mysql_query("SELECT id FROM $TABLE[chat]"))-50);
	echo "<META http-equiv=Refresh content='2'>";
	echo "<style>BODY,TABLE { font-family:Verdana;font-size:11px;color:black;cursor:default; }</style>";
	echo "<body style='overflow:auto;' leftmargin=1 rightmargin=1 topmargin=1 bottommargin=1 bgcolor=#dddddd>";
	echo "<table border=0 cellpadding=1 cellspacing=0 width=100%>";
	$chat = mysql_query("SELECT *,u.charachtername AS name FROM $TABLE[chat] c LEFT JOIN $TABLE[users] u ON (u.id=c.uid) ORDER BY time,u.id LIMIT $vanaf,50") or die(mysql_error());
	while ($rc = mysql_fetch_assoc($chat))
	{
		echo "<tr ".(($UID==$rc[uid])?"bgcolor=#bbbbbb":"")."><td style='border-bottom:solid 1 white;'>$rc[name]: $rc[bericht]</td></tr>";
	}
	die("</table><a name=onder>&nbsp;</a>");
}
if ($_POST[check] == 1)
{
	$time = time();
	if (strlen($_POST[bericht])>1)
		mysql_query("INSERT INTO $TABLE[chat] (uid,bericht,time) VALUES ('$UID','$bericht','$time')");

	Go("?");
}

$title="Chatbox";
include("header.php");

?>

<br>
<b>Chatbox</b><br>
<br>

<iframe src="pre_chatbox.php?mode=chat" style='width:95%;height:350;'></iframe>

<table border=0 cellpadding=0 cellspacing=0 width=95%><tr valign=middle><form method=post><input type=hidden name=check value=1><td width=90%>
<input type=text name=bericht autocomplete=off></td><td width=10%><input type=submit value="Talk" accesskey=s>
</td></tr></form></table>


<?

include("footer.php");


