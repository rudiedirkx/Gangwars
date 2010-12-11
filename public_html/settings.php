<?php

// Zo'n beetjte hetzelfde als die van BlackNova Traders

require_once("inc.config.php");

?>
<html>

<head>
<title>GameSettings</title>
<style>
BODY,TABLE,INPUT { font-family:Verdana;font-size:11px; }
</style>
</head>

<body scroll=auto>
<table border=0 cellpadding=1 cellspacing=0 width=500>
<tr bgcolor=#eeeeee>
<td>Max aantal turns mogelijk</td>
<td><?php echo $MAX_TURNS; ?></td>
</tr>
<tr bgcolor=#dddddd>
<td>De tijd die 1 tick duurt</td>
<td><?php echo $TICK_LENGTH; ?> s.</td>
</tr>
<tr bgcolor=#eeeeee>
<td>Hoeveel colonisten 1 nieuwe maken per turn</td>
<td><?php echo ceil(1/$PLANET_COLONISTS); ?></td>
</tr>
<tr bgcolor=#dddddd>
<td>Rente voor geld op een planeet</td>
<td><?php echo $PLANET_CREDITSINTEREST; ?></td>
</tr>
<tr bgcolor=#eeeeee>
<td>Hoeveel colonisten 1 credit maken per turn</td>
<td><?php echo ceil(1/$PLANET_CREDITS); ?></td>
</tr>
<tr bgcolor=#dddddd>
<td>Hoeveel colonisten 1 fighter maken per turn</td>
<td><?php echo ceil(1/$PLANET_FIGHTERS); ?></td>
</tr>
<tr bgcolor=#eeeeee>
<td>Hoeveel colonisten 1 ore maken per turn</td>
<td><?php echo ceil(1/$PLANET_ORE); ?></td>
</tr>

</table>