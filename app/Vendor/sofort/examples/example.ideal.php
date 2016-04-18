<?php

require_once(dirname(__FILE__).'/../ideal/sofortLibIdeal.inc.php');

// enter your configuration key – you only can create a new configuration key by creating
// a new Gateway project in your account at sofort.com
define('CONFIGKEY', '12345:123456:edc788a4316ce7e2ac0ede037aa623d7');
define('PASSWORD', 'project_password');

$SofortIdeal = new SofortLibIdeal(CONFIGKEY, PASSWORD);
// $SofortIdeal = new SofortLibIdeal(CONFIGKEY, PASSWORD, 'md5');
// $SofortIdeal = new SofortLibIdeal(CONFIGKEY, PASSWORD, 'sha256');
$SofortIdeal->setReason('Testzweck', 'Testzweck4');
$SofortIdeal->setAmount(10.00);
//$SofortIdeal->setSenderAccountNumber('2345678902');
$SofortIdeal->setSenderBankCode('31');
$SofortIdeal->setSenderCountryId('NL');
$SofortIdeal->setSuccessUrl('http://www.yourdomain.org/yourshop/success.php');
$SofortIdeal->setAbortUrl('http://www.yourdomain.org/yourshop/abort.php?transaction=-TRANSACTION-');
$SofortIdeal->setNotificationUrl('http://www.yourdomain.org/yourshop/notification.php?transaction=-TRANSACTION-');
//$SofortIdeal->setVersion('Framework 0.0.1');

echo 'User should be redirected to: <a href="'.$SofortIdeal->getPaymentUrl().'" target="_blank">Link</a>';
