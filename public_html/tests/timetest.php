<?

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
		$sec = $verschil - ($dagen*24*3600) - (3600*$uur) - (60*$min);
		if (strlen($sec) == 1)
			$sec = '0'.$sec;
		$tijd = $dagen . " dagen " . $uur . " uur " . $min . " min " . $sec . " sec";
	}

	return $tijd;
}

?>
<html>

<head>
<title></title>
<style>
BODY,TABLE,A { text-decoration:none;font-size:12px;font-family:Verdana;color:#000000;background:#eeeeee; }
A:hover { text-decoration:onderline underline; }
.field { background:#eeeeee;border:solid 1 px #000000;text-align:center;font-family:courier new;width:300; }
</style>
</head>

<body scroll=auto>

<?

$settime = 1043078032;
$setdate = "20/01/03 16:53:52";

?>

<br>
<br>
<br>

<?=$verschil?><br>
<br>
<br>
TIME PAST SINCE <b><?=$setdate?></b><br>
<input type=text value="<?=Verschil_In_Datum($settime,time())?>" class=field><br>

<br>
<br>
<br>

<?=time()?><br>
<?=date('d/m/y H:i:s')?>



<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

Iedereeen heeft al <b><?=Verschil_In_Datum($settime,time())?></b> de tijd gehad om zichzelf te ontwikkelen!!! :)

