<?php

require("inc.config.php");

Check_Login();

$buttonText = "Equip";
if ( isset($_POST['equip_new']) )
{
	foreach ( $_POST AS $key => $val )
	{
		if ( $buttonText === $val )
		{
			$getItemName = $key . "_item";
			$itemName = $key;
			break;
		}
	}

	if ( isset($getItemName, $itemName) && !empty($_POST[$getItemName]) )
	{
		$sql = "UPDATE $TABLE[users] SET ".$itemName."='".$_POST[$getItemName]."' WHERE id='".$UID."';";
		mysql_query($sql);
	}

	Go();
}

$title="Equipment";
require("inc.header.php");

$l = "u".$UID;

?>

<br>
<b>Equipment</b><br>
<br>
<table border="0" cellpadding="2" cellspacing="0">
<form method="post" action="">
<input type="hidden" name="equip_new" value="1">
<tr>
	<td colspan="3"><b>WEAPONS</b></td>
</tr>
<tr>
	<td width="140">Primary Weapon</td>
	<td><select name="weapon1_item" style="width:180px;"><option value=''>-- Empty<?php $q=mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='$l' AND type='weapon' GROUP BY name") or die(mysql_error()); while ($r = mysql_fetch_assoc($q)) { echo "<option".(($THISUSER['weapon1']==$r['id'])?' style="font-weight:bold;" selected="selected"':"")." value='".$r['id']."'>".$r['name']."</option>"; } ?></select></td>
	<td><input type="submit" name="weapon1" value="<?php echo $buttonText; ?>" style="width:50px;"></td>
</tr>
<tr>
	<td width="140">Secundary Weapon</td>
	<td><select name="weapon2_item" style='width:180;'><option value=''>-- Empty<?php $q=mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='$l' AND type='weapon' GROUP BY name") or die(mysql_error()); while ($r = mysql_fetch_assoc($q)) { echo "<option".(($THISUSER['weapon2']==$r['id'])?' style="font-weight:bold;" selected="selected"':"")." value='".$r['id']."'>".$r['name']."</option>"; } ?></select>
	<td><input type="submit" name="weapon2" value="<?php echo $buttonText; ?>" style="width:50px;"></td>
</tr>

<tr>
	<td colspan="3"><br/><b>MISC</b></td>
</tr>
<tr>
	<td width="140">Medical</td>
	<td><select name="medical_item" style="width:180px;"><option value=''>-- Empty<?php $q=mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='$l' AND type='medical' GROUP BY name") or die(mysql_error()); while ($r = mysql_fetch_assoc($q)) { echo "<option".(($THISUSER['medical']==$r['id'])?' style="font-weight:bold;" selected="selected"':"")." value='".$r['id']."'>".$r['name']."</option>"; } ?></select>
	<td><input type="submit" name="medical" value="<?php echo $buttonText; ?>" style="width:50px;"></td>
</tr>
<tr>
	<td width="140">Trade item</td>
	<td><select name="trade_item" style="width:180px;"><option value=''>-- Empty<?php $q=mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='$l' AND type='trade' GROUP BY name") or die(mysql_error()); while ($r = mysql_fetch_assoc($q)) { echo "<option".(($THISUSER['trade']==$r['id'])?' style="font-weight:bold;" selected="selected"':"")." value='".$r['id']."'>".$r['name']."</option>"; } ?></select>
	<td><input type="submit" name="trade" value="<?php echo $buttonText; ?>" style="width:50px;"></td>
</tr>
<tr>
	<td width="140">Communication Device</td>
	<td><select name="communication_item" style="width:180px;"><option value=''>-- Empty<?php $q=mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='$l' AND type='communication' GROUP BY name") or die(mysql_error()); while ($r = mysql_fetch_assoc($q)) { echo "<option".(($THISUSER['communication']==$r['id'])?' style="font-weight:bold;" selected="selected"':"")." value='".$r['id']."'>".$r['name']."</option>"; } ?></select>
	<td><input type="submit" name="communication" value="<?php echo $buttonText; ?>" style="width:50px;"></td>
</tr>

<tr>
	<td colspan="3"><br/><b>ARMOUR</b></td>
</tr>
<tr>
	<td width="140">Shoes</td>
	<td><select name="cloathing_feet_item" style="width:180px;"><option value=''>-- Empty<?php $q=mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='$l' AND type='feet' GROUP BY name") or die(mysql_error()); while ($r = mysql_fetch_assoc($q)) { echo "<option".(($THISUSER['cloathing_feet']==$r['id'])?' style="font-weight:bold;" selected="selected"':"")." value='".$r['id']."'>".$r['name']."</option>"; } ?></select>
	<td><input type="submit" name="cloathing_feet" value="<?php echo $buttonText; ?>" style="width:50px;"></td>
</tr>
<tr>
	<td width="140">Pants</td>
	<td><select name="cloathing_legs_item" style="width:180px;"><option value=''>-- Empty<?php $q=mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='$l' AND type='legs' GROUP BY name") or die(mysql_error()); while ($r = mysql_fetch_assoc($q)) { echo "<option".(($THISUSER['cloathing_legs']==$r['id'])?' style="font-weight:bold;" selected="selected"':"")." value='".$r['id']."'>".$r['name']."</option>"; } ?></select>
	<td><input type="submit" name="cloathing_legs" value="<?php echo $buttonText; ?>" style="width:50px;"></td>
</tr>
<tr>
	<td width="140">Torso</td>
	<td><select name="cloathing_torso_item" style="width:180px;"><option value=''>-- Empty<?php $q=mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='$l' AND type='torso' GROUP BY name") or die(mysql_error()); while ($r = mysql_fetch_assoc($q)) { echo "<option".(($THISUSER['cloathing_torso']==$r['id'])?' style="font-weight:bold;" selected="selected"':"")." value='".$r['id']."'>".$r['name']."</option>"; } ?></select>
	<td><input type="submit" name="cloathing_torso" value="<?php echo $buttonText; ?>" style="width:50px;"></td>
</tr>
<tr>
	<td width="140">Gloves</td>
	<td><select name="cloathing_hands_item" style="width:180px;"><option value=''>-- Empty<?php $q=mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='$l' AND type='hands' GROUP BY name") or die(mysql_error()); while ($r = mysql_fetch_assoc($q)) { echo "<option".(($THISUSER['cloathing_hands']==$r['id'])?' style="font-weight:bold;" selected="selected"':"")." value='".$r['id']."'>".$r['name']."</option>"; } ?></select>
	<td><input type="submit" name="cloathing_hands" value="<?php echo $buttonText; ?>" style="width:50px;"></td>
</tr>
<tr>
	<td width="140">Headwear</td>
	<td><select name="cloathing_head_item" style="width:180px;"><option value=''>-- Empty<?php $q=mysql_query("SELECT * FROM $TABLE[items] WHERE locatie='$l' AND type='head' GROUP BY name") or die(mysql_error()); while ($r = mysql_fetch_assoc($q)) { echo "<option".(($THISUSER['cloathing_head']==$r['id'])?' style="font-weight:bold;" selected="selected"':"")." value='".$r['id']."'>".$r['name']."</option>"; } ?></select>
	<td><input type="submit" name="cloathing_head" value="<?php echo $buttonText; ?>" style="width:50px;"></td>
</tr>
</form></table>

<?php

require("inc.footer.php");

?>