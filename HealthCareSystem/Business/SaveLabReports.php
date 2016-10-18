<?php session_start(); 
//$message = "Thanks ! For Booking Appointment with Doctor : ".$doctor." at Hospital : ".$hosiptal." on ".$appdate." at ".$slot." From CGS Health Care";

//SendMessageToPatient
$message = "";
$message = $message."<html>";
$message = $message."<head>";
$message = $message."<meta charset='UTF-8'>";
?>
<br/><br/><br/><br/>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<style> 
  .textbox { 
    height: 25px; 
    width: 75px; 
    background-color: transparent;  
    border-style: solid;  
    border-width: 0px 0px 1px 0px;  
    border-color: darkred; 
    outline:0; 
  } 
  .btnExample {
  color: #900;
  background: #FF0;
  font-weight: bold;
  border: 1px solid #900;
}
 
.btnExample:hover {
  color: #FFF;
  background: #900;
}
 </style> 
 <input type="hidden" name="appointmentid" id="appointmentid" value="<?php  echo $appointmentId; ?>"/>
    <div id="printbutton">
 <!--button class="btnExample" onclick="myFunction()" type="button" value="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button-->
 </div><br/>
<?php 

include_once 'CreateFolder.php';
include_once 'PatientData.php'; 
include_once 'PatientPrescription.php';
include_once 'AppointmentData.php';
include_once 'SendMessageToPatient.php';

$sms = new SendMessageToPatient();
$ad = new AppointmentData();
$pd = new PatientData();
$pp = new PatientPrescription();

$patientid = $_POST['patientid'];
$appointmentid = $_POST['appointmentid'];
$counter = $_POST['counter'];

$appData = $ad->getAppointmentPatientList("nodata",$patientid,"nodata");
$patientdetdata = json_decode($pd->patientDetails($patientid));
$date = (date('ymdHis'));//echo "<br/>";
$receiptId =  "HCM".$date."TESTRESULT".mt_rand(0, 999);


 $message = $message."<title></title>";
$message = $message." </head>";
$message = $message."<body>";
      
$message = $message."<div class='tg-wrap'>";
$message = $message."<table width='70%' align='center'>";
$message = $message." <tr style='background-color:orange;'><td colspan='6' align='center'>". $_SESSION['logeduser']."</td></tr>";
$message = $message." <tr><td>Receipt #</td><td>".$receiptId."</td><td>Date</td><td>".date("F j, Y")."</td><td>PW</td><td></td></tr>";
$message = $message." <tr><td>Patient ID</td><td>".$patientid."</td><td>Age/Sex</td><td>".$patientdetdata[0]->age."/".$patientdetdata[0]->gender."</td><td colspan='2' rowspan='3'></td></tr>";
$message = $message." <tr><td>Patient Name</td><td>".$patientdetdata[0]->name."</td><td></td><td></td></tr>";
$message = $message."<tr><td>Ref Doctor</td><td>".$appData[0]->DoctorName."</td><td></td><td></td></tr>";
$message = $message." <tr><td colspan='6'><hr/></td></tr>";
$message = $message."<tr ><td><b>Test Name</b></td><td><b>Paramter Name</b></td><td colspan='3'><b>Value</b></td><td colspan='4'><b>References</b></td></tr>";
$message = $message." <tr><td colspan='6'><hr/></td></tr>";
$reportresultsmsmsg = "";

for($i=1;$i<$_POST['counter']+1;$i++){

    $data = explode("_",$_POST['textbox'.$i]);
  //print_r($data);
    if(count($data) > 1){
        $reportId = $data[0];
        $reportName = $data[1];
        $parameterId = $data[2];
        $parameterName = $data[3];
        $units = $data[4];
        $reportresult = $data[5];
        $testId = $data[6];
        $consultationdiagnosticsid = 123;
        $userId = $_SESSION['userid'];
         $filename = 'file'.$reportId;
         
         $pd = new PatientData();
         $pp = new PatientPrescription();
         $ad = new AppointmentData();
         
         $patientData = $pd->patientDetails($patientid);
        // echo "Printing Data :";
        // print_r(json_decode($patientData)[0]);
        // echo "<br/>";
         $patientName = json_decode($patientData)[0]->name;
         
       //  echo $patientName;echo "<br/>";
      
      try{   
      	
       $cf = new CreateFolder();
       $cf->createDirectory($patientName,"Reports");
       $target_dir = "../Transcripts/".$patientName."/Reports/";
      // echo "Target Directory : ".$target_dir;echo "<br/>";
       $target_file = $target_dir . basename($_FILES[$filename]["name"]);
       // echo "Target File : ".$target_file;echo "<br/>";
       // echo "Target Temp File : ".$_FILES[$filename]["tmp_name"];echo "<br/>"; 
         move_uploaded_file($_FILES[$filename]["tmp_name"], $target_file);
         //    echo "User Id : ".$userId;echo "<br/>";
         /*
          * Wrong consultation ID is passed
          */                                              //$appointmentId,$patientid,$parameterId,$units,$reportresult,$reportId,$testId,$consultationdiagnosticsId,$userId
       $result = $pp->insertPatientAppointmentLabTestReport($appointmentid,$patientid,$parameterId,$units,$reportresult,$reportId,$testId,"123",$userId);
     
       $transcripts = $ad->insertPrescriptionDiagnosisTranscriptsDetails($patientid,(basename($_FILES[$filename]["name"])),$target_dir,"Reports",$appointmentid,$patientName,$reportId,$reportName);
       
       $updateconsultation = $pp->updateConsultationDiagnosisDetails($appointmentid);
      
     //  $message = "Thanks ! For Booking Appointment with Doctor : ".$doctor." at Hospital : ".$hosiptal." on ".$appdate." at ".$slot." From CGS Health Care";
      
      // echo "Parameter ID : ".$parameterId;
       $result = $pp->fetchParameterName($parameterId);
       //print_r($result);
        $message = $message."<tr><td>".$result[0]->testname."</td><td>".$result[0]->parametername."</td><td colspan='3'>".$reportresult."</td><td colspan='4'>".$result[0]->bioref."</td></tr>";
       
       $reportresultsmsmsg = $reportresultsmsmsg." Test Name :  ".$result[0]->testname." Parameter Name : ".$result[0]->parametername." Test Value : ".$reportresult. "  ";
       
      }  catch (Exception $ex){
          echo "In Exception";
          echo $ex->getMessage();
          echo $ex->getFile();
      }
      
    }
}
 
        //echo  "Mobile Number ".$data[0]->mobile;
        //print_r($patientdetdata);echo "<br/>";
        $mobile = $patientdetdata[0]->mobile;
        //$mobile = "7760059002";
        $smsmessage = $_SESSION['labnametoshow']. " :  Your reports are ready. ".$patientdetdata[0]->name." Please collect reports. Results ".$reportresultsmsmsg;
       
       $sms->sendSMS($smsmessage, $mobile);
       
       
       
$message = $message."<tr><td colspan='6'><hr/></td></tr>";
$message = $message."</table>";
$message = $message." </div>";
	  
	  
$message = $message." </body>";
$message = $message."</html>";

print_r($message);



//echo $_POST['counter'];
/*
for($i=0;$i<$_POST['counter']+1;$i++){
     echo "<br/>";
    echo "i value = ".$i;
    echo $_POST['textbox'.$i];
    $data = split("_",$_POST['textbox'.$i]);echo "<br/>";
    print_r($data);  echo "<br/>";
       echo "Count ".count($data); echo "<br/>";
    if(count($data) > 1){
        echo ($data[0]);
        $reportId = $data[0];
        $filename = 'file'.$reportId;
        echo "File Name : ".$filename; echo "<br/>";
        echo $_POST[$filename];  echo "<br/>";
        echo "Name : ".basename($_FILES[$filename]["name"]);  echo "<br/>";
        echo "temp name : ".basename($_FILES[$filename]["tmp_name"]);  echo "<br/>";
        move_uploaded_file($_FILES[$filename]["tmp_name"], "/");
         move_uploaded_file($_FILES[$filename]["name"], "/");
    }
    
    echo "<br/>";
    
}
*/
 $alertmessage = "Reports Updated Successfull";
 $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=patientResults";
               
//$_SESSION['message'] = "Reports Updated Successfull"; 

//echo "<script>$('#labErrorMessage').html('<b>Info : Reports Updated Successfully</b>');  $('#labErrorBlock').show(); window.location='../Web/lab/labindex.php?page=patientResults'</script>";
?>

<script>
setTimeout(function () {
    alert("<?php echo $alertmessage ;?>");
    $('#printbutton').hide();
    
    window.print();
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 5000);

</script>
 <script>
function myFunction() {
    
    $('#printbutton').hide();
    
    window.print();
    
   // window.location.href='<?php  echo $url; ?>'+$('#paidamount').val();
}
</script>