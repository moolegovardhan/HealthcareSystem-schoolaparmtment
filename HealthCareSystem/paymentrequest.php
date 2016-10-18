<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:7ea5c468f95758e6bdb3d55b14d43882",
                  "X-Auth-Token:0c3788c53893b75c32e82b2d7f579ead"));
$payload = Array(
    'purpose' => 'CGS',
    'amount' => '2500',
    'phone' => '9999999999',
    'buyer_name' => 'iNDIAN',
    'redirect_url' => 'http://localhost:9999/HCS/cardlogin/paymentresponse.php/',
    'send_email' => true,
    'webhook' => '',
    'send_sms' => true,
    'email' => 'foo@example.com',
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 
/*echo($response);*/


$json_decode = json_decode($response , true);
$long_url = $json_decode['payment_request']['longurl'] ;
header('Location:'.$long_url.'?phone='.$payload['phone'])


?>