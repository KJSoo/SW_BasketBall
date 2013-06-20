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
        <h1>훈련하기</h1>
        <a href="#" data-role="button" data-rel="back" data-icon="arrow-l">Back</a>
    </div><!-- /header -->
 
    <div data-role="content">    
        <input type="button" value="스피드 훈련(<?=$speed?>)">
        <input type="button" value="점프 훈련(<?=$jump?>)">
        <input type="button" value="파워 훈련(<?=$power?>)">
        <input type="button" value="테크닉 훈련(<?=$technique?>)">
        <input type="button" value="패스 훈련(<?=$pace?>)">
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