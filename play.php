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
</head>

<body>
<div data-role="page" id="player">
    <div data-role="header" data-position="fixed" data-tap-toggle="false" data-id="persistent">
        <h1>대쉬보드</h1>
    </div><!-- /header -->
 
    <div data-role="content">    
        <h1><?=$week+1?> Week's Game</h1>
        <h1><?=$team?>:<?=$awayname?></h1>
        <p><a href="simulator.php?uid=<?=$uid?>" rel="external" data-role="button">경기시작</a>
    </div><!-- /content -->

</div>
</body>
</html>