<?php
/**
 * Copyright 2018 CloudCoin 
 *
 * You are hereby granted a non-exclusive, worldwide, royalty-free license to
 * use, copy, modify, and distribute this software in source code or binary
 * form for use in connection with the web services and APIs provided by
 * Facebook.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 */

namespace CloudBank;

use CloudBank\HTTPClient\HTTPClientFactory;
use CloudBank\CloudBankException;
use CloudBank\Logger;

class CloudBank {
	const VERSION = '0.1.15';

	private $client;

	private $config;

	private $rmappings;

	private $privateKey;

	private $validator;

	public function __construct($config = []) {

		$this->config = array_merge([
			"url" => "",
			"debug" => false,
			"privateKey" => "",
			"account" => "",
			"timeout" => 30
		], $config);

		if ($this->config['debug'])
			Logger::init(Logger::MSGTYPE_DEBUG);

		Logger::debug("SDK initialized: " . print_r($this->config, true));

		if (!$this->config['url']) {
			throw new CloudBankException("Required 'url' parameter not supplied");
		}

		$this->privateKey = $this->config['privateKey'];
		$this->account = $this->config['account'];

		$this->setResponseMappings();
		$rmappings = $this->rmappings;

		$this->client = HTTPClientFactory::createClient();
		$this->client->setBaseURL($this->config['url']);
		$this->client->setProcessResponseFunc(function($data, $url) use ($rmappings) {
			$payload = @json_decode($data);
			$jsonLastError = json_last_error();
			if ($jsonLastError !== JSON_ERROR_NONE) {
				throw new CloudBankException("Failed to parse JSON: " . $jsonLastError);
			}

			$url = preg_replace("/\/?(.+?)(\?.*)?$/", "$1", $url);
			if (!isset($rmappings[$url])) {
				Logger::debug(print_r($rmappings, true));
				throw new CloudBankException("Invalid response format for $url");
			}

			$className = "\CloudBank\\" . $rmappings[$url];
			$rObject = new $className();
			foreach ($payload as $k => $v)
				$rObject->$k = $v;

			return $rObject;
		});

		if ($this->config['timeout'])
			$this->client->setTimeout($this->config['timeout']);


		$this->validator = new Validator();
	}

	private function setResponseMappings() {
		$this->rmappings = [
			"print_welcome" => "WelcomeResponse",
			"echo"		=> "EchoRAIDAResponse",
			"deposit_one_stack" 	=> "DepositStackResponse",
			"get_receipt"	=> "GetReceiptResponse",
			"show_coins"	=> "ShowCoinsResponse",
			"withdraw_one_stack" => "WithdrawStackResponse",
			"write_check"	=> "WriteCheckResponse"
		];
	}

	public function printWelcome() {
		$welcomeResponse = $this->client->send("print_welcome");

		return $welcomeResponse;
	}

	public function echoRAIDA() {
		$params = $this->getPK();

		$echoRAIDAResponse = $this->client->send("echo?$params");

		return $echoRAIDAResponse;
	}

	public function getStack($stackData) {

		$stackObj = new Stack($stackData);

		return $stackObj;
	}

	private function _doDepositStack($stack) {
		$params = $this->getPK();

		$url = "deposit_one_stack";
		$stack="$params&stack=$stack";
		
		$depositStackResponse = $this->client->send($url, $stack);

		return $depositStackResponse;
	}

	private function checkCoinsAvailable($amount) {
		$inventoryObj = $this->showCoins();
		$inventory = $inventoryObj->getBulk();

		krsort($inventory);
		foreach ($inventory as $denomination => $bankAmount) {
			if ($amount >= $denomination && $bankAmount > 0) {
				$sub = intval($amount / $denomination);
				if ($sub > $bankAmount) 
					$sub = $bankAmount;

				$amount -= ($sub * $denomination);
				if ($amount == 0)
					break;
			}
		}

		if ($amount != 0) 
			return false;

		return true;
	}

	public function depositStack($stack, $amount = null) {
		Logger::debug("Deposit Stack");

		if (is_null($amount)) 
			return $this->_doDepositStack($stack);

		$amount = intval($amount);
		if ($amount <= 0) 
			throw new CloudBankException("Invalid amount");

		
		$stackObj = new Stack($stack);
		$changeTotal = $stackObj->getTotal() - $amount;
		if ($changeTotal == 0)
			return $this->_doDepositStack($stack);

		if ($changeTotal < 0)
			throw new CloudBankException("Amount is too big");

		if (!$this->checkCoinsAvailable($changeTotal))
			throw new CloudBankException("Not enough coins in the Bank");

		$depositResponse = $this->_doDepositStack($stack);
		if ($depositResponse->isError())
			throw new CloudBankException("Failed to deposit coins");

		Logger::debug("Deposit message: " . $depositResponse->message);
		$receiptNumber = $depositResponse->receipt;

		$receiptResponse = $this->getReceipt($receiptNumber);
		if (!$receiptResponse->isValid()) 
			return $depositResponse;
		//	throw new CloudBankException("The coins are counterfeit. Receipt #$receiptNumber");
				
		$withdrawStackResponse = $this->withdrawStack($changeTotal);
		$depositResponse->change = $withdrawStackResponse->getStack();

		return $depositResponse;
	}

	public function withdrawStack($amount) {
		Logger::debug("Withdraw $amount CC");

		$amount = intval($amount);
		if (!$this->validator->amount($amount))
			throw new CloudBankException("Invalid amount");

		$params = $this->getPK();

		$url = "withdraw_one_stack?amount=$amount&$params";

		$withdrawStackResponse = $this->client->send($url);

		return $withdrawStackResponse;
	}

	public function writeCheck($amount, $checkId, $email, $payto, $fromemail, $by, $memo = "") {
		Logger::debug("WriteCheck $checkId: $amount CC to $email");

		$amount = intval($amount);
		if (!$this->validator->amount($amount))
			throw new CloudBankException("Invalid amount");
	
		if (!$this->validator->email($email))
			throw new CloudBankException("Invalid email");

		if (!$this->validator->email($fromemail))
			throw new CloudBankException("Invalid email from");

		if (!$this->validator->checkID($checkId))
			throw new CloudBankException("Invalid checkID. Must contain alphanum chars. Min length is 4");

		if (!$payto)	
			throw new CloudBankException("Payee is not specifed");

		if (!$by) 
			throw new CloudBankException("Payer is not specifed");

		$payto = urlencode($payto);
		$by = urlencode($by);
		$memo = urlencode($memo);

		$url = "write_check";

		$params = $this->getPK();
		$params .= "&action=email&amount=$amount&checkid=$checkId";
		$params .= "&emailto=$email&payto=$payto&fromemail=$fromemail&signby=$by&memo=$memo";

		$writeCheckResponse = $this->client->send($url, $params);

		return $writeCheckResponse;
	}

	public function getCashCheckURL($checkId, $format = "json", $data = "") {
		if (!$this->validator->checkID($checkId))
			throw new CloudBankException("Invalid checkID. Must contain alphanum chars. Min length is 4");

		if (!$this->validator->sendType($format))
			throw new CloudBankException("Invalid format. Must be one of 'json','email','url'");

		$url = $this->config['url'] . "/checks?id=$checkId";
		$url .= "&receive=$format";

		if ($format == "email" && !$this->validator->email($data))
			throw new CloudBankException("Invalid email");

		if ($format == "sms" && !$this->validator->phoneNumber($data))
			throw new CloudBankException("Invalid phone number");
			
		if ($data)
			$url .= "&contact=$data";

		return $url;
	}


	public function getReceipt($rn) {
		Logger::debug("Get Receipt $rn");

		$params = $this->getPK();

		$url = "get_receipt?rn=$rn&$params";

		$getReceiptResponse = $this->client->send($url);

		return $getReceiptResponse;
	}

	public function showCoins() {
		Logger::debug("Show coins");
		$params = $this->getPK();

		$showCoinsResponse = $this->client->send("show_coins?$params");

		return $showCoinsResponse;
	}

	public function getVersion() {
		return self::VERSION;
	}

	private function getPK() {
		$val = "account=" . $this->account . "&pk=" . $this->privateKey;

		return $val;
	}


}


?>
