<?php
include_once 'PatientData.php';
class AppointmentEmail {
   
    
    function sendMail($doctorName,$hospitalName,$name,$appointmentDate,$appointmentTime,$patientId){
        $pd = new PatientData();
        $result = $pd->patientDetails($patientId);
        $data = json_decode($result);
        $email = $data->email;
        
        $to = $email;
        $subject = "CGS Health System : Appointment Confirmation";

        $message = '<html>';
        $message =$message.'<head>';
        $message =$message.'<meta charset="UTF-8">';
        $message =$message.'<title></title>';
        $message =$message.'</head>';
        $message =$message.'<body>';
        $message =$message.'<table width="50%" border="1" align="center" cellpadding="0" style="border-collapse: collapse;border-style:dotted">';
        $message =$message.'<tr bgcolor="#F7BE81" style="border-color:#FFFFFF">';
        $message =$message.'<td colspan="3" align="center"><b><i>CGS Health Systems</i></b></td>';
        $message =$message.'</tr>';
        $message =$message.'<tr  style="border-color:#FFFFFF">';
        $message =$message.'<td rowspan="5"><b><img src=../Transcripts/'.$name.'></b></td>';
        $message =$message.'</tr>';
        $message =$message.'<tr style="border-color:#FFFFFF">';
        $message =$message.'<td><b>Doctor Name</b></td>';
        $message =$message.'<td colspan="2">'.$doctorName.'</td>';
        $message =$message.'</tr>';
        $message =$message.'<tr style="border-color:#FFFFFF">';
        $message =$message.' <td><b>Hospital Name</b></td>';
        $message =$message.' <td colspan="2">'.$hospitalName.'</td>';
        $message =$message.' </tr>';
        $message =$message.'<tr style="border-color:#FFFFFF">';
        $message =$message.'<td><b>Appointment Date</b></td>';
        $message =$message.'<td colspan="2">'.$appointmentDate.'</td>';
        $message =$message.'</tr>';
        $message =$message.'<tr style="border-color:#FFFFFF">';
        $message =$message.'<td><b>Appointment Timing</b></td>';
        $message =$message.' <td colspan="2">'.$appointmentTime.'</td>';
         $message =$message.'</tr>';
        $message =$message.' </table>';
        $message =$message.'</body>';
        $message =$message.'</html>';
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: info@cgshealthcare.com' . "\r\n";

        mail($to,$subject,$message,$headers);
    }
    
}

            
            
 ?>           