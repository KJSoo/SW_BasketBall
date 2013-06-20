<?
// session start //

 session_cache_expire(30);

 session_start();

 //session_destroy();session_start();


// //

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

$grade = $row['grade'];
$week = $row['week'];


$strSQL = "SELECT * from team where grade = '{$grade}'";
$rs = DBSelect($strSQL);

$teamcount = mysql_num_rows($rs);
for($Loop1 = 1; $Loop1 <= $teamcount; $Loop1++)
{
	$row = mysql_fetch_array($rs);
	$teamname[$Loop1] = $row['name'];
	$teamnum[$Loop1] = $Loop1;
	$teamrebound[$Loop1] = $row['rebound'];
	$teamshoot[$Loop1] = $row['shoot'];
	$teamintercept[$Loop1] = $row['intercept'];
	$teamblocking[$Loop1] = $row['blocking'];
	$teampace[$Loop1] = $row['pace'];
	
	if(strcmp($team,$teamname[$Loop1]) == 0)
	{
		$home = $Loop1;
	}
}

function swap($a, $b) {
    $temp = $a;
    $a = $b;
    $b = $temp;
}

function matchtable($teamcount, $week,$home){

	if($teamcount % 2 == 1){
		$teamcount++;
	}

	for($Loop1 = 1; $Loop1 <= $teamcount/2; $Loop1++)
	{
		$match[$Loop1][1] = $Loop1;
		$match[$Loop1][2]= $teamcount+1-$Loop1;	
		//echo("<br>".$match[$Loop1][1].":".$match[$Loop1][2]."<br>");
	}
	
	for($Loop1 = 1; $Loop1 <= $week; $Loop1++)
	{
		for($Loop2 = 1; $Loop2 <= $teamcount/2; $Loop2++)
		{
			$match[$Loop2][1]--;
			if($match[$Loop2][1]==0) $match[$Loop2][1] = $teamcount-1;
			if($Loop2 > 1){
				$match[$Loop2][2]--;
				if($match[$Loop2][2] == 0) $match[$Loop2][2] = $teamcount-1;
			}
		}
	}
	
	for($Loop1 = 1; $Loop1 <= $teamcount/2; $Loop1++)
	{
		$result[$match[$Loop1][1]] = $match[$Loop1][2];
		$result[$match[$Loop1][2]] = $match[$Loop1][1];
	}
	
	return $result[$home];
}

