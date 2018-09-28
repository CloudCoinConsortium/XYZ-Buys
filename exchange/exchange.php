<!DOCTYPE html>
<html class="no-js fa-events-icons-ready" lang="en" dir="ltr"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="x-ua-compatible" content="ie=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Buy Cloud Currencies Educational Package</title>

<link rel="apple-touch-icon" sizes="180x180" href="https://cloudcoinconsortium.com/apple-touch-icon.png">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="https://cloudcoinconsortium.com/manifest.json">
<link rel="mask-icon" href="https://cloudcoinconsortium.com/safari-pinned-tab.svg" color="#5bbad5">

<meta name="theme-color" content="#ffffff">

<link rel="stylesheet" href="css/foundation.css">
<link rel="stylesheet" href="css/app.css">
<link href="css/css" rel="stylesheet" type="text/css">

<style type="text/css">
		select{
			background-color:white;
			
		}
        .grandTotal {
	        text-align: center;
	        horizontal-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
	        background-color: aliceblue;
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {background-color:#8e8e8e;}

        #cta select option {
            color: black;
            background-color: blue;
			border-color: blue;
        }
		select focus{
			border-color: dodgerblue;
			
		}
        select option {
            color: white;
            background-color: #000;
			border-color: blue;
        }
	</style>
		<link href="css/main.css" rel="stylesheet">
		<link rel="stylesheet" href="css/pay.css">
		<link href="css/b7a745f5ac.css" media="all" rel="stylesheet"></head>
	<body style="background-color: White">
	
	<?php
	include('../config.php');
		
		if ($_GET['af'] == null){
		$str = file_get_contents("https://$server/service/showcoinsforsale.php$configPK");
		}else{
		$account = $_GET['af'];
		$pk = file_get_contents("https://$server/accounts/$pfile/$account.txt");
		$str = file_get_contents("https://$server/service/showcoinsforsale.php?account=$account&pk=$pk");
		}
		
		$json = json_decode($str, true); // decode the JSON into an associative array
		
		$Price= 0.03;
				
		$numberOfOnes= $json[ones];
		$numberOfFives= $json[fives];
		$numberOfTwentyFives= $json[twentyfives];
		$numberOfOneHundreds= $json[hundreds];
		$numberOfTwoHundredFifties= $json[twohundredfifties];
		$totals = $numberOfOnes+$numberOfFives+$numberOfTwentyFives+$numberOfOneHundreds+$numberOfTwoHundredFifties;

		
		



		?>
	
	
<form method="post" action="https://<?php echo $_SERVER['SERVER_NAME']?>/exchange/greenform.php" id="form1">
<?php echo file_get_contents('edupage.html');?>
<!-- above line contains the html for the Educational page -->


	
	<div class="inner" style="background-color:aliceBlue;  border: 1px solid lightgrey;
  border-radius: 3px;">
	<center><span id="LBLCurrentPrice" style="font-size:39px;">Current Price Per Coin: <?php echo $Price;?> </span></center>
	<table>

		
		
		
		<tr style="padding: 10px 10px 10px 10px;"><!--Begin Headers-->
			<th>CloudCoin</th>
			<th>Denomination</th>
			<th>Amount</th>
			<th>Stock Available</th>
		</tr><!-- end headers -->
		
		
		<!-- Populate drop down menus with the number of coins in bank -->
		<tr>
			<td><img alt="1 CloudCoin" src="css/cc-1.jpg" width="200"></td>
			<th>1s</th>
			<td>
				<select name="DDLOnes" id="DDLOnes" onchange="totals()">
				<option value="0">0 | 0.00</option>
				<?php
					for ($i=1;$i<=$numberOfOnes;$i++){
						$total= $i * $Price;
						echo "<option value='$i'>$i | $total </option>";					
					}
				?>
				</select>
			</td>
			<th><span id="LBLOnesAvailable"><?php echo $numberOfOnes ?> in stock</span></th>
		</tr>
		
		
		<tr>
			<td><img alt="5 CloudCoin" src="css/cc-5.png" width="200"></td>
			<th>5s</th>
			<td>
				<select name="DDLFives" id="DDLFives" onchange="totals()">
				<option value="0">0 | 0.00</option>
				<?php
					for ($i=1;$i<=$numberOfFives;$i++){
						$total= $i * 5 * $Price;
						$value= $i * 5;
						echo "<option value='$value'>$i | $total </option>";					
					}
				?>
				</select>
			</td>
			<th><span id="LBLFivesAvailable"><?php echo $numberOfFives?> in stock</span></th>
		</tr>
		
		
		<tr>
			<td><img alt="25 CloudCoin" src="css/cc-25.png" width="200"></td>
			<th>25s</th>
			<td>
				<select name="DDLTwentyFives" id="DDLTwentyFives" onchange="totals()" >
				<option value="0">0 | 0.00</option>
				<?php
					for ($i=1;$i<=$numberOfTwentyFives;$i++){
						$total= $i * 25 *$Price;
						$value= $i * 25;
						echo "<option value='$value'>$i | $total </option>";					
					}
				?>
				</select>
			</td>
			<th><span id="LBLTwentyFivesAvailable"><?php echo $numberOfTwentyFives?> in stock</span></th>
		</tr>
		
	
		<tr>
			<td><img alt="100 CloudCoin" src="css/cc-100.png" width="200"></td>
			<th>100s</th>
			<td>
				<select name="DDLHundreds" id="DDLHundreds" onchange="totals()">
				<option value="0">0 | 0.00</option>
				<?php
					for ($i=1;$i<=$numberOfOneHundreds;$i++){
						$total= $i * 100 *$Price;
						$value= $i * 100;
						echo "<option value='$value'>$i | $total </option>";					
					}
				?>
				</select>
			</td>
			<th><span id="LBLHundredsAvailable"><?php echo $numberOfOneHundreds?> in stock</span></th>
		</tr>
		
		
		<tr>
			<td><img alt="250 CloudCoin" src="css/cc-250.png" width="200"></td>
			<th>250s</th>
			<td>
				<select name="DDLTwoHundredFifties" id="DDLTwoHundredFifties" onchange="totals()">
				<option value="0">0 | 0.00</option>
				<?php
					for ($i=1;$i<=$numberOfTwoHundredFifties;$i++){
						$total= $i * 250 * $Price;
						$value= $i * 250;
						echo "<option value='$value'>$i | $total </option>";					
					}
				?>
				</select>
			</td>
			<th><span id="LBLTwoHundredFiftiesAvailable"><?php echo $numberOfTwoHundredFifties?> in stock</span></th>
		</tr>
		
		<!-- populate the totals -->
		<tr>
		<td></td>
			<th colspan="4" style="text-align:center"><b colspan="4">Grand Total: <span id="grandtotal"></span></b>
			<span id="LBLWarning">Order must be at least $5.00 to process!</span>
			</th>
			

		</tr>
	<tr>
		<td><input type="hidden" name="" value="" id="BTNSubmitGreenPay" type='image' src='https://greenbyphone.com/eCheck/images/PayNowButton.png' border='0' />
		</td>
		<th><input type="hidden" name="" value="" id="BTNSubmitGreenPay" type='image' src='https://greenbyphone.com/eCheck/images/PayNowButton.png' border='0' />
		</th>
		<td>
		<input  name="BTNSubmitGreenPay" value="" id="BTNSubmitGreenPay" type='image' src='https://greenbyphone.com/eCheck/images/PayNowButton.png' border='0' name='submit' alt='' value="Place Order"/>
		</td>
		
		<td><input type="hidden" name="" value="" id="BTNSubmitGreenPay" type='image' src='https://greenbyphone.com/eCheck/images/PayNowButton.png' border='0' />
		</td>

		</tr>
	</table

	</div>

	</section>

<?php echo file_get_contents('edupagefooter.html');?>
<!-- Above line contains the code for the footer -->
	<input name="pricepercoin" type="hidden" id="pricepercoin" value="<?php echo $Price?>">
	<input name="af" type="hidden" id="af" value="<?PHP echo $_GET['af']?>">
</form>

<!-- JS for the form-->
<script type="text/javascript">
        function totals() {
            var totalCoins = 0;
            var totalPrice = 0;
            var pricePerCoin = parseFloat(pricepercoin.value);

            var ones = parseInt(DDLOnes.value);
            var fives = parseInt(DDLFives.value);
            var twentyfives = parseInt(DDLTwentyFives.value);
            var hundreds = parseInt(DDLHundreds.value);
            var twohundredfifties = parseInt(DDLTwoHundredFifties.value);

            totalCoins = ones + fives + twentyfives + hundreds + twohundredfifties;
            totalPrice = totalCoins * pricePerCoin;
            grandtotal.value = totalPrice;
            grandtotal.innerText = "$" + totalPrice.toFixed(2);
            if (totalPrice > 4.99) {
                LBLWarning.innerText = "";
            }
            else
            {
                LBLWarning.innerText = "Order must be at least $5.00 to process!";
            }
        }



				//<![CDATA[
			var theForm = document.forms['form1'];
				if (!theForm)
					{
					theForm = document.form1;
					}
			function __doPostBack(eventTarget, eventArgument)
				{
					if (!theForm.onsubmit || (theForm.onsubmit() != false)) 
					{
					theForm.__EVENTTARGET.value = eventTarget;
					theForm.__EVENTARGUMENT.value = eventArgument;
					theForm.submit();
					}
				}
		//]]>
			
    </script>

</body></html>