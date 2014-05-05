<?php	
	$user= "root";
	$db= "treasure";
	$pass= "";
	$host = "localhost";
	$connect_error = "Sorry We're experiencing connection Problem";
	mysql_connect($host,$user,$pass) or die($connect_error);
	mysql_select_db($db) or die($connect_error);
?>
