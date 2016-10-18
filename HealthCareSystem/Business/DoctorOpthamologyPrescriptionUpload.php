<?php 
session_start();
?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p


<?php 
try{
include_once 'AppointmentData.php';
include_once 'CreateFolder.php';
$ad = new AppointmentData(); 

//
//$date = (date('ymdHis'));
// 
//$receiptid =  "HCM".$date."OPTO".mt_rand(0, 999);
//
//$sql = "INSERT INTO healthcare.eye_details
// (patientid,patientname,doctorid,doctorname,hospitalid,hospitalname,"
// . "rDiagnosis,lDiagnosis,rDiagnosisCode,lDiagnosisCode,rLidsandAdnexae,lLidsandAdnexae,"
// . "rLacrimalDucts,lLacrimalDucts,rConjunctiva,lConjunctiva,rCornea,lCornea,rAnteriorChamber,"
// ."lAnteriorChamber,rIris,lIris,rPupil,lPupil,rLens,lLens,rOcularMovements,lOcularMovements,status,createdby, createddate, receiptid)"
//        
// . " values(:patientid,:patientname,:doctorid,:doctorname,:hospitalid,:hospitalname,"
// . ":rDiagnosis,:lDiagnosis,:rDiagnosisCode,:lDiagnosisCode,:rLidsandAdnexae,:lLidsandAdnexae,"
// . ":rLacrimalDucts,:lLacrimalDucts,:rConjunctiva,:lConjunctiva,:rCornea,:lCornea,:rAnteriorChamber,"
// . ":lAnteriorChamber,:rIris,:lIris,:rPupil,:lPupil,:rLens,:lLens,:rOcularMovements,:lOcularMovements,"
// . ":'Y',:$userid, :CURDATE(), :$receiptid)";

$patientName = $_POST['hiddenpatientName'];
$patientId = $_POST['hiddenpatientId'];
$doctorName = $_POST['hiddendoctorName'];
$hospitalName = $_POST['hidhospitalName'];
$doctorId = $_POST['hiddendoctorId'];
$hospitalId = $_POST['hidhospitalId'];
$appointmentId = $_POST['hidappointmentId'];
$appointmentDate = $_POST['hidappointmentDate'];
$nextappointment = $_POST['start'];
$complaints = $_POST['complaints'];
$rDiagnosis = $_POST['rDiagnosis'];
$lDiagnosis = $_POST['lDiagnosis'];
$rDiagnosisCode = $_POST['rDiagnosisCode'];
$lDiagnosisCode = $_POST['lDiagnosisCode'];
$rLidsandAdnexae = $_POST['rLidsandAdnexae'];
$lLidsandAdnexae = $_POST['lLidsandAdnexae'];
$rLacrimalDucts = $_POST['rLacrimalDucts'];
$lLacrimalDucts = $_POST['lLacrimalDucts'];
$rConjunctiva= $_POST['rConjunctiva'];
$lConjunctiva = $_POST['lConjunctiva'];
$rCornea = $_POST['rCornea'];
$lCornea = $_POST['lCornea'];
$rAnteriorChamber = $_POST['rAnteriorChamber'];
$lAnteriorChamber = $_POST['lAnteriorChamber'];
$rIris = $_POST['rIris'];
$lIris = $_POST['lIris'];
$rPupil = $_POST['rPupil'];
$lPupil = $_POST['lPupil'];
$rLens = $_POST['rLens'];
$lLens = $_POST['lLens'];
$rOcularMovements = $_POST['rOcularMovements'];
$lOcularMovements = $_POST['rOcularMovements'];


if(stripos($nextappointment,'.') > 0 ){
$explodeDate = explode(".", $nextappointment);

$nextappointmentdt = $explodeDate[2]."-".$explodeDate[1]."-".$explodeDate[0];
}else{
   $nextappointmentdt =  $nextappointment;
}
$ad->insertOpthomolgyPatientPrescriptionDetails($patientName,$patientId,$doctorName,$hospitalName,$doctorId,$hospitalId,$appointmentId,$appointmentDate,$nextappointmentdt,$complaints,$rDiagnosis,$lDiagnosis,$rDiagnosisCode,$lDiagnosisCode,$rLidsandAdnexae,$lLidsandAdnexae,$rLacrimalDucts,$lLacrimalDucts,$rConjunctiva,$lConjunctiva,$rCornea,$lCornea,$rAnteriorChamber,$lAnteriorChamber,$rIris,$lIris,$rPupil,$lPupil,$rLens,$lLens,$rOcularMovements,$lOcularMovements);
               
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Business/GenerateOpthomolgyPrescriptionPDF.php?appointmentid=".$appointmentId;
   // echo "Urlllllllll........".$url;
 echo "<script> window.open('".$url."', '_blank')</script>";


 $message = "Data Updated Successfully. ";
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/doctor/doctorindex.php?page=optoprescription";
}catch(Exception $ex){
    $message = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/doctor/doctorindex.php?page=optoprescription";
}

?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>






