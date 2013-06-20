<?
require_once("DBAccess.php");

$uid = $_GET["uid"];


$strSQL = "SELECT uid, name from member where uid='{$uid}' ";
$rs = DBSelect($strSQL);
$count = mysql_num_rows($rs);


if($count == 0)
{
	$strSQL = "INSERT into member (uid) values ('{$uid}') ";
	DBSelect($strSQL);
	
	header("Location: http://jaewoong.com/game/mobile/dashboard.html");
    exit();
}
else{
	$row = mysql_fetch_row($rs);
	if($row[1] == '') {
		header("Location: http://jaewoong.com/game/mobile/dashboard.html");
		exit();
	}
	else
	{
		header("Location: http://jaewoong.com/game/mobile/dashboard.html");
		exit();
	}
	
}

?>