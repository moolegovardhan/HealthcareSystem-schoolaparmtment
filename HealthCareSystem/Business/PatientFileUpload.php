
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
//sleep(500);
include_once 'CreateFolder.php';
include_once 'AppointmentData.php';

$pd = new AppointmentData();


$patientName =ltrim($_POST['selectedpatient']);
$patientName = rtrim($patientName);
$patientId =$_POST['selectedpatientid'];
$start =$_POST['start'];
$appointmentDate =$_POST['hidappointmentDate'];
$presdoctorid =$_POST['hidpresdoctorid'];
$preshosiptalid =$_POST['hidpreshosiptalid'];
$presdescription =$_POST['presdescription'];
$appointmentId =$_POST['appointmentId'];
$appointmentId = substr($appointmentId,4,strlen($appointmentId));
//echo "Appoint ID ".substr($appointmentId,4,strlen($appointmentId));
$inpatient = ($_POST['inpatient'] == 'inpatient') ? "Y" : "N";
$endDt = explode(".",$start);
$start = $endDt[2]."-".$endDt[1]."-".$endDt[0];

$pd->insertPatientPrescriptionDetails($appointmentId,$patientId,$patientName,$presdescription,$presdoctorid,$preshosiptalid,$appointmentDate,$start,$inpatient);

$count = 0;
foreach ($_POST['presmedicaltest'] as $selectedOptionq){
    $namevalue = $selectedOptionq;
    $pd->insertPrescriptionDiagnosisDetails("MEDICAL TEST",$namevalue,$appointmentId,$patientId);
}

 
foreach ($_POST['presdiagnosis'] as $selectedOption){
      $pd->insertPrescriptionDiagnosisDetails("DIAGNOSIS CENTER",$selectedOption,$appointmentId,$patientId);
}
foreach ($_POST['presdiseases'] as $selectedOption2){
      $pd->insertPrescriptionDiagnosisDetails("DISEASES",$selectedOption2,$appointmentId,$patientId);
}

/*
for($i=1;$i<11;$i++ ){
    echo "Count mbm".$i; echo "<br/>";
    echo $_POST["mbm".$i];echo "<br/>";
}
for($i=1;$i<11;$i++ ){
    echo "Count mam".$i; echo "<br/>";
    echo $_POST["mam".$i];echo "<br/>";
}
for($i=1;$i<11;$i++ ){
    echo "Count abm".$i; echo "<br/>";
    echo $_POST["abm".$i];echo "<br/>";
}
for($i=1;$i<11;$i++ ){
    echo "Count afm".$i; echo "<br/>";
    echo $_POST["afm".$i];echo "<br/>";
}
for($i=1;$i<11;$i++ ){
    echo "Count ebm".$i; echo "<br/>";
    echo $_POST["ebm".$i];echo "<br/>";
}

for($i=1;$i<11;$i++ ){
    echo "Count eam".$i; echo "<br/>";
    echo $_POST["eam".$i];echo "<br/>";
}
*/
for($i=1;$i<11;$i++){

    $medicineName = $_POST['mname'.$i];
    if(strlen($medicineName) < 1)
        continue;
    
 $mbf = $_POST['mbm'.$i];
$maf = $_POST['mam'.$i];
$abf = $_POST['abm'.$i];
$aaf = $_POST['afm'.$i];
$ebf = $_POST['ebm'.$i];
$eaf = $_POST['eam'.$i];
$noofdays = $_POST['days'.$i];
   // echo $appointmentId;echo "<br/>";
 $pd->insertPrescriptionDiagnosisMedicenesDetails($patientId,$medicineName,$mbf,$maf,$abf,$aaf,$ebf,$eaf,$appointmentId,$noofdays);
}
try{
if(isset($_POST['selectedpatient'])){

        $patientName = $_POST['selectedpatient'];
        //echo $patientName;
     //echo "<br/>";
    if(isset($_POST['filepres'])){
        $cf = new CreateFolder();
        $cf->createDirectory($patientName,"Prescription");
        $target_dir = "../Transcripts/".$patientName."/Prescription/";
        //echo $target_dir;
        //echo "<br/>";
       
        $target_file = $target_dir . basename($_FILES["filepres"]["name"]);
        //echo "<br/>";echo $target_file;echo "<br/>";
        move_uploaded_file($_FILES["filepres"]["tmp_name"], "../".$target_file);
        $pd->insertPrescriptionDiagnosisTranscriptsDetails($patientId,$_FILES["filepres"]["name"],$target_dir,"Prescription",$appointmentId,$patientName);
        //($patientId,$fileName,$path,$reportType,$appointmentId)
    }
    
    foreach ($_FILES['files']['name'] as $f => $name) {
        
      $count++;    
    }
    //echo "FIle Count is ".$count;
    //echo "<br/>";
    if($count > 0){
        
        $cf = new CreateFolder();
        $cf->createDirectory($patientName,"Reports");
        
        
         foreach ($_FILES['files']['name'] as $f => $name) {
             //echo "In Multiple File Upload "; echo "<br/>";
            $target_dir = "../Transcripts/".$patientName."/Reports/";
             //echo $target_dir;
            // echo "<br/>";
            //$target_file = $target_dir . basename($_FILES["files"]["name"]);
           //  echo "<br/>";
           // echo "Reports".$target_file;
            // echo "<br/>";
            move_uploaded_file($_FILES["files"]["tmp_name"][$f], "../".$target_dir.$name);
	        $pd->insertPrescriptionDiagnosisTranscriptsDetails($patientId,$name,$target_dir,"Reports",$appointmentId,$patientName);
	     }
        
      $count++;    
    }
   // header('Status: 301 Moved Permanently', false, 301);       
   //header("Location:staffindex.php?page=prescription"); 
     echo '<script>window.location="../Web/staff/staffindex.php?page=prescription"</script>';
}
}catch(Exception $e){
    echo $e->getMessage();   
}

?>