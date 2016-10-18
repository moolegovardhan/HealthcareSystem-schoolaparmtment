<?php session_start(); ?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>



<?php
 $_SESSION['message'] = "";
 
 include_once 'CreateFolder.php';
//include_once 'AppointmentData.php';
include_once 'BusinessHSMDatabase.php';
include_once 'MasterData.php';
$md = new MasterData();

$name =$_SESSION['logeduser'];
$patientid =$_SESSION['userid'];
$appointmentdate =$_POST['start'];
$documentname =$_POST['documentname'];

if(isset($_POST['filepres'])){
    
    
    $cf = new CreateFolder();
    $cf->createDirectory($name,"Document");
    $target_dir = "/Transcripts/".$name."/Document/"; 
     $target_file = $target_dir . basename($_FILES["filepres"]["name"]);
    // echo "Target File ".$target_file;
    move_uploaded_file($_FILES["filepres"]["tmp_name"], $target_file);
    
    $datetoChange = explode(".", $appointmentdate);
    $appDate = $datetoChange[2]."-".$datetoChange[1]."-".$datetoChange[0];
    insertPrescriptionDiagnosisTranscriptsDetails($patientid,$_FILES["filepres"]["name"],$target_dir,"Document",$name,$appDate,$documentname);
    
    
}
   function insertPrescriptionDiagnosisTranscriptsDetails($patientid,$fileName,$path,$reportType,$patientName,$appointmentdate,$documentname){
        $dbConnection = new BusinessHSMDatabase();
     
        try{
       //  $sql = "INSERT INTO patienttranscripts(filename,path,reporttype,patientname) VALUES(:fileName,:path,:reportType,:patientname)";   
       $sql = "INSERT INTO patienttranscripts
(patientid, appointmentdate, reportname, filename, path, reporttype, status, patientname) 
VALUES ($patientid, '$appointmentdate', '$documentname', :fileName, :path, :reportType, 'P', :patientname)";
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
        
    }
    
     $_SESSION['message'] = "Document Posted Successfull";  
  echo '<script>window.location="../Web/patient/patientindex.php?page=olddata"</script>';
 
 ?>