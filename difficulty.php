<?php
include 'core/init.php';
include 'includes/overall/header.php';
if(logged_in()===true){
global 		$session_user_id;
$id		=	$session_user_id;
if(check_choice_status($id)===true){
		if(isset($_GET['choice'])===false){
?>
		<div id="difficulty_container" class="cpos">
			<div class="clearfix cpos">
				<div class="lfloat wborder easy">
					Would you go the easy way?
					<span>You will be gven 6 more easy question<br/>Each correct answer gets you <strong>one</strong> step closer to the top<br/><a href="difficulty.php?choice=easy">Click to go the easy way.</a></span>
				</div>
				<div class="lfloat wborder diff">
					Or do you have the guts to face the real deal?
					<span>You will be given 3 more difficult question<br/>Each correct answer gets you <strong>two</strong> step closer to the top<br/><a href="difficulty.php?choice=hard">Click to go the hard way.</a></span>
				</div>
			</div>
			<span class="medium-font">Click to know more</span>
		</div>
		<?php
		}else{
			set_choice($_GET['choice'],$id);
			header('Location index.php');
		}
	}else{
?>
	<h1>You are smart that you know how stuff works.. But you aint smarter than us.<br />Please Go back home.</h1>
<?php
}
}
else{
	header('Location: index.php');
}
include 'includes/overall/footer.php';
?>