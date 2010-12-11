<?php /*

// LAST SIGNUP
$lastsignup = mysql_query("SELECT charachtername FROM $TABLE[users] ORDER BY -signuptime LIMIT 1") or die(mysql_error());
$lastsignup = mysql_result($lastsignup,0) or die(mysql_error());
echo "Last Signup:<br><b>$lastsignup</b><br><br>";

// NEWEST GANG
$newestgang = mysql_query("SELECT name FROM $TABLE[gangs] ORDER BY -created LIMIT 1") or die(mysql_error());
$newestgang = mysql_result($newestgang,0) or die(mysql_error());
echo "Newest Gang:<br><b>$newestgang</b><br><br>";

// LAST CONTRACT
$lastcontract = 0;

echo "Last Contract:<br><b>$lastcontract</b>";

*/ ?>
No news :(