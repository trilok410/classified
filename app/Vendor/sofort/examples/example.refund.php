<?php


require_once(dirname(__FILE__).'/../refund/sofortLibRefund.inc.php');

// enter your configuration key – you only can create a new configuration key by creating
// a new Gateway project in your account at sofort.com
$configkey = '12345:123456:edc788a4316ce7e2ac0ede037aa623d7';

$SofortLibRefund = new SofortLibRefund($configkey);
$SofortLibRefund->setSenderSepaAccount('SFRTDE20XXX', 'DE11888888889999999999', 'Max Mustermann');
$transactionId = '00907-01222-50D43927-FFDF';
$SofortLibRefund->addRefund($transactionId, 1, '17:43 auf gehts');
$SofortLibRefund->setPartialRefundId('454545');
$SofortLibRefund->setReason('reason1', 'reason2');


$SofortLibRefund->sendRequest();


if($SofortLibRefund->isError()) {
	//SOFORT-API didn't accept the data
	echo $SofortLibRefund->getError();
} else {
	//buyer must be redirected to $paymentUrl else payment cannot be successfully completed!
	$paymentUrl = $SofortLibRefund->getPaymentUrl();
	header('Location: '.$paymentUrl);
}

/*
	echo $SofortLibRefund->getSenderHolder(0).'<br/>';
	echo $SofortLibRefund->getSenderBic(0).'<br/>';
	echo $SofortLibRefund->getSenderIban(0).'<br/>';
	echo $SofortLibRefund->getTitle().'<br/>';
	echo $SofortLibRefund->getPain().'<br/>';
	echo $SofortLibRefund->getRecipientBankName(0).'<br/>';
	echo $SofortLibRefund->getRecipientHolder(0).'<br/>';
	echo $SofortLibRefund->getRecipientBic(0).'<br/>';
	echo $SofortLibRefund->getRecipientIban(0).'<br/>';
	echo $SofortLibRefund->getTransactionId(0).'<br/>';
	echo $SofortLibRefund->getAmount(0).'<br/>';
	echo $SofortLibRefund->getComment(0).'<br/>';
	echo $SofortLibRefund->getStatus(0).'<br/>';
	echo $SofortLibRefund->getTime(0).'<br/>';
	echo $SofortLibRefund->getPartialRefundId(0).'<br/>';
*/