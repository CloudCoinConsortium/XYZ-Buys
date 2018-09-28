<?php
//uncomment lines below for error checking
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


//included and required files

require_once 'green.php';
	use Green\CheckGateway as Gateway;
	include('../config.php');
	
	
		//convert phone number to more useable format
	$Phone = $_POST['Phone'];
	$firstChar=mb_substr($Phone, 0, 1, 'utf-8');
	$Phone = str_replace("-","",$Phone);
	$Phone = str_replace("(","",$Phone);
	$Phone = str_replace(")","",$Phone);
	$Phone = str_replace("+","",$Phone);
	
	if ($firstChar==1)
	echo $Phone;
	echo "<BR>";
	echo $PhoneLngth=strlen($Phone);
	echo "<BR>";
	if ($PhoneLngth>10){
		$remove= $PhoneLngth-10;
	$Phone=substr($Phone, $remove);
	}
	echo "<BR>";
	echo $Phone;
	}
	
	$str = file_get_contents("http://$bankserver/service/showcoinsforsale.php$configPK");
	$greenId = $id;
	$greenPass = $pass;
	$accountID=$configAccount;
	$T=date('Y-m-d');
	
	//get server
//	$server = $_SERVER['SERVER_NAME'];
	
	//set timezone
	$tz = 'zulu';
	$timestamp = time();
	$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
	$dt->setTimestamp($timestamp); //adjust the object to correct timestamp


	//current version
	$version = "2.0";
	
	
//get number of coins available for sale
		$json = json_decode($str, true);

		$amountDue=$_POST['passTotal'];
		
		
		//get the number of coins for orders
		$DDLone=$_POST['DDLOnes'];
		
		$DDLfive=$_POST['DDLFives'];
		
		$DDLtwentyfive=$_POST['DDLTwentyFives'];
		
		$DDLhundred=$_POST['DDLHundreds'];
		
		$DDLtwohundredfifty=$_POST['DDLTwoHundredFifties'];		


		$Package=$_POST['Pselect'];

		
		
		//get number of coins available for sale
		
		$numberOfOnes= $json['ones'];
		$numberOfFives= $json['fives'];
		$numberOfTwentyFives= $json['twentyfives'];
		$numberOfOneHundreds= $json['hundreds'];
		$numberOfTwoHundredFifties= $json['twohundredfifties'];
		$totals = $numberOfOnes+$numberOfFives+$numberOfTwentyFives+$numberOfOneHundreds+$numberOfTwoHundredFifties;
		$validOrder=0;
		$totalpurchaseprice=$amountDue + $transactionFee;
		
//confirm validity of cart
//make sure that there is atleast $5 of cloudcoin
if ($amountDue <= 4.99)
{
	//redirect to failure not enough coins in cart
	
	header("location: https://$server/exchange/orderfail.php?errorcode=4");
	
	
}else{
	
	//make sure there are enough coins in bank
	if ($DDLtwohundredfifty/250 > $numberOfTwoHundredFifties or $DDLhundred/100 > $numberOfOneHundreds or $DDLtwentyfive/25 > $numberOfTwentyFives  or $numberOfFives/5 > $numberOfFives or $DDLone > $numberOfOnes )
	{
		//show number of coins vs how many in bank
		echo "Not enough coins to fulfill purchase<br><br>";
		echo "250 ".($DDLtwohundredfifty/250)." > ".$numberOfTwoHundredFifties."<br>";
		echo "100 ".($DDLhundred/100)." > ".$numberOfOneHundreds."<br>";
		echo "25 ".($DDLtwentyfive/25)." > ".$numberOfTwentyFives."<br>";
		echo "5 ".($DDLfive/5)." > ".$numberOfFives."<br>";
		echo "1 ".($DDLone)." > ".$numberOfOnes."<br><br>";
		echo "redirect to failed Order";
		
		
		//send to order failure with error code for not enough coins in bank
		
		header("location: https://$server/exchange/orderfail.php?errorcode=2");
		
	}else{	
			//checks to make sure cart is not empty
			if($DDLtwohundredfifty == 0 && $DDLhundred == 0 && $DDLtwentyfive == 0 && $DDLfive == 0 && $DDLone == 0)
			{
			
			echo "Order Invalid: Cart Empty<br>";
			echo "redirect to failed order";
		
			//send to order failure with error code for empty cart
			header("location: https://$server/exchange/orderfail.php?errorcode=1");
	
		}
		else
		{ 	
			//confirm price if the purchase was a package
			if($Package != Null){
				switch ($Package){
								case 1:
								if ($DDLtwohundredfifty/250 != $basicAmount or  $amountDue != $basic*$basicAmount*250){
									echo "testing";
									
									//send to failure page with code for invalid cart
										header("location: https://$server/exchange/orderfail.php?errorcode=5");
								}else{$validOrder=1;}
							break;
							case 2:
								if
								($DDLtwohundredfifty/250 != $silverAmount or  $amountDue != $silver*$silverAmount*250){
									//send to failure page with code for invalid cart
										header("location: https://$server/exchange/orderfail.php?errorcode=5");
									
								}else{$validOrder=1;}
							break;
							case 3:
								if ($DDLtwohundredfifty/250 != $goldAmount or  $amountDue != $gold*$goldAmount*250){
									//send to failure page with code for invalid cart
										header("location: https://$server/exchange/orderfail.php?errorcode=5");
									
								}else{$validOrder=1;}
							break;
							case 4:
								if ($DDLtwohundredfifty/250 != $platinumAmount or  $amountDue != $platinum*$platinumAmount*250){
									//send to failure page with code for invalid cart
									header("location: https://$server/exchange/orderfail.php?errorcode=5");
									
								}else{$validOrder=1;}
							break;
							case 5:
								if ($DDLtwohundredfifty/250 != $titaniumAmount or  $amountDue != $titanium*$titaniumAmount*250){
									//send to failure page with code for invalid cart
									header("location: https://$server/exchange/orderfail.php?errorcode=5");
								}else{$validOrder=1;}
							break;
							case 6:
								if ($DDLtwohundredfifty/250 != $titaniumPlusAmount or  $amountDue != $titaniumPlus*$titaniumPlusAmount*250){
									//send to failure page with code for invalid cart
									header("location: https://$server/exchange/orderfail.php?errorcode=5");
								}else{$validOrder=1;}
							break;
							
						};
			
			
				}else{
			
		//		$validOrder=1;
			
				}
			//confirms order is valid
		
		
		
		}
	

	}


}
	// if order is valid, attempt to process check
	if ($validOrder==1)
	{
		//begin check processing
		

		$ClientID = $greenId;
		$ApiPassword = $greenPass;

		$gateway = new Gateway($ClientID, $ApiPassword);
		//uncomment line below to enter test mode
		//$gateway->testMode();

		



		//Create a single check and get results back after verification in array format

	
		$name = $_POST['cardname'];//name of purchaser
		$email = $_POST['email'];//email of user
		$phone = $Phone;// phone number associated with account
		$phone_ext = '';
		$address1 = $_POST['address'];//address on check
		$address2 = '';
		$city = $_POST['city'];//city on check
		$state = $_POST['state'];//state on check
		$zip = $_POST['zip'];//zip number on check
		$country = 'US';//only allow for us purchases
		$routing = $_POST['routingNumber'];//routing number on check
		$account = $_POST['accountNumber'];//account number on check
		$bank_name = $_POST['bankName'];//bank of the check
		$memo = "$ememo $T";//memo 
		$amount = $amountDue+$transactionFee;//the amount that the account will be charged
		$date = date("m/d/Y");

		$result = $gateway->singleCheck($name, $email, $phone, $phone_ext, $address1, $address2, $city, $state, $zip, $country, $routing, $account, $bank_name, $memo, $amount, $date);
		
		//uncomment line #143 of Green.php for a more detailed report of the check
		if($result) {
			  //The call succeeded
				  if($result['Result'] == '0'){
					//0 means success
					echo "Check created with ID: " . $result['Check_ID'] . "<br/>";
			  } else {
				  
					//other than 0 specifies some kind of error.

					echo "Check not created.<br/>Error Code: {$result['Result']}<br/>Error: {$result['ResultDescription']}<br/>";
					
				}

			  echo "Full Return Details<br/><pre>".print_r($result, TRUE)."</pre>";
				

			  } else {
			  //The call failed!
		  echo "GATEWAY ERROR: " . $gateway->getLastError();

		}
	//finish creating cheque

		
		
		
		
		//verify check before final submission
			
		if ($result['Result'] == '0'){
			
			//verify results one more time
			$check_number = $result['Check_ID'];
			$delim = FALSE;
			$delim_char = ',';
			$result = $gateway->verificationResult($check_number,$delim,$delim_char);
		
				
			if($result) {
				
				//The call succeeded, let's parse it out
				if($result['Result'] == '0'){
					//A "Result" of 0 typically means success
					echo "Check created with ID: " . $result['Check_ID'] . "<br/>";
				  } else {
					//Anything other than 0 specifies some kind of error.
					echo "Check not created.<br/>Error Code: {$result['Result']}<br/>Error: {$result['ResultDescription']}<br/>";
					
					
					
					
			
				  }
						//if the first and second verification are successful then create check and send email.
				if ($result['VerifyResult'] == '0' ){
						//get all the variables needed to write the check
						$pk = urlencode($privateKey);
						$account=urlencode($configAccount);
						$totalOrder=$_POST['totalcoin'];
						$payto= urlencode($name);
						$emailto = urlencode($email);

							//write the check
						$check = file_get_contents("https://$bankserver/service/write_check.aspx?pk=$pk&account=$accountID&action=url&signby=cloudcoin&emailto=$emailto&payto=$payto&amount=$totalOrder");
						
						
						
						
						//read the check for the id
						$jsoncheck = json_decode($check, true);
						
						//echo for testing reasons
						//echo print_r($jsoncheck, TRUE);
							
						
							$download= $jsoncheck['message'];
							
							echo $idposition = strpos($download,'id');
							echo "<br>";
							
							$download = substr($download, $idposition);
							
							
							
									//set ready to start the email
							$ready=1;
							
					}else{
						header("location: https://$server/exchange/orderfail.php?errorcode=0&pass=2");
						}//end result check
								
							
								
							if($ready==1){
								//write json file
									$response->exchange_server = $server;
									$response->account = $configAccount;
									$response->status = "success";
									$response->message = "Green Payment Accepted. Check URL to collect your CloudCoins";
									$response->green_pay_status_url = "https://$bankserver/service/cash_checks.aspx?id=$download&account=$accountID";
									$response->time = $dt->format('d-m-Y:H:i:s.u');
									$response->version= $version;
									$responseWrite = json_encode($response);
									
									//redirect to the email page
								header("location: createemail.php?email=$emailto&name=$payto&amount=$totalOrder&$download&account=$accountID&amountDue=$amountDue");

									
							}else{								
								header("location: https://$server/exchange/orderfail.php?errorcode=0&pass=3");
								//send to page order failure
							}	
					
				
			}else{
				header("location: https://$server/exchange/orderfail.php?errorcode=0&pass=4");
				}	
		}else{header("location: https://$server/exchange/orderfail.php?errorcode=0&pass=5");}	
		//end verification check
		
	}//end valid order
		?>