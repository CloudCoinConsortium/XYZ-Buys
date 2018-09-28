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
	$change=0;
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
			$change=1;
			$TwoHundredFifties=$numberOfTwoHundredFifties*250;
		}
		if ($Hundreds>$numberOfOneHundreds*100){
			$change=1;
			$Hundreds=$numberOfOneHundreds*100;
		}
		if ($TwentyFives>$numberOfTwentyFives*25){
			$change=1;
			$TwentyFives=$numberOfTwentyFives*25;
		}
		if ($Fives>$numberOfFives*5){
			$change=1;
			$Fives=$numberOfFives*5;
		}
		if ($Ones>$numberOfOnes){
			$change=1;
			$Ones=$numberOfOnes;
		}
		



// create display values
	$displayFives = $Fives/5;
	$displayTwentyFives = $TwentyFives/25;
	$displayHundreds = $Hundreds/100;
	$displayTwoHundredFifties = $TwoHundredFifties/250;
	//get totals
	
	$total= $Ones + $Fives + $TwentyFives + $Hundreds + $TwoHundredFifties;
	
	$orderTotal = $total*$price;
	//check to make sure price matches with the package
	if($orderTotal <= 5 && $_GET['errorcode']== null){header("location: https://$server/exchange/index.php?error=2");}
	

			
			
	
	
	

	


?>


<HTML>
<header>

<title>Buy Cloud Currencies Educational Package</title>

<link rel="apple-touch-icon" sizes="180x180" href="https://cloudcoinconsortium.com/apple-touch-icon.png">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="https://cloudcoinconsortium.com/manifest.json">
<link rel="mask-icon" href="https://cloudcoinconsortium.com/safari-pinned-tab.svg" color="#5bbad5">
<link rel="stylesheet" href="css/exchangeindex.css">
<link rel="stylesheet" href="css/exchangeindex.css">
  <div>Cloud Coin</div>
</header>
<main>
  <section class="main purchase">
    <h1>Buy Cloudcoin</h1>
    <div class="steps">
      Step 1 - Amount | <b>Step 2 - Billing</b> | Step 3 - Download
    </div>
    <?php if($_GET['errorcode'] == null){
		
		
		echo " <div id='notice' class='notice' style='display:none;'>";
		if($change==1){echo "Your cart had to be adjusted";}
		echo " You will be paying $$orderTotal for buying $total Cloudcoins. <a href='https://$server/exchange/index.php'>Change</a> ";
		
	}else{
		echo " <div id='notice' class='alert' style='display:none;'> This account has been verified two many times in 24 hours, please wait 24 hours before trying again later.";
		
	}
	
	
	
	?>
     
    </div>
    <div class="form-container">
		<form action="https://<?php echo $server?>/exchange/createcheck.php" method = "POST"> 
        <div class="form-inner">
          <div class="field">
            <label for="name">Full Name</label>
            <input type="text" name="cardname" id="cname" placeholder="Enter your Full Name" required>
          </div><div class="field">
            <label for="Phone">Phone Number</label>
            <input type="text" name="Phone" id="phone"
			placeholder="2225554444"
			maxlength="10"
			required
			/>
          </div>
           <div class="field">
            <label for="address1">Address 1</label>
            <input type="text" name="address" id="adr" placeholder="Enter your Street Address Line 1" required>
          </div>
          <div class="field">
            <label for="address2">Address 2</label>
            <input type="text" name="address2" id="address2" placeholder="Enter your Street Address Line 2 (Optional)">
          </div>
          <div class="field">
            <label for="city">City</label>
            <input type="text" name="city" id="city" placeholder="Enter your City" required>
          </div>
          <div class="field">
            <label for="state">State</label>
            <input type="text" name="state" id="state" placeholder="Enter your State" required>
          </div>
          <div class="field">
            <label for="zip">Zip</label> 
            <input type="text" name="zip" id="zip" placeholder="Enter your Five Digit ZipCode" 
			pattern="(\d{5}([\-]\d{4})?)"
			required
			/>
          </div>
          <div class="field">
            <label for="email">Email</label>
            <input type="email"name="email" id="email" placeholder="User@domain.com" 
			pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]"
			required />
          </div>
          
          <div class="field">
            <label for="bank_name">Bank Name</label>
            <input type="text" name="bankName" id="bankName" placeholder="Enter your Bank Name" required>
          </div>
          <div class="field">
            <label for="account_number">Account Number</label>
            <input type="text" name="accountNumber" id="accountNumber" placeholder="Enter your Account Number" required>
          </div>
          <div class="field">
            <label for="routing_number">Routing Number</label>
            <input type="text" name="routingNumber" id="routingNumber" placeholder="Enter your Routing Number" required>
          </div>
          <div class="field">
            <label for="check_number">Check Number</label>
            <input type="text" name="checkNumber" id="checkNumber" placeholder="Enter your Check Number" required>
          </div>
          
          <div class="field">
		  
		  
		  <div class="container" style="background-color: rgba(255,0,0,0);border-color: rgba(0,0,0,0)"><!-- hidden values to pass through-->
		<input name="DDLOnes" type="hidden" id="DDLOnes" value="<?php echo $Ones?>">
		<input name="DDLFives" type="hidden" id="DDLFives" value="<?php echo $Fives?>">
		<input name="DDLTwentyFives" type="hidden" id="DDLTwentyFives" value="<?php echo $TwentyFives?>">
		<input name="DDLHundreds" type="hidden" id="DDLHundreds" value="<?php echo $Hundreds?>">
		<input name="DDLTwoHundredFifties" type="hidden" id="DDLTwoHundredFifties" value="<?php echo $TwoHundredFifties?>">
		<input name="passTotal" type="hidden" id="Total" value="<?php echo $orderTotal?>">
		<input name="totalcoin" type="hidden" id="totalcoin" value="<?php echo $total?>">
		<input name="Pselect" type="hidden" id="Pselect" value="<?PHP echo $Pid?>">
		<input name="af" type="hidden" id="af" value="<?PHP echo $af?>">
		  
		  
		  
		  
		  
            <input type="submit" name="commit" value="PAY" data-disable-with="Review">
            
          </div>
        </div>
      </form>
    </div>
  </section>
</main>
<footer>

</footer>
 
  <div class= "col-75">
	
		
		

	<div >
   </div>
  </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$( document ).ready(function() {
    console.log( "ready!" );
	  //fade in errors
   $("#notice").fadeIn('slow');
});
</script>

</body>
</HTML>	
	