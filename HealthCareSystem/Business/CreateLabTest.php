<?php 
session_start();
?>
<br/><br/><br/><br/>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>


<style>
    td, th {
  width: 4rem;
  height: 2rem;
  border: 0px solid #ccc;
  text-align: justify;
}
th {
 -- background: lightblue;
  border-color: white;
}
body {
  padding: 1rem;
}
  /* CSS */
.btnExample {
  color: #900;
  background: #FF0;
  font-weight: bold;
  border: 1px solid #900;
}
 
.btnExample:hover {
  color: #FFF;
  background: #900;
}
</style>
<script>
function myFunction() {
    $('#printbutton').hide();
    window.print();
}
</script>

    <?php
include_once 'AppointmentData.php';
include_once 'PatientData.php';
include_once 'MasterData.php';
try{
    

$ad = new AppointmentData();
$pd = new PatientData();
$master = new MasterData();
$hospital = $_POST['hospital'];
$hosData = $master->getHosiptalDataBasedOnId($hospital);
$testname = $_POST['list'];
$doctor = $_POST['doctor'];
$appointmentType = $_POST['prescriptiontype'];
$appointmentdate = $_POST['start'];
/*$fromhr = $_POST['fromhr'];
$frommin = $_POST['frommin'];
$endhr = $_POST['endhr'];
$endmin = $_POST['endmin'];*/
$patientid = $_POST['testforpatient'];
//echo "Patient ID ".$patientid;
$details = ($pd->fetchPatientDetails($patientid));
//print_r($details);
$amount = 0;
$slot = $_POST['slottime']; 

if($hospital == "HOSPITAL" || $doctor == "DOCTOR" || $testname == "TESTNAME" || $appointmentdate == ""){
   $message = "Data Updated Failed. Please re populate the data again ";
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=newReport";
  
}else{


//echo "patientInfo :".$patientid." <br/>";

$patientInfo = $pd->fetchPatientDetails($patientid);
//print_r($patientInfo);
//echo "patientInfo : <br/>";

$appointmentInfo = $ad->createCallCenterOldAppointment($hospital, $doctor, $appointmentdate, $slot, $patientid, 'Y', $patientInfo[0]->name, $appointmentType,$amount);

//echo "Appointment ID : ".$appointmentInfo."<br/>";
/*if($appointmentType = "General")
    $ad->createCallCenterOldDateDummyPrescription($appointmentInfo,$patientid,$patientInfo[0]->name,$doctor,$hospital,$appointmentdate);
else if($appointmentType = "Pregnancy")
      $ad->createDummyPregnancyPatientPrescriptionDetails($appointmentInfo,$patientid,$patientInfo[0]->name,"",$doctor,$hospital,$appointmentdate);  
else if($appointmentType = "Child")
    $ad->createDummyChildPatientPrescriptionDetails($appointmentInfo,$patientid,$patientInfo[0]->name,"",$doctor,$hospital,$appointmentdate);
*/
for($i=0;$i<$_POST['counter'];$i++){
    $namevalue = $_POST['textbox'.$i];
    $testdata = split("#", $namevalue);
    //$ad->insertPrescriptionDiagnosisDetails("MEDICAL TEST",$testdata[0],$appointmentInfo,$patientId);
}

    $message = "Data Updated Successfully. ";
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=newReport";
}

} catch (Exception $ex) {
    
    echo $ex->getMessage();
     $message = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=newReport";
}



?>

<div id="printbutton">
 <button class="btnExample" onclick="myFunction()" type="button" value="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>
 </div><br/>
<table width="70%" cellspacing="0" cellpadding="0" border="0" align="center">
    <tr> <td ><b>Patient Name</b></td><td colspan="1"><?php echo $details[0]->name;?></td></tr>
     <tr> <td><b>Hospital Name </b></td><td colspan="1"><?php echo $hosData[0]->hosiptalname;?></td></tr>
      <tr> <td><b>Doctor Name </b></td><td colspan="1"><?php echo $doctor;?></td></tr>
      <tr> <td><b>Date </b></td><td colspan="1"><?php echo date("d.m.Y");?></td></tr>
    <tr bgcolor="#81F7BE">
        <th style="color: #990000;" width="80%"><b>Test Name</b></th>
         <th style="color: #990000;" width="20%"><b>Test Price</b></th>
    </tr>
<?php 
for($i=0;$i<$_POST['counter'];$i++){
    $namevalue = $_POST['textbox'.$i];
    $testdata = split("#", $namevalue);
?>
     <tr>
        <th width="80%"><?php echo $testdata[1]; ?></th>
         <td width="20%"><?php echo $testdata[2]; ?></td>
    </tr>
    
 <?php
 $totalCost = $totalCost+$testdata[2];
}
 ?>
    <tr>
        <td colspan="1" style="text-align: end;">Total Cost :&nbsp;&nbsp;</td>
        <td  align="right">  <b>Rs. <?php echo $totalCost;?>/-</b></td>
    </tr> 
</table> 


<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  //  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 10000);

</script>
