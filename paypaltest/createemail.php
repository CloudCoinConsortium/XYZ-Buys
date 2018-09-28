<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('config.php');
//get user inputted data
 $totalOrder=$_GET['amount'];
 $payto=$_GET['name'];
 $ID =$_GET['id'];
 
 $accountID=$_GET['account'];
//make sure that the Check ID was correct
 if($ID == null){
	
	header("location: https://$server/exchange/orderfail.php?errorcode=5");
	 
	 }else{
	 $userEmail= urldecode($_GET['email']);
	 $name= urldecode($_GET['name']);	
	
	//get the cloudcoin to be sent
	$stack = file_get_contents("https://$bankserver/service/cash_checks.aspx?id=".$ID."&account=".$accountID);

	//get the subject line from config
$subject=$Esubject;


$email = fopen("$emailPath/Emails/Queue/$ID.txt", "w") or die("Unable to open file!");
$uname=base64_encode($emailSend);


//write the email file
$txt = "HELO protonmail.com
AUTH LOGIN
$uname
$epass
MAIL FROM:<$emailSend>
RCPT TO:<$userEmail>
DATA
Subject: $subject
To: $name <$userEmail>
Content-Type: text/plain
Content-Disposition: attachment; filename='$totalOrder.CloudCoin.1.$ID..stack'\n
$stack
.
";
//close the email
fwrite($email, $txt);
fclose($email);

//write the receipt file
$emails = fopen("$emailPath/Emails/Queue/Receipt$ID.txt", "w") or die("Unable to open file!");
$Rtxt = "HELO protonmail.com
AUTH LOGIN
$uname
$epass
MAIL FROM:<$emailSend>
RCPT TO:<$receiptemail>
DATA
Subject: stripe test Receipt
To: Seller <$receiptemail>
Content-Type: text/plain

this email is a test

A purchase of $totalOrder CloudCoins has been made.
the check id is: $ID
These coins were sent to $userEmail;
.
";
//close the receipt
fwrite($emails, $Rtxt);
fclose($emails);
//send to order success page
header("location: https://$server/exchange/ordersuccessNEW.php?email=$userEmail&name=$payto&amount=$totalOrder&$download&id=$ID&accountid=$accountID");
	 }
?>