<?php
if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
    //Todo resto do código iremos inserir aqui.

    $email = 'EMAIL';
    $token = 'TOKEN';

    //$url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $email . '&token=' . $token;
    //Caso use sandbox descontente a linha abaixo.
    $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $email . '&token=' . $token;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $transaction= curl_exec($curl); //transforma em xml
    curl_close($curl);

    if($transaction == 'Unauthorized'){
        echo 'You shall not pass';
        exit;//Mantenha essa linha
    }

    $transaction = simplexml_load_string($transaction);

    echo 'code ' . $transaction->code . ' ';
    echo 'accountName ' . $transaction->items->item->id . ' ';
    echo 'type ' . $transaction->paymentMethod->type . ' ';
    echo 'status ' . $transaction->status . ' ';
    echo 'quantity ' . $transaction->items->item->quantity . ' ';
    echo 'date ' . $transaction->date . ' ';
    echo 'netAmount ' . $transaction->netAmount . ' ';

}