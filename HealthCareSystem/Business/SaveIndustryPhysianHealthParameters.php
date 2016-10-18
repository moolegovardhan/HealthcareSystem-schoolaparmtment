<?php
session_start();
?>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <?php session_start(); ?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
include_once 'BusinessHSMDatabase.php';

include_once 'MasterData.php';
include_once 'AppointmentData.php';
include_once 'SchoolData.php';

$ad = new AppointmentData();
$sd = new SchoolData();
$md = new MasterData();

$patientid = $_POST['pappointmentempid'];
$appointmentid = $_POST['pappointmentid'];
$officeid = $_SESSION['officeid'];
$userid = $_SESSION['userid'];
$classid = $_POST['pclassid'];
$doctor = $_POST['pptodoctor'];
$pcomplaints = $_POST['pcomplaints'];
$pobservations = $_POST['pobservations'];

$appInfo = $sd->fetchAppointmentDate($appointmentid);
$studentInfo = $sd->fetchStudentName($patientid);
$cgsHospital = $md->fetchCGSHospital();
$cgsMedicalShop = $md->fetchCGSMedicalShop();
//$doctorDetails = $md->userMasterData($doctor);
$appointment = $ad->createAppointment($cgsHospital[0]->id,$doctor,$appInfo[0]->appointmentdate,"00:00 - 00:00",$patientid,'Y',$studentInfo[0]->name,"");
    //print_r($appointment);General
//$sql = "update industry_appointment set generalappointment = '$appointment' where id = $appointmentid";

$sql = "INSERT INTO healthcare.industry_employee_appointment_mapping
(industryid, employee, appointmentid, generalappointment, status, createddate, createdby) 
VALUES ('$officeid', '$patientid', '$appointmentid', '$appointment', 'Y', CURDATE(), $userid)";

$dbConnection = new BusinessHSMDatabase();
            try{
                $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql); 
                 
                $stmt->execute();
                $appointment1 = $db->lastInsertId();
                $db = null;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
 $receiptid ="";//print_r($appointment);
    try{        
     $receiptsql = "select receiptid from appointment where id = $appointment";       
                       $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($receiptsql);  
                        $stmt->execute();

                        $receiptid = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
         } catch (Exception $ex) {
                echo "ffffffffffffff".$ex->getMessage();
            }            
            $amount = "0";
            $receipt = $receiptid[0]->receiptid;
           
            $amountsql = "update appointment set amount = $amount where id = $appointment";
$dbConnection = new BusinessHSMDatabase();
            try{
                $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($amountsql); 
                 
                $stmt->execute();
               
                $db = null;
            } catch (Exception $ex) {
                echo  "fffssssssssssssssssssfffffffffff".$ex->getMessage();
            }
            
 $ad->insertPatientPrescriptionDetails($appointment,$patientid,$studentInfo[0]->name,
         $pcomplaints,$doctor,$cgsHospital[0]->id,$appInfo[0]->appointmentdate,$appInfo[0]->appointmentdate,$cgsMedicalShop->id,'N',$pobservations);           
     
 
 $ad->insertPrescriptionDiagnosisDetails("DIAGNOSIS CENTER",$_POST['presdiagnostics'],$appointment,$patientid,$receipt);

foreach ($_POST['presdiseases'] as $selectedOption2){
      $ad->insertPrescriptionDiagnosisDetails("DISEASES",$selectedOption2,$appointment,$patientid,$receipt);
}

foreach ($_POST['presmedicaltest'] as $selectedOptionq){
    $namevalue = $selectedOptionq;
    $ad->insertPrescriptionDiagnosisDetails("MEDICAL TEST",$namevalue,$appointment,$patientid,$receipt);
}
 
$counter =$_POST['counter'];

for($i = 1;$i<$counter+1;$i++){
    //echo "Counter ".$i." : ".$_POST['textbox'.$i];echo "<br/>";
    $data = $_POST['textbox'.$i];
    if(strlen($data) > 1){
        $dataArray = explode("#", $data);
     $medicineName = "";
    if($dataArray[0] != "nogmedicine") 
        $medicineName = $dataArray[0];
    else if($dataArray[1] != "nodmedicine") 
         $medicineName = $dataArray[1];
    else if($dataArray[9] != "noomedicine") 
         $medicineName = $dataArray[9];
 //   echo $medicineName;echo "<br/>";
        $ad->insertPrescriptionDiagnosisMedicenesDetails($patientid, $medicineName, 
             (($dataArray[3] == 0) ? "N" : "Y"), (($dataArray[4] == 0) ? "N" : "Y"), 
                (($dataArray[5] == 0) ? "N" : "Y"), (($dataArray[6] == 0) ? "N" : "Y"), 
                (($dataArray[7] == 0) ? "N" : "Y"), (($dataArray[8] == 0) ? "N" : "Y"),
                $appointment, $dataArray[2], $dataArray[10]);   
        
    }
//echo "<br/>";echo "<br/>";
}


            
$message = "Industry Employee  Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/industry/industryindex.php?page=checkup";
               

?>  
   
<script  type="text/javascript">
    
setTimeout(function () {
    
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 200);

</script>
