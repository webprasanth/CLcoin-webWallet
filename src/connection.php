<?php
	require_once '../AltcoinsECDSA/src/AltcoinsECDSA.php'; // The library to gen keys fo CLcoin
	use AltcoinsECDSA\AltcoinsECDSA as CLcoin;
	
	require_once("../CLcoin-PHP/CLcoin.php"); // The library to ask CLcoin nodes (cf https://github.com/darosior/CLcoin-PHP)
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$key = $_POST["key"];
		$clcoin = new CLcoin();
		if($clcoin->validateWifKey($key)){
			$clcoin->setPrivateKeyWithWif($key);
		}
		else{
			echo "Wif key not valid";
		}
		echo $clcoin->getPrivateKey()."       ";
		$address = $clcoin->getAddress();
		echo "address  " . $address . "  " .strlen($address). "         ";
		if($clcoin->validateAddress(address)){
			$_SESSION["address"] = $address;
			$_SESSION["key"] = $clcoin->getPrivateKey();
			header('Location: https://dentoz.fr/webwallet/index.php');
		}
		else{
			echo "FALSE  " . $address . PHP_EOL;
		}
	}
	else{
		echo "GET";
	}
?>
