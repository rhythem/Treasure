<!doctype>
<html>
<head>
<title>
<?php
	if(logged_in() === false){
		echo "Level 9000";
	} else if(isset($_GET['leaderboard'])===true){
		echo "Leaderboard";
	} else if(isset($_GET['rules'])===true){
		echo "Rules";
	} else {
		echo first_name_from_user_id($_SESSION['user_id'])." ".last_name_from_user_id($_SESSION['user_id']);
	}
?>
</title>
<link href="css/style.css" rel="stylesheet" />
<script type="text/javascript" src="script/jquery.js"></script>
<script type="text/javascript" src="script/script.js"></script>
</head>
<body>
	<div id="bg">
	<img src="photo/resources/background.jpg" alt="Welcome To Level 9000">
	</div>
	<div id="page-wrap" class="cpos">
	<div id="Container">
		<div id="InnerWrap" class="clearfix">
			<div id="HeadContainer" class="clearfix">
			<div id="logo">
				<img src="photo/resources/logo.jpg"></img>
			</div>

				<nav class="top-nav-bar">
					<ul class="medium-font">
						<li class="home"><a class="white<?php if(empty($_GET)===true){echo ' selected';}?>" href="index.php">Home</a></li>
						<li class="leader"><a class="white<?php if(isset($_GET['leaderboard'])===true){echo ' selected';}?>" href="index.php?leaderboard">Leaderboard</a></li>
						<li class="rules"><a class="white<?php if(isset($_GET['rules'])===true){echo ' selected';}?>" target="_blank" href="rules.txt">Rules</a></li>
						<li><a class="white" target="_blank" href="https://www.facebook.com/Level9000TheOnlineTreasureHunt/app_202980683107053">Forum</a></li>
						<?php if(logged_in()===true){?><li><a class="white" href="logout.php">Logout</a></li><?php } ?>
					</ul>
				</nav>
			</div>
			<div id="MainContainer">
				<?php
				if(isset($_GET['leaderboard'])){
					include 'includes/leaderboard.php';
				}
				?>