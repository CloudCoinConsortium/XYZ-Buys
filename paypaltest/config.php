<?php 
//sending email 
$emailserver="protonmail.com";
$receiptemail="cloudcoin@protonmail.com";
$emailSend = "cloudcoinbanker@protonmail.com"; //email of sender
$emailPath="C:/Users/Dale/Documents/PHPEMAIL";//folder that contains automatic email sender
$Esubject="CloudCoin Purchase!";//subject for emails to be sent
$epass = "bmVGcTJxX1NRWHVlREk3NEd5RW9KQQ==";//password to smtp in base64
$ememo = "testing";

//
$bankserver="bank.cloudcoin.global";
$server = $_SERVER['SERVER_NAME'];
$pfile = "A071AA88FA3430E9762E59EA7913BA3P";	//folder that contains passwords
$configAccount = "cloudcoin@protonmail.com";	// account Id Primary of seller
$privateKey = "00000000000000000000000000000000";	//Primary seller bank Private Key
$configPK = "?pk=00000000000000000000000000000000&account=".$configAccount; //seller bank url extension

//default greenpay information
$id="107877";		//greenpay id
$pass="fz5cz7ex6j"; // password for greenpay
//remaining greenpay information
$stripeID="pk_test_6pRNASCoBOKtIshFeQd4XMUh";
$stripeSID="sk_test_ccYuNA0tFRmVOENec7JvzTci";


	//purchasing information
	$price=0.03;//default price
?>