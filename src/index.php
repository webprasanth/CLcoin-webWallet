<!DOCTYPE html>
<?php
	require_once("./CLcoin-PHP/CLcoin.php"); // The library to ask CLcoin nodes (cf https://github.com/darosior/CLcoin-PHP)
	session_start();
	if(isset($_GET["deco"])){ // See the deconnection button
		session_unset();
		header("https://dentoz.fr/webwallet/index.php");
	}
	//For each client we create an instance to connect to the node
	if(!isset($_SESSION["client"]) || $_SESSION["client"] == NULL){
		$_SESSION["client"] = new CLcoin("CLcoinrpc", "Fdwdc8tFoSnf8XNHXqjrTBQ2r4XvgRLYxfK3F4gn8GiU");
	}
?>
<html>
	<head>
		<title>CLcoin wallet</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/index.css">
	</head>
	
	<body>
		<div id="title">
			<h1>CLcoin web wallet</h1>
			<hr>
		</div>
		<?php if(!isset($_SESSION["address"])){//If nobody's connected ?>
			<div id="connection">
				<form method="GET" action="src/connection.php">
					<h3>Connexion</h3>
					<input name="key" type="text" min="64" max="64" placeholder="  Entrez ici votre clef privée"/>
				</form>
			</div>
			
			<div id="createAccount">
				<form method="GET" action="src/generate.php">
					<h3>Création d'un compte</h3>
					<input name ="buttonGen" type="submit" id="genKeys" value="Générer une paire de clefs"/>
				</form>
			</div>
		<?php }else{ //If connected
			$_SESSION["balance"] = $_SESSION["client"]->getbalance($_SESSION["address"]); ?>
			
			<div id="accountInfos">
				Votre addresse : <?php echo $_SESSION["address"]; ?></br>
				Votre clef : <?php echo $_SESSION["key"]; ?></br>
			</div>
			
			<div id="balance">
				Vous avez : <span id="amount"><?php echo $_SESSION["balance"]; ?></span> <span id="coinName">CLC</span>
			</div>
			
			<?php
			//Sending error handling
			if(isset($_GET["error"]) && $_GET["error"] == 1){
				$_GET["error"] = 0;
			?>
				<div id="sendingError">
					<h5>Une erreur s'est produite durant la transaction :</h5>
					<?php 
					echo $_SESSION["error"];
					$_SESSION["error"] = NULL;
					?>
				</div>
			<?php
			}//Error handling end
			//If transaction succeeded
			if(isset($_GET["txSuccess"]) && $_GET["txSuccess"] == True){
			?>
				<div id="sendingSuccess">
					<h5>La transaction a été effectuée avec succès</h5>
				</div>
			<?php
			}
			?>
			
			<div id="send">
				<h3>Envoyer de l'argent</h3>
				<form method="POST" action="src/send.php">
					<div class="formPart">
						Quantité : <input type="number" name="amount" min=0/>
					</div>
					<div class="formPart">
						Destinataire : <input type="text" name="receiver"/>
					</div>
					<input id="submitSend" type="submit" value="Envoyer !"/>
				</form>
			</div>
			
			<div id="deco">
				<form method="GET" action="index.php">
					<input type="submit" name="deco" value="Deconnexion"/>
				</form>
			</div>
		<?php }//If not connected{ [..] } else{ [..] } ends here ?>
	</body>
</html>
