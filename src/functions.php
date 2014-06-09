<?php

	include('../config.php');
	
	function DatabaseConnect() {
		global $DatabaseHost, $DatabaseName, $DatabaseUsername, $DatabasePassword;
		try {
			$DBH = new PDO("mysql:host=$DatabaseHost;dbname=$DatabaseName", $DatabaseUsername, $DatabasePassword); //DBH is a Database Handle
			$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$GLOBALS['DBH'] = $DBH;
		}
		catch(PDOException $exception) {
			file_put_contents('errorlog.txt', $exception->getMessage(), FILE_APPEND);
		}
	}
	
	function GetThreads($Board, $Page) {
		global $DBH;
		$StartRange = ($Page * 10) - 10;
		$EndRange = $Page * 10;
		
		$Board = Sanatize($Board);
		$STH = $DBH->prepare("SELECT * FROM $Board WHERE parent='0' LIMIT $StartRange,$EndRange"); //parent being the parent thread to a reply, 0 meaning its a thread
		$STH->execute();
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
	
	function GetParent($Board, $Thread) {
		global $DBH;
		$Board = Sanatize($Board);
		
		$STH = $DBH->prepare("SELECT * FROM $Board WHERE id=?");
		$STH->execute(array($Thread));
		$Rows = $STH->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($Rows as $Row) {
			print('
				<div class="thread" id="'.$Row["id"].'">
					<span class="post-info">'.$Row["date"].' @ '.$Row["time"].' <a href="#'.$Row["id"].'">#'.$Row["id"].'</a> <span class="more">[<a href="index.php">back</a>]</span></span>
					<hr class="post">
					'.$Row["content"].'
				</div>
			');	//change second $Row["id"] to javascript to insert quote into postbox for that id
		}
	}
	
	function GetPosts($Board, $Thread) {
		global $DBH;
		$Board = Sanatize($Board);
	
		$STH = $DBH->prepare("SELECT * FROM $Board WHERE parent=?");
		$STH->execute(array($Thread));
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
	
	function PostThread($Board, $Content) {
		
	}
	
	function PostReply($Board, $Parent, $Content) {
		
	}
	
	function Sanatize($Data) {
		return mysql_real_escape_string($Data);
	}

?>