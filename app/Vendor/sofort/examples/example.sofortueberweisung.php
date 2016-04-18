<?php

if(!empty($_REQUEST)){
	
echo "</pre>"; print_r($_REQUEST); die('STOP');	

}

require_once(dirname(__FILE__).'/../payment/sofortLibSofortueberweisung.inc.php');

// enter your configuration key – you only can create a new configuration key by creating
// a new Gateway project in your account at sofort.com
//$configkey = '123759:263166:03f6ff90ddf9fb340965f116672590bf';
$configkey = '123759:273271:03f6ff90ddf9fb340965f116672590bf'; //trilok
$Sofortueberweisung = new Sofortueberweisung($configkey);

$Sofortueberweisung->setAmount(10.21);
$Sofortueberweisung->setCurrencyCode('EUR');

$Sofortueberweisung->setReason('Testueberweisung', 'Verwendungszweck');
$Sofortueberweisung->setSuccessUrl('http://localhost/sofort/examples/example.sofortueberweisung.php', true);
$Sofortueberweisung->setAbortUrl('http://localhost/sofort/examples/example.sofortueberweisung.php');
$Sofortueberweisung->setNotificationUrl('http://localhost/sofort/examples/return.php');

// $Sofortueberweisung->setSenderSepaAccount('SFRTDE20XXX', 'DE06000000000023456789', 'Max Mustermann');
// $Sofortueberweisung->setSenderCountryCode('DE');
$Sofortueberweisung->setNotificationUrl('http://localhost/sofort/examples/return.php', 'loss,pending');
$Sofortueberweisung->setNotificationUrl('http://localhost/sofort/examples/return.php', 'loss');
$Sofortueberweisung->setNotificationUrl('http://localhost/sofort/examples/return.php', 'pending');
$Sofortueberweisung->setNotificationUrl('http://localhost/sofort/examples/return.php', 'received');
$Sofortueberweisung->setNotificationUrl('http://localhost/sofort/examples/return.php', 'refunded');
$Sofortueberweisung->setNotificationUrl('http://localhost/sofort/examples/return.php', 'untraceable');
$Sofortueberweisung->setCustomerprotection(true);


$Sofortueberweisung->sendRequest();

if($Sofortueberweisung->isError()) {
	//SOFORT-API didn't accept the data
	echo $Sofortueberweisung->getError();
} else {
	//buyer must be redirected to $paymentUrl else payment cannot be successfully completed!
	$paymentUrl = $Sofortueberweisung->getPaymentUrl();
	header('Location: '.$paymentUrl);
}

