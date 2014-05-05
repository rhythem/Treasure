<?php

include 'core/init.php';
logged_in_redirect();
if(!empty($_POST) ){
	$username=$_POST['username'];
	$password = $_POST['password'];
	
	if(empty($username)==true || empty($password) == true){
		$errors[] = 'You Need To enter a username/Password';
		
	}else if(user_exists($username)== false){
		$errors[] = 'We can\'t find that USERNAME Have you registerd?';
		
	}  else {
	
		if(strlen($password) > 32){
			$errors[] = 'Password Too Long.';
		}
		$login = login($username,$password);
		if($login ===false){
			$errors[] = 'Incorrect Username/Password.';
		} else {
		 
			// set user session
			$_SESSION['user_id'] = $login;
			//redirect user to home
			header('Location: index.php');
			exit();
		}
	}
} else{
	$errors[] ='No Data Received. Please try again.';
}
include 'includes/overall/header.php';
if(empty($errors) === false){
?>
		<h2>We tried to log you in but..</h2>
<?php
		echo output_error($errors);
	}
include 'includes/overall/footer.php';
?>