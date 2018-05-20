<?php
	require_once("../CLcoin-PHP/CLcoin.php"); // The library to ask CLcoin nodes (cf https://github.com/darosior/CLcoin-PHP)
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		$_SESSION["address"] = $_SESSION["client"]->getnewaddress();
		$_SESSION["key"] = $_SESSION["client"]->dumpprivkey($_SESSION["address"]);
	}
	header('Location: https://dentoz.fr/webwallet/index.php');
?>
