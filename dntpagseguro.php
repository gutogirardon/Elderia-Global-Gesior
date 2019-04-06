<?php

### DONT TOUCH IN THIS CODE ###
### WORKING FINE 19/08/2006 ###
###       IVENSPONTES       ###
### github.com/ivenspontes/ ###

require_once 'custom_scripts/PagSeguroLibrary/PagSeguroLibrary.php';
require 'config/config.php';

$product_id = $_POST['qtde_coins'];
$account_name = $_POST['account_name'];



if(!isset($product_id, $account_name)){
    die("invalid parameters");
}
else {

    $coinCount = $product_id;

    $paymentRequest = new PagSeguroPaymentRequest();
    $paymentRequest->addItem($account_name, $coinCount . " - " . $config['pagseguro']['produtoNome'], 1, $coinCount/40.0);
    $paymentRequest->setCurrency("BRL");
    $paymentRequest->setShippingType(3); //Not specified
    $paymentRequest->setShippingCost(0.0);
    $paymentRequest->setReference($account_name . "-" . $coinCount);
    $paymentRequest->setRedirectUrl($config['pagseguro']['urlRedirect']);
    $paymentRequest->addParameter('notificationURL', $config['pagseguro']['urlNotification']);

    try {

        $credentials = PagSeguroConfig::getAccountCredentials();
        $checkoutUrl = $paymentRequest->register($credentials);
        header('location:' . $checkoutUrl);

    } catch (PagSeguroServiceException $e) {
        die($e->getMessage());
    }
}

?>