<?php session_start(); 


?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>


<?php 

include_once 'CreateFolder.php';
include_once 'PatientData.php'; 
include_once 'PatientPrescription.php';
include_once 'AppointmentData.php';

$patientid = $_POST['patientid'];
$appointmentid = $_POST['appointmentid'];
$counter = $_POST['counter'];

 echo "Patient ID : ".$patientid;echo "<br/>";
  echo "Appointment ID : ".$appointmentid;echo "<br/>";
   echo "COunter : ".$counter;echo "<br/>";

for($i=0;$i<$_POST['counter']+1;$i++){
    $data = split("_",$_POST['textbox'.$i]);
   // (reportId+"_"+reportName+"_"+parameterName+"_"+parameterValue1+"_"+parameterValue2+"_"+parameterValue3); 
    if(count($data) > 1){
      
        $reportId = $data[0];
        $reportName = $data[1];
        $parameterName = $data[2];
        $parameterValue1 = $data[3];
        $parameterValue2 = $data[4];
        $parameterValue3 = $data[5];
         $filename = 'file'.$reportId;
        
         $pd = new PatientData();
         $pp = new PatientPrescription();
         $ad = new AppointmentData();
         
         $patientData = $pd->patientDetails($patientid);
         echo "Printing Data :";
         print_r(json_decode($patientData)[0]);
         echo "<br/>";
         $patientName = json_decode($patientData)[0]->name;
         
         echo $patientName;echo "<br/>";
      
      try{   
       $cf = new CreateFolder();
       $cf->createDirectory($patientName,"Reports");
       $target_dir = "../Transcripts/".$patientName."/Reports/";
       echo "Target Directory : ".$target_dir;echo "<br/>";
       $target_file = $target_dir . basename($_FILES[$filename]["name"]);
        echo "Target File : ".$target_file;echo "<br/>";
        echo "Target Temp File : ".$_FILES[$filename]["tmp_name"];echo "<br/>"; 
         move_uploaded_file($_FILES[$filename]["tmp_name"], $target_file);
       
       $result = $pp->insertPatientAppointmentTestReportParameters($appointmentid,$patientid,$patientName,$parameterName,$parameterValue1,$parameterValue2,$parameterValue3,$reportId,$reportName);
     
       $transcripts = $ad->insertPrescriptionDiagnosisTranscriptsDetails($patientid,(basename($_FILES[$filename]["name"])),$target_dir,"Reports",$appointmentid,$patientName,$reportId,$reportName);
       
      }  catch (Exception $ex){
          echo "In Exception";
          echo $ex->getMessage();
          echo $ex->getFile();
      }
      
    }
}





echo $_POST['counter'];
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
//$_SESSION['message'] = "Reports Updated Successfull"; 


?>

 echo '<script>$('#adminStaffErrorMessage').html("<b>Info : Reports Updated Successfully</b>");  $('#adminStaffErrorBlock').show(); window.location="../Web/staff/staffindex.php?page=patientreport"</script>';