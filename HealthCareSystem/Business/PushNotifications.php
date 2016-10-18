<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include_once 'FetchSendPushNotificationData.php';
            include_once 'ReminderServices.php';
            try{
                
                if($_GET['page'] == "test"){ 
                     $fm = new FetchSendPushNotificationData();
                     //$fm->sendpushforandroid("Hello",);
                }else if($_GET['page'] == "Last3DaysPrescriptions"){
                    
                     $fm = new FetchSendPushNotificationData();
                     $rs = new ReminderServices();
                     $result = $rs->fetchLast3DaysPrescriptions();
                     foreach($result as $data){
                        $registatoin_id =  ($data->udid);//$device_udid;
                        if($registatoin_id != "")
                            $fm->sendpushforandroid(HSMMessages::$last3DaysPrescription,$registatoin_id);
                     }
                     
                }else if($_GET['page'] == "Next3DaysAppointment"){
                     $fm = new FetchSendPushNotificationData();
                     $rs = new ReminderServices();
                     $result = $rs->fetchNext3DaysPrescriptions();
                     foreach($result as $data){
                         print_r($data->udid);
                         print_r($data);
                        $registatoin_id =  ($data->udid);//$device_udid;
                        $message = "Reminder !.You have an appointment with : ".$data->doctorname." on :".$data->nextappointmentdt;
                        if($registatoin_id != "")
                            $fm->sendpushforandroid($message,$registatoin_id);
                     }
                }     
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        ?>
    </body>
</html>
