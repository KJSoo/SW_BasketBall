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

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Basket</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</head>

<body>
<div data-role="page" id="player">
    <div data-role="header" data-position="fixed" data-tap-toggle="false" data-id="persistent">
        <h1>선수정보</h1>
        <a href="#" data-role="button" data-rel="back" data-icon="arrow-l">Back</a>
    </div><!-- /header -->
 
    <div data-role="content">    
        <ul>
        <li>이름:<?=$name?></li>
        <li>포지션:<?=$position?></li>
        <li>레벨:<?=$level?></li>
        <li>경험치:<?=$exp?>/<?=$leveltable[$level]?></li>
        <li>골드:<?=$gold?></li>
        <li>캐시:<?=$cash?></li>
        <li>에너지:<?=$energy?>/<?=$energytable[$level]?></li>
        </ul>
        <hl>
        <ul>
        <li>소속 리그 : <?=$league?></li>
        <li>리그경기수 : <?=$week?> / 5</li>
        <li>소속 팀 : <?=$team?></li>
        </ul>
        <ul>
        <li>스피드 : <?=$speed?></li>
        <li>점프력 : <?=$jump?></li>
        <li>파워 : <?=$power?></li>
        <li>테크닉 : <?=$technique?></li>
        <li>패스 : <?=$pace?></li>
        </ul>
        <ul>
        <li>총경기수 : <?=$playcount?></li>
        <li>득점 : <?=$goalcount?> / <?=$shoottotal?></li>
        <li>덩크 : <?=$dunkcount?></li>
        <li>패스 : <?=$pacecount?> / <?=$pacetotal?></li>
        <li>블록 : <?=$blockcount?> / <?=$blocktotal?></li>
        <li>인터셉트 : <?=$interceptcount?> / <?=$intercepttotal?></li>        
        </ul>
    </div><!-- /content -->
        
    <div data-role="footer" data-position="fixed" data-tap-toggle="false" data-id="persistent">
	  <div data-role="navbar">
	  	<ul>
	  		<li><a href="index.php#home" data-icon="home">홈</a></li>
	  		<li><a href="index.php#league" data-icon="grid">리그</a></li>
	  		<li><a href="index.php#player" data-icon="info">선수</a></li>
	  		<li><a href="index.php#store" data-icon="star">상점</a></li>
	  		<li><a href="index.php#friend" data-icon="search">친구</a></li>
	  	</ul>
	  </div>
    </div><!-- /footer -->
</div>
</body>
</html>