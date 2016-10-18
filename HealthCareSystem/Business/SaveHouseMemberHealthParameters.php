<?php
session_start();
?>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <?php session_start(); ?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
include_once 'BusinessHSMDatabase.php';

$patientid = $_POST['appointmenthousememberid'];
$appointmentid = $_POST['appointmentdate'];
$sugar = $_POST['sugar'];
$bp = $_POST['bp'];
$col1 = $_POST['cholo1'];
$col2 = $_POST['cholo2'];
$col3 = $_POST['cholo3'];
$col4 = $_POST['cholo4'];
$col5 = $_POST['cholo5'];
$officeid = $_SESSION['officeid'];
$userid = $_SESSION['userid'];
$housenumber = $_POST['ghousenumber'];

$date = (date('ymdHis'));
 
 $receiptid =  "HCM".$date."APTGEN".mt_rand(0, 999);
   
$dbConnection = new BusinessHSMDatabase();
$sql = "INSERT INTO village_healthcheckup
(appointmentid, villageid, memberid, sugar, bp, colo1, colo2, colo3, colo4, colo5, status, createddate, createdby,housenumber,receiptid) 
VALUES ('$appointmentid', '$officeid', '$patientid', :sugar, :bp, :weight, :height, :col3, :col4, :col5, "
        . " 'Y', CURDATE(), '$userid','$housenumber','$receiptid')";
//echo $sql;
              $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                 $stmt->bindParam("weight", $col1); 
                $stmt->bindParam("height", $col2); 
                $stmt->bindParam("sugar", $sugar); 
                $stmt->bindParam("bp", $bp); 
                $stmt->bindParam("col3", $col3); 
                $stmt->bindParam("col4", $col4); 
                $stmt->bindParam("col5", $col5); 
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
