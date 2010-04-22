<?

include("config.php");

Check_Login();
if (!$THISUSER[accepted])
	Go("./");

$ref = $_SERVER[HTTP_REFERER];
if (stristr($ref,"merchandise.php")&&stristr($ref,"lookaround=1")||stristr($ref,"thismap.php"))
	Go("./");

//

$title="Fighting";
include("header.php");

?>

<br>
Fight<br>
<br>

//

<?

include("footer.php");


