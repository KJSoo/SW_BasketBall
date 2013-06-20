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

?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Basket</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</head>

<body>
<div data-role="page" id="home">
 
    <div data-role="header" data-position="fixed" data-tap-toggle="false" data-id="persistent">
        <h1>홈</h1>
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
	        <a href="event.php" data-rel="dialog" data-role="button">이벤트 정보</a>
	        <a href="update.php" data-rel="dialog" data-role="button">업데이트 정보</a>
	        <input type="button" value="레이드 입장" />
	        <input type="button" value="랭킹" />
    </div><!-- /content -->
 
    <div data-role="footer" data-position="fixed" data-tap-toggle="false" data-id="persistent">
	  <div data-role="navbar">
	  	<ul>
	  		<li><a href="#home" data-icon="home">홈</a></li>
	  		<li><a href="#league" data-icon="grid">리그</a></li>
	  		<li><a href="#player" data-icon="info">선수</a></li>
	  		<li><a href="#store" data-icon="star">상점</a></li>
	  		<li><a href="#friend" data-icon="search">친구</a></li>
	  	</ul>
	  </div>
    </div><!-- /footer -->
</div><!-- /page -->
 
<div data-role="page" id="league">
 
    <div data-role="header" data-position="fixed" data-tap-toggle="false" data-id="persistent">
        <h1>리그</h1>
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
        
        <a href="play_1.php?uid=<?=$uid?>" data-role="button" data-transition="slidefade">경기시작</a>               
        
    </div><!-- /content -->
 
    <div data-role="footer" data-position="fixed" data-tap-toggle="false" data-id="persistent">
	  <div data-role="navbar">
	  	<ul>
	  		<li><a href="#home" data-icon="home">홈</a></li>
	  		<li><a href="#league" data-icon="grid">리그</a></li>
	  		<li><a href="#player" data-icon="info">선수</a></li>
	  		<li><a href="#store" data-icon="star">상점</a></li>
	  		<li><a href="#friend" data-icon="search">친구</a></li>
	  	</ul>
	  </div>
    </div><!-- /footer -->
</div><!-- /page -->

<div data-role="page" id="player">
 
    <div data-role="header" data-position="fixed" data-tap-toggle="false" data-id="persistent">
        <h1>선수</h1>
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
	        <a href="player.php?uid=<?=$uid?>" data-role="button" data-transition="slidefade">선수정보</a>
	        <a href="trainer.php?uid=<?=$uid?>" data-role="button" data-transition="slidefade">훈련하기</a>
	        <a href="#" data-role="button" data-transition="pop">아이템 착용</a>
    </div><!-- /content -->
 
    <div data-role="footer" data-position="fixed" data-tap-toggle="false" data-id="persistent">
	  <div data-role="navbar">
	  	<ul>
	  		<li><a href="#home" data-icon="home">홈</a></li>
	  		<li><a href="#league" data-icon="grid">리그</a></li>
	  		<li><a href="#player" data-icon="info">선수</a></li>
	  		<li><a href="#store" data-icon="star">상점</a></li>
	  		<li><a href="#friend" data-icon="search">친구</a></li>
	  	</ul>
	  </div>
    </div><!-- /footer -->
</div><!-- /page -->

<div data-role="page" id="store">
 
    <div data-role="header" data-position="fixed" data-tap-toggle="false" data-id="persistent">
        <h1>상점</h1>
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
		<input type="button" value="아이템 상점" />
		<input type="button" value="캐시 충전" />     
		<a href="#energy" data-rel="popup" data-position-to="window" data-role="button" data-transition="pop">에너지 회복</a>
    </div><!-- /content -->
 
    <div data-role="footer" data-position="fixed" data-tap-toggle="false" data-id="persistent">
	  <div data-role="navbar">
	  	<ul>
	  		<li><a href="#home" data-icon="home">홈</a></li>
	  		<li><a href="#league" data-icon="grid">리그</a></li>
	  		<li><a href="#player" data-icon="info">선수</a></li>
	  		<li><a href="#store" data-icon="star">상점</a></li>
	  		<li><a href="#friend" data-icon="search">친구</a></li>
	  	</ul>
	  </div>
    </div><!-- /footer -->

		<div data-role="popup" id="energy" data-overlay-theme="a" data-theme="c" style="max-width:400px;" class="ui-corner-all">
			<div data-role="header" data-theme="a" class="ui-corner-top">
				<h1>에너지 회복</h1>
			</div>
			<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
				<h3 class="ui-title">에너지를 회복</h3>
				<p>에너지를 회복합니다. 10캐쉬 소모. 수행하시겠습니까?</p>
				<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="b">네</a>    
				<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">아니요</a>  
			</div>
		</div>
</div><!-- /page -->



<div data-role="page" id="friend">
 
    <div data-role="header" data-position="fixed" data-tap-toggle="false" data-id="persistent">
        <h1>친구</h1>
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
		<input type="button" value="친구 목록" />     
		<input type="button" value="ID검색" />
		<input type="button" value="메일/친구신청 확인" />
		<input type="button" value="메일 보내기" />
    </div><!-- /content -->
 
    <div data-role="footer" data-position="fixed" data-tap-toggle="false" data-id="persistent">
	  <div data-role="navbar">
	  	<ul>
	  		<li><a href="#home" data-icon="home">홈</a></li>
	  		<li><a href="#league" data-icon="grid">리그</a></li>
	  		<li><a href="#player" data-icon="info">선수</a></li>
	  		<li><a href="#store" data-icon="star">상점</a></li>
	  		<li><a href="#friend" data-icon="search">친구</a></li>
	  	</ul>
	  </div>
    </div><!-- /footer -->
</div><!-- /page -->


</body>

</html>