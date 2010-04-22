<?php

// MySQL Tabellen
$TABLE = array(
	"users"		=> 'users',
	"gangs"		=> 'gangs',
	"sectors"	=> 'd_sectors',
	"items"		=> 'items',
	"chat"		=> 'chat',
	"timer"		=> 'timer',
	"log"		=> 'log',
);


// Userinfo (logged in)
$THISUSER = mysql_fetch_assoc(mysql_query("SELECT * FROM $TABLE[users] WHERE id='".$UID."';"));
$l = "u".$UID;
$reng = mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='".$l."';") or die(mysql_error()); // R en G
$RUIMTE = $GEWICHT = 0;
while ($rengi = mysql_fetch_assoc($reng))
{
	$RUIMTE += $rengi['ruimte'];
	$GEWICHT += $rengi['gewicht'];
}
$X = $THISUSER['sector_map_id'];
$Y = $THISUSER['sector_map_location'];



// Userarray maken
$userarray_username = Array();
$userarray_gangid = Array();
$users = mysql_query("SELECT * FROM $TABLE[users] ORDER BY id");
while ($userinfo = mysql_fetch_array($users))
{
	$userarray_username[$userinfo['id']] = $userinfo['username'];
	$userarray_gangid[$userinfo['id']] = $userinfo['gang_id'];
}


// Gangarray maken
$gangarray_name = $gangarray_color = $gangarray_leaderid = $gangarray_sectorid = array();
$gangs = mysql_query("SELECT * FROM ".$TABLE['gangs']." ORDER BY id");
while ($ganginfo = mysql_fetch_array($gangs))
{
	$gangarray_name[$ganginfo['id']]		= $ganginfo['name'];
	$gangarray_color[$ganginfo['id']]		= $ganginfo['gang_color_id'];
	$gangarray_leaderid[$ganginfo['id']]	= $ganginfo['leader_id'];
	$gangarray_sectorid[$ganginfo['id']]	= $ganginfo['sector_id'];
}



// Functions

function Verschil_In_Datum($begin,$eind)
{
	$verschil = $eind - $begin;

	if ($verschil < 60)
	{
		echo "SEC<br>";
		$sec = $verschil;
		if (strlen($sec) == 1)
			$sec = '0'.$sec;
		$tijd = "00:00:".$verschil;
	}
	if ($verschil >= 60 && $verschil < 3600)
	{
		$min = floor($verschil/60);
		if (strlen($min) == 1)
			$min = '0'.$min;
		$sec = $verschil - ($min*60);
		if (strlen($sec) == 1)
			$sec = '0'.$sec;
		$tijd =  "00:".$min.":".$sec;
	}
	if ($verschil >= 3600 && $verschil < 3600*24)
	{
		$uur = floor($verschil/3600);
		if (strlen($uur) == 1)
			$uur = '0'.$uur;
		$min = floor(($verschil - (3600*$uur))/60);
		if (strlen($min) == 1)
			$min = '0'.$min;
		$sec = $verschil - (3600*$uur) - (60*$min);
		if (strlen($sec) == 1)
			$sec = '0'.$sec;
		$tijd = $uur.":".$min.":".$sec;
	}
	if ($verschil > 3600*24)
	{
		$dagen = floor($verschil/(3600*24));
		$uur = floor(($verschil-($dagen*3600*24))/3600);
		if (strlen($uur) == 1)
			$uur = '0'.$uur;
		$min = floor(($verschil - ($dagen*24*3600) - (3600*$uur))/60);
		if (strlen($min) == 1)
			$min = '0'.$min;
	//	$sec = $verschil - ($dagen*24*3600) - (3600*$uur) - (60*$min);
	//	if (strlen($sec) == 1)
	//		$sec = '0'.$sec;
		$dn = ($dagen == 1) ? "dag" : "dagen";
	//	$tijd = $dagen . " $dn " . $uur . " uur " . $min . " min " . $sec . " sec";
		$tijd = $dagen . " $dn " . $uur . " uur " . $min . " min";
	}

	return $tijd;
}


function Create_Password($chars)
{
	$nps = "";
	mt_srand ((double) microtime() * 1000000);
	while (strlen($nps)<$chars)
	{
		$c = chr(mt_rand (0,255));
		if (eregi("^[a-z0-9]$", $c))
		{
			$nps .= $c;
		}
	}
	return ($nps); 
}


function Email_Is_Correct($email)
{
	$correct=1;
	if (!preg_match("/(?i)^([a-z0-9._-])+@([a-z0-9.-])+\.([a-z0-9]){2,4}$/",$email))
	{
		$correct=0;
	}

	return $corrent;
}


