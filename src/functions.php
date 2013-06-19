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
	
	function GetThreads($board, $page) {
		$StartRange = ($page * 10) - 10
		$EndRange = $page * 10
		
		$STH = $DBH->query('SELECT * FROM threads'); //the "threads" table will change to the name of the board
	}

?>