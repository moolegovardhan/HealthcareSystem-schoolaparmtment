<?php session_start();
 include_once 'DiagnosticData.php';
?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png" width="75px" height="75px"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>
<?php
         include_once 'DiagnosticData.php';
         $dd = new DiagnosticData();
         
         $fromtype = $_POST['mapfor'];
         $recordcount = $_POST['recordcount'];
         
         for($i=0;$i<$recordcount;$i++){
             
            $labid = $_POST[$i];
            if($labid != 0){
                if($fromtype == "lab"){
                    $dd->mapHospitaltoLab($_SESSION['officeid'], $labid);
                     $message = "Lab mapped successfully";
                 $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=maplab";
                } 
                if($fromtype  =="medicalshop"){
                     $dd->mapHospitaltoMedicalShop($_SESSION['officeid'], $labid);
                      $message = "Medical shop mapped successfully";
                      $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=mapmedicalshop";
                }
            }
         }
?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>