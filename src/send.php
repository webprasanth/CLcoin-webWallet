<?php
	require_once("../CLcoin-PHP/CLcoin.php"); // The library to ask CLcoin nodes (cf http://github.com/darosior/CLcoin-PHP)
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//For clarity and for the eyes
		$address = $_SESSION["address"];
		$key = $_SESSION["key"];
		//The form values
		$amount = $_POST["amount"];
		$receiver = $_POST["receiver"];
		//Checking address pattern validity (basically)
		$regex = '/^B[a-zA-Z0-9]{25,36}$/';
		if(preg_match($regex, $address) == 0){
			if(!$_SESSION["client"]->sendfrom($address, $receiver, $amount)){
				//If there was a problem, we stock the error and redir
				$_SESSION["error"] =  $_SESSION["client"]->error;
				header('Location: http://localhost/index.php?error=1');
			}
			else{
				$_SESSION["txSuccess"] = True;
			}
		}
		else{
			//Same here, there was a problem
			$_SESSION["error"] = "Veuillez vérifier l'adresse (qui doit etre de la forme B[...])";
			header('Location: http://localhost/index.php?error=1');
		}
	}
	else{
		header('Location: http://localhost/index.php');
	}
?>
