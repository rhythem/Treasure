<?php
include 'core/init.php';
include 'includes/overall/header.php';
?>
<div id="question-container" class="clearfix">

<?php


if (logged_in()===true){
	if(isset($_GET['addmeen'])) {
		include 'includes/addmeen.php';
	}
	else if(!isset($_GET['leaderboard'])) {
		include 'includes/treasure_contest.php';
	}
}else{
	include 'includes/buttons.php';
}
?>
</div>

<?php

include 'includes/overall/footer.php';
?>
