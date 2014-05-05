<?php
	$id	= $_SESSION['user_id'];
	if($id==14) {
		$sql = "SELECT `users`.`username`, `logs`.`level`, `logs`.`answer`,  `logs`.`timestamp` FROM `logs`, `users` WHERE `logs`.`user_id`=`users`.`user_id` ORDER BY  `logs`.`user_id`,  `logs`.`timestamp` asc";
		$ref = mysql_query($sql);	
		
		$content = '<div class="leaderboard-content"><div id="leaderboard-header"><span class="medium-font  iblock">User ID</span><span id="hname" class="medium-font  iblock">Level</span><span id="hcollege" class="medium-font  iblock">Answer</span><span id="hlevel" class="medium-font  iblock">TimeStamp</span></div>';
		$i = 1;
		//$content = $content.'<table>';
		while($row = mysql_fetch_array($ref,MYSQL_ASSOC))
		{
			if($i%2 == 0){
			$content = $content .'<div><span class="medium-font  iblock">' . $row["username"] . '</span><span id="name" class="medium-font  iblock"> ' . $row["level"] . '</span><span></span><span id="college" class="medium-font  iblock">' . $row["answer"]. '</span><span id="level" class="medium-font  iblock">' . $row["timestamp"]. '</span></div>';
			} else{
				$content = $content .'<div class="bg-gray"><span class="medium-font  iblock">' . $row["username"] . '</span><span id="name" class="medium-font  iblock"> ' . $row["level"] . '</span><span></span><span id="college" class="medium-font  iblock">' . $row["answer"]. '</span><span id="level" class="medium-font  iblock">' . $row["timestamp"]. '</span></div>';
			}
			$i++;	
			
			//$content = $content.'<tr><td>'.$row["username"].'</td><td>'.$row["level"].'</td><td>'.$row["answer"].'</td><td>'.$row["timestamp"].'</td></tr>';
		}
		//$content = $content.'</table>';
	echo $content;
	}
?>
