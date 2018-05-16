<?php
	require_once("../CLcoin-PHP/CLcoin.php"); // The library to ask CLcoin nodes (cf http://github.com/darosior/CLcoin-PHP)
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		$_SESSION["address"] = $_SESSION["client"]->getnewaddress();
		$_SESSION["key"] = $_SESSION["client"]->dumpprivkey($_SESSION["address"]);
	}
	header('Location: http://localhost/index.php');
?>
