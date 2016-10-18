<?php
include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FetchSendPushNotificationData
 *
 * @author pkumarku
 */
class FetchSendPushNotificationData {
    
    function fetchUDID($userid){
        
        $sql = " select mobile,udid from users where username = :userid ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("userid", $userid);
                $stmt->execute();
                $userData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $userData[0];



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function createMessage($message,$general){
        
    }
    
    
   function sendpushforandroid($message,$udid)
    {
       try{
      // Set POST variables
            $url = 'https://android.googleapis.com/gcm/send';
            define("GOOGLE_API_KEY", "AIzaSyB9lJrhE3RYh6QWXD2-G2hMCjLvsoRw1jg");//  AIzaSyBW3ucgY9os6ref_ysmk7zm-7213qs9NFs
            $headers = array(
                'Authorization: key=' . GOOGLE_API_KEY,
                'Content-Type: application/json'
            );

                            // Open connection
                        $ch = curl_init();

                        // Set the url, number of POST vars, POST data
                        curl_setopt($ch, CURLOPT_URL, $url);

                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        // Disabling SSL Certificate support temporarly
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 20);


                        // prep the bundle
                        $message['gcm'] = array
                        (
                            'message'       => $message,
                            'title'         => "From Pro94Tek",
                            'subtitle'      => '',
                            'tickerText'    => '',
                            'vibrate'   => 1,
                            'sound'     => 1
                        );


                        print_r($udid);
                        $fields = array(
                            'registration_ids' => array($udid),
                            'data' => array("message" =>$message),
                        );



                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                   
                        // Execute post
                        $result = curl_exec($ch);

                        print_r($result);

                        if ($result === FALSE) {
                            die('Curl failed: ' . curl_error($ch));
                            echo "In Fail";
                            log_notice( 'Android push failed' );
                        }else
                        {
                            echo "in success....";
                            // log_notice( 'Android push success' );
                        }


            } catch (Exception $ex) {
                echo "Error in Sending Notification...".$ex->getMessage();
            }


    }

    
}
