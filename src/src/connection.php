<?php
	require_once '../src/AltcoinsECDSA.php'; // The library to gen keys fo CLcoin
	use AltcoinsECDSA\AltcoinsECDSA as CLcoin;

	require_once("../CLcoin-PHP/CLcoin.php"); // The library to ask CLcoin nodes (cf https://github.com/darosior/CLcoin-PHP)
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$key = $_GET["key"];
		//Basic verif, needs regex
		$clcoin = new CLcoin();
		$hexKey = CLcoin::dec2hex($key);
		echo "hex  " . $hexKey . PHP_EOL;
		$clcoin->setPrivateKey($hexKey);
		$address = $clcoin->getAddress();
		echo "address  " . $address . PHP_EOL;
		if($clcoin->validateAddress(address)){
			$_SESSION["address"] = $address;
			$_SESSION["key"] = $clcoin->getPrivateKey();
			header('Location: https://dentoz.fr/webwallet/index.php');
		}
		else{
			echo "FALSE" . $address . PHP_EOL;
		}
	}
	else{
		echo "GET";
	}
?>
