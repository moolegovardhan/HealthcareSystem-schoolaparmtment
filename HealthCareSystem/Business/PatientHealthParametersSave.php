<?php
session_start();
include_once 'PatientData.php';
?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png" width="100px" height="100px"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
$pd = new PatientData();
$patientid = $_SESSION['userid'];//$_POST['patientid'];
$counter = $_POST['counter'];
//echo "Counter : ".$counter;echo "<br/>";
//echo "patientid : ".$patientid;echo "<br/>";
for($i =1 ; $i<$counter+1; $i++){
    $paramdata = $_POST['textbox'.$i];
   // echo "paramdata : ".$paramdata;echo "<br/>";
    $param = explode("$", $paramdata);
   // echo "param : ".$param;echo "<br/>";
   // echo "Param 0 Valyue : ".(($param[0] == 'nodata') ? '' : $param[0]);echo "<br/>";
    $result = $pd->insertPatientHealthParameters((($param[0] == 'nodata') ? '' : $param[0]), (($param[1] == 'nodata') ? '' : $param[1]), (($param[2] == 'nodata') ? '' : $param[2]), $patientid);

    //echo "Result ".$result;
    // echo "In > 0";
     if($_POST['frommodule'] == ""){
        $message = "Data Updated Successfully";
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/patient/patientindex.php?page=patienthealth";
    }else if($_POST['frommodule'] == "patient"){
        $message = "Data Updated Successfully";
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/patient/patientindex.php?page=patienthealth";
    }
}

?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>