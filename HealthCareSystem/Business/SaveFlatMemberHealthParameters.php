<?php
session_start();
?>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <?php session_start(); ?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
include_once 'BusinessHSMDatabase.php';

$patientid = $_POST['appointmentflatmemberid'];
$appointmentid = $_POST['appointmentid'];
$sugar = $_POST['sugar'];
$bp = $_POST['bp'];
$col1 = $_POST['cholo1'];
$col2 = $_POST['cholo2'];
$col3 = $_POST['cholo3'];
$col4 = $_POST['cholo4'];
$col5 = $_POST['cholo5'];
$officeid = $_SESSION['officeid'];
$userid = $_SESSION['userid'];
$flatnumber = $_POST['gflatnumber'];

$date = (date('ymdHis'));
 
 $receiptid =  "HCM".$date."APTGEN".mt_rand(0, 999);
   
$dbConnection = new BusinessHSMDatabase();
$sql = "INSERT INTO apartment_healthcheckup
(appointmentid, apartmentid, memberid, sugar, bp, colo1, colo2, colo3, colo4, colo5, status, createddate, createdby,flatnumber,receiptid) 
VALUES ('$appointmentid', '$officeid', '$patientid', '$sugar', '$bp', '$col1', '$col2', '$col3', '$col4', '$col5', "
        . " 'Y', CURDATE(), '$userid','$flatnumber','$receiptid')";
//echo $sql;
              $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql); 
                $stmt->execute();  
                $studentData = $db->lastInsertId();
             
                $db = null;
   
$message = "Flat Member  Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/apartment/apartmentindex.php?page=fmcheckup";
               

?>  
   
<script  type="text/javascript">
    
setTimeout(function () {
    
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 200);

</script>
