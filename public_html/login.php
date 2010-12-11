<?php

include_once("inc.config.php");

// print_r( $_POST );


/** LOG OUT **/
if ( !empty($_GET['logout']) )
{
	$vuid = $_SESSION['gangwars']['uid'];
	$vip = $_SERVER['REMOTE_ADDR'];
	$time = time();
	mysql_query("INSERT INTO $TABLE[log] (uid,ip,time,actie) VALUES ('$vuid','$vip','$time','logout');") or die("A: ".mysql_error());

	session_unregister("gangwars");
	SetCookie("logininfo",FALSE,time()+1);

	Go("./");
}

/** RETRIEVE PASSWORD **/
if ( isset($_GET['pwdvergeten'], $_GET['code'], $_GET['username']) )
{
	$qr = mysql_query("SELECT * FROM $TABLE[users] WHERE usr='".$_GET['usr']."' AND pwd='".$_GET['code']."';") or die("B: ".mysql_error());

	if (!mysql_num_rows($qr))
	{
		mysql_query("INSERT INTO $TABLE[log] (username,ip,time,date,actie) VALUES ('$vusr.\"_RETRIEVAL\"','$vip','$time','$date','niet ingelogd')") or die("C: ".mysql_error());

		Go("./?msg=This username does not exist in this database.Its been blocked for now.");
	}

	$ui=mysql_fetch_array($qr);

	if ( !empty($ui['activationcode']) )
	{
		Go("./?msg=Je account is nog niet geactiveerd.");
	}

	$save['login'] = TRUE;
	$save['uid'] = $ui['id'];
	$save['username'] = $_GET['usr'];

	// Opslaan in de logboeken
	$vusr = $save['username'];
	$vip = $_SERVER['REMOTE_ADDR'];
	$time = time();
	$date = date('d.m.Y H:i:s');
	mysql_query("INSERT INTO $TABLE[log] (username,ip,time,date,actie) VALUES ('$vusr.\"_RETRIEVAL\"','$vip','$time','$date','ingelogd')") or die("D: ".mysql_error());
	$uid = $save[id];
	mysql_query("UPDATE $TABLE[users] SET lastip='$vip', lastlogin='$date', lastlogintime='$time' WHERE id='$uid'") or die("E: ".mysql_error());

	$_SESSION['gangwars'] = $save;

	Go("./");
	exit();
}

/** LOG IN **/
if ( isset($_POST['usr'], $_POST['pwd']) )
{
	$qUserCheck = mysql_query("SELECT id, username FROM ".$TABLE['users']." WHERE username = '".$_POST['usr']."' AND password = '".md5($_POST['pwd'])."';") or die("F: ".mysql_error());

	if ( 1 == mysql_num_rows($qUserCheck) )
	{
		$arrUser = mysql_fetch_assoc($qUserCheck);

		if ( !empty($arrUser['activationcode']) )
		{
			Go("./?msg=Je account is nog niet geactiveerd.");
		}

		$save['login']		= true;
		$save['uid']		= $arrUser['id'];
		$save['username']	= $arrUser['username'];

		$uip	= $_SERVER['REMOTE_ADDR'];
		$time	= time();
		$date	= date('d.m.Y H:i:s');
		$uid	= $save['uid'];
		mysql_query("INSERT INTO $TABLE[log] (uid, ip, time, actie) VALUES ('".$save['uid']."','".$uip."','".time()."','login')") or die("H: (".$TABLE[log].") ".mysql_error());
//		mysql_query("UPDATE $TABLE[users] SET lastlogin = '$time' WHERE id = '$uid'") or die("I: ".mysql_error());

		$_SESSION['gangwars'] = $save;

		Go("index.php");
		exit;
	}
	else
	{
		$vusr = $usr;
		$vip = $_SERVER['REMOTE_ADDR'];
		$time = time();
		$date = date('d.m.Y H:i:s');
		mysql_query("INSERT INTO $TABLE[log] (uid,ip,time,actie) VALUES (null,'$vip','$time','login-failed')") or die("G: ".mysql_error());

		SetCookie("logininfo",FALSE,time()+1);

		Go("./?msg=FOUTTT");
		exit;
	}
	exit;
}

?>