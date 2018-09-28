<?php  //get the number of coins in the currrent bank
	include('config.php');
		
		
		$str = file_get_contents("http://$bankserver/service/showcoinsforsale.php$configPK");		
		$json = json_decode($str, true); // decode the JSON into an associative array
		
		
		
		$numberOfOnes= $json[ones];
		$numberOfFives= $json[fives];
		$numberOfTwentyFives= $json[twentyfives];
		$numberOfOneHundreds= $json[hundreds];
		$numberOfTwoHundredFifties= $json[twohundredfifties];
		$totals = $numberOfOnes+$numberOfFives+$numberOfTwentyFives+$numberOfOneHundreds+$numberOfTwoHundredFifties;
	

		?>
<!DOCTYPE html>
<HTML>
<head>
<title>CloudCoin</title>


<link rel="apple-touch-icon" href="https://cloudcoinconsortium.com/apple-touch-icon.png">
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-32x32.png" >
<link rel="icon" type="image/png" href="https://cloudcoinconsortium.com/favicon-16x16.png" >
<link rel="manifest" href="https://cloudcoinconsortium.com/manifest.json">
<link rel="mask-icon" href="https://cloudcoinconsortium.com/safari-pinned-tab.svg">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://codepen.io/overdrivemachines/pen/megaYG.css">
<link rel="stylesheet" href="https://codepen.io/overdrivemachines/pen/JBrdrq.css">
	</head>
<body>

<header>
  <div class="header-container">
    <div class="left "><a href="https://cloudcoins.com/">CLOUDCOIN</a></div>
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
      <h5 >STEP 1 PACKAGE | STEP 2 - BILLING | STEP 3 - DOWNLOAD</h5>
    </div>

	 
    <hr>
	<?PHP if($_GET['error'] == '1'){
 echo '<div id="alert" class="alert" style="display: none;">
      Your cart is empty.
    </div>'; }?>
    <div class="vspace"></div>
      <form action="https://<?php echo $server?>/exchange/blueform2.php" method="POST">
      <div class="field">
        <label for="radio_package">Select a package</label>
        <ul class="plc">
         
		 <?PHP if($numberOfTwoHundredFifties>=$basicAmount){
		 echo ' <li class="pc ">
            <div class="art"><i class="fas fa-chess-pawn"></i>
              <h6>BASIC</h6>
            </div>
            <input type="radio" name="packageSelect" data-package-name="basic" class="hide" value="1" />

            <h3>$'.$basic*$basicAmount*250 .'</h3>
            <p>'.$basicAmount*250 .' Cloud Coins</p>
		 </li>';}else{}
		 if($numberOfTwoHundredFifties>=$silverAmount){
        echo'  <li class="pc">
            <div class="art"><i class="fas fa-chess-knight"></i>
              <h6>SILVER</h6>
            </div>
            <input type="radio" name="packageSelect" data-package-name="silver" class="hide" value="2" />

            <h3>$'.$silver*$silverAmount*250 .'</h3>
            <p>'.$silverAmount*250 .' Cloud Coins</p>
		 </li>';}else{}
				
		  
		  
		  if($numberOfTwoHundredFifties>=$goldAmount){
       echo'   <li class="pc">
            <div class="art"><i class="fas fa-chess-bishop"></i>
              <h6>GOLD</h6>
            </div>
            <input type="radio" name="packageSelect" data-package-name="gold" class="hide" value="3" />

			<h3>$'.$gold*$goldAmount*250 .'</h3>
            <p>'.$goldAmount*250 .' Cloud Coins</p>
          </li>';
		  }else{}
		  
		  if($numberOfTwoHundredFifties>=$platinumAmount){
		  
         echo ' <li class="pc">
            <div class="art"><i class="fas fa-chess-rook"></i>
              <h6>PLATINUM</h6>
            </div>
            <input type="radio" name="packageSelect" data-package-name="platinum" class="hide" value="4" />

            
			<h3>$'.$platinum*$platinumAmount*250 .'</h3>
            <p>'.$platinumAmount*250 .' Cloud Coins</p>
          </li>';
		  }else{};
		  
		  if($numberOfTwoHundredFifties>=$titaniumAmount){
        echo '  <li class="pc">
            <div class="art"><i class="fas fa-chess-queen"></i>
              <h6>TITANIUM</h6>
            </div>
            <input type="radio" name="packageSelect" data-package-name="titanium-plus" class="hide" value="5" />

            <h3>$'.$titanium*$titaniumAmount*250 .'</h3>
            <p>'.$titaniumAmount*250 .' Cloud Coins</p>
          </li>';
		  }else{}
		  if($numberOfTwoHundredFifties>=$titaniumPlusAmount){
        echo '  <li class="pc">
            <div class="art"><i class="fas fa-chess-king"></i>
              <h6>TITANIUM+</h6>
            </div>
            <input type="radio" name="packageSelect" data-package-name="titanium-plus" class="hide" value="6" />

            <h3>$'.$titanium*$titaniumPlusAmount*250  .'</h3>
            <p>'.$titaniumPlusAmount*250 .' Cloud Coins</p>
          </li>';
		  }else{}?>
		  
		  <input type="hidden" name="DDLTwoHundredFifties" id="DDLTwoHundredFifties" value="0"/>
		  
        </ul>
      </div>
      <div class="actions">
        <div>&nbsp;</div>
        <div>
          <button type="submit" class="btn-blue spacer-v">Continue<i class="fa fa-angle-right fa right"></i></button>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
</body>
</HTML>

