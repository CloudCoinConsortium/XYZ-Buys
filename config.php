<?php 
//sending email 
$emailserver="protonmail.com";
$receiptemail="Receipt@page.com";
$emailSend = "cloudcoinbanker@protonmail.com"; //email of sender
$emailPath="C:/Users/(name)/Documents/PHPEMAIL";//folder that contains automatic email sender
$Esubject="CloudCoin Purchase!";//subject for emails to be sent
$epass = "bmVGcTJxX1NRWHVlREk3NEd5RW9KQQ==";//password to smtp in base64
$ememo = "CC";

//
$bankserver="bank_server";
$server = $_SERVER['SERVER_NAME'];
$pfile = "GA093D45FA3430E9762E59EA7913BA3P";	//folder that contains passwords
$configAccount = "account";	// account Id Primary of seller
$privateKey = "00000000000000000000000000000000";	//Primary seller bank Private Key
$configPK = "?pk=00000000000000000000000000000000&account=".$configAccount; //seller bank url extension

//default greenpay information
$id=000000;		//greenpay id
$pass=00000000; // password for greenpay
//remaining greenpay information


	//purchasing information
	$price=0.10;//default price

	
	
	
	//number of coins in each package
	$basicAmount = 10;
	$basicAmount = 10;
	$silverAmount = 10;
	$goldAmount = 10;
	$platinumAmount = 10;
	$titaniumAmount = 10;
	$titaniumPlusAmount = 10;

	//price of coins in each package
	$basic=0.10;
	$silver=0.10;
	$gold=0.10;
	$platinum=0.10;
	$titanium=0.10;
	$titaniumPlus=0.10;
	
	$basicDisplay='$0.10';
	$silverDisplay='$0.10';
	$goldDisplay='$0.10';
	$platinumDisplay='$0.10';
	$titaniumDisplay='$0.10';
	$titaniumPlusDisplay='$0.10';
?>