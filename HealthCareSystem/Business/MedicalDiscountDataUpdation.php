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
$recordCount = $_POST['medicalrecordcount'];
//echo "in record count  ".$recordCount;echo "<br/>";
for($i=0;$i<$recordCount;$i++){
  
     $diagId = $_POST['shop'.$i];
      $cgsdiscount = $_POST['medicalcgsdiscount'.$i];
   /*   $promotional = $_POST['medpromotional'.$i];
      $general = $_POST['medgeneral'.$i];
       $silver = $_POST['medsilver'.$i];
        $fromhome = $_POST['medfromhome'.$i];
        $appusers = $_POST['medappusers'.$i];
        $noncardholders = $_POST['mednoncardholders'.$i];*/
    //  print_r($_REQUEST);
        if(($diagId != "") && ($cgsdiscount > 0 )){
                $extData = $disc->fetchInstitution($diagId,'Medical');
                if(sizeof($extData) > 0){
                    $disc->updateInstitutionDiscount($diagId,'Medical',$cgsdiscount);
                }else if(sizeof($extData) < 1){
                    $disc->createInstitutionalDiscount($diagId,$cgsdiscount,'Medical');
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