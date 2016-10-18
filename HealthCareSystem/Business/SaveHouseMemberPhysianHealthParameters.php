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
include_once 'VillageData.php';

$ad = new AppointmentData();
$sd = new VillageData();
$md = new MasterData();

$patientid = $_POST['pappointmenthousememberid'];
$appointmentid = $_POST['phyappointmentdate'];
$officeid = $_SESSION['officeid'];
$userid = $_SESSION['userid'];
$phousenumber = $_POST['phousenumber'];
$doctor = $_POST['pptodoctor'];
$pcomplaints = $_POST['pcomplaints'];
$pobservations = $_POST['pobservations'];

//echo "Patientid....................".$patientid;echo "<br/>";

$appInfo = $sd->fetchAppointmentDate($appointmentid);
$memberInfo = $md->userMasterData($patientid);
$cgsHospital = $md->fetchCGSHospital();
$cgsMedicalShop = $md->fetchCGSMedicalShop();
//$doctorDetails = $md->userMasterData($doctor);

//echo "<br/>";    echo $memberInfo;echo "<br/>";

$appointment = $ad->createAppointment($cgsHospital[0]->id,$doctor,$appInfo[0]->appointmentdate,"00:00 - 00:00",$patientid,'Y',$memberInfo[0]->name,"General");
   // print_r($appointment);
//$sql = "update village_appointment set generalappointment = '$appointment' where id = $appointmentid";
//echo "<br/>";echo $sql;
$sql = "INSERT INTO village_member_appointment_mapping
(apartmentid, memberid, appointmentid, generalappointment, status, createddate, createdby) 
VALUES ('$officeid', '$patientid', '$appointmentid', '$appointment', 'Y', CURDATE(), '$userid')";

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
    // echo "<br/>";echo $receiptsql;
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
        //    echo "<br/>";echo $amountsql;
$dbConnection = new BusinessHSMDatabase();
            try{
                $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($amountsql); 
                 
                $stmt->execute();
               
                $db = null;
            } catch (Exception $ex) {
                echo  "fffssssssssssssssssssfffffffffff".$ex->getMessage();
            }
       // echo "<br/>";    echo $memberInfo[0]->ID;echo "<br/>";
 $ad->insertPatientPrescriptionDetails($appointment,$memberInfo[0]->ID,$memberInfo[0]->name,
         $pcomplaints,$doctor,$cgsHospital[0]->id,$appInfo[0]->appointmentdate,$appInfo[0]->appointmentdate,$cgsMedicalShop->id,'N',$pobservations);           
     
 
 $ad->insertPrescriptionDiagnosisDetails("DIAGNOSIS CENTER",$_POST['presdiagnostics'],$appointment,$memberInfo[0]->ID,$receipt);

foreach ($_POST['presdiseases'] as $selectedOption2){
      $ad->insertPrescriptionDiagnosisDetails("DISEASES",$selectedOption2,$appointment,$memberInfo[0]->ID,$receipt);
}

foreach ($_POST['presmedicaltest'] as $selectedOptionq){
    $namevalue = $selectedOptionq;
    $ad->insertPrescriptionDiagnosisDetails("MEDICAL TEST",$namevalue,$appointment,$memberInfo[0]->ID,$receipt);
}
 
$counter =$_POST['villcounter'];
//echo "illcounter..........".$counter;
for($i = 1;$i<$counter+1;$i++){
  //  echo "Counter ".$i." : ".$_POST['textbox'.$i];echo "<br/>";
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


            
$message = "Member  Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/village/villageindex.php?page=checkup";
               

?>  
   
<script  type="text/javascript">
    
setTimeout(function () {
    
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 200);

</script>
