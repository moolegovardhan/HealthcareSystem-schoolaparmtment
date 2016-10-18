<?php 
session_start();
?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php

try{
include_once 'AppointmentData.php';
$ad = new AppointmentData(); 

include_once 'MasterData.php';
$md = new MasterData();

echo ("inaptient : ".$_POST['inpatient']);echo "<br/>";
echo ("hidhospitalName Name : ".$_POST['hidhospitalName']);echo "<br/>";
echo ("hidhospitalId ID : ".$_POST['hidhospitalId']);echo "<br/>";
echo ("Patient ID : ".$_POST['hidappointmentId']);echo "<br/>";
echo ("presdiseases : ");echo "<br/>";
print_r($_POST['presdiseases']);
echo "<br/>";
echo ("presdiagnostics : ".$_POST['presdiagnostics']);echo "<br/>";
print_r($_POST['presdiagnostics']);
echo "<br/>";


$patientName = $_POST['hiddenpatientName'];
$patientId = $_POST['hiddenpatientId'];
$doctorName = $_POST['hiddendoctorName'];
$hospitalName = $_POST['hidhospitalName'];
$doctorId = $_POST['hiddendoctorId'];
$hospitalId = $_POST['hidhospitalId'];
$appointmentId = $_POST['hidappointmentId'];
$appointmentDate = $_POST['hidappointmentDate'];
$nextappointment = $_POST['start'];
$description = $_POST['description'];
$suggestions = $_POST['suggestions'];
$medicalshop = $_POST['presmedicalshop'];
$inpatient = ($_POST['inpatient'] == 'inpatient') ? "Y" : "N";
echo "inpatient : ................".$inpatient; echo "<br/>";
$counter = $_POST['counter'];
echo ("hidappointmentDate ID : ".$_POST['hidappointmentDate']);echo "<br/>";

echo ("hiddenpatientName ID : ".$_POST['hiddenpatientName']);echo "<br/>";
echo "Next Appointment Date : ".$nextappointment;echo "<br/>";
echo 'suggestions'.$suggestions;
if(!stripos($nextappointment,'-') ){
$explodeDate = explode(".", $nextappointment);

//$ad->insertPatientPrescriptionDetails($appointmentId, $patientId, $patientName,$description, $doctorId, $hospitalId, $appointmentDate, $nextappointmentdt,$medicalshop);
$nextappointmentdt = $explodeDate[2]."-".$explodeDate[1]."-".$explodeDate[0];
}else{
   $nextappointmentdt =  $nextappointment;
}
echo "Next Appointment Date : ".$nextappointmentdt;echo "<br/>";
/*
echo("hidhospitalId Id : ".$_POST['hidhospitalId']);
echo "<br/>";
echo("Doctor Id : ".$_POST['$doctorId']);
echo "<br/>";
echo("Next Appt Id : ".$_POST['start']);
echo "<br/>";*/
if($inpatient == 'Y'){
$ad->updateAppointmentForInpatient($appointmentId);
}
$ad->insertPatientPrescriptionDetails($appointmentId, $patientId, $patientName,$description, $doctorId, $hospitalId, $appointmentDate, $nextappointmentdt,$medicalshop,$inpatient,$suggestions);
if($referral != "REFERRAL")
  $ad->insertIntoDoctorReferral($patientId,$doctorId,$hospitalId);



$ad->insertPrescriptionDiagnosisDetails("DIAGNOSIS CENTER",$_POST['presdiagnostics'],$appointmentId,$patientId);

foreach ($_POST['presdiseases'] as $selectedOption2){
      $ad->insertPrescriptionDiagnosisDetails("DISEASES",$selectedOption2,$appointmentId,$patientId);
}
if($_POST['otherdiseases'] != "" || $_POST['otherdiseases'] != null){
     $ad->insertPrescriptionDiagnosisDetails("DISEASES",$_POST['otherdiseases'],$appointmentId,$patientId);
}
foreach ($_POST['presmedicaltest'] as $selectedOptionq){
    $namevalue = $selectedOptionq;
    $ad->insertPrescriptionDiagnosisDetails("MEDICAL TEST",$namevalue,$appointmentId,$patientId);
}

$smsMessage = "";
for($i = 1;$i<$counter+1;$i++){

	$data = $_POST['textbox'.$i];
    if(strlen($data) > 1){
        $dataArray = explode("#", $data);
     //   print_r($dataArray);echo "<br/>";

    $medicineName = "";
    if($dataArray[0] != "nogmedicine") 
        $medicineName = $dataArray[0];
    else if($dataArray[1] != "nodmedicine") 
         $medicineName = $dataArray[1];
    else if($dataArray[9] != "noomedicine") 
         $medicineName = $dataArray[9];

    	$time = "";
   		if($dataArray[3] != 0)
   		{
   			$time .= "MBF|";	
   		}
   		
   		if($dataArray[4] != 0)
   		{
   			$time .= "MAF|";
   		}
   		
   		if($dataArray[5] != 0)
   		{
   			$time .= "ABF|";
   		}
   		
   		if($dataArray[6] != 0)
   		{
   			$time .= "AAF|";
   		}
   		
   		if($dataArray[7] != 0)
   		{
   			$time .= "EBF|";
   		}
   		
   		if($dataArray[8] != 0)
   		{
   			$time .= "EAF|";
   		}
   		
   		$timesArray = explode("|", $time);
   		$smsMessage .= "$medicineName : ";
   		for($j = 0;$j<sizeof($timesArray);$j++){
   			if($timesArray[$j] != "")
   			{
   				$smsMessage .= "$timesArray[$j],";
   			}	
   		}

   		$smsMessage .= "Days : $dataArray[2];  ";
   		$ad->insertPrescriptionDiagnosisMedicenesDetails($patientId, $medicineName, 
             (($dataArray[3] == 0) ? "N" : "Y"), (($dataArray[4] == 0) ? "N" : "Y"), 
                (($dataArray[5] == 0) ? "N" : "Y"), (($dataArray[6] == 0) ? "N" : "Y"), 
                (($dataArray[7] == 0) ? "N" : "Y"), (($dataArray[8] == 0) ? "N" : "Y"),
                $appointmentId, $dataArray[2], $dataArray[10]);   
        
    }
}//end of for loop
  $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Business/GeneratePrescriptionPDF.php?appointmentid=".$appointmentId;
   // echo $url;
   echo "<script> window.open('".$url."', '_blank')</script>";
$mobileNumber = array();
$mobileNumber = $md->getUserMobileNumber($_POST['hiddenpatientId']);

$message = "Data Updated Successfully. ";
 
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/doctor/doctorindex.php?page=doctorcurrentappointment&reloaddoctor=false";
}catch(Exception $ex){
    $message = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/doctor/doctorindex.php?page=doctorcurrentappointment&reloaddoctor=false";
}

?>
<script>
setTimeout(function () {

	var mobilenumber = <?php echo $mobileNumber[0]->mobile; ?>;

		if(mobilenumber != 'undefined')
		{
			mobile = mobilenumber;
			message = '<?php echo $smsMessage; ?>';
			var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="+mobile+"&text="+message+"&priority=ndnd&stype=normal";
			$.post(url, function(data){
			//Need to show some message if we get response from the SMS api.
			//Currently we are just sending Message after authenticated by Super Admin
			});
		}

	
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>