function ubb($bericht)
{

	$bericht = str_replace(">", "&gt;", $bericht);

	$bericht = str_replace("<", "&lt;", $bericht);


	$smilies = mysql_query("SELECT * FROM csmilies");
	while ($s = mysql_fetch_array($smilies))
	{
		$bericht = str_replace("$s[smilie]","<img src=\"images/smilies/$s[url]\" width=19 height=19>", $bericht);
	}





	// BBCODE START



	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff. <BLOCKQUOTE>

	$bericht = preg_replace("/\[quote\](.*?)\[\/quote\]/si", "<TABLE BORDER=0 ALIGN=CENTER WIDTH=85%><TR><TD><font size=-1>Quote:</font><HR color=#000000 size=1></TD></TR><TR><TD><FONT SIZE=-1><BLOCKQUOTE>\\1</BLOCKQUOTE></FONT></TD></TR><TR><TD><HR color=#000000 size=1></TD></TR></TABLE>", $bericht);



	// [b] and [/b] for bolding text.

	$bericht = preg_replace("/\[b\](.*?)\[\/b\]/si", "<B>\\1</B>", $bericht);



	// [h1] and [/h1] for bolding text.

	$bericht = preg_replace("/\[h1\](.*?)\[\/h1\]/si", "<h1>\\1</h1>", $bericht);



	// [h2] and [/h2] for bolding text.

	$bericht = preg_replace("/\[h2\](.*?)\[\/h2\]/si", "<h2>\\1</h2>", $bericht);

	

	// [i] and [/i] for italicizing text.

	$bericht = preg_replace("/\[i\](.*?)\[\/i\]/si", "<I>\\1</I>", $bericht);



	// [u] and [/u] for italicizing text.

	$bericht = preg_replace("/\[u\](.*?)\[\/u\]/si", "<U>\\1</U>", $bericht);



	// [s] and [/s] for italicizing text.

	$bericht = preg_replace("/\[s\](.*?)\[\/s\]/si", "<STRIKE>\\1</STRIKE>", $bericht);



	// [ot] and [/ot] for italicizing text.

	$bericht = preg_replace("/\[ot\](.*?)\[\/ot\]/si", "<font color=gray>\\1</font>", $bericht);



	// [img]image_url_here[/img] code..

	$bericht = preg_replace("/\[img\](.*?)\[\/img\]/si", "<IMG SRC=\"\\1\" BORDER=\"0\">", $bericht);

	

	// Patterns and replacements for URL and email tags..

	$patterns = array();

	$replacements = array();

	

	// [url]xxxx://www.phpbb.com[/url] code..

	$patterns[0] = "#\[url\]([a-z]+?://){1}(.*?)\[/url\]#si";

	$replacements[0] = '<!-- BBCode u1 Start --><A HREF="\1\2" TARGET="_blank">\1\2</A><!-- BBCode u1 End -->';

	

	// [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).

	$patterns[1] = "#\[url\](.*?)\[/url\]#si";

	$replacements[1] = '<!-- BBCode u1 Start --><A HREF="http://\1" TARGET="_blank">\1</A><!-- BBCode u1 End -->';

	

	// [url=xxxx://www.phpbb.com]phpBB[/url] code.. 

	$patterns[2] = "#\[url=([a-z]+?://){1}(.*?)\](.*?)\[/url\]#si";

	$replacements[2] = '<!-- BBCode u2 Start --><A HREF="\1\2" TARGET="_blank">\3</A><!-- BBCode u2 End -->';

	

	// [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).

	$patterns[3] = "#\[url=(.*?)\](.*?)\[/url\]#si";

	$replacements[3] = '<!-- BBCode u2 Start --><A HREF="http://\1" TARGET="_blank">\2</A><!-- BBCode u2 End -->';

	

	// [email]user@domain.tld[/email] code..

	$patterns[4] = "#\[email\](.*?)\[/email\]#si";

	$replacements[4] = '<A HREF="mailto:\1">\1</A>';	



	

	// [color=colorfull]message[/color] code.. 

	   $patterns[3] = "#\[color=(.*?)\](.*?)\[/color\]#si"; 

	   $replacements[3] = '<!-- BBCode color Start --><font color="\1">\2</font><!-- BBCode color End -->'; 



	   $bericht = preg_replace($patterns, $replacements, $bericht);



	// EINDE BBCODES



	return $bericht;

}


function Get_Weeknummer()
{
	return date('W');
}


function Make_Datum()
{
	global $maanden;

	$date = date('j')." ".$maanden[date('n')]." ".date('Y');

	return $date;
}


function Make_Tijd()
{
	global $maanden;

	$time = date('H:i');

	return $time;
}


function Goede_Gebruikersnaam($usr)
{
	$goed = 1;

	$letters = strtolower($usr);
	for ($i=0;$i<strlen($letters);$i++)
	{
//		echo "$letters[$i]<br><br>";
		if (!ereg("[a-z]",$letters[$i]) && !ereg("[0-9]",$letters[$i]) && !ereg("_",$letters[$i]) && !ereg("-",$letters[$i]))
		{
			$goed = 0;
		}
	}

	return $goed;
}


function Check_Login()
{
	if ( empty($_SESSION['gangwars']['login']) )
	{
		session_destroy();
		Header("Location: ./?msg=Je bent niet ingelogd. Je kan deze pagina niet bekijken!");
		exit();
	}
}


function Go( $to = BASEPAGE )
{
	if ( empty($to) ) $to = BASEPAGE;
	Header("Location: ".$to);
	exit;
}


function File_To_String($file)
{
	if (file_exists($file))
	{
		$lines = file($file);
		for ($i=0;$i<count($lines);$i++)
		{
			$content .= $lines[$i]."\n";
		}
	}
	else
	{
		$content = "<i>File doesnt exist!</i>";
	}

	return $content;
}


function Refresh_THISUSER()
{
	global $THISUSER;
	$THISUSER = mysql_fetch_assoc(mysql_query("SELECT * FROM $TABLE[users] WHERE id='$UID';"));
}




?>