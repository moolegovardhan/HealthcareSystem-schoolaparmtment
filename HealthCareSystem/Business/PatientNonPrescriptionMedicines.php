<?php 
session_start();
?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
include_once 'MedicinesOrdered.php';

$mo = new MedicinesOrdered();

 try{       

$counter = $_POST['counter'];
$patientid = $_SESSION['userid'];
echo "$counter";echo "<br/>";
for($i=0;$i<$counter;$i++){
    
    $quantity = $_POST["quantity".$i];
    if($quantity < 0 || $quantity == "")
        $quantity = "0";
    echo $quantity; echo "<br/>";
    $data = $_POST['textbox'.$i];
   // echo "Data.........".$data;
    $medicineData = explode("#", $data);
    $mo->nonPrescriptionMedicineOrdered($patientid, $medicineData[1], $quantity);
}



    $message = "Medicines Order Made Successfully. ";
    if(!isset($_GET['pageFrom']) )
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/patient/patientindex.php?page=nonprescriptionmedicines";
    if(isset($_GET['pageFrom']) && $_GET['pageFrom'] == 'school')
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/school/schoolindex.php?page=ordermedicines";
     if(isset($_GET['pageFrom']) && $_GET['pageFrom'] == 'industry')
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/industry/industryindex.php?page=ordermedicines";
     if(isset($_GET['pageFrom']) && $_GET['pageFrom'] == 'apartment')
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/apartment/apartmentindex.php?page=ordermedicines";
     if(isset($_GET['pageFrom']) && $_GET['pageFrom'] == 'village')
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/village/villageindex.php?page=ordermedicines";
}catch(Exception $ex){
    $message = $ex->getMessage();
    if(!isset($_GET['pageFrom']) )
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/patient/patientindex.php?page=nonprescriptionmedicines";
    if(isset($_GET['pageFrom']) && $_GET['pageFrom'] == 'school')
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/school/schoolindex.php?page=ordermedicines";
    if(isset($_GET['pageFrom']) && $_GET['pageFrom'] == 'industry')
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/industry/industryindex.php?page=ordermedicines";
    if(isset($_GET['pageFrom']) && $_GET['pageFrom'] == 'apartment')
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/apartment/apartmentindex.php?page=ordermedicines";
}

?>
<script>
setTimeout(function () {
   alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>
