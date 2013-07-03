<?php

	include('../config.php');
	
	function DatabaseConnect() {
		try {
			$DBH = new PDO("mysql:host=$DatabaseHost;dbname=$DatabaseName", $DatabaseUsername, $DatabasePassword); //DBH is a Database Handle
			$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)
		}
		catch(PDOException $exception) {
			file_put_contents('errorlog.txt', $exception->getMessage(), FILE_APPEND);
		}
	}
	
	function GetThreads($Board, $Page) {
		$StartRange = ($Page * 10) - 10;
		$EndRange = $Page * 10;
		
		$STH = $DBH->prepare('SELECT * FROM ? WHERE parent="0" LIMIT ?, ?'); //parent being the parent thread to a reply, 0 meaning its a thread
		$STH->execute(array($Board, $StartRange, $EndRange));
		$Rows = $STH->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($Rows as $Row) {
			print('
					<div class="thread" id="'.$Row["id"].'">
						<span class="post-info"> '.$Row["date"].' @ '.$Row["time"].' <a href="#'.$Row["id"].'">#'.$Row["id"].'</a> <span class="more">[<a href="thread.php?id='.$Row["id"].'">more</a>]</span></span>
						<hr class="post">
						'.$Row["content"].'
					</div>
			');	//change second $Row["id"] to javascript to insert quote into postbox for that id
		}
	}
	
	function GetPosts($Board, $Thread) {
		$STH = $DBH->prepare('SELECT * FROM ? WHERE parent="?"');
		$STH->execute(array($Board, $Thread));
		$Rows = $STH->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($Rows as $Row) {
			print('
				<div class="post" id="'.$Row["id"].'">
					<span class="post-info"> '.$Row["date"].' @ '.$Row["time"].' <a href="#'.$Row["id"].'">#'.$Row["id"].'</a></span>
					<hr class="post">
					'.$Row["content"].'
				</div>
			');
		}
	}

?>