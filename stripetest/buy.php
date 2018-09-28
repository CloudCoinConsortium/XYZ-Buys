<?php 
require_once('stripe-php-6.15.0/init.php');
require_once('config.php');
 

?>

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
<link rel="stylesheet" href="../exchange/css/exchangeindex.css">
</head>

	


		<?php
//use the showcoinsforsale to get coins that are in the bankserver/service/showcoinsforsale

		$str = file_get_contents("https://$bankserver/service/showcoinsforsale.php$configPK");
		
		$json = json_decode($str, true); // decode the JSON into an associative array
		
		$Price= $price;
				
//read the json file to get the number of coins in bank in  each denomination
		$numberOfOnes= $json[ones];
		$numberOfFives= $json[fives];
		$numberOfTwentyFives= $json[twentyfives];
		$numberOfOneHundreds= $json[hundreds];
		$numberOfTwoHundredFifties= $json[twohundredfifties];
		$totals = $numberOfOnes+$numberOfFives*5+$numberOfTwentyFives*25+$numberOfOneHundreds*100+$numberOfTwoHundredFifties*250;
		echo file_get_contents("https://$server/html/edupage.html");
		$numberOfTwoHundredFifties=5;
		$numberOfTwentyFives=5;
		$numberOfFives=5;
		
		?>

<header>
  <div>Cloud Coin</div>
</header>
<main>
<link rel="stylesheet" href="../exchange/css/foundation.css">
	<link rel="stylesheet" href="../exchange/css/app.css">
	<link href="css/css" rel="stylesheet" type="text/css">
	
	
	<div class="inner">
	<div class="row center" style="max-width:2000px;  background-color:white">
		<!-- //column1 -->
		<div class="large-4 columns" style="padding:40px">
			<h3>eBook: </h3>
			<b>Beyond Bitcoin - The Future of Digital Currency</b>
			<img src="../css/beyond_bitcoin.jpg" alt="Beyond Bitcoin BOOK">
			<br>
			<br>
			You will receive a link to the digital version of <i>Beyond Bitcoin: The Future of Digital Currency</i>. This eBook describes what money is, why digital money will dominate the future, the perfect money possible and, the utopian and dystopian potential of digital currencies, how money got started, and how we can protect our right to use money.
		</div>
		<!-- //column2 -->
		<div class="large-4 columns" style="padding:40px">
			<h3>Software: </h3>
			
			<b>CloudCoin Consumer Edition</b><br><br>
			<img src="../css/consumeredition.jpg" alt="Consumer Edition">
			<br>
			<br>
			<br><br><br>
			You will receive Consumers Edition Desktop software for Windows. (There are other programs for Mac, Android and Linux). Consumer's Edition
			manages your CloudCoins like a cash register. It Powns (password owns) your new CloudCoin 200 times faster than other software. It stores them safely in your bank folder until you exports them as jpeg files or text files.
		</div>
		<!-- //column3 -->
		<div class="large-4 columns" style="padding:40px">
			<h3>Videos:</h3>
			<b>CloudCoin University</b>
			<img src="../css/ccu.webp">
			<br>
			<br>
			Includes links to private videos that can only be seen by link holder.
			Videos include:
		<div>
			<div>
				<ul>
				<li>CloudCoin file formats</li>
				<li>Storing CloudCoins</li>
				<li>Transfering CloudCoins</li>
				
				<li>Exchanging CloudCoins</li>
				<li>Accepting CloudCoins as Payment</li>
				<li>Using CloudCoins as Payment</li>
				</ul>
			</div>
		</div>
	</div>
	</div>
	</div>
	
	
	
	

  <section class="main purchase">
    <h1>Buy CloudCoin</h1>
    <div class="steps">
      <b>Step 1 - Amount</b> | Step 2 - Billing | Step 3 - Download
    </div>
	<br>
	<div>Currently there are: <?php echo number_format($totals);?> CloudCoins for sale</div><br>
	
	 Exchange Rate: 1 Cloudcoin = $<?php echo $Price;?> (USD)<br>
	 
    <?PHP 
	
	//checks if a error is found and create an alert with the details.
	
	
	if($_POST['error'] != null ){
	$errorMessage=urldecode($_POST['error']);
	
	echo '<div id="alert" class="alert" style="display: default;">'.$errorMessage.' Please Try Again</div>'; }
	
	
	
	?>
	
     
 
    <div class="form-container">
      <form id="myForm" action="charge.php" method="POST">
        <div class="form-inner">
          <div class="field">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" placeholder="Enter the amount of Cloud Coins you want to buy" onchange="totals()">
			
          </div>
          <div class="field">
			
			<script src="https://checkout.stripe.com/checkout.js"></script>

			<input type="submit" id="customButton" value="purchase"></input>

			<script>
			/*create the Stripe Checkout and get the user information*/
			var handler = StripeCheckout.configure({
				
			  key: 'pk_test_qlSeB9kuktizck3yL9sD7YRH',
			  image: 'https://cloudcoinconsortium.com/apple-touch-icon.png',
			  locale: 'auto',
			  zipCode: true,
			  token: function(token) {
					  // Use the token to create the charge with a server-side script.
					  $("#stripeToken").val(token.id);
					  $("#stripeEmail").val(token.email);
					  $("#myForm").submit();
					  
			  }
			});

			document.getElementById('customButton').addEventListener('click', function(e) {
			  // Open Checkout with further options:
			  handler.open({
				name: 'CloudCoins',
				description:  document.getElementById('testing').innerText + ' CloudCoins ',
				amount: document.getElementById('DDLTwoHundredFifties').value*<?php echo $price*100?>,
			  });
			  e.preventDefault();
			});

			// Close Checkout on page navigation:
			window.addEventListener('popstate', function() {
				
			  handler.close();
			});
			
			
			</script>
			
			
			
			<!--paypal test button-->
					
					<script src="https://www.paypalobjects.com/api/checkout.js"></script>
					<div id="paypal-button-container"></div>
					<script>

							// Render the PayPal button

							paypal.Button.render({
								// Set your environment
								env: 'sandbox', // sandbox | production

								// Specify the style of the button
								style: {
									label: 'paypal',
									size:  'medium',    // small | medium | large | responsive
									shape: 'rect',     // pill | rect
									color: 'blue',     // gold | blue | silver | black
									tagline: false    
								},

								client: {
									sandbox:    '<?php echo $PayPalSandBoxID;?>',
									production: '<?php echo $PayPalID;?>'
								},
								payment: function(data, actions) {
									return actions.payment.create({
										payment: {
											transactions: [
												{
													amount: { total: '0.01', currency: 'USD' }
												}
											]
										}
									});
								},

								onAuthorize: function(data, actions) {
									return actions.payment.execute().then(function() {
										window.alert('Payment Complete!');
									});
								}

							}, '#paypal-button-container');
					</script>

					
          </div>

        </div>
      <input type="hidden" name="DDLTwoHundredFifties" id="DDLTwoHundredFifties" value="">
      <input type="hidden" name="DDLHundreds" id="DDLHundreds" value="">
      <input type="hidden" name="DDLTwentyFives" id="DDLTwentyFives" value="">
      <input type="hidden" name="DDLFives" id="DDLFives" value="">
      <input type="hidden" name="DDLOnes" id="DDLOnes" value="">
	  <input type="hidden" name="testing" id="testing" value="">
      <input type="hidden" name="stripeToken" id="stripeToken" value="">
      <input type="hidden" name="stripeEmail" id="stripeEmail" value="">
	
	  
	  

		  
	
	  </form>
    </div>
  </section>
