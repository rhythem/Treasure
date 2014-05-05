<?php


	session_start();
	ob_start();
	//error_reporting(1);
	include 'core/database.php';
	include 'core/functions.php';
		if(logged_in() === true){
		$session_user_id = $_SESSION['user_id'];
		//$user_data = user_data($session_user_id, 'user_id' , 'username' , 'password' , 'first_name' , 'last_name' ,'gender','birthday', 'email', 'password_recover', 'type','allow_email', 'profile','thumbnail');

	}
	$errors 	= array();
?>