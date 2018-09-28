<?PHP
	//a list of functions for PHP
	//
			//contacts raida and confirms it is ready for authenticating
		function _echo($account = null, $pk = null){
			//if left null, variables will be filled in with config file information
			include('../config.php');
			if ($account == null){
				$account= $configAccount;
			}

			if ($pk == null){
				$pk = $privateKey;
			}
			
			$result = file_get_contents("https://bank2.cloudcoin.global/echo?account=$account&pk=$pk");
			$result = json_decode($result, true);
			//returns array that gives relevant information.
			//gives ready count, and not ready count of raida.
			return $result;
		}
		
		
		
		//contact Cloudbank and checks how many coins are in an account
		function _showcoins($account = null, $pk = null){
			//if left null, variables will be filled in with config file information
			include('../config.php');
			if ($account == null){
				$account= $configAccount;
			}

			if ($pk == null){
				$pk = $privateKey;
			}	
			
			$result = file_get_contents("https://bank2.cloudcoin.global/show_coins?account=$account&pk=$pk");
			$result = json_decode($result, true);
			//returns array with success or fail, and also the number of coins in the associated bank.
			return $result;
		}
		
		
		//contacts CloudBank and marks coins in the account for sale.
		function _markcoins($account = null, $pk = null, $one = 0, $five = 0, $twentfive = 0, $hundred = 0, $twofifty = 0){
			//if left null, variables will be filled in with config file information
			include('../config.php');
			if ($account == null){
				$account= $configAccount;
			}

			if ($pk == null){
				$pk = $privateKey;
			}	
			
			
			$result = file_get_contents("https://bank2.cloudcoin.global/mark_coins_for_sale?account=$account&pk=$pk&ones=$one&fives=$five&twentyfives$twentyfive0&hundreds=$hundred&twohundredfifties=$twofifty");
			$result = json_decode($result, true);
			//returns array that tells if it was successful or not.
			return $result;
		}
	
	
		function _getreceipt($account = null, $receipt = null){
			//if left null, variables will be filled in with config file information
			include('../config.php');
			if ($account == null){
				$account= $configAccount;
			}
			$result = file_get_contents("https://bank2.cloudcoin.global/get_receipt?account=$account&rn=$receipt");
			$result = json_decode($result, true);
			//returns array that shows the user the receipt.
			return $result;
		}
		
		
		function _withdrawstack($account = null, $pk = null,$amount = 0){
			//if left null, variables will be filled in with config file information
			include('../config.php');
			if ($account == null){
				$account= $configAccount;
			}

			if ($pk == null){
				$pk = $privateKey;
			}
			
			$result=file_get_contents("https://bank2.cloudcoin.global/withdraw_one_stack?account=$account&pk=$pk&amount=$amount");
			
			
			$result = json_decode($result, true);
			//returns array that shows the user the receipt.
			return $result;
			
		}
		
		
		
		
	
		
		
	
?>