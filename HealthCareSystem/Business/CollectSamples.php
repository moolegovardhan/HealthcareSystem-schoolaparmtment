<div class="sky-form">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<br/><br/>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
include_once 'AppointmentData.php';

$ad = new AppointmentData();

$counter = $_POST['recordcount'];
try{
for($i=0;$i<$counter;$i++){
    $constid = $_POST['testsample'.$i];
  //  echo $_POST['testsample'.$i];
    if($constid != "")
      $result = $ad->updateSampleCollectedInDiagnostics($constid);
    
}
$alertmessage = "Data Updated Successfully";
}  catch (Exception $e){
    $alertmessage = "Invalid Data please contact support";
}
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=samplecollection";
?>
<script>

    // $('#noLabTestMessage').modal('show');
     setTimeout(function () {
        alert("<?php echo $alertmessage ;?>");
        window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
    }, 1000);
</script>

</div>