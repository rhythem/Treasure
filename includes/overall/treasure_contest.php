<?php
$id 		= $_SESSION['user_id'];
$choice		= get_choice($id);
$question 	= get_question($id,$choice);
$level		= get_level($id);
$rank 		= get_rank($id);
if($level<38){
	echo '<h1>Level '.$level.'</h1>';
	if(($choice == '1')&&($level=='25')){
		$alt = "(0,0), (tt0058576)";
	}
	else{
		$alt = $level;	
	}
	echo '<img src="'.$question.'" alt="'.$alt.'" title="Level '.$level.'" width="100%" />';
	?>
	<div class="clearfix">
	<h1>
	Could you guess the answer?
	</h1>
	<form action="" method="post">
		<input type="text" name="answer" class="text-ui lfloat"/>
		<input type="submit" value="submit" class="ui-button lfloat"/>
	</form>
	</div>
	<?php
	if(($rank>24 &&$rank<31) && check_choice_status($id)===true){
		header("Location: difficulty.php");
	}else if(empty($_POST['answer'])===false and isset($_POST['answer'])===true ){
		if(check_answer($_POST['answer'],$id,$level)===false){
			output_error('Sorry wrong answer. Keep trying untill you guess the correct answer.');
		}else {
			
				correct_answer_normal_procedure($id);
				header("Location: index.php");
			
		}
	} else if(empty($_POST['answer'])){
		output_error('You need to enter an answer to proceed to next level.');
	} else if(empty($_POST['answer'])===true and isset($_POST['answer'])===true){
		output_error('We had a technical issue. You are being redirected.');
		
		header('Location: index.php');
		exit(0);
	}
}else if(empty($_GET)){
	echo '<div id="congratulation" class="big-font wborder padding bold">You have completed the quest. Please wait for results.</div>';
}
?>