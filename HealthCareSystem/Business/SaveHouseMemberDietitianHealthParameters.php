<?php
session_start();
?>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <?php session_start(); ?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
include_once 'BusinessHSMDatabase.php';

$patientid = $_POST['dappointmenthousememberid'];
$appointmentid = $_POST['dietappointmentdate'];
$observations = $_POST['dobservation'];
$complaints = $_POST['complaints'];
$dietitian = $_POST['dietitian'];
$mfrecomendation = $_POST['mfrecomendation'];
$afrecomendation = $_POST['afrecomendation'];
$efrecomendation = $_POST['efrecomendation'];
$officeid = $_SESSION['officeid'];
$userid = $_SESSION['userid'];
$housenumber = $_POST['dhousenumber'];

$date = (date('ymdHis'));
 
   $receiptid =  "HCM".$date."APTDIET".mt_rand(0, 999);

$dbConnection = new BusinessHSMDatabase();
$sql = "INSERT INTO village_dietitian
(appointmentid, complaints, observations, mfrecomend, afrecomend, nfrecomend, villageid, memberid, housenumber, status, dietitianid, createddate, createdby, receiptid) 
VALUES ('$appointmentid', '$complaints', '$observations', '$mfrecomendation', '$afrecomendation', '$efrecomendation', '$officeid', '$patientid', '$housenumber', 'Y', '$dietitian',"
        . " CURDATE(), '$userid', '$receiptid')";
//echo $sql;
              $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql); 
                $stmt->execute();  
                $memberData = $db->lastInsertId();
             
                $db = null;
   
$message = "House Member  Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/village/villageindex.php?page=checkup";
               

?>  
   
<script  type="text/javascript">
    
setTimeout(function () {
    
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 200);

</script>
