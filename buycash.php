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
		<img src="image/cash.png" usemap="#back" style="width:320px; height:45px; position:absolute; left:0; top:78px">
		<map id="back" name="back">
			<area shape="rect" coords="0,0,80,45" href="store.php" alt="Image Map" title="Image Map" />
		</map>
		<a href="buycash.php"></a>
		</div>
</div>
<div id="wrapper">
	<div id="scroller">
	
	
	<div style="width:1px; height:10px;"></div>
	<div style="width:272px; height:127px; margin:0 auto; background:url('image/itembox.png'); background-size:cover; z-index:1">
		<div style="float:left; width:65px; height:65px; padding:0px; margin-left:13px; margin-top:10px;">
			<img src="image/itemcover.png" style="width:65px; height:65px;">
		</div>
		<div style="position:relative; left:10px; top:13px; text-align:left; color:black; font-weight:bold; font-size:17px; ">
			캐시 묶음
		</div>
		<div style="position:relative; width:240px; left:10px; top:18px; text-align:left; color:black; font-size:14px; ">
			약간의 쩐.<br />50캐시를 구매합니다.
		</div>
		<img src="image/button_buy.png" style="position:relative; top:22px; left:135px; width:45px; height:36px;">
		<div style="position:relative; left:20px; top:-9px; color:black">
			상품가격 : $4.99<br />
		</div>
	</div>
	
	<div style="width:1px; height:10px;"></div>
	<div style="width:272px; height:127px; margin:0 auto; background:url('image/itembox.png'); background-size:cover; z-index:1">
		<div style="float:left; width:65px; height:65px; padding:0px; margin-left:13px; margin-top:10px;">
			<img src="image/itemcover.png" style="width:65px; height:65px;">
		</div>
		<div style="position:relative; left:10px; top:13px; text-align:left; color:black; font-weight:bold; font-size:17px; ">
			캐시 뭉치
		</div>
		<div style="position:relative; width:240px; left:10px; top:18px; text-align:left; color:black; font-size:14px; ">
			돈뭉치!<br />200캐시를 구매합니다.
		</div>
		<img src="image/button_buy.png" style="position:relative; top:22px; left:135px; width:45px; height:36px;">
		<div style="position:relative; left:20px; top:-9px; color:black">
			상품가격 : $19.99<br />
		</div>
	</div>
	
	<div style="width:1px; height:10px;"></div>
	<div style="width:272px; height:127px; margin:0 auto; background:url('image/itembox.png'); background-size:cover; z-index:1">
		<div style="float:left; width:65px; height:65px; padding:0px; margin-left:13px; margin-top:10px;">
			<img src="image/itemcover.png" style="width:65px; height:65px;">
		</div>
		<div style="position:relative; left:10px; top:13px; text-align:left; color:black; font-weight:bold; font-size:17px; ">
			캐시 덩어리
		</div>
		<div style="position:relative; width:240px; left:10px; top:18px; text-align:left; color:black; font-size:14px; ">
			돈덩어리!<br />500캐시를 구매합니다.
		</div>
		<img src="image/button_buy.png" style="position:relative; top:22px; left:135px; width:45px; height:36px;">
		<div style="position:relative; left:20px; top:-9px; color:black">
			상품가격 : $49.99<br />
		</div>
	</div>
	
	<div style="width:1px; height:10px;"></div>
	<div style="width:272px; height:127px; margin:0 auto; background:url('image/itembox.png'); background-size:cover; z-index:1">
		<div style="float:left; width:65px; height:65px; padding:0px; margin-left:13px; margin-top:10px;">
			<img src="image/itemcover.png" style="width:65px; height:65px;">
		</div>
		<div style="position:relative; left:10px; top:13px; text-align:left; color:black; font-weight:bold; font-size:17px; ">
			캐시 보따리
		</div>
		<div style="position:relative; width:240px; left:10px; top:18px; text-align:left; color:black; font-size:14px; ">
			돈보따리!<br />1000캐시를 구매합니다.
		</div>
		<img src="image/button_buy.png" style="position:relative; top:22px; left:135px; width:45px; height:36px;">
		<div style="position:relative; left:20px; top:-9px; color:black">
			상품가격 : $99.99<