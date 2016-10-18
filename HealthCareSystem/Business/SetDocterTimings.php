<?php
session_start();
?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>


<?php 
include_once 'DoctorData.php';
try{
$counter = $_POST['counter'];
//echo "counter : ".$counter;
$dd = new DoctorData();
if(isset($_POST['counter'])){
    for($i =0;$i< $counter;$i++){
  //      echo "i : ".$i;echo "<br/>";
    //    echo "Doctor Id : ".$_POST[$i];echo "<br/>";
      /*  echo "From TIme : ".$_POST["fromtime".$i];echo "<br/>";
        echo "To Time : ".$_POST["totime".$i];echo "<br/>";
      //  echo "From Time : ".strtotime($_POST["fromtime".$i]);echo "<br/>";
       // echo "To Time : ".strtotime($_POST["totime".$i]);echo "<br/>";
        */
        $requestFrom = $_POST['requestFrom'];
        if($_POST[$i] != ""){
        $doctorInfo = $dd->fetcTimingsforDoctorBasedOnHospital($doctorid,$hospitalid); 
      //  print_r($doctorInfo);
        $insertFlag = "false";
        if($insertFlag){
                $dd->insertIntoDoctor($_POST[$i], $_POST["fromtime".$i], $_POST["totime".$i],$_SESSION['officeid']);

                $startTime=strtotime($_POST["fromtime".$i]);
                $endTime=strtotime($_POST["totime".$i]);
              //  $intervel="10";
                $duration = $_POST["duration".$i];
                if($duration == "")
                    $duration ="10";
                $intervel = $duration;
                 $time=$startTime;
                $slotStart = "";
                $slotEnd =  "";
               // echo "Slot : ".$_POST[$i];echo "<br/>";
                $dd->deleteAppointmentSlots($_POST[$i],$_SESSION['officeid']);

                 while ($time <= $endTime) {
                    $slotStart =  $time;
                    $slotEnd =  strtotime('+'.$intervel.' minutes', $time);
                    $temp = date('H:i', $slotStart)." - ".date('H:i', $slotEnd);
                  /*  echo $temp;echo "<br/>";
                    echo "Doctor Id : ".$_POST[$i];echo "<br/>";
                    echo "Slot Start TIme : ".date('H:i',$slotStart);echo "<br/>";
                    echo "Slot End Time : ".date('H:i',$slotEnd);echo "<br/>"; */
                  $dd->insertIntoAppointmentHospitalSlots($temp, $_POST[$i]);
                  $time = strtotime('+'.$intervel.' minutes', $time);
                 }
        }
        }   
    }
}
 $message = "Data Updated Successfully. ";
    if($requestFrom == "Clinic"){
        $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/doctor/doctorindex.php";
    }else
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=timings";
}catch(Exception $ex){
    $message = $ex->getMessage();
    echo $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=timings";
}
?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>