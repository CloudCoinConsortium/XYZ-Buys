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
	
	
	<body>
	
	<?php
	include('../config.php');
		if ($_GET['af'] == null){
		$str = file_get_contents("https://$server/service/showcoinsforsale.php$configPK");
		}else{
		$account = $_GET['af'];
		$pk = file_get_contents("https://$server/accounts/$pfile/$account.txt");
		$str = file_get_contents("https://$server/service/showcoinsforsale.php?account=$account&pk=$pk");
		}
		
		
		
		$str = file_get_contents("http://$server/service/showcoinsforsale.php$configPK");
		
		$json = json_decode($str, true); // decode the JSON into an associative array
		
				
		$numberOfOnes= $json[ones];
		$numberOfFives= $json[fives];
		$numberOfTwentyFives= $json[twentyfives];
		$numberOfOneHundreds= $json[hundreds];
		$numberOfTwoHundredFifties= $json[twohundredfifties];
		$totals = $numberOfOnes+$numberOfFives+$numberOfTwentyFives+$numberOfOneHundreds+$numberOfTwoHundredFifties
		?>
	
	
	
<form method="POST" action="https://<?php echo $_SERVER['SERVER_NAME']?>/exchange/greenform.php" id="form1">
<?php //echo file_get_contents('edupage.html');?>
<!-- above line contains the html for the Educational page -->


	
	<div class="inner" style="background-color:aliceBlue;  border: 1px solid lightgrey;">
	<center><span id="LBLCurrentPrice" style="font-size:39px; text-align:right;">Current Price Per Coin: <span id="displayPrice"> <?php echo $price;?> </span></span></center>
	<table>
	<tr>
	
	</tr>

			<script>
		function Packages()
		{
			var Option = document.getElementById("Pselect").value;
			switch(Option){
			case "1":
			//document.getElementById("demo").innerHTML = "You selected: " + Option;
					document.getElementById("displayPrice").innerHTML = "<?PHP echo $basic?>";
					setOrder("<?php echo $basicAmount;?>");
					totals();
				
			break;
			case "2":
			//document.getElementById("demo").innerHTML = "You selected: " + Option;
					document.getElementById("displayPrice").innerHTML = "<?PHP echo $silver;?>";
					setOrder("<?php echo $silverAmount;?>");
					totals();
					
			break;
			case "3":
			//document.getElementById("demo").innerHTML = "You selected: " + Option;
					document.getElementById("displayPrice").innerHTML = "<?PHP echo $gold;?>";
					setOrder("<?php echo $goldAmount;?>");
					totals();
					
			break;
			case "4":
			//document.getElementById("demo").innerHTML = "You selected: " + Option;
					document.getElementById("displayPrice").innerHTML = "<?PHP echo $platinum;?>";
					setOrder("<?php echo $platinumAmount;?>");
					totals();

			break;
			case "5":
			//document.getElementById("demo").innerHTML = "You selected: " + Option;
					document.getElementById("displayPrice").innerHTML = "<?PHP echo $titanium;?>";
					setOrder("<?php echo $titaniumAmount;?>");
					totals();
					
			break;
			case "6":
			//document.getElementById("demo").innerHTML = "You selected: " + Option;
					document.getElementById("displayPrice").innerHTML = "<?PHP echo $titaniumPlus;?>";
					setOrder("<?php echo $titaniumPlusAmount;?>");
					totals();
					
			break;
			
			}
		}
		//V1=amount of ones,V5=Amount of Fives,V25=amount of twenty fives and so on.
		function setOrder(V250)
		{
			
		//	document.getElementById("DDLOnes").value=V1; document.getElementById("DDLOnes").innerHTML = V1;
		//	document.getElementById("DDLFives").value= parseInt(V5)*5  ; document.getElementById("DDLFives").innerHTML = V5;
		//	document.getElementById("DDLTwentyFives").value= parseInt(V25)*25; document.getElementById("DDLTwentyFives").innerHTML = V25;
		//	document.getElementById("DDLHundreds").value= parseInt(V100)*100; document.getElementById("DDLHundreds").innerHTML = V100;
			document.getElementById("DDL").value = parseInt(V250)* 250 ; 
			document.getElementById("DDLTwoHundredFifties").value = parseInt(V250)* 250 ; 
			document.getElementById("DDL").option[V250*250]= V250;
			document.getElementById("packageid").value = parseInt(Option);
		}
		
		
		</script>
		
		
		<tr style="padding: 10px 10px 10px 10px;"><!--Begin Headers-->
			<th>CloudCoin</th>
			<th>Denomination</th>
			<th>Amount</th>
			<th>Stock Available</th>
		</tr><!-- end headers -->
		
		
		<!-- Populate drop down menus with the number of coins in bank -->		
		
		<tr>
			<td>
			</td>
			<th>

			
			</th>
			<td>
					<select name="packageSelect" id="Pselect" onchange="Packages()">
			<option value="0">Please select a package</option><?PHP if($numberOfTwoHundredFifties>=2){
			echo " <option value='1'>Basic package</option>";}
			if($numberOfTwoHundredFifties>=4){ echo "<option value='2'>Silver package</option>"; }
			if($numberOfTwoHundredFifties>=8){ echo "<option value'3'>Gold package</option>";}
			if($numberOfTwoHundredFifties>=20){ echo "<option value='4'>Platinum package</option>";}
			if($numberOfTwoHundredFifties>=40){ echo "<option value='5'>Titanium package</option>";}
			if($numberOfTwoHundredFifties>=80){ echo "<option value='6'>Titanium Plus package</option>";}
			
		
			
			?></select>
			</td>
			<td></td>
			</tr>
			
		
			<tr>
			<td><img alt="250 CloudCoin" src="css/cc-250.png" width="200"></td>
			<th>250s</th>
			<td>
				<select name="DDL" id="DDL" onchange="totals()" disabled >
				<option value="0">0 | 0.00</option>
				<?php
					$maxShown=$numberOfTwoHundredFifties;
					if ($maxShown>200){$maxShown=200;}
					for ($i=1;$i<=$maxShown;$i++){
						$value= $i * 250;
						echo "<option value='$value'>$i | <span id='$value'></span> </option>";					
					}
				
				?>
				</select>
				<input type="hidden" name="DDLTwoHundredFifties" id="DDLTwoHundredFifties" value="0">
			</td>
			<td><span id="LBLTwoHundredFiftiesAvailable"><?php echo $numberOfTwoHundredFifties?> in stock</span></td>
		</tr>
		
		<!-- populate the totals -->
		<tr>
		<td></td>
			<th colspan="4" style="text-align:center"><b colspan="4">Grand Total: <span id="grandtotal"></span></b>
			<span id="LBLWarning">Order must be at least $5.00 to process!</span>
			</th>
			

		</tr>
		<tr>
		<td><input type="hidden" name="BTNSubmitGreenPay" value="" id="BTNSubmitGreenPay" type='image' src='https://greenbyphone.com/eCheck/images/PayNowButton.png' border='0' />
		</td>
		<th><input type="hidden" name="BTNSubmitGreenPay" value="" id="BTNSubmitGreenPay" type='image' src='https://greenbyphone.com/eCheck/images/PayNowButton.png' border='0' />
		</th>
		<td>
		<input  name="BTNSubmitGreenPay" value="" id="BTNSubmitGreenPay" type='image' src='https://greenbyphone.com/eCheck/images/PayNowButton.png' border='0' name='submit' alt='' value="Place Order"/>
		</td>
		
		<td><input type="hidden" name="BTNSubmitGreenPay" value="" id="BTNSubmitGreenPay" type='image' src='https://greenbyphone.com/eCheck/images/PayNowButton.png' border='0' />
		</td>

		</tr>
	</table>

	</div>

	</section>

<?php?>
<!-- Above line contains the code for the footer -->
	<input name="pricepercoin" type="hidden" id="pricepercoin" value="<?php echo $Price?>">
	<input name="af" type="hidden" id="af" value="<?PHP echo $_GET['af']?>">
	
</form>

<!-- JS for the form-->
<script type="text/javascript">
        function totals() {
            var totalCoins = 0;
            var totalPrice = 0;
            var pricePerCoin = parseFloat(displayPrice.value);

			
        //    var ones = parseInt(DDLOnes.value);
         //   var fives = parseInt(DDLFives.value);
         //   var twentyfives = parseInt(DDLTwentyFives.value);
         //   var hundreds = parseInt(DDLHundreds.value);
            var twohundredfifties = parseInt(DDLTwoHundredFifties.value);

            totalCoins = twohundredfifties;
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