<?php
session_start();
?>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <?php session_start(); ?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
include_once 'BusinessHSMDatabase.php';

$patientid = $_POST['dappointmentempid'];
$appointmentid = $_POST['dappointmentid'];
$observations = $_POST['observation'];
$complaints = $_POST['complaints'];
$dietitian = $_POST['dietitian'];
$mfrecomendation = $_POST['mfrecomendation'];
$afrecomendation = $_POST['afrecomendation'];
$efrecomendation = $_POST['efrecomendation'];
$officeid = $_SESSION['officeid'];
$userid = $_SESSION['userid'];
$classid = $_POST['dclassid'];

$date = (date('ymdHis'));
 
   $receiptid =  "HCM".$date."INDDIET".mt_rand(0, 999);

$dbConnection = new BusinessHSMDatabase();
$sql = "INSERT INTO industry_dietitian
        (appointmentid, complaints, observations, mfrecomend, afrecomend, nfrecomend, industryid, patientid, status, dietitianid, createddate, createdby,receiptid) 
        VALUES ('$appointmentid', '$complaints', '$observations', '$mfrecomendation', '$afrecomendation', '$efrecomendation', '$officeid',
         '$patientid', 'Y', '$dietitian', CURDATE(), '$userid','$receiptid')";

              $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql); 
                $stmt->execute();  
                $studentData = $db->lastInsertId();
             
                $db = null;
   
$message = "Student  Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/industry/industryindex.php?page=checkup";
               

?>  
   
<script  type="text/javascript">
    
setTimeout(function () {
    
    alert("<?php echo $message ;?>");
  //window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 200);

</script>
