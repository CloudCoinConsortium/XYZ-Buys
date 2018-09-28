<!DOCTYPE html>
<html class="no-js fa-events-icons-ready" lang="en" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="x-ua-compatible" content="ie=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Buy Cloud Currencies Educational Package</title>

<link rel="apple-touch-icon" sizes="180x180" href="https://cloudcoinconsortium.com/apple-touch-icon.png">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="https://cloudcoinconsortium.com/manifest.json">
<link rel="mask-icon" href="https://cloudcoinconsortium.com/safari-pinned-tab.svg" color="#5bbad5">
<link rel="stylesheet" href="css/exchangeindex.css">
</head>

	


		<?php
	include('../config.php');
		

		$str = file_get_contents("https://$server/service/showcoinsforsale.php$configPK");
		
		
		$json = json_decode($str, true); // decode the JSON into an associative array
		
		$Price= 0.03;
				
		$numberOfOnes= $json[ones];
		$numberOfFives= $json[fives];
		$numberOfTwentyFives= $json[twentyfives];
		$numberOfOneHundreds= $json[hundreds];
		$numberOfTwoHundredFifties= $json[twohundredfifties];
		$totals = $numberOfOnes+$numberOfFives+$numberOfTwentyFives+$numberOfOneHundreds+$numberOfTwoHundredFifties;
	
		?>

<header>
  <div>Cloud Coin</div>
</header>
<main>
  <section class="main purchase">
    <h1>Buy CloudCoin</h1>
    <div class="steps">
      <b>Step 1 - Amount</b> | Step 2 - Billing | Step 3 - Download
    </div>
	<br>
	 Exchange Rate: 1 Cloudcoin = $0.03 (USD)<br>
    <?PHP if($_GET['error'] == 2 ){
	echo '<div id="alert" class="alert" style="display: default;"> Your cart did not contain enough coins. the minimum is 250 coins.</div>'; }?>
	
     
 
    <div class="form-container">
      <form action="blueform.php" method="POST">
        <div class="form-inner">
          <div class="field">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" placeholder="Enter the amount of Cloud Coins you want to buy" onchange="">
			<br><span id="testing"></span>
          </div>
          <div class="field">
            <input type="submit" name="commit" value="Next" data-disable-with="Review" onclick="totals()">
          </div>

        </div>
      <input type="hidden" name="DDLTwoHundredFifties" id="DDLTwoHundredFifties" value="">
      <input type="hidden" name="DDLHundreds" id="DDLHundreds" value="">
      <input type="hidden" name="DDLTwentyFives" id="DDLTwentyFives" value="">
      <input type="hidden" name="DDLFives" id="DDLFives" value="">
      <input type="hidden" name="DDLOnes" id="DDLOnes" value="">

	  
	  
	  
	  </form>
    </div>
  </section>
</main>
<footer>

</footer>
	
	
	




	
	

<!-- JS for the form-->
<script type="text/javascript">
        function totals() {
         var userinput = document.getElementById("amount").value;
		var ddltwohundredfifties = 0;
		ddltwohundredfifties = Math.trunc(userinput/250);  
		var ddlhundreds  = Math.trunc((userinput-ddltwohundredfifties*250)/100);
		var ddltwentyfives =  Math.trunc(((userinput)-(ddltwohundredfifties*250)-(ddlhundreds*100))/25);
		var ddlfives = Math.trunc( ((userinput) - (ddltwohundredfifties*250) - (ddlhundreds*100) - (ddltwentyfives*25)) /5 );
		var ddlOnes = Math.trunc( ((userinput) - (ddltwohundredfifties*250) - (ddlhundreds*100) - (ddltwentyfives*25) - (ddlfives*5)));
		var ppc = <?PHP echo $price?>;
		document.getElementById("testing").innerText = (ddltwohundredfifties*250 + ddlhundreds*100 + ddltwentyfives*25  + ddlfives*5 + ddlOnes)*ppc;
		document.getElementById("DDLTwoHundredFifties").value = ddltwohundredfifties*250;
		document.getElementById("DDLHundreds").value = ddlhundreds*100;
		document.getElementById("DDLTwentyFives").value = ddltwentyfives*25;
		document.getElementById("DDLFives").value = ddlfives*5;
		document.getElementById("DDLOnes").value = ddlOnes;
		
		
		}
			
    </script>

</html>