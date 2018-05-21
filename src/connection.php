<?php
	require_once '../AltcoinsECDSA/src/AltcoinsECDSA.php'; // The library to gen keys fo CLcoin
	use AltcoinsECDSA\AltcoinsECDSA as CLcoin;
	
	require_once("../CLcoin-PHP/CLcoin.php"); // The library to ask CLcoin nodes (cf https://github.com/darosior/CLcoin-PHP)
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//Get the key and the instance of the object to manipulate it
		$key = $_POST["key"];
		$clcoin = new CLcoin();
		//If the key is a valid one, we set it and get the address
		if($clcoin->validateWifKey($key)){
			$clcoin->setPrivateKeyWithWif($key);
			$address = $clcoin->getAddress();
			//And then set up the vars with the appropriate values
			if($clcoin->validateAddress($address)){
				$_SESSION["address"] = $address;
				$_SESSION["key"] = $clcoin->getWif();
			}
		}
	}
	//We redirect the user in any case
	header('Location: https://dentoz.fr/webwallet/index.php');
?>
