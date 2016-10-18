<?php 
session_start();
?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php 
try{
include_once 'AppointmentData.php';
include_once 'CreateFolder.php';
$ad = new AppointmentData(); 

echo ("hidhospitalName Name : ".$_POST['hidhospitalName']);echo "<br/>";
echo ("hidhospitalId ID : ".$_POST['hidhospitalId']);echo "<br/>";
echo ("Patient  ID : ".$_POST['hiddenpatientId']);echo "<br/>";
echo ("presdiseases : ");echo "<br/>";
print_r($_POST['presdiseases']);
echo "<br/>";
echo ("presdiagnostics : ".$_POST['presdiagnostics']);echo "<br/>";
print_r($_POST['presdiagnostics']);
echo "<br/>";

$patientName = $_POST['hiddenpatientName'];
$patientId = $_POST['hiddenpatientId'];
$doctorName = $_POST['hiddendoctorName'];
$hospitalName = $_POST['hidhospitalName'];
$doctorId = $_POST['hiddendoctorId'];
$hospitalId = $_POST['hidhospitalId'];
$appointmentId = $_POST['hidappointmentId'];
$appointmentDate = $_POST['hidappointmentDate'];
$nextappointment = $_POST['start'];
$description = $_POST['description'];
$suggestions = $_POST['suggestions'];
$medicalshop = $_POST['presmedicalshop'];
$inpatient = ($_POST['inpatient'] == 'inpatient') ? "Y" : "N";
$counter = $_POST['counter'];
$weight = $_POST['oweight'];
$bp = $_POST['obp'];
$month = $_POST['omonth'];
echo ("hidappointmentDate ID : ".$_POST['hidappointmentDate']);echo "<br/>";
echo ("start ID : ".$_POST['start']);echo "<br/>";
echo ("hiddenpatientName ID : ".$_POST['hiddenpatientName']);echo "<br/>";
//$explodeDate = explode(".", $nextappointment);
if(!stripos($nextappointment,'-') ){
$explodeDate = explode(".", $nextappointment);

$nextappointmentdt = $explodeDate[2]."-".$explodeDate[1]."-".$explodeDate[0];
}else{
   $nextappointmentdt =  $nextappointment;
}

if($inpatient == 'Y'){
$ad->updateAppointmentForInpatient($appointmentId);
}
$ad->insertPregnancyPatientPrescriptionDetails($appointmentId, $patientId, $patientName,$description, $doctorId, $hospitalId, $appointmentDate, $nextappointmentdt,$medicalshop,$inpatient,$suggestions,$weight,$bp,$month);


$ad->insertPrescriptionDiagnosisDetails("DIAGNOSIS CENTER",$_POST['presdiagnostics'],$appointmentId,$patientId);

foreach ($_POST['presdiseases'] as $selectedOption2){
      $ad->insertPrescriptionDiagnosisDetails("DISEASES",$selectedOption2,$appointmentId,$patientId);
}

foreach ($_POST['presmedicaltest'] as $selectedOptionq){
    $namevalue = $selectedOptionq;
    $ad->insertPrescriptionDiagnosisDetails("MEDICAL TEST",$namevalue,$appointmentId,$patientId);
}


for($i = 1;$i<$counter+1;$i++){
    //echo "Counter ".$i." : ".$_POST['textbox'.$i];echo "<br/>";
    $data = $_POST['textbox'.$i];
    if(strlen($data) > 1){
        $dataArray = explode("#", $data);
     //   print_r($dataArray);echo "<br/>";
   //   Counter 1 : Comblifuen#nodmedicine#2#0#0#0#0#0#1
//Array ( [0] => Comblifuen [1] => nodmedicine [2] => 2 [3] => 0 [4] => 0 [5] => 0 [6] => 0 [7] => 0 [8] => 1 )   
    $medicineName = "";
    if($dataArray[0] != "nogmedicine") 
        $medicineName = $dataArray[0];
    else if($dataArray[1] != "nodmedicine") 
         $medicineName = $dataArray[1];
    else if($dataArray[9] != "noomedicine") 
         $medicineName = $dataArray[9];
 //   echo $medicineName;echo "<br/>";
        $ad->insertPrescriptionDiagnosisMedicenesDetails($patientId, $medicineName, 
             (($dataArray[3] == 0) ? "N" : "Y"), (($dataArray[4] == 0) ? "N" : "Y"), 
                (($dataArray[5] == 0) ? "N" : "Y"), (($dataArray[6] == 0) ? "N" : "Y"), 
                (($dataArray[7] == 0) ? "N" : "Y"), (($dataArray[8] == 0) ? "N" : "Y"),
                $appointmentId, $dataArray[2], $dataArray[10]);   
        
    }
//echo "<br/>";echo "<br/>";
}//end of for loop

try{
if(isset($patientName)){

        $patientName = $patientName;
        //echo $patientName;
     //echo "<br/>";
   /* if(isset($_POST['filepres'])){
        $cf = new CreateFolder();
        $cf->createDirectory($patientName,"Prescription");
        $target_dir = "Transcripts/".$patientName."/Prescription/";
        //echo $target_dir;
        //echo "<br/>";
       
        $target_file = $target_dir . basename($_FILES["filepres"]["name"]);
        //echo "<br/>";echo $target_file;echo "<br/>";
        move_uploaded_file($_FILES["filepres"]["tmp_name"], "../".$target_file);
        $pd->insertPrescriptionDiagnosisTranscriptsDetails($patientId,$_FILES["filepres"]["name"],$target_dir,"Prescription",$appointmentId,$patientName);
        //($patientId,$fileName,$path,$reportType,$appointmentId)
    }
   */ 
    foreach ($_FILES['files']['name'] as $f => $name) {
        
      $count++;    
    }
    //echo "FIle Count is ".$count;
    //echo "<br/>";
    if($count > 0){
        
        $cf = new CreateFolder();
        $cf->createDirectory($patientName,"Prescription");
        
        
         foreach ($_FILES['files']['name'] as $f => $name) {
             //echo "In Multiple File Upload "; echo "<br/>";
            $target_dir = "../Transcripts/".$patientName."/Prescription/";
             //echo $target_dir;
            // echo "<br/>";
            //$target_file = $target_dir . basename($_FILES["files"]["name"]);
           //  echo "<br/>";
           // echo "Reports".$target_file;
            // echo "<br/>";
            move_uploaded_file($_FILES["files"]["tmp_name"][$f], "../".$target_dir.$name);
                                                                //$patientId,$fileName,$path,$reportType,$appointmentId,$patientname,$reportid,$reportname  
            $reportid = "";$reportname = "";
	        $ad->insertPrescriptionDiagnosisTranscriptsDetails($patientId,$name,$target_dir,"Prescription",$appointmentId,$patientName,$reportid,$reportname);
	     }
        
      $count++;    
    }
   // header('Status: 301 Moved Permanently', false, 301);       
   //header("Location:staffindex.php?page=prescription"); 
  //   echo '<script>window.location="../Web/staff/staffindex.php?page=prescription"</script>';
}
}catch(Exception $e){
    echo $e->getMessage();   
}

$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Business/GeneratePregnancyPrescriptionPDF.php?appointmentid=".$appointmentId;
    echo "Urlllllllll........".$url;
 echo "<script> window.open('".$url."', '_blank')</script>";


 $message = "Data Updated Successfully. ";
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=pregnancyprescription";
}catch(Exception $ex){
    $message = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=pregnancyprescription";
}

?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>