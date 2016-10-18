<?php
session_start();

?>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <?php session_start(); ?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
include_once 'BusinessHSMDatabase.php';

$patientid = $_POST['oappointmenthouseid'];
$appointmentid = $_POST['oappointmentdate'];
$observations = $_POST['oobservations'];
$complaints = $_POST['ocomplaints'];
$doctor = $_POST['optodoctor'];
$officeid = $_SESSION['officeid'];
$userid = $_SESSION['userid'];
$housenumber = $_POST['ohousenumber'];
$rDiagnosis = $_POST['rDiagnosis'];
$lDiagnosis = $_POST['lDiagnosis'];
$rDiagnosisCode = $_POST['rDiagnosisCode'];
$lDiagnosisCode = $_POST['lDiagnosisCode'];
$rLidsandAdnexae = $_POST['rLidsandAdnexae'];
$lLidsandAdnexae = $_POST['lLidsandAdnexae'];
$rLacrimalDucts = $_POST['rLacrimalDucts'];
$lLacrimalDucts = $_POST['lLacrimalDucts'];
$rConjunctiva = $_POST['rConjunctiva'];
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
$lOcularMovements = $_POST['lOcularMovements'];

$date = (date('ymdHis'));
 
$receiptid =  "HCM".$date."APTOPT".mt_rand(0, 999);

$sql = "INSERT INTO village_optomology
(patientid, doctorid, appointmentid, complaints, observations, villageid, housenumber, rDiagnosis, lDiagnosis, rDiagnosisCode, lDiagnosisCode, rLidsandAdnexae, lLidsandAdnexae,
rLacrimalDucts, lLacrimalDucts, rConjunctiva, lConjunctiva, rCornea, lCornea, rAnteriorChamber, lAnteriorChamber, rIris, lIris, rPupil, lPupil, rLens, lLens, rOcularMovements, lOcularMovements, 
status, createdby, createddate, receiptid,memberid) 
VALUES ($patientid, $doctor, $appointmentid, '$complaints', '$observations', '$officeid', '$housenumber', '$rDiagnosis', '$lDiagnosis', '$rDiagnosisCode', '$lDiagnosisCode', 
'$rLidsandAdnexae', '$lLidsandAdnexae', '$rLacrimalDucts', '$lLacrimalDucts', '$rConjunctiva', '$lConjunctiva', '$rCornea', '$lCornea', '$rAnteriorChamber', '$lAnteriorChamber', '$rIris', '$lIris', 
'$rPupil', '$lPupil', '$rLens', '$lLens', '$rOcularMovements', '$lOcularMovements', 'Y', $userid, CURDATE(), '$receiptid',$patientid)";

//echo $sql;

         $dbConnection = new BusinessHSMDatabase();
            try{
                $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql); 
                 
                $stmt->execute();
                $appointment = $db->lastInsertId();
                $db = null;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
$message = "House Member  Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/village/villageindex.php?page=checkup";
               

?>  
   
<script  type="text/javascript">
    
setTimeout(function () {
    
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 200);

</script>