$away = matchtable($teamcount, $week, $home);
$awayname = $teamname[$away];



 // Simulator
 
 
   $output = "";
   $count = "";
   $homescore = 0;
   $awayscore = 0;
   $try = 0;
   
   function outputaddhome($str){
    global $output;
   	$output.="<li style='display:none;' class='home'>".$str."</li>";
   }

   function outputaddhomegoal($str){
    global $output;
   	$output.="<li style='display:none;' class='homegoal'>".$str."</li>";
   }
   
   function outputaddaway($str){
    global $output;
   	$output.="<li style='display:none;' class='away'>".$str."</li>";
   }
   
   function outputaddawaygoal($str){
    global $output;
   	$output.="<li style='display:none;' class='awaygoal'>".$str."</li>";
   }

   $ball = mt_rand(1,2);
   $countplus = mt_rand(1, 5);
   $counttemp = 0;
    
 if(isset($_SESSION['count']) == 0) {
   // 경기시작부
   if($ball == 1) outputaddhome("경기시작! ".$teamname[$home]."의 선제공격이 시작되었어!");
   else if($ball == 2) outputaddaway("경기시작! ".$teamname[$away]."의 선제공격이 시작되었어!");
   
   $_SESSION['count'] = 0;
   $counttemp++;
 }  else {
 	global $output;
    // 경기지속부
    $output = str_replace(" style='display:none;'", "", $_SESSION['data']);
    $count = $_SESSION['count'];
    $homescore = $_SESSION['homescore'];
    $awayscore = $_SESSION['awayscore'];
    $try = $_SESSION['try'];
    
    
     // 이전 내용들은 그냥 표시
 }
 
 
 
 for($Loop1 = 1; $Loop1 <= $countplus; $Loop1++)
 {
	 if($ball == 1){ // home팀 볼소유
		 $next = mt_rand(1,4);
		 if($next == 1 or $goshoot == 1) { // 슛
			 $temp = mt_rand(1,5);
			 if($temp == 1) outputaddhome($teamname[$home]." 레이업 슛을 시도합니다!");
			 if($temp == 2) outputaddhome($teamname[$home]." 원핸드 슛!");
			 if($temp == 3) outputaddhome($teamname[$home]." 페이드 어웨이 슛!"); 
			 if($temp == 4) outputaddhome($teamname[$home]." 미들 점프 슛!"); 
			 if($temp == 5) outputaddhome($teamname[$home]." 훅 슛!"); 
			 $ball = 3;
			 $goshoot = 0;
			 continue;
		 }
		 else if($next == 2) { // 패스
			 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddhome($teamname[$home]."! 성공적인 바운드 패스~");
			 if($temp == 2) outputaddhome($teamname[$home]." 앞선수에게 짧은 패스");
			 if($temp == 3) outputaddhome($teamname[$home]." 기막힌 오버헤드 패스!");
			 continue;
		 }
		 else if($next == 3) { // 인터셉트
			 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddaway($teamname[$away]." 날카로운 인터셉트~");
			 if($temp == 2) outputaddaway($teamname[$away]." 가 공을 가로챘어!");
			 if($temp == 3) outputaddaway($teamname[$away]." 날아오는 공을 캐치했어"); 
			 $ball = 2;
			 continue;
		 }
		 else if($next == 4) { // 돌파
			 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddhome($teamname[$home]." 공을 공격수에게 앨리웁!");
			 if($temp == 2) outputaddhome($teamname[$home]." 폭풍같은 돌파!");
			 if($temp == 3) outputaddhome($teamname[$home]." 적 수비수를 따돌렸어!");
			 $goshoot = 1;
			 continue;
		 }
	 }
	 else if($ball == 2){ // away팀 볼소유
		 $next = mt_rand(1,4);
		 if($next == 1 or $goshoot == 1) { // 슛
			 $temp = mt_rand(1,5);
			 if($temp == 1) outputaddaway($teamname[$away]." 레이업 슛을 시도합니다!");
			 if($temp == 2) outputaddaway($teamname[$away]." 원핸드 슛!");
			 if($temp == 3) outputaddaway($teamname[$away]." 페이드 어웨이 슛!"); 
			 if($temp == 4) outputaddaway($teamname[$away]." 미들 점프 슛!"); 
			 if($temp == 5) outputaddaway($teamname[$away]." 훅 슛!"); 
			 $ball = 4;
			 $goshoot = 0;
			 continue;
		 }
		 else if($next == 2) { // 패스
			 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddaway($teamname[$away]."! 성공적인 바운드 패스~");
			 if($temp == 2) outputaddaway($teamname[$away]." 앞선수에게 짧은 패스");
			 if($temp == 3) outputaddaway($teamname[$away]." 기막힌 오버헤드 패스!");
			 continue;
		 }
		 else if($next == 3) { // 인터셉트
			 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddhome($teamname[$home]." 날카로운 인터셉트~");
			 if($temp == 2) outputaddhome($teamname[$home]." 볼을 가로챘어!");
			 if($temp == 3) outputaddhome($teamname[$home]." 스틸!"); 
			 $ball = 1;
			 continue;
		 }
		 else if($next == 4) { // 돌파
			 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddaway($teamname[$away]." 볼을 공격수에게 앨리웁!");
			 if($temp == 2) outputaddaway($teamname[$away]." 폭풍같은 돌파!");
			 if($temp == 3) outputaddaway($teamname[$away]." 적 수비수를 따돌렸어!");
			 $goshoot = 1;
			 continue;
		 }
	 }
	 else if($ball == 3){ // home팀 슛팅
 		 $next = mt_rand(1,5);
 		 if($next == 1 or $next == 2){ // 골인
			 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddhomegoal($teamname[$home]." 득점~");
			 if($temp == 2) outputaddhomegoal($teamname[$home]." 고올~인!");
			 if($temp == 3) outputaddhomegoal($teamname[$home]." 골!"); 
			 $ball = 2;
			 $temp = mt_rand(1,2);
			 if($temp == 1) outputaddaway($teamname[$away]." 골라인 패스");
			 if($temp == 2) outputaddaway($teamname[$away]." 바로 경기를 속행!");
			 $countplus++;
			 $homeplus++;
			 continue;
 		 }
	 	 else if($next == 3 or $next == 4){ // 노골
		 	 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddhome($teamname[$home]." 아깝게 노골~");
			 if($temp == 2) outputaddhome($teamname[$home]." 공이 골대를 벗어났어");
			 if($temp == 3) outputaddhome($teamname[$home]." 이런 볼이 튀어나왔어!"); 
			 $ball = 5;
			 continue;
	 	 }
	 	 else if($next == 5){
		 	 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddaway($teamname[$away]." 환상적인 블로킹!");
			 if($temp == 2) outputaddaway($teamname[$away]." 볼을 쳐냈어!");
			 if($temp == 3) outputaddaway($teamname[$away]." 수비벽에 막혔어!"); 
		 	 $ball = 2;
		 	 continue;
	 	 }
	 }
	 else if($ball == 4){ // away팀 슛팅
 		 $next = mt_rand(1,5);
 		 if($next == 1 or $next == 2){ // 골인
			 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddawaygoal($teamname[$away]." 득점~");
			 if($temp == 2) outputaddawaygoal($teamname[$away]." 고올~인!");
			 if($temp == 3) outputaddawaygoal($teamname[$away]." 골!"); 
			 $ball = 1;
			 $temp = mt_rand(1,2);
			 if($temp == 1) outputaddhome($teamname[$home]." 골라인 패스");
			 if($temp == 2) outputaddhome($teamname[$home]." 바로 경기를 속행!");
			 $awaysplus++;
			 $countplus++;
			 continue;
 		 }
	 	 else if($next == 3 or $next == 4){ // 노골
		 	 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddaway($teamname[$away]." 아깝게 노골~");
			 if($temp == 2) outputaddaway($teamname[$away]." 볼이 골대를 벗어났어");
			 if($temp == 3) outputaddaway($teamname[$away]." 이런 볼이 튀어나오다니!"); 
			 $ball = 5;
			 continue;
	 	 }
	 	 else if($next == 5){
		 	 $temp = mt_rand(1,3);
			 if($temp == 1) outputaddhome($teamname[$home]." 환상적인 블로킹!");
			 if($temp == 2) outputaddhome($teamname[$home]." 볼을 쳐냈어!");
			 if($temp == 3) outputaddhome($teamname[$home]." 수비벽에 막혔어!"); 
		 	 $ball = 1;
		 	 continue;
	 	 }
	 }
	 else if($ball == 5){
		 $next = mt_rand(1,2);
		 if($next == 1){
			 outputaddhome($teamname[$home]." 리바운드!");
			 $ball = 1;
		 }
		 else if($next == 2){
		 	 outputaddaway($teamname[$away]." 리바운드!");
			 $ball = 2;
		 }
		 continue;
	 }

 }
 
