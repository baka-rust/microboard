<?php

	include('../config.php');
	
	function DatabaseConnect() {
		try {
			$DBH = new PDO("mysql:host=$DatabaseHost;dbname=$DatabaseName", $DatabaseUsername, $DatabasePassword); //DBH is a Database Handle
			$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)
		}
		catch(PDOException $exception) {
			echo $exception->getMessage();
		}
	}
	
	function GetThreads($board, $page) {
		$StartRange = ($page * 10) - 10
		$EndRange = $page * 10
	}

?>