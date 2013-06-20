<?
require_once("../DBAccess.php");
require_once("../config.php");

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
$leagueplay = $row['leagueplay'];
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
<html>
    <head>
        <meta charset="utf-8">
            <title>Basket Ball</title>
            <link rel="icon" type="image/GIF" href="res/favicon.ico"/>
    </head>
    <body style="padding:0; margin: 0; background: #FFF;">
        <div style="text-align: center; font-size: 0">
            <canvas id="gameCanvas"></canvas>
        </div>
    </body>
</html>
    <script>
    function getViewport() {
        
        var viewPortWidth;
        var viewPortHeight;
        
        // the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight
        if (typeof window.innerWidth != 'undefined') {
            viewPortWidth = window.innerWidth,
            viewPortHeight = window.innerHeight
        }
        
        // IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document)
        else if (typeof document.documentElement != 'undefined'
                 && typeof document.documentElement.clientWidth !=
                 'undefined' && document.documentElement.clientWidth != 0) {
            viewPortWidth = document.documentElement.clientWidth,
            viewPortHeight = document.documentElement.clientHeight
        }
        
        // older versions of IE
        else {
            viewPortWidth = document.getElementsByTagName('body')[0].clientWidth,
            viewPortHeight = document.getElementsByTagName('body')[0].clientHeight
        }
        return [viewPortWidth, viewPortHeight];
    }
	var gameCanvas = document.getElementById("gameCanvas");
	var viewport = getViewport();
	//gameCanvas.width = viewport[0];
	//gameCanvas.height = viewport[1];
    gameCanvas.width = 320;
	gameCanvas.height = 568;
	window.game = 1;
	window.player = {speed:<?=$speed?>,jump:<?=$jump?>,power:<?=$power?>,technique:<?=$technique?>,pace:<?=$pace?>};

    </script>
<script src="cocos2d.js"></script>