$_SESSION['count']=$_SESSION['count']+$counttemp+$countplus;
$_SESSION['data'] = $output;
$_SESSION['homescore']=$homescore+$homeplus;
$_SESSION['awayscore']=$awayscore+$awayplus;
 
 
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf8">
<title>Basket</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
            //interval 아이디를 저장하는 변수
            var interval = -1;
            var go = <?=$_SESSION['count']-$countplus-$counttemp?>;
            var homescore = <?=$homescore?>;
            var awayscore = <?=$awayscore?>;
            
            alert(homescore+" : "+awayscore);
            
            
            
            function updatescore(){
	            $("#score").html(homescore+":"+awayscore);
            }            
            
            updatescore();
            
            $(function() {
                $('html, body').animate({scrollTop:$(document).height()}, 'slow');

                interval = setInterval(function() {
                	 if(go <= <?=$_SESSION['count']?>){
                     if($("#board li:eq("+go+")").hasClass('homegoal')){
	                     homescore++;
                     }
                     if($("#board li:eq("+go+")").hasClass('awaygoal')){
	                     awayscore++;
	                     
                     }
                     
                     $("#board li:eq("+go+")").show('swing', function() {updatescore();});
                     go++;
                     
                     $('html, body').animate({scrollTop:$(document).height()}, 'slow');

                   }
                },1500);
                
            })
        </script>
</head>

<body>
<div data-role="page" id="player">
    <div data-role="header" data-position="fixed" data-tap-toggle="false" data-id="persistent">
        <h1>대쉬보드</h1>
    </div><!-- /header -->
 
    <div data-role="content">    
        <h1>현재카운트=<?=$_SESSION['count']-$countplus?>+<?=$countplus?></h1>
        
        <?=$team?><h1 id="score">0:0</h1><?=$awayname?>

        <ul data-role="listview" data-inset="true" id="board">
        <?=$output?> 
        </ul>
        
    </div><!-- /content -->

</div>
</body>
</html>