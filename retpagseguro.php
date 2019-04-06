<?php
require_once 'custom_scripts/PagSeguroLibrary/PagSeguroLibrary.php';
require 'config/config.php';

if($config['pagseguro']['testing'] == true){
    header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
}else{
    header("access-control-allow-origin: https://pagseguro.uol.com.br");
}

// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE',false);

define('INITIALIZED', true);

// if not defined before, set 'false' to load all normal
if(!defined('ONLY_PAGE'))
    define('ONLY_PAGE', false);

// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');

// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');

// DATABASE
include_once('./system/load.database.php');
if(DEBUG_DATABASE)
    Website::getDBHandle()->setPrintQueries(true);
// DATABASE END

$method = $_SERVER['REQUEST_METHOD'];

if('POST' == $method){

    $type = $_POST['notificationType'];

    $notificationCode = $_POST['notificationCode'];

    if ($type === 'transaction'){

        try {
            $credentials = PagSeguroConfig::getAccountCredentials();
            $transaction = PagSeguroNotificationService::checkTransaction($credentials, $notificationCode);

            $reference= explode("-",$transaction->getReference());

            $transaction_code = $transaction->getCode();
            $arrayPDO['transaction_code'] = $transaction->getCode();

            $name = $reference[0]; //exploded from reference;
            $arrayPDO['name'] = $name;
            $arrayPDO['payment_method'] = $transaction->getPaymentMethod()->getType()->getTypeFromValue();
            $arrayPDO['status'] = $transaction->getStatus()->getTypeFromValue();
            $arrayPDO['payment_amount'] = $transaction ->getGrossAmount();
            $item = $transaction->getItems();
            $arrayPDO['item_count'] = $reference[1];
            $date_now = date('Y-m-d H:i:s');
            $arrayPDO['data'] = $date_now;

            try {

                $servername = "127.0.0.1";
                $username = "root";
                $password = "34997e4f!LoL";
                $dbname = "alg_back";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
                }

                $stmt = $conn->prepare("INSERT INTO pagseguro_transactions (transaction_code, name, payment_method, status, item_count, data, payment_amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssisd", $arrayPDO['transaction_code'], $arrayPDO['name'], $arrayPDO['payment_method'], $arrayPDO['status'], $arrayPDO['item_count'] , $arrayPDO['data'], $arrayPDO['payment_amount']);
                $stmt->execute();


                if ($arrayPDO['status'] == 'PAID') {
                    
                    if ($config['pagseguro']['doublePoints']) {
                        $arrayPDO['item_count'] = $arrayPDO['item_count']*2;
                    }

                    $stmt = $conn->prepare("UPDATE accounts SET coins = coins+? WHERE name = ?");
                    $stmt->bind_param("is", $arrayPDO['item_count'], $arrayPDO['name']);
                    $stmt->execute();

                    $stmt = $conn->prepare("UPDATE pagseguro_transactions SET status = 'DELIVERED' WHERE transaction_code = ? AND status = 'PAID'");
                    $stmt->bind_param("s", $arrayPDO['transaction_code']);
                    $stmt->execute(array('transaction_code' => $arrayPDO['transaction_code']));
                    $stmt->execute();

                    $stmt->close();
                    $conn->close();

                }
                echo 'Received.';

            } catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }

        } catch(PagSeguroServiceException $e) {
            die($e->getMessage());
        }


    }
}
