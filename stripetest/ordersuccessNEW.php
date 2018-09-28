
<?php
include('../config.php');
	$af= $_GET['af'];
$account=$_GET['accountid'];
?>
<header>
  
<title>Buy Cloud Currencies Educational Package</title>

<link rel="apple-touch-icon" sizes="180x180" href="https://cloudcoinconsortium.com/apple-touch-icon.png">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="https://cloudcoinconsortium.com/manifest.json">
<link rel="mask-icon" href="https://cloudcoinconsortium.com/safari-pinned-tab.svg" color="#5bbad5">
<link rel="stylesheet" href="css/exchangeindex.css">

  <div>Cloud Coin</div>
</header>
<main>
  <section class="main purchase">
    <h1>Buy Cloudcoins</h1>
    <div class="steps">
      Step 1 - Amount | Step 2 - Billing | <b>Step 3 - Download</b>
    </div>
    <div class="notice">
	<form action="https://<?php echo $bankserver?>/service/cash_checks.aspx" method="GET" id="dwld">
      <b>Thank You!</b>
      <p>Your payment was processed and your check id is <?PHP echo $_GET['id']?><br>you can download your Cloudcoins below. A copy of the CloudCoins will also been sent to your email.</p>
      <input type="hidden" name="account" value="<?php echo $account;?>">
					<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
    </div>
    <div class="dw field">
					
      <input type="submit" name="commit" value="Download" data-disable-with="Review"/>
	  </form>
    </div>
  </section>
</main>
<footer>

</footer>

	 <script > <?php if($_GET['id']==null or $account == null){echo "nothing";}else{echo "document.getElementById('dwld').submit();";}?> </script>



<?PHP

	//get server
		$server = $_SERVER['SERVER_NAME'];
		
		//set timezone
		$tz = 'zulu';
		$timestamp = time();
		$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
		$dt->setTimestamp($timestamp); //adjust the object to correct timestamp


		//current version
		$version = "2.0";


			$response->exchange_server = $server;
			$response->account = $configAccount;
			$response->status = "Order_success";
			$response->message = "Order Successful";
			$response->amount = $_GET['amount'];
			$response->time = $dt->format('d-m-Y:H:i:s.u');
			$response->version= $version;
			$responseWrite = json_encode($response);
		





?>
