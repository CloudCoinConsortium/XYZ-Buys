<?php 
//include config file
include('../config.php');
//get values of Post
	$af= $_POST['af'];
	$Pid= $_POST['packageSelect'];
	$Ones = $_POST["DDLOnes"];
	$Fives = $_POST["DDLFives"];
	$TwentyFives = $_POST["DDLTwentyFives"];
	$Hundreds = $_POST["DDLHundreds"];
	$TwoHundredFifties = $_POST["DDLTwoHundredFifties"];
//check coins against bank

		$str = file_get_contents("https://$server/service/showcoinsforsale.php$configPK");
		
		
		$json = json_decode($str, true); // decode the JSON into an associative array
		
		$Price= 0.03;
				
		$numberOfOnes= $json[ones];
		$numberOfFives= $json[fives];
		$numberOfTwentyFives= $json[twentyfives];
		$numberOfOneHundreds= $json[hundreds];
		$numberOfTwoHundredFifties= $json[twohundredfifties];
		
		if ($TwoHundredFifties>$numberOfTwoHundredFifties*250){
			$TwoHundredFifties=$numberOfTwoHundredFifties*250;
		}
		if ($Hundreds>$numberOfOneHundreds*100){
			$Hundreds=$numberOfOneHundreds*100;
		}
		if ($TwentyFives>$numberOfTwentyFives*25){
			$TwentyFives=$numberOfTwentyFives*25;
		}
		if ($Fives>$numberOfFives*5){
			$Fives=$numberOfFives*5;
		}
		if ($Ones>$numberOfOnes){
			$Ones=$numberOfOnes;
		}
		



// create display values
	$displayFives = $Fives/5;
	$displayTwentyFives = $TwentyFives/25;
	$displayHundreds = $Hundreds/100;
	$displayTwoHundredFifties = $TwoHundredFifties/250;
	//get totals
	
	$total= $Ones + $Fives + $TwentyFives + $Hundreds + $TwoHundredFifties;

	
	//check to make sure that the purchase does have some information
	if($Pid == null && $total == 0 && errorcode == null){header("location: https://$server/index2.php?error=1");}
	
	
	//check to make sure price matches with the package
		if ($Pid !== null){
			if ($Ones !== null || $Fives !== null || $TwentyFives !== null or $Hundreds !== null){
				header("location: https://$server/exchange/orderfail.php?errorcode=5");
			}
		
				switch($Pid){
				case 0:
					header("location: https://$server/index.php?error=1");
				
				break;
				case 1:
				
				$orderTotal = $basic * $basicAmount*250;
				$displayTwoHundredFifties = $basicAmount;
				$TwoHundredFifties = 250*$basicAmount;
				$selected=" 
								 <div class='art'><i class='fas fa-chess-pawn'></i>
								<h6>BASIC</h6>
								</div>
								<h3>$".$orderTotal."</h3>
								<p>".$basicAmount*250 ." Cloud Coins</p>
						 ";
				break;
				
				case 2:
								
				$orderTotal = $silverAmount * $silver*250;
				$displayTwoHundredFifties = $silverAmount;
				$TwoHundredFifties = 250*$silverAmount;
				$selected=" 
								 <div class='art'><i class='fas fa-chess-knight'></i>
								<h6>SILVER</h6>
								</div>
								<h3>$".$silver*$silverAmount*250 ."</h3>
								<p>".$silverAmount*250 ." Cloud Coins</p>
						 ";
				
				
				break;
				
				case 3:
								
				$orderTotal = $goldAmount * $gold*250;
				$displayTwoHundredFifties = $goldAmount;
				$TwoHundredFifties = 250*$goldAmount;
				$selected=" 
								 <div class='art'><i class='fas fa-chess-bishop'></i>
								<h6>GOLD</h6>
								</div>
								<h3>$".$gold*$goldAmount*250 ."</h3>
								<p>".$goldAmount*250 ." Cloud Coins</p>
						 ";
				
				break;
				
				case 4:
								
				$orderTotal = $platinumAmount * $platinum*250;
				$displayTwoHundredFifties = $platinumAmount;
				$TwoHundredFifties = 250*$platinumAmount;
				$selected=" 
								 <div class='art'><i class='fas fa-chess-rook'></i>
								<h6>PLATINUM</h6>
								</div>
								<h3>$".$platinum*$platinumAmount*250 ."</h3>
								<p>".$platinumAmount*250 ." Cloud Coins</p>
						 ";
				
				break;
				
				case 5:
								
				$orderTotal = $titaniumAmount * $titanium*250;
				$displayTwoHundredFifties = $titaniumAmount;
				$TwoHundredFifties = 250*$titaniumAmount;
				$selected=" 
								 <div class='art'><i class='fas fa-chess-queen'></i>
								<h6>TITANIUM</h6>
								</div>
								<h3>$".$titanium*$titaniumAmount*250 ."</h3>
								<p>".$titaniumAmount*250 ." Cloud Coins</p>
						 ";
				
				break;
				
				case 6:
								
				$orderTotal = $titaniumPlusAmount * $titaniumPlus*250;
				$displayTwoHundredFifties = $titaniumPlusAmount;
				$TwoHundredFifties = 250*$titaniumPlusAmount;
				$selected=" 
								 <div class='art'><i class='fas fa-chess-king'></i>
								<h6>TITANIUM+</h6>
								</div>
								<h3>$".$titaniumPlus*$titaniumPlusAmount*250 ."</h3>
								<p>".$titaniumPlusAmount*250 ." Cloud Coins</p>
						 ";
				
				break;
				default:
					$selected=" 
								 <div class='art'><i class='fas fa-chess-pawn'></i>
								<h6>BASIC</h6>
								</div>
								<h3>$".$basic*$basicAmount*250 ."</h3>
								<p>".$basicAmount*250 ." Cloud Coins</p>
						 ";
					
				break;
			}
		
		}else{
			
			
			$orderTotal = $total*$price;
		}
	

	$total= $Ones + $Fives + $TwentyFives + $Hundreds + $TwoHundredFifties;


?>
<!DOCTYPE html>
<head>
<title>Check Out</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://codepen.io/overdrivemachines/pen/megaYG.css">
<link rel="stylesheet" href="https://codepen.io/overdrivemachines/pen/JBrdrq.css">
</head>
<body>
<header>
  <div class="header-container">
    <div class="left"><a href="https://cloudcoins.com/">CLOUDCOIN</a></div>
    <div class="right">
      <div id="header-user-info">
        MENU <i class="fa fa-bars"></i>
      </div>
    </div>
  </div>
</header>
<section id="section-main">
  <div class="w800">
    <div class="steps">
      <h5>STEP 1 PACKAGE | STEP 2 - BILLING | STEP 3 - DOWNLOAD</h5>
    </div>
    <hr>
    <div class="vspace"></div>
    <h5>Package Selected</h5>
	
	<?php
 echo "<ul class='plc'>
			<li class='pc is-selected'>
				 $selected
			 </li>
		</ul>";
						  ?>
	
    <div class="vspace"></div>
    <form action="createcheck.php" METHOD='POST'>
      <h5>Billing Address</h5>
      <div class="field">
        <label for="name">Full Name</label>
        <input type="text" name="cardname" id="cname" placeholder="Enter your Full Name" required="">
      </div>
      <div class="field">
        <label for="address1">Address 1</label>
        <input type="text" name="address" id="adr" placeholder="Enter your Street Address Line 1" required="">
      </div>
      <div class="field">
        <label for="address2">Address 2</label>
        <input type="text" name="address2" id="address2" placeholder="Enter your Street Address Line 2 (Optional)">
      </div>
      <div class="field split">
        <div>
          <label for="city">City</label>
          <input type="text" name="city" id="city" placeholder="Enter your City" required="">
        </div>
        <div>
          <label for="state">State</label>
          <input type="text" name="state" id="state" placeholder="Enter your State" required="">
        </div>
        <div>
          <label for="zip">Zip</label>
          <input type="text" name="zip" id="zip" placeholder="Enter your Zip" required="">
        </div>
      </div>
      <div class="field split">
        <div class="tooltip">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="example@protonmail.com" required="">
        </div>
        <div>
          <label for="Phone">Phone Number</label>
          <input type="text" name="Phone" id="phone" placeholder="5555555555" required="">
        </div>
      </div>
      <div class="vspace"></div>
      <h5>Bank Information</h5>

      <div class="field">
        <label for="bank_name">Bank Name</label>
        <input type="text" name="bankName" id="bankName" placeholder="Enter your Bank Name" required="">
      </div>
      <div class="field split">
        <div>
<label for="account_number">Account Number</label>
<input type="text" name="accountNumber" id="accountNumber" placeholder="Enter your Account Number" required="">
</div>
<div>
<label for="routing_number">Routing Number</label>
<input type="text" name="routingNumber" id="routingNumber" placeholder="Enter your Routing Number" required="">
</div>
<div>
<label for="check_number">Check Number</label>
<input type="text" name="checkNumber" id="checkNumber" placeholder="Enter your Check Number" required="">
</div>
      </div>
      
	  <input name="DDLOnes" type="hidden" id="DDLOnes" value="<?php echo $Ones?>">
		<input name="DDLFives" type="hidden" id="DDLFives" value="<?php echo $Fives?>">
		<input name="DDLTwentyFives" type="hidden" id="DDLTwentyFives" value="<?php echo $TwentyFives?>">
		<input name="DDLHundreds" type="hidden" id="DDLHundreds" value="<?php echo $Hundreds?>">
		<input name="DDLTwoHundredFifties" type="hidden" id="DDLTwoHundredFifties" value="<?php echo $TwoHundredFifties?>">
		<input name="passTotal" type="hidden" id="Total" value="<?php echo $orderTotal?>">
		<input name="totalcoin" type="hidden" id="totalcoin" value="<?php echo $total?>">
		<input name="Pselect" type="hidden" id="Pselect" value="<?PHP echo $Pid?>">
		<input name="af" type="hidden" id="af" value="<?PHP echo $af?>">
	  


      <div class="actions">
        <div><a class="btn btn-blue" href="https://cloudcoins.com/"><i class="fa fa-angle-left fa left"></i> Back</a></div>
        <div>
          <button type="submit" class="btn-blue spacer-v">Pay<i class="fa fa-angle-right fa right"></i></button>
        </div>
      </div>
    </form>

  </div>
</section>
<footer>
  <div class="footer-inner">
    <div class="footer-item"><a href="#">About</a></div>
    <div class="footer-item"><a href="#">Privacy Policy</a></div>
    <div class="footer-item"><a href="#">Terms and Conditions</a></div>
  </div>
</footer>
</body>