</main>
<footer >
	<div class="inner">
		<div class="content">	
			<section>
				<h4  style="color:black;">Contact Us</h4 >
				<ul class="alt" >
					<a href="mailto:CloudCoin.HelpDesk@protonmail.com" style="color:blue;font-size:18px;"><u><span class="__cf_email__" style="">CloudCoin.HelpDesk@protonmail.com</span></a><br>
					<a style="font-size:18px;color:blue;" href="tel:1-530-500-2646"><u>1-530-500-2646</u></a></li>
				</ul>
			</section>
		</div>
		
		<div class="copyright" style="color:black;"><a href="http://cloudcoin.global/"style="color:black;">CloudCoin.global</a> © 2018</div>
</div>

	</footer>
	
	




	
	

<!-- JS for the form-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
        //get the user input
		
		function totals() {
         var userinput = document.getElementById("amount").value;
		var ddltwohundredfifties = 0;
		ddltwohundredfifties = Math.trunc(userinput/250);  
		var ddlhundreds  = Math.trunc((userinput-ddltwohundredfifties*250)/100);
		var ddltwentyfives =  Math.trunc(((userinput)-(ddltwohundredfifties*250)-(ddlhundreds*100))/25);
		var ddlfives = Math.trunc( ((userinput) - (ddltwohundredfifties*250) - (ddlhundreds*100) - (ddltwentyfives*25)) /5 );
		var ddlOnes = Math.trunc( ((userinput) - (ddltwohundredfifties*250) - (ddlhundreds*100) - (ddltwentyfives*25) - (ddlfives*5)));
		var ppc = <?PHP echo $price?>;
		document.getElementById("testing").innerText = (ddltwohundredfifties*250 + ddlhundreds*100 + ddltwentyfives*25  + ddlfives*5 + ddlOnes);
		document.getElementById("DDLTwoHundredFifties").value = ddltwohundredfifties*250;
		document.getElementById("DDLHundreds").value = ddlhundreds*100;
		document.getElementById("DDLTwentyFives").value = ddltwentyfives*25;
		document.getElementById("DDLFives").value = ddlfives*5;
		document.getElementById("DDLOnes").value = ddlOnes;
		
		
		}
			
    </script>
			<script type="text/javascript" language="javascript">

			function ClearForm(){
				document.MyForm.reset();
			}
			</script>
</html>