<?
require_once("DBAccess.php");
require_once("config.php");

$uid = $_GET["uid"];

if($uid == "") $uid = "0B4EE7E5-C73F-4F14-A38E-357D305EBC26";

$strSQL = "select * from member";

$rs = DBSelect($strSQL);
$row = mysql_fetch_array($rs);


$name = $row['name'];
$gender = $row['gender'];
$position = $row['position'];
$level = $row['level'];
$gold = $row['gold'];
$cash = $row['cash'];
$exp = $row['exp'];
$energy = $row['energy'];
$last = $row['last'];
$league = $row['league'];
$week = $row['week'];
$team = $row['team'];

$speed = $row['speed'];
$jump = $row['jump'];
$power = $row['power'];
$technique = $row['technique'];
$pace = $row['pace'];

$playcount = $row['playcount'];
$goalcount = $row['goalcount'];
$dunkcount = $row['dunkcount'];
$pacecount = $row['pacecount'];
$blockcount = $row['blockcount'];
$interceptcount = $row['interceptcount'];

$shoottotal = $row['shoottotal'];
$pacetotal = $row['pacetotal'];
$blocktotal = $row['blocktotal'];
$intercepttotal = $row['intercepttotal'];

?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>iScroll demo: lite edition</title>

<script type="application/javascript" src="iscroll-lite.js"></script>
<link rel="stylesheet" href="default.css" />
<script type="text/javascript">

var myScroll;
function loaded() {
	myScroll = new iScroll('wrapper');
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

document.addEventListener('DOMContentLoaded', loaded, false);

</script>
</head>
<body>
<div id="container">
<div id="header">
		<div id="name"><?=$row['name']?></div>
		<div id="position"><?=$row['position']?></div>
		<div id="level">Lv. <?=$row['level']?></div>
		<div id="gold"><?=$row['gold']?></div>
		<div id="cash"><?=$row['cash']?></div>
		<div id="eng" style="width:<?=round($energy/$energytable[$level])*127?>px;"></div>
		<div id="exp" style="width:<?=round($exp/$leveltable[$level])*127?>px;"></div>
		<div id="title">
		<img src="image/friend_list_title.png" usemap="#back" style="width:320px; height:45px; position:absolute; left:0; top:78px">
		<map id="back" name="back">
			<area shape="rect" coords="0,0,80,45" href="friend.php" alt="Image Map" title="Image Map" />
		</map>
		</div>
</div>
<div id="wrapper">
	<div id="scroller">
	
	<div style="width:320px; height:60px; background:url('image/listbar.png'); background-size:cover">
		<img src="image/player1.png" style="float:left;width:45px;height:45px; margin-left:6px; margin-top:6px;">
		<div style="position:relative;left:9px; font-size:18px; top:8px;">김지수</div>
		<div style="position:relative;left:9px; font-size:13px; top:12px;">마지막 플레이 : 1