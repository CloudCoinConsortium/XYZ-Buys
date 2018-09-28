<?php

function shutDownFunction() { 
			$error = error_get_last();
			
			// fatal error, E_ERROR === 1
			if ($error['type'] === E_ERROR) { 
				print_r($error);   
			} 
		}
		register_shutdown_function('shutDownFunction');

//turn on error checking
error_reporting(E_ALL);
ini_set('display_errors', 1);

//require any dependencies
require_once('stripe-php-6.15.0/init.php');
require_once('config.php');

//call for stripe api
\Stripe\Stripe::setApiKey($stripeSID);

//set variables for the transaction
		$orderStatus=1;
		$token=$_POST['stripeToken'];
		$Uemail=$_POST['stripeEmail'];
		$OGamount=$_POST['amount'];

		$str = file_get_contents("https://$server/service/showcoinsforsale.php$configPK");
		
		
		$json = json_decode($str, true); // decode the JSON into an associative array
		
		$Price= 0.03;
				
		$Ones = $_POST["DDLOnes"];

		$Fives = $_POST["DDLFives"];

		$TwentyFives = $_POST["DDLTwentyFives"];

		$Hundreds = $_POST["DDLHundreds"];

		$TwoHundredFifties = $_POST["DDLTwoHundredFifties"];

				
		$numberOfOnes= $json['ones'];
		$numberOfFives= $json['fives'];
		$numberOfTwentyFives= $json['twentyfives'];
		$numberOfOneHundreds= $json['hundreds'];
		$numberOfTwoHundredFifties= $json['twohundredfifties'];
		
		
		//confirm the amount of coins requested to the amount of coins in the bank and adjust accordingly
		if ($TwoHundredFifties>$numberOfTwoHundredFifties*250){
			$TwoHundredFifties=$numberOfTwoHundredFifties*250;
			$editedPurchase=1;
		}
		if ($Hundreds>$numberOfOneHundreds*100){
			$Hundreds=$numberOfOneHundreds*100;
			$editedPurchase=1;
		}
		if ($TwentyFives>$numberOfTwentyFives*25){
			$TwentyFives=$numberOfTwentyFives*25;
			$editedPurchase=1;
		}
		if ($Fives>$numberOfFives*5){
			$Fives=$numberOfFives*5;
			$editedPurchase=1;
		}
		if ($Ones>$numberOfOnes){
			$Ones=$numberOfOnes;
			$editedPurchase=1;
		}
		












//get the total amount of coins in the purchase
$coins=$Ones;
$coins += $Fives;
$coins += $TwentyFives;
$coins += $Hundreds;
$coins += $TwoHundredFifties;
	//make sure that the order is more than the minimum
	if($coins<250){$orderStatus=0;}
	
//get the amount of to charge the buyer
$amountCharged=$coins;
$amountCharged=$amountCharged*$price*100;



//make sure that the order status is successful and that the purchase hasn't been edited
If($orderStatus==1 && $editedPurchase == null){

			try {
			$charge = \Stripe\Charge::create([
					'amount' => $amountCharged,
					'currency' => 'usd',
					'description' => 'Example charge',
					'source' => $token,//$token,
					'receipt_email'=> $Uemail,
					'statement_descriptor' => "$coins test",
					]);
			} catch(\Stripe\Error\Card $e) {
				
				  // Since it's a decline, \Stripe\Error\Card will be caught
				  $body = $e->getJsonBody();
				  $err  = $body['error'];

				  print('Status is:' . $e->getHttpStatus() . "\n");
				  print('Type is:' . $err['type'] . "\n");
				  print('Code is:' . $err['code'] . "\n");
				  

				  // param is '' in this case
				  print('Param is:' . $err['param'] . "\n");
				  print('Message is:' . $err['message'] . "\n");
				  
				 $message=urlencode($err['message']);
				  echo "<html>
				  <form id='myForm' method='post' action='https://bank.cloudcoin.global/stripetest/buy.php'>
				  <input type='hidden' id='error' name='error' value='".$message."'>
				  </form>
				  </html>
				  <script>
				  document.getElementById('myForm').submit()
				  </script>
				  ";
				} catch (\Stripe\Error\RateLimit $e) {
				  // Too many requests made to the API too quickly
				} catch (\Stripe\Error\InvalidRequest $e) {
				  // Invalid parameters were supplied to Stripe's API
				} catch (\Stripe\Error\Authentication $e) {
				  // Authentication with Stripe's API failed
				  // (maybe you changed API keys recently)
				} catch (\Stripe\Error\ApiConnection $e) {
				  // Network communication with Stripe failed
				} catch (\Stripe\Error\Base $e) {
				  // Display a very generic error to the user, and maybe send
				  // yourself an email
				} catch (Exception $e) {
				  // Something else happened, completely unrelated to Stripe
				}
		
		
		
		
		
		



//get the config information
$pk=$privateKey;
$accountID=$configAccount;

			//create a check with the coins inside it
			$check = file_get_contents("https://$bankserver/service/write_check.aspx?pk=$pk&account=$accountID&action=url&signby=cloudcoin&emailto=$emailto&payto=$payto&amount=$coins");
						
	//			echo $check;				
		
							
			//read the check for the id
			$jsoncheck = json_decode($check, true);
			
			//echo print_r($jsoncheck, TRUE);
				
			
			//get the information needed from the json file created by createcheck
			$download= $jsoncheck['message'];
			
			 $idposition = strpos($download,'id');
			
		$download = substr($download, $idposition);
		
		
		
		
		print_r($charge);
		
		

//create the charge
	
		
		
		//send to email
		header("location: createemail.php?email=$Uemail&name=$Uemail&amount=$totalOrder&$download&account=$accountID&amountDue=$amountCharged");
		
}else{};


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="x-ua-compatible" content="ie=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Buy Cloud Currencies Educational Package</title>

<link rel="apple-touch-icon" sizes="180x180" href="https://cloudcoinconsortium.com/apple-touch-icon.png">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="https://cloudcoinconsortium.com/manifest.json">
<link rel="mask-icon" href="https://cloudcoinconsortium.com/safari-pinned-tab.svg" color="#5bbad5">
<link rel="stylesheet" href="../exchange/css/exchangeindex.css">
</head>
<header>
  <div>Cloud Coin</div>
</header>
<main>
<link rel="stylesheet" href="../exchange/css/foundation.css">
	<link rel="stylesheet" href="../exchange/css/app.css">
	<link href="css/css" rel="stylesheet" type="text/css">
	
	
	<section class="main purchase">
	 <h1>Buy CloudCoin</h1>
	<div class="steps">
      Step 1 - Amount |<b> Step 2 - Confirm</b> | Step 3 - Download
    </div>
<?php

	//confirm if the adjustments to the cart are fine, and if so resubmit the purchase, otherwise send back to order creation page.
	if($editedPurchase != null){echo "
		
		<div id='alert' class='alert'>
		Your cart has been edited to adjust for stock.<br>
		The total in your cart has changed from $OGamount CloudCoins, to $coins CloudCoins
		</div>
		<div class='form-container'>
		<form id='myForm' method='POST' action='https://bank.cloudcoin.global/stripetest/charge.php'>
		<div class='form-inner'>
		<div class='field'>
		<input id='customButton' type='submit' value='Confirm Changes'></input>
		<input id='customButton' type='submit' value='Cancel Purchase' onclick='cancel()'></input>
		<div class='field'>
		<input type='hidden' value='$Ones' name='DDLOnes'/>
		<input type='hidden' value='$Fives' name='DDLFives'/>
		<input type='hidden' value='$TwentyFives' name='DDLTwentyFives'/>
		<input type='hidden' value='$Hundreds' name='DDLHundreds'/>
		<input type='hidden' value='$TwoHundredFifties' name='DDLTwoHundredFifties' />
		<input type='hidden' value='$token'  name='stripeToken' />
		<input type='hidden' value='$Uemail' name='stripeEmail'/>
		
		</div>	
	
		</form>
		
		</div>
	
	
	
	<script>
	function cancel(){
	window.location = 'https://bank.cloudcoin.global/stripetest/buy.php'
	}	
	</script>
";}
?>

</main>
<footer></footer>
</html>