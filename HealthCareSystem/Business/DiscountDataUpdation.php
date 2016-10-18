<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<?php 
session_start();
include_once  'BusinessHSMDatabase.php';
require '../Common/HSMMessages.php';
include_once 'DiscountData.php';
$disc = new DiscountData();

?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>
<?php
try{
$recordCount = $_POST['recordcount'];
for($i=0;$i<$recordCount;$i++){
  //  echo "counter - ".$i;echo "<br/>";
  //  echo "Diag ...".$_POST['diag'.$i];echo "<br/>";
  //  echo "Hosiptal ...".$_POST['discvalue'.$i];echo "<br/>";
     $diagId = $_POST['diag'.$i];
   /*  $promotional = $_POST['promotional'.$i];
      $general = $_POST['general'.$i];
       $silver = $_POST['silver'.$i];
        $fromhome = $_POST['fromhome'.$i];
          $appusers = $_POST['appusers'.$i];
        $noncardholders = $_POST['noncardholders'.$i];  */
      $cgsdiscount = $_POST['cgsdiscount'.$i];
     
     if(($diagId != "") && ($cgsdiscount > 0 )){
         $extData = $disc->fetchInstitution($diagId,'Lab');
         if(sizeof($extData) > 0){
             $disc->updateInstitutionDiscount($diagId,'Lab',$cgsdiscount);
         }else if(sizeof($extData) < 1){
             $disc->createInstitutionalDiscount($diagId,$cgsdiscount,'Lab');
         }
     }
}
 $message = "Data Updated Successfully. ";
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=discount";

} catch(Exception $ex) {
    echo $ex->getMessage();
} 
?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>