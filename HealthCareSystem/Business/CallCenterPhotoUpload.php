<?php session_start(); ?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>



<?php
 $_SESSION['message'] = "";
 
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhotoUpload
 *
 * @author pkumarku
 */

include_once 'CreateFolder.php';
//include_once 'AppointmentData.php';
include_once 'BusinessHSMDatabase.php';
include_once 'MasterData.php';
$md = new MasterData();


$name =$_POST['name'];
$mName =$_POST['mname'];
$lName =$_POST['lname'];
$patientName =$name." ".$mName." ".$lName;
$patientId =$_POST['selectedpatientid'];
echo "Patient Id".$patientId;echo "<br/>";
//echo "Patient Name : ".$patientName;echo "<br/>";
// echo "Photo Name : ".$_POST['filepres'];   echo "<br/>";
$patientData = $md->patientList('Others', $patientName, 'nodata');
$userId = $patientData[0]->ID;
echo "User ID ...................".$userId;
echo "newuser.....................".$_POST['newuser'];
if(isset($_POST['filepres'])){
      
        $cf = new CreateFolder();
        $cf->createDirectory($patientName,"Photo");
        $target_dir = "../Transcripts/".$patientName."/Photo/";
        //echo $target_dir;
        //echo "<br/>";
       //$appointmentId ="150";
        $target_file = $target_dir . basename($_FILES["filepres"]["name"]);
        // echo "Target File ".$target_file;
        move_uploaded_file($_FILES["filepres"]["tmp_name"], $target_file);
        insertPrescriptionDiagnosisTranscriptsDetails($_FILES["filepres"]["name"],$target_dir,"Photo",$patientName);
        //($patientId,$fileName,$path,$reportType,$appointmentId)
        insertCardDetails($_POST['cardtype'],$_POST['newuser']);
    }
    
    function insertCardDetails($cardType,$userId){ 
        
        $dbConnection = new BusinessHSMDatabase();
     
        try{
         $sql = "INSERT INTO patient_card (patientid,cardtype,status,distribution_date,hospitalid) VALUES(:patientid,:cardtype,'Y',CURDATE(),'CALCENTER')";   
           // echo $sql;
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("patientid", $userId);
                $stmt->bindParam("cardtype", $_POST['cardtype']);
                $stmt->execute();  
                $masterData = $db->lastInsertId();
             
                $db = null;
              
                //return $presMasterData;
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
        
    } 
        
    
    
     function insertPrescriptionDiagnosisTranscriptsDetails($fileName,$path,$reportType,$patientName){
        $dbConnection = new BusinessHSMDatabase();
     
        try{
         $sql = "INSERT INTO patienttranscripts(filename,path,reporttype,patientname) VALUES(:fileName,:path,:reportType,:patientname)";   
           // echo $sql;
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("fileName", $fileName);
                $stmt->bindParam("path", $path);
                $stmt->bindParam("reportType", $reportType);
                $stmt->bindParam("patientname", $patientName);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
             
                $db = null;
              
                //return $presMasterData;
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
    }//Business/GenerateIDCardPDF.php?patientid=121
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Business/GenerateIDCardPDF.php?patientid=".$userId;
   // echo $url;
   echo "<script> window.open('".$url."', '_blank')</script>";
   
  $_SESSION['message'] = "User Registration Successfull";  
  //echo '<script>window.location="../Web/callcenter/callcenterindex.php?page=registerPatient"</script>';
