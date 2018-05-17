<?php
	require_once("../CLcoin-PHP/CLcoin.php"); // The library to ask CLcoin nodes (cf http://github.com/darosior/CLcoin-PHP)
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		$key = $_GET["key"];
		$_SESSION["client"]->
	}
?>
