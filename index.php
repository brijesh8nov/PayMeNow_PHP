<?php 
include ("class_lib.php");
$paymenowObj = new paymenow();
$param = array(
				'ccname' => 'Brijesh Chauhan',
				'ccnum' => '5454545454545454',
				'amount' => 1.01,
				'expmon' => 07,
				'expyear' => '2014'
				);
$returnResult = $paymenowObj->callWebService($param);
var_dump($returnResult);
foreach ($returnResult as $key => $val) {
    print "$key = $val\n";
} 
?>