<?php
	$errorcode = 0;
	$errorcode=$_GET['errorcode'];
	switch($errorcode){
		case 0://check not accepted
		$errormessage = "Your Check wasn't accepted! please contact your seller for help or try again.";
	break;
		case 1://empty cart
		$errormessage = "Your Cart Was empty please try again.";
	break;
		case 2://not enough coins in bank
		$errormessage = "Not enough coins to fulfill order, please contact your seller or try again later";
	break;
		case 3://unknown error
		$errormessage = "unknown error, please contact your seller or try again.";
	break;
	
		case 4://cart has less than 5 dollars of coins	
		$errormessage = "Not enough Coins in cart";
	
	break;
		// cart has incorrect data
		case 5:
		$errormessage = "Invalid Cart, contact seller or try again.";
		break;
		
	default;
		$errormessage="Contact your seller for help";
		
	break;
	
	}


?>
<HTML>




	<head>

	<title> Failed Order </title>

		<link rel="apple-touch-icon" sizes="180x180" href="https://cloudcoinconsortium.com/apple-touch-icon.png">
		<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="https://cloudcoinconsortium.com/manifest.json">
		<link rel="mask-icon" href="https://cloudcoinconsortium.com/safari-pinned-tab.svg" color="#5bbad5">	
	
	
		<meta name="theme-color" content="#ffffff">

		<link rel="stylesheet" href="css/foundation.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/pay.css">
		<link href="css/css" rel="stylesheet" type="text/css">
	
	
	
	
	</head>
	
		<body style="background-color: #fafafa">
		
		<center>
		<div class="row" >
			<div class="col-75">
				<div class="container" style="background-color: #ffffff">
				<BR><BR><BR>
				<form action="" method="GET">
					<H1>Order Failed</H1>
					<h3>Your Purchase could not be made.</h3>
					<h3><?PHP echo $errormessage ;?></h3>
				
				</form>
				</div>
			</div>
		</div>
	</center>
		</body>



</HTML>
