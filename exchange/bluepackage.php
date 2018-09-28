<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="x-ua-compatible" content="ie=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Buy Cloud Currencies Educational Package</title>

<link rel="apple-touch-icon" sizes="180x180" href="https://cloudcoinconsortium.com/apple-touch-icon.png">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="https://cloudcoinconsortium.com/manifest.json">
<link rel="mask-icon" href="https://cloudcoinconsortium.com/safari-pinned-tab.svg" color="#5bbad5">
<link rel="stylesheet" href="css/exchangeindex2.css">
</head>

<?php  //get the number of coins in the currrent bank
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
	







<header>
  <div>Cloud Coin</div>
</header>

  <section class="main purchase">
    <h1>Buy CloudCoin</h1>
    <div class="steps">
      <b>Step 1 - Select Package</b> | Step 2 - Billing | Step 3 - Download
    </div>
<?PHP if($_GET['error']!==null){
 echo '<div id="alert" class="alert" style="display:none;">
      Your cart is empty.
    </div>'; }?>
	 
	
    <div class="form-container">
      <form action="blueform.php" method="POST">
        <div class="form-inner">
          <div class="field">
            <label for="package_type">Package</label>
            <ul class="radio_package_container">
			
			
			
			<?PHP if($numberOfTwoHundredFifties>=$basicAmount){
				echo '<li class="pc">
                <input  type="radio" name="packageSelect" data-package-name="basic" class="hide" value="1"  />
                <div class="package_name">basic</div>
                <div class="package_amount">500 CloudCoins</div>
				<div class="package_amount">'.$basicDisplay.'</div>
				</li>';
				}else{echo '<li class="pc">
                <input  type="radio" name="packageSelect" data-package-name="basic" class="hide" value="0"  />
                <div class="package_name">basic</div>
                <div class="package_amount">Out of Stock</div>
				</li>';}
				if($numberOfTwoHundredFifties>=$silverAmount){
				echo  
				'<li class="pc">
                <input type="radio" name="packageSelect" data-package-name="silver" class="hide" value="2" />
                <div class="package_name">silver</div>
                <div class="package_amount">1000 CloudCoins</div>
                <div class="package_amount">$'.$silverDisplay.'</div>
				</li>';
				}else{
				echo	'<li class="pc">
                <input type="radio" name="packageSelect" data-package-name="silver" class="hide" value="0" />
                <div class="package_name">Silver</div>
                <div class="package_amount">Out of Stock</div>
				
				</li>';
					
				}
				if($numberOfTwoHundredFifties>=$goldAmount){
					echo '<li class="pc">
                <input type="radio" name="packageSelect" data-package-name="gold" class="hide" value="3" />
                <div class="package_name">Gold</div>
                <div class="package_amount">2000 CloudCoins</div>
				<div class="package_amount">$'.$goldDisplay.'</div>
				</li>';
				}else{
					echo '
					<li class="pc">
                <input type="radio" name="packageSelect" data-package-name="gold" class="hide" value="0" />
                <div class="package_name">Gold</div>
                <div class="package_amount">Out of Stock</div>
				
				</li>
					';
					
					
				}
				if($numberOfTwoHundredFifties>=$platinumAmount){
					echo '<li class="pc">
                <input type="radio" name="packageSelect" data-package-name="platinum" class="hide" value="4" />
                <div class="package_name">Platinum</div>
                <div class="package_amount">5000 CloudCoins</div>
				<div class="package_amount">$'.$platinumDisplay.'</div>
				</li>'; }else{
				  echo '<li class="pc">
                <input type="radio" name="packageSelect" data-package-name="platinum" class="hide" value="0" />
                <div class="package_name">Platinum</div>
                <div class="package_amount">Out Of Stock</div>
				
				</li> ';
				  
				  
				  
			  }
				if($numberOfTwoHundredFifties>=$titaniumAmount){
					echo '<li class="pc">
                <input type="radio" name="packageSelect" data-package-name="titanium" class="hide" value="5" />
                <div class="package_name">titanium</div>
                <div class="package_amount">10000 CloudCoins</div>
				<div class="package_amount">$'.$titaniumDisplay.'</div>
				</li>';
					
				}else{
					echo '
					<li class="pc">
                <input type="radio" name="packageSelect" data-package-name="titanium" class="hide" value="0" />
                <div class="package_name">titanium</div>
                <div class="package_amount">Out Of Stock</div>
				
				</li>
					
					';
					
				}
				if($numberOfTwoHundredFifties>=$titaniumPlusAmount){
					echo '
					<li class="pc">
                <input type="radio" name="packageSelect" data-package-name="titanium_plus" class="hide" value="6" />
                <div class="package_name">Titanium Plus</div>
                <div class="package_amount">20000 CloudCoins</div>
				<div class="package_amount">$'.$titaniumPlusDisplay.'</div>
				</li>
					';
					
					
				}else{
					echo '
					<li class="pc">
                <input type="radio" name="packageSelect" data-package-name="titanium_plus" class="hide" value="0" />
                <div class="package_name">Titanium Plus</div>
                <div class="package_amount">Out Of Stock</div>
				</li>
					';
				}
				
				
				
				
				
				?>
			
              
			
						<input type="hidden" name="DDLTwoHundredFifties" id="DDLTwoHundredFifties" value="0"/>
			
              
              
			  
              
			  
			  
			  
              
              
            
			</ul>
          </div>
          <div class="field">
            <input type="submit" value="continue >" data-disable-with="Review">
          </div>
        </div>
      </form>
    </div>
  </section>
</main>
<footer>
</footer>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$( document ).ready(function() {
    console.log( "ready!" );
	  //fade in errors
   $("#alert").fadeIn('slow');
});
$(document).ready(function() {
  
  
  // when a package is clicked...  
  $('li.pc').click(function() {
    $(this).addClass('is-selected');
    $(this).siblings().removeClass('is-selected');
		
	
	
	
    rd = $(this).find("input[type='radio']")[0];
    rd.checked = true;
	
  });  
  

});

</script>
