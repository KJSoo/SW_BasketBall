<?php
$DBHost = "localhost"; //DB호스트주소
$DBUser = "root"; //DB접속ID
$DBPass = "88dhFflavlR!"; //DB접속비밀번호
$DBName  = "test"; //DB명
	
	
DBConn($DBHost, $DBUser, $DBPass, $DBName);

function DBConn($host, $user, $pass, $dbname){
	$conn = mysql_connect($host, $user, $pass)
    or die("connect error!!" . mysql_error());
	
	mysql_select_db($dbname);	
	return $conn;
}

function DBSelect($strSQL){	
	mysql_query("SET NAMES utf8");
	$rs = mysql_query($strSQL);
	
	return $rs;
}
 
?>