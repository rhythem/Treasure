<?php
function sanitize($data){
		return  htmlentities(strip_tags(mysql_real_escape_string($data)));
}
function get_leaderboard(){
	$sql = "SELECT * FROM `users` ORDER BY `users`.`rank` desc, `users`.`timestamp` asc";
	$ref = mysql_query($sql);
	
	
	
	$content = '<div class="leaderboard-content"><div id="leaderboard-header"><span class="medium-font  iblock">Rank</span><span id="hname" class="medium-font  iblock">Name</span><span class="medium-font  iblock">Rank</span><span id="hcollege" class="medium-font  iblock">College</span><span class="medium-font  iblock">Date</span></div>';
	$i = 1;
	while($row = mysql_fetch_array($ref,MYSQL_ASSOC))
	{
		$dt		= explode(' ',$row['timestamp']);
		$date = $dt[0];
		$time = $dt[1];
		if($i%2 == 0){
		$content = $content .'<div><span class="medium-font  iblock">' . $i . '.</span><span id="name" class="medium-font  iblock"> ' . ucfirst($row["username"]) . '</span><span class="medium-font  iblock">' . $row["rank"] . '</span><span></span><span id="college" class="medium-font  iblock">' . $row["college"]. '</span>'.$date.' at '.$time.'</div>';
		} else{
			$content = $content .'<div class="bg-gray"><span class="medium-font  iblock">' . $i . '.</span><span id="name" class="medium-font  iblock"> ' . ucfirst($row["username"]) . '</span><span class="medium-font  iblock">' . $row["rank"] . '</span><span></span><span id="college" class="medium-font  iblock">' . $row["college"]. '</span>'.$date.' at '.$time.'</div>';
		}
		$i++;
		
	}
	$content = $content . "<span>*Read Rules for ranking procedure.</span></div>";
	$title = "Leaderboard";
	return $content;
}
function email_exists($email){

	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'" ) or die(mysql_error());
	
	return (mysql_result($query, 0) == 1) ? true : false;

}
function register_user($register_data){
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	$feilds = '`'.implode('`, `', array_keys($register_data)).'`';
	$data= '\''.implode('\', \'',$register_data).'\'';
	
	mysql_query("INSERT INTO `users` ($feilds) VALUES ($data)");
	//email($register_data['email'], 'Activate Your account at rhythem.co.cc', "Hello ".$register_user['first_name'].",You need to activate your account.\n\nUse this link to activate your account:\n\n http://rhythem.co.cc/activate.php?email=".$register_data['email']."&email_code=" . $register_data['email_code'] ."\nNote: If the link does not works try copying and pasting in your url bar.\n\n-Rhythem");
}
function get_level($id){
	$id		= sanitize($id);
	$sql 	= "SELECT `level` FROM `users` where `user_id`='$id'";
	$ref 	= mysql_query($sql);
	$row	= mysql_fetch_row($ref);
	return $row[0];
}



function get_rank($id){
	$id		= sanitize($id);
	$sql 	= "SELECT `rank` FROM `users` where `user_id`='$id'";
	$ref 	= mysql_query($sql);
	$row	= mysql_fetch_row($ref);
	return $row[0];
}
function get_question($id,$choice){
	$level 	= get_level($id);
	$rank	= get_rank($id);
	$choice	= get_choice($id);

	if($level >= 28 and $choice=='0'){
		$level = $rank;
		
	}
	$sql 	= "SELECT `file` FROM `users`,`questions` WHERE `users`.`user_id` = $id AND `questions`.`qno`='$rank' and `difficulty`='$choice'";
	$ref	= mysql_query($sql);
	$row	= mysql_fetch_row($ref);
	return $row[0];
}
function check_answer($answer,$id,$level){
	$answer	= sanitize($answer);
	$id		= sanitize($id);
	$level	= sanitize($level);
	$rank	= get_rank($id);
	$choice	= get_choice($id);
	
	$sql	= "SELECT `answer` FROM `questions`,`users` WHERE `users`.`user_id` = $id AND `questions`.`qno`='$rank' && `questions`.`difficulty`=$choice && `answer`='$answer'";
	$ref	= mysql_query($sql);
	$row	= mysql_fetch_row($ref);
	return (empty($row)===true)? false:true;
}


function output_error($error){
	$error 	= '<div class="error small-font"><strong>'.implode('<div></div>',$error).'</strong></div>';
	echo $error;
}
function correct_answer_normal_procedure($id){
	$id		= sanitize($id);
	$level	= get_level($id);
	$choice	= get_choice($id);
	$rank	= get_rank($id);
	$level++;
	if($choice == '0' || $choice == '2'){
		$rank++;
	}else if($choice == '1'){
		$rank+=2;
	}
	$sql	= "UPDATE `users` SET `rank` = '$rank',`level` = '$level' WHERE `users`.`user_id` = $id";
	$ref	= mysql_query($sql);
	if((($level >= '28')&&($choice == '1'))||(($level>= '31')&&($choice=='2'))){
		$sql2	= "UPDATE `users` SET `choice` = '0' WHERE `users`.`user_id` = $id";
		$ref2	= mysql_query($sql2) or die(mysql_error($ref2));
	}
}
function set_choice($choice,$id){
	$choice	= sanitize($choice);
	$id		= sanitize($id);
	if($choice == 'hard'){
		$choice=1;
	} else if($choice =='easy'){
		$choice=2;
	}
	$sql 	= "UPDATE `users` SET `choice` = '$choice' WHERE `user_id` = $id";
	$ref	= mysql_query($sql);
	header('Location: index.php');
	exit(0);
}
function get_choice($id){
	$id		= sanitize($id);
	$sql	= "SELECT `choice` FROM `users` WHERE `user_id` = $id";
	$ref	= mysql_query($sql);
	$row	= mysql_fetch_row($ref);
	return $row[0];
}
function check_choice_status($id){
	$id		= sanitize($id);
	$choice	= get_choice($id);
	if($choice=='0'){
		return true;
	}else{
		return false;
	}
}
function logged_in_redirect(){
	if(logged_in() === true){
		header('Location: index.php');
		exit();
	}

}
function user_exists($username){

	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'" ) or die(mysql_error());
	return (mysql_result($query, 0) == 1) ? true : false;

}
function login($username, $password){
	$user_id = user_id_from_username($username);
	$username = sanitize($username);
	$password = md5($password);
	
	return (mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE username = '$username' and password = '$password'"),0) == 1) ? $user_id : false;
}
function user_id_from_username($username){
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT user_id FROM users WHERE username = '$username'"),0,'user_id');
}
function first_name_from_user_id($user_id){
	$user_id = sanitize($user_id);
	return mysql_result(mysql_query("SELECT `first_name` FROM users WHERE user_id = '$user_id'"),0,'first_name');
}
function last_name_from_user_id($user_id){
	$user_id = sanitize($user_id);
	return mysql_result(mysql_query("SELECT `last_name` FROM users WHERE user_id = '$user_id'"),0,'last_name');
}
function logged_in(){
	return(isset($_SESSION['user_id'])) ? true : false;
 
}

?>