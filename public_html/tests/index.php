<?

function getmicrotime()
{
	list($usec, $sec) = explode(" ",microtime());
	return ((float)$usec + (float)$sec);
}
$start_time = getmicrotime();

$dir = (!$_GET[dir]) ? "./" : $_GET[dir];

$adres = (!$_GET[dir]) ? explode("/",$_SERVER[SCRIPT_NAME]) : explode("/",$dir);
$map = $adres[count($adres)-2];
$forthisfile = explode("/",$_SERVER[SCRIPT_NAME]);
$THISFILE = $forthisfile[count($forthisfile)-1];

// Images
$images = array("gif","jpg","bmp","jpeg","png");
$icons = array("jpg"=>"image2","jpeg"=>"image2","gif"=>"image2","bmp"=>"image2","png"=>"image2","txt"=>"text","php"=>"p","zip"=>"compressed","rar"=>"compressed","lnk"=>"link");

?>
<html>

<head>
<title><?=($_GET[opensource])?"Source: ".str_replace("\\","/",str_replace("d:\foxserv\www","",realpath($_GET[opensource]))):"Index van \"$map/\""?></title>
<style>
BODY,TABLE,A { font-family:courier new;font-size:12px;color:#000000; }
</style>
</head>

<?

if ($_GET[opensource])
{
	$numlines = count(file(realpath($_GET[opensource])))+4;
	echo "<body leftmargin=0 topmargin=0 rightmargin=0 bottommargin=0 scroll=auto>";
	$exp = explode(".",$_GET[opensource]);
	$ext = strtolower($exp[count($exp)-1]);
	if (in_array($ext,$images))
	{
		?>
		<center><a href="<?=$_GET[opensource]?>"><?=$_GET[filename]?></a> - <?=ceil(filesize($_GET[opensource])/1024)?> KB</center>
		<table border=0 cellpadding=3 cellspacing=0 width=100% style='border-top:solid 1px black;border-bottom:solid 1px black;'><tr valign=top>
		<td><center><img src="<?=$_GET[opensource]?>"></td>
		</tr></table>
		<?
	}
	else
	{
		?>
		<center><a href="<?=$_GET[opensource]?>"><?=$_GET[filename]?></a> - <?=ceil(filesize($_GET[opensource])/1024)?> KB</center>
		<table border=0 cellpadding=3 cellspacing=0 width=100% style='border-top:solid 1px black;'><tr valign=top>
		<td width=1 align=right><pre><? for ($i=1;$i<$numlines;$i++) { echo str_pad($i,strlen($numlines-1),' ',STR_PAD_LEFT)."\n"; } ?></td>
		<td style='border-left:solid 1px black;' nowrap=nowrap><?show_source(realpath($_GET[opensource])) ?></td>
		</tr></table>
		<?
	}
}
else
{

?>
<body topmargin=0 leftmargin=2 bgproperties=fixed>
<table border=0 cellpadding=0 cellspacing=0>
<tr valign=middle><td>&nbsp;<a href='?dir=<?=$dir?>../'><img src='/icons/folder.gif' width=20 height=22 border=0></a></td><td colspan=2>&nbsp;<font size=1>LEVEL UP!</td></tr>
<?

/* MAPPEN */

$map = opendir($dir);
$i=0;
while ($file = readdir($map))
{
	if (is_dir($dir.$file) && $file !='.' && $file !='..')
	{
		$files_bestandsnaam[$i] = $file;
		$files_ordernaam[$i] = strtolower($file);
		$i++;
	}
}
if ($i)
{
	asort($files_ordernaam); reset($files_ordernaam);
	foreach ($files_ordernaam AS $num => $value)
	{
		echo "<tr valign=middle><td>&nbsp;<a href='?dir=".$dir.$files_bestandsnaam[$num]."/'><img src='/icons/folder.gif' width=20 height=22 border=0></a></td><td colspan=2>&nbsp;<font size=1><a href=\"".$dir.$files_bestandsnaam[$num]."\">".$files_bestandsnaam[$num]."</a></td></tr>";
	}
}
unset($files_ordernaam);
unset($files_bestandsnaam);
unset($i);


/* BESTANDEN */

$map = opendir($dir);
$i=0;
while ($file = readdir($map))
{
	$exp = explode(".",$file);
	$ext = strtolower($exp[count($exp)-1]);

	if (!is_dir($dir.$file) && strtolower(realpath("./").$THISFILE) != strtolower(realpath($dir).$file))
	{
		$files_bestandsnaam[$i] = $file;
		$files_ordernaam[$i] = strtolower($file);
		$files_extensie[$i] = $ext;
		$i++;
	}
}
if ($i)
{
	asort($files_ordernaam); reset($files_ordernaam);
	foreach ($files_ordernaam AS $num => $value)
	{
		echo "<tr valign=middle><td>&nbsp;<a href=\"?opensource=".$dir.$files_bestandsnaam[$num]."&filename=$files_bestandsnaam[$num]\"><img src='/icons/".(($icons[$files_extensie[$num]])?$icons[$files_extensie[$num]]:"unknown").".gif' width=20 height=22 border=0></td><td>&nbsp;<font size=1><a href='".$dir.$files_bestandsnaam[$num]."'>".$files_bestandsnaam[$num]."</a></td><td>&nbsp;(".ceil(filesize($dir.$files_bestandsnaam[$num])/1024)." kb)</td></tr>";
	}
}
unset($files_ordernaam);
unset($files_bestandsnaam);
unset($files_extensie);
unset($i);

?>
</table>
<?

}
$end_time = getmicrotime(); 
$load_time = round($end_time-$start_time,$x=2); 
echo "Loaded in ".sprintf("%2.".$x."f",$load_time)." seconds";
