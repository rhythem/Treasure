<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';

if (empty($_POST) === false){
	$required_feilds = array('username','password','password_again','first_name','last_name','college','day','month','year','email');
	foreach($_POST as $key=>$value){
		if((empty($value) && in_array($key, $required_feilds) ===true)||(($_POST['day'] == '-1')||($_POST['month'] == '-1')||($_POST['year'] == '-1'))||(empty($_POST['gender']))){
			$errors[] = 'All feilds are required.';
			break 1;
		}
		
	}
	
	if(empty($errors) === true){
		if (user_exists($_POST['username']) === true) {
			$errors[]='Sorry, The username \''.htmlentities($_POST['username']). '\' is already taken.';
		}
		if(preg_match("/\\s/", $_POST['username']) == true ){
			$errors[] = 'Username Cant contain spaces.';
		
		}
		if(strlen($_POST['password']) < 6){
			$errors[] = 'Password too small.(min 6 characters)';
		}
		if($_POST['password'] != $_POST['password_again']){
			$errors[] = 'Your passwords do not match';
		}
		if(email_exists($_POST['email']) === true){
			
			$errors[] = 'Sorry, The email \''.htmlentities($_POST['email']). '\' is already in use.';
		}
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[] = 'A valid email address in required.';
		}
		
	}
	
}

?>
<?php
if(isset($_GET['success']) && empty($_GET['success'])){
	echo 'You\'ve been registered succesfully!';
}else {
		if(empty($_POST) === false && empty($errors) === true){	
			//set date and gender
			
			if($_POST['gender'] == 'Male'){
				$gender = 'Male';
			}
			else{
				$gender = 'Female';
			}
			$birthday = $_POST['year'].$_POST['month'].$_POST['day'];
			//register user
			 $register_data = array(
			 'username' 	=> $_POST['username'],
			 'password'		=> $_POST['password'],
			 'first_name' 	=> ucfirst($_POST['first_name']),
			 'last_name' 	=> ucfirst($_POST['last_name']),
			 'gender'		=> $gender,
			 'birthday'		=> $birthday,
			 'college'		=> $_POST['college'],
			 'email' 		=> $_POST['email']
			 );
			register_user($register_data);
			//redirect
			header('Location: register.php?success');
			//exit
			exit();
		} else if(empty($errors) === false) {
			echo output_error($errors);
		}
}
?>
<?php include 'includes/overall/footer.php';  ?>