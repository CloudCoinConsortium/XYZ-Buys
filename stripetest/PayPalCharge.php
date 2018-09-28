<?php
	require('PayPal-PHP-SDK/autoload.php');

	$apiContext = new \PayPal\Rest\ApiContext(
				new \PayPal\Auth\OAuthTokenCredential(
					'Ad_K_GmCpkciq2nBRijZaNoREO9ox8JtkQdsJigbfDSFbVmuKCYWwewWoswR9Qpy52jYx3G6K01sSI3G',
					'ECzNdVUDQ8JbhQDXHZ7oH_UoLfwtUYdJ7t7Ms-mbCWzKYYfVpVmnFzsIs0QtM1c9B4gYPrQlSlUFIvn-'

				)
		);
		
		
		$payer = new \PayPal\Api\Payer();
		$payer->setPaymentMethod('paypal');

		$amount = new \PayPal\Api\Amount();
		$amount->setTotal('1.00');
		$amount->setCurrency('USD');

		$transaction = new \PayPal\Api\Transaction();
		$transaction->setAmount($amount);

		$redirectUrls = new \PayPal\Api\RedirectUrls();
		$redirectUrls->setReturnUrl("https://example.com/your_redirect_url.html")
			->setCancelUrl("https://example.com/your_cancel_url.html");

		$payment = new \PayPal\Api\Payment();
		$payment->setIntent('sale')
			->setPayer($payer)
			->setTransactions(array($transaction))
			->setRedirectUrls($redirectUrls);
			
			
		try {
			$payment->create($apiContext);
			echo $payment;

			echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
		}
		catch (\PayPal\Exception\PayPalConnectionException $ex) {
			// This will print the detailed information on the exception.
			//REALLY HELPFUL FOR DEBUGGING
			echo $ex->getData();
		}	
			
			
		
		
		
		?>