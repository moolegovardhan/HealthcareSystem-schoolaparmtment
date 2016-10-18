<?php session_start();
include_once 'AppointmentData.php';
include_once 'PatientData.php';
include_once 'SendMessageToPatient.php';
include_once 'OfficeSettings.php';

$pd = new PatientData();
$sms = new SendMessageToPatient();
$office = new OfficeSettings();

$paymentDone = $_GET['price'];
$appointmentid = $_GET['apid'];
$totalprice = $_GET['totalamount'];
$discpercent = $_GET['discamount'];
$cgsdicount = $_GET['cgsdiscount'];
$billwaver = $_GET['billwaver'];
$waveramount = $_GET['waveramount'];
$instid = $_SESSION['officeid'];
/*print_r($_SESSION['userid']);echo "userid";
print_r($_SESSION['profession']);echo "profession";
print_r($_SESSION['labcallcenterofficeid']);
echo "last";print_r($instid);echo "instid"; */
if($instid == "" && $_SESSION['profession'] == "callcenter"){
 //   echo "in null";
    $instid = $_SESSION['labcallcenterofficeid'];
}
try{
$wallet = $_GET['wallet'];
$discountto = $_GET['flagType'];
$discamount = ($totalprice*$discpercent)/100;
$patientid = $_GET['patientid'];
$receiptid = $_GET['receiptid'];
$from =  $_GET['from'];
//print_r($from);
$onlycash =  $_GET['onlycash'];
$walletcash =  $_GET['wallet'];
$mycash =  $_GET['mycash'];
$voucher = $_GET['voucher'];

$dcard =  $_GET['dcard'];
$dcamount =  $_GET['dcamount'];
$ccard =  $_GET['ccard'];
$ccamount =  $_GET['ccamount'];


$message = "Data Updated Successfully";
//print_r($_REQUEST);echo "<br/>";
$ad = new AppointmentData();
$pDetails = $pd->patientIDDetails($patientid);
$mobileNumber = $pDetails[0]->mobile;
$discountType = $_GET['discountType'];

if($from != "medicine"){
    $ad->updateAppointmentWithLabPrice($appointmentid,$totalprice,$paymentDone);
}
//if($cardtype !=  ""){echo "Inside 1";
$endtype = "";
//print_r($from == "medicine");
if($from == "medicine"){
  //  echo "INside Medicine";
    $endtype = "Medical Shop";
}else{
    // echo "INside Lab";
     $endtype = "Lab";
}
if($voucher != "" && $voucher != "0"){
    
    $vouchermain = explode("$", $voucher);
    
    $voucherId = $vouchermain[2];
    
    if($vouchermain[1] == "Fixed"){
        
        $vouchersplit = explode("}",$vouchermain[0]);
        $voucherValue = $vouchersplit[1];
        $voucherAmount = $voucherValue;
    }else{
        $vouchersplit = explode("{",$vouchermain[0]);
        $voucherValue = $vouchersplit[0];
         $voucherAmount = ($totalprice*$voucherValue)/100;
    }
    
    
    if($from == "medicine"){
        $insttype = "Medical";
    }else{
         $insttype = "Lab";
    }
    if($pDetails[0]->primarymemberid != ""){
        $memberid = $pDetails[0]->primarymemberid;
    }else{
       $memberid =  $patientid;
    }
    $pd->updatePatientVoucherCount($memberid,$voucherId,$insttype);
    $smsmessage = "CGS Thanks for using ".$vouchermain[3]." voucher at ".$insttype." Transaction receipt id : ".$receiptid;
    $sms->sendSMS($smsmessage, $mobileNumber);
    $comments = "Paid bill through Voucher.Voucher value used is ".$voucherAmount." Bill Amount is ".$paymentDone;
    // We are showig voucher spent against the primarymember id 
     $pd->insertPaymentDetails('VOUCHER',$memberid,$voucherAmount,'CURDATE()','D',$receiptid,$insttype,$comments,$appointmentid,$totalprice,false);
    
     if($vouchermain[1] == "Percent"){
         
        $ad->insertDiscountInformation($instid,"0",$voucherValue,$totalprice,$paymentDone,$appointmentid,$endtype,$receiptid,"ToInst","Voucher"); 
     }
     
     
     
}

if($billwaver != "billwaver" && $waveramount !="0"){
     if($from == "medicine"){
        $insttype = "Medical";
    }else{
         $insttype = "Lab";
    }
    $comments = " Special Discount Applied : ".$billwaver;
   // echo "Inside Bill waver discount";echo "<br/>";
   //  $ad->insertDiscountInformation($instid,$waveramount,"0",$totalprice,$paymentDone,$appointmentid,$endtype,$receiptid,"-",$billwaver);
      $pd->insertPaymentDetails('SPLDISCOUNT',$patientid,'-'.$waveramount,'CURDATE()','D',$receiptid,$insttype,$comments,$appointmentid,$totalprice,false);
      $comments = "";
    
}

   $ad->insertDiscountInformation($instid,$discamount,$cgsdicount,$totalprice,$paymentDone,$appointmentid,$endtype,$receiptid,$discountto,$discountType);
if($walletcash != "" && $walletcash != "0"){ //echo "Inside 2";echo "<br/>";
     if($from == "medicine"){
        $insttype = "Medical";
    }else{
         $insttype = "Lab";
    }
   $pd->updatePatientWalletPaymentInfo($patientid, $walletcash);
   $comments = "Paid throught Wallet";
    $pd->insertPaymentDetails('WALLET',$patientid,$walletcash,'CURDATE()','D',$receiptid,$insttype,$comments,$appointmentid,$totalprice,false);
      $comments = "";
}if($mycash != "" && $mycash != "0"){//echo "Inside My cash";echo "<br/>";
    if($from != "medicine"){
        $insttype = "Lab";
    }else{
         $insttype = "Medical";
    }
     $pd->updatePatientMyCashPaymentInfo($patientid, $mycash);
     $smsmessage = "CGS Thanks for using".$mycash." MYCASH at ".$insttype." Transaction receipt id : ".$receiptid;
     $sms->sendSMS($smsmessage, $mobileNumber);
      $comments = "Paid bill through MYCASH.MyCash Amount is ".$mycash." Bill Amount is ".$paymentDone;
      $pd->insertPaymentDetails('MYCASH',$patientid,$mycash,'CURDATE()','D',$receiptid,$insttype,$comments,$appointmentid,$totalprice,false);
}
$comments = "";
//echo "mycash   ".$mycash;
if($mycash != "" && $mycash > 0){
    $addingAmount = $mycash*(0.05);
    
    if($from != "medicine"){
        $instmytype = "Lab";
    }  else {
        $instmytype = "Medical Shop";
    }
    $comments = "Wallet amount for paying through My Cash of :Rs ".$mycash."/- Receipt Id : ".$receiptid;
    $pd->insertPaymentDetails('WALLET',$patientid,$addingAmount,'CURDATE()','C',$receiptid,$instmytype,$comments,$appointmentid,$totalprice,false);
     $pd->updatePatientWalletPaymentInfo($patientid, $addingAmount);
     
     $smsmessage = "CGS  Wallet amount for paying through My Cash of :Rs ".$mycash."/- Receipt Id : ".$receiptid;
     $sms->sendSMS($smsmessage, $mobileNumber);
}
$comments = "";

if($onlycash > 0){
    
     if($from != "medicine"){
            $instmytype = "Lab";
        }  else {
            $instmytype = "Medical Shop";
        }
        $comments = "Cash payment";
    $pd->insertPaymentDetails('CASH',$patientid,$onlycash,'CURDATE()','D',$receiptid,$instmytype,$comments,$appointmentid,$totalprice,false);
      $comments = "";
}



if($from == "lab"){
//echo $dcard; echo "<br/>";
if($dcard != "creditcard" && $dcamount > 0){
      $comments = "Paid throught Debit Card";
      $pd->insertPaymentDetails($dcard.' DEBIT CARD',$patientid,$dcamount,'CURDATE()','D',$receiptid,'Lab',$comments,$appointmentid,$totalprice,false);
      $comments = "";
}

if($ccard != "creditcard" && $ccamount > 0){
      $comments = "Paid throught Credit Card";
      $pd->insertPaymentDetails($ccard.' CREDIT CARD',$patientid,$ccamount,'CURDATE()','D',$receiptid,'Lab',$comments,$appointmentid,$totalprice,false);
      $comments = "";
}


  //  echo "In Lab";
     $pd->insertPaymentDetails('LAB TEST',$patientid,$paymentDone,'CURDATE()','D',$receiptid,'Lab',$comments,$appointmentid,$totalprice,true);
     $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=samplecollection";
     $updateappointment = $ad->updateAppointmentWithLabPrice($appointmentid,$totalprice,$paymentDone);
     
}else if($from == "callcenter"){
    
   if($dcard != "creditcard" && $dcamount > 0){
      $comments = "Paid throught Debit Card";
      $pd->insertPaymentDetails($dcard.' DEBIT CARD',$patientid,$dcamount,'CURDATE()','D',$receiptid,'Lab',$comments,$appointmentid,$totalprice,false);
      $comments = "";
}

if($ccard != "creditcard" && $ccamount > 0){
      $comments = "Paid throught Credit Card";
      $pd->insertPaymentDetails($ccard.' CREDIT CARD',$patientid,$ccamount,'CURDATE()','D',$receiptid,'Lab',$comments,$appointmentid,$totalprice,false);
      $comments = "";
}
    $office->updateHomeServiceRequestByLab($_SESSION['serviceid'],$instid);
    $ad->updateConsultingDiagWithPaidAmount($_SESSION['constdiagid'] , $paymentDone);
    $pd->insertPaymentDetails('LAB TEST',$patientid,$paymentDone,'CURDATE()','D',$receiptid,'Lab',$comments,$appointmentid,$totalprice,true);
     $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/callcenter/callcenterindex.php?page=uhomeservice";
     $updateappointment = $ad->updateAppointmentWithLabPrice($appointmentid,$totalprice,$paymentDone);
     
}else if($from == "medicine"){ //echo "In medical";
    
    if($dcard != "creditcard" && $dcamount > 0){
      $comments = "Paid throught Debit Card";
      $pd->insertPaymentDetails($dcard.' DEBIT CARD',$patientid,$dcamount,'CURDATE()','D',$receiptid,'Medical Shop',$comments,$appointmentid,$totalprice,true);
      $comments = "";
}

if($ccard != "creditcard" && $ccamount > 0){
      $comments = "Paid throught Credit Card";
      $pd->insertPaymentDetails($ccard.' CREDIT CARD',$patientid,$ccamount,'CURDATE()','D',$receiptid,'Medical Shop',$comments,$appointmentid,$totalprice,false);
      $comments = "";
}

    $pd->insertPaymentDetails('MEDICAL SHOP',$patientid,$paymentDone,'CURDATE()','D',$receiptid,'Medical Shop',$comments,$appointmentid,$totalprice,true);
     $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/medical/medicalindex.php?page=distribution";
     $updateappointment = $ad->updateAppointmentWithMedicinePrice($appointmentid,$totalprice,$paymentDone);
}
// /
}  catch (Exception $e){
    echo "Line ................".$e->getLine();echo "<br/>";
    echo "Message .............".$e->getMessage();echo "<br/>";
    echo "Code ................".$e->getCode();echo "<br/>";
    echo "File .................".$e->getFile();
}
?>


<script>
setTimeout(function () {
   alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; 
}, 1000);

</script>