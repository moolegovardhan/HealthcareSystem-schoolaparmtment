<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SendMessageToPatient
 *
 * @author pkumarku
 */
class SendMessageToPatient {

    
    
    
    
function sendSMS($message,$mobileNumber){
 
// create a new cURL resource
$ch = curl_init();

    try
    {
    //print_r("sending SMS");
			
    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone=".$mobileNumber."&text=".urlencode($message )."&priority=ndnd&stype=normal");
//echo ("http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone=".$mobileNumber."&text=".urlencode($message )."&priority=ndnd&stype=normal");
    curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // grab URL and pass it to the browser
    curl_exec($ch); 
    }
    catch (Exception $e)
    {
        echo($e->getMessage());
    }
// close cURL resource, and free up system resources
curl_close($ch);
}



}
