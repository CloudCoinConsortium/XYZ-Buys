<?PHP
//gets the results of the deposit.
include('../config.php');

$stack=$_POST['stack'];
$account=$_POST['account'];
$result = file_get_contents("https://bank2.cloudcoin.global/deposit_one_stack?account=$account&stack=$stack&pk=$privateKey");
$result= json_decode($result,true);
?>