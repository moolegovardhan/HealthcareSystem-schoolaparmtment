<?php
session_start();
include_once 'ChildVacinationData.php';
?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png" width="100px" height="100px"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
$pd = new ChildVacinationData();
$counter = $_POST['counter'];
//echo "Counter : ".$counter;echo "<br/>";
//echo "patientid : ".$patientid;echo "<br/>";
for($i =1 ; $i<$counter+1; $i++){
    $paramdata = $_POST['textbox'.$i];
   // echo "paramdata : ".$paramdata;echo "<br/>";
    $param = explode("$", $paramdata);
     $result = $pd->childMonthlyDetails($param[0],$param[1], $param[2], 'Y', $_SESSION['officeid']);
      //$month,$weight, $height,$pulse, $observation, $status, $hosiptalId
    if($_POST['frommodule'] == ""){
        $message = "Data Updated Successfully";
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=cvacinations";
    }else if($_POST['frommodule'] == "patient"){
        $message = "Data Updated Successfully";
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=cvacinations";
    }
}

?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>