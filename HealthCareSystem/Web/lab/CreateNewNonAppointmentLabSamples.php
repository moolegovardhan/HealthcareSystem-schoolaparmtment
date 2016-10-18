<?php 
session_start();
?>
<div class="col-md-12">

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


    <?php
include_once '../../Business/AppointmentData.php';
include_once '../../Business/PatientData.php';
include_once '../../Business/MasterData.php';
include_once '../../Business/DiscountData.php';
try{
    

$ad = new AppointmentData();
$pd = new PatientData();
$master = new MasterData();
$discountData = new DiscountData();
$hospital = $_POST['hospital'];

$testname = $_POST['list'];
$doctor = $_POST['doctor'];
$appointmentType = $_POST['prescriptiontype'];
$appointmentdate = $_POST['start'];
$samplecollectiontype = $_POST['samplecollectiontype'];
$patientid = $_POST['testforpatient'];
//echo "Patient ID ".$patientid;
$patientdata = json_decode($pd->patientDetails($patientid));
//print_r($patientdata);echo "<br/>";
$primaryMemberId = $patientdata[0]->primarymemberid;
        
if($primaryMemberId == "")        
        $voucherDetails = ($pd->fetchPatientVoucherDetails($patientid,'Lab'));
    else {
         $voucherDetails = ($pd->fetchPatientVoucherDetails($primaryMemberId,'Lab'));
}

$overAllDiscount = $discountData->fetchInstitution($_SESSION['officeid'],'Lab');


$systemDiscount = $pd->fetchSystemDiscounts('lab');
$percent = $systemDiscount[0]->percent;
//echo "Percent ".$percent;
//echo "Voucher count : ".sizeof($voucherDetails);echo "<br/>";
//print_r($voucherDetails);
$discountToApply = "";
$flagType = "";
$cgsDiscount = "";

$address = $patientdata[0]->address;
$udid = $patientdata[0]->udid;
$cardtype = $patientdata[0]->cardtype;
$totalamount = $patientdata[0]->totalamount;
$wallet = $patientdata[0]->wallet;
$voucher = $patientdata[0]->voucher;
$mobile = $patientdata[0]->mobile;

$billDicount = $master->fetchBillPayDiscount("Lab");
/*
if(sizeof($discountDetails) > 0){
$quickregister = $discountDetails[0]->noncardholders ? $discountDetails[0]->noncardholders : "0";
$promotional = $discountDetails[0]->promotional ? $discountDetails[0]->promotional : "0";
$general = $discountDetails[0]->general ? $discountDetails[0]->general : "0";
$silver = $discountDetails[0]->silver ? $discountDetails[0]->silver : "0";
$appuser = $discountDetails[0]->appusers ? $discountDetails[0]->appusers : "0";
$fromhome = $discountDetails[0]->fromhome ? $discountDetails[0]->fromhome : "0";
$cgs =  $discountDetails[0]->cgsdiscount ? $discountDetails[0]->cgsdiscount : "0";
}else{
 $quickregister = "0";
 $promotional = "0";
 $general = "0";
 $silver = "0";
 $appuser = "0";
 $fromhome = "0";
 $cgs = "0";
}
 * */
 $fromhome = "0";
$patientSpecificCardDiscount = Array();
if($cardtype != ""){
if(is_int($cardtype)){
    $cardName = "NA";
    $cardId = $cardtype;
}else{
     $cardName = $cardtype;
    $cardId = "NA";
}

$patientSpecificCardDiscount = $discountData->fetchCardInstitutionNameSearchDetails('Lab', $cardName, $cardId);
}//echo "<br/>";
$OverAllDiscountForCGS = "0";
if(sizeof($overAllDiscount)> 0){
    $OverAllDiscountForCGS = $overAllDiscount[0]->discount;
}


$cgsDiscountToApply = "0";
if(sizeof($overAllDiscount) > 0){
    $cgsDiscountToApply = $overAllDiscount[0]->discount;
}
  $cardDiscountToApply = 0;
if(sizeof($patientSpecificCardDiscount) > 0){
    
    $cardDiscountToApply = $patientSpecificCardDiscount[0]->discount;
    
}
$patientSpecificMobileDiscount = "0";
if($mobile != "" && $udid != ""){
    
    $patientSpecificMobileDiscount = $discountData->fetchCardInstitutionNameSearchDetails('Lab', 'Mobile' , $cardId);
}

     $patientSpecificNonCardDiscount = "0";
   
    $patientSpecificNonCardDiscount = $discountData->fetchCardInstitutionNameSearchDetails('Lab', 'Non Card' , $cardId);
 //  echo " patientSpecificNonCardDiscount : ";print_r($patientSpecificNonCardDiscount);echo "<br/>";
  // echo "Size of ";print_r(sizeof($patientSpecificNonCardDiscount));echo "<br/>";
   $nonCardMobileAppUserDiscount = "0";
  if(sizeof($patientSpecificNonCardDiscount) > 0){
      
      $nonCardMobileAppUserDiscount = $patientSpecificNonCardDiscount[0]->discount;
  }  
  
   $discountToApply ="0";
 $cgsDiscount = "0";


//print_r($discountDetails);

$date1 = new DateTime("now");
//var_dump($date1);echo "Card Expiry : ";echo "<br/>";

$date2 = new DateTime($patientdata[0]->cardexpiry);
/*var_dump($date2);echo "<br/>";
var_dump($date2 > $date1);echo "<br/>";
var_dump($date2 < $date1);echo "<br/>";
var_dump($date2 == $date1);echo "<br/>";
*/
if($date2 < $date1){
    $cardtype = "";
}
$discounType = "";

if($percent == 0){

if($address == "" || strlen($address) < 1 ){
    $discountToApply = 0;
    $cgsDiscount = $OverAllDiscountForCGS;
    $flagType = "ToCGS";//
    $discounType = "Quick Register";
  //  echo " Address Discoutn to Apply : ";print_r($discountToApply);echo "<br/>";
// echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

}else if($samplecollectiontype == "home"){
    $fromHomeDiscount = "0";
     $sampleCollectionFromHomeDiscount = $discountData->fetchCardInstitutionNameSearchDetails('Lab', 'From Home' , '6');
     if(sizeof($sampleCollectionFromHomeDiscount) > 0){
         $fromHomeDiscount = $sampleCollectionFromHomeDiscount[0]->discount;
     }
      $discountToApply = $fromHomeDiscount;
    $cgsDiscount = $OverAllDiscountForCGS- $fromHomeDiscount;
    $flagType = "ToCGS";//
    $discounType = "Sample Collection From Home";
    
    
}else if($cardtype != "" ){
     $discountToApply = $cardDiscountToApply;
    $cgsDiscount = $OverAllDiscountForCGS- $cardDiscountToApply;
    $flagType = "ToBoth";//
    $discounType = $cardtype." Card Discount";
 //    echo $cardtype." Card Discount : ";print_r($discountToApply);echo "<br/>";
 //echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

}else if($udid != "" && $mobile != ""){
        $discountToApply = $patientSpecificMobileDiscount;
        $cgsDiscount = $OverAllDiscountForCGS- $patientSpecificMobileDiscount;
        $flagType = "ToBoth";//
        $discounType = "Mobile App";
    //     echo "Mobile Discoutn to Apply : ";print_r($discountToApply);echo "<br/>";
 //echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

}else{
     $discountToApply = $nonCardMobileAppUserDiscount;
    $cgsDiscount = $OverAllDiscountForCGS-$nonCardMobileAppUserDiscount;
    $flagType = "ToCGS";//
    $discounType = "Non Card or Mobile User";
 //    echo "Non Card Discoutn to Apply : ";print_r($discountToApply);echo "<br/>";
 //echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";From Home

}
    
}else{
    
     $cgsDiscount = 0;
     $flagType = "ToInst";
     $discountToApply = $percent;
     $discounType = "System Discount";
    
}

$date = (date('ymdHis'));//echo "<br/>";
$receiptId =  "HCM".$date."TEST".mt_rand(0, 999);

//print_r($details);
$amount = 0;
$slot = $_POST['slottime']; 
if(strlen($slot) < 2){
    $slot = "00:00 - 00:00";
} 
if(strlen($appointmentdate) < 3){
    $appointmentdate = date("Y-m-d");
}
/*if($hospital == "HOSPITAL"){
   $hospital =  $_SESSION['officeid'];
   $hospitalName = $hospital;
}  else {*/
if(is_numeric($hospital)){
    $hosData = $master->getHosiptalDataBasedOnId($hospital);
$hospitalName = $hosData[0]->hosiptalname;  
}  else {
    $hospitalName = $hospital;
}
//}
if($doctor == "DOCTOR" || $doctor == ""){
    $doctor = " - ";
}

$patientInfo = $pd->fetchPatientDetails($patientid);

$appointmentInfo = $ad->createCallCenterOldAppointment($hospital, $doctor, $appointmentdate, $slot, $patientid, 'Y', $patientInfo[0]->name, $appointmentType);
$ad->insertConsultingDiagWithLabId($hosiptalName[0]->id,$appointmentInfo,$patientid,$receiptId);
//echo "Appointment ID : ".$appointmentInfo."<br/>";
/*if($appointmentType = "General")
    $ad->createCallCenterOldDateDummyPrescription($appointmentInfo,$patientid,$patientInfo[0]->name,$doctor,$hospital,$appointmentdate);
else if($appointmentType = "Pregnancy")
      $ad->createDummyPregnancyPatientPrescriptionDetails($appointmentInfo,$patientid,$patientInfo[0]->name,"",$doctor,$hospital,$appointmentdate);  
else if($appointmentType = "Child")
    $ad->createDummyChildPatientPrescriptionDetails($appointmentInfo,$patientid,$patientInfo[0]->name,"",$doctor,$hospital,$appointmentdate);
*/
$message = "";
$message = $message."<html>";
$message = $message."<head>";
$message = $message."<meta charset='UTF-8'>";
?>
 
<style> 
 #textcss {
    height: 30px;
    padding: 0 10px;
    border: none;
    background: red;
    background: rgba(255, 255, 255, 0.2);
    box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.5);
    font-family: 'Montserrat', sans-serif;
    text-indent: 10px;
    color: #EE4C8D;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    font-size: 20px;
    width: 270px;
}
  /*.textbox { 
    height: 25px; 
    width: 75px; 
    background-color: transparent;  
    border-style: solid;  
    border-width: 0px 0px 1px 0px;  
    border-color: darkred; 
    outline:0; 
  } */
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

<input type="hidden" name="apid" id="apid" value="<?php  echo $appointmentInfo; ?>"/>
<div class="col-md-12">
    <br/>
    <?php
$message = $message."<title></title>";
$message = $message." </head>";
$message = $message."<body>";
      
$message = $message."<div class='tg-wrap'>";
$message = $message."<table width='100%' align='center'>";
$message = $message." <tr style='background-color:#6B92FA;color:#FFFFFF;'><td colspan='6' align='center' ><b> Lab Name : </b>". $hosiptalName[0]->diagnosticsname."</td></tr>";
$message = $message." <tr><td colspan='6'><br/></td></tr>";
$message = $message." <tr><td nowrap='true'><b>Receipt #</b></td><td>".rtrim($receiptId)."</td><td nowrap='true'><b>Date</b></td><td>".date("d-m-Y")."</td><td><b>Lab ID</b></td><td nowrap='true'>".$hosiptalName[0]->labuniqueid."</td></tr>";
$message = $message." <tr><td nowrap='true'><b>Patient ID</b></td><td>".$patientid."</td><td nowrap='true'><b>Age/Sex</b></td><td nowrap='true'>".$patientInfo[0]->age."/".ucfirst($patientInfo[0]->gender)."</td><td colspan='2' rowspan='3'></td></tr>";
$message = $message." <tr><td nowrap='true'><b>Patient Name</b></td><td nowrap='true'>".$patientInfo[0]->name."</td><td></td><td></td></tr>";
$message = $message."<tr><td nowrap='true'><b>Ref Doctor</b></td><td>".$doctor."</td><td></td><td></td></tr>";
$message = $message." <tr><td colspan='6'><hr/></td></tr>";
$message = $message."<tr ><td nowrap='true'   colspan='3'><b>Tests</b></td><td colspan='2' nowrap='true'><b>Amount</b></td></tr>";

$totalPrice = 0;$testandprice = "";
for($i=0;$i<$_POST['counter'];$i++){
    
    $namevalue = $_POST['textbox'.$i];
    $testdata = explode("#", $namevalue);
    $totalPrice = $totalPrice+$testdata[2];
   //($diagtype,$nameValue,$appointmentId,$patientId)
    $ad->insertNonPrescriptionDiagnosisDetails("MEDICAL TEST",$testdata[0],$appointmentInfo,$patientid,$receiptId,$testdata[2]);
     $message = $message."<tr><td nowrap='true'  colspan='3'>".ucwords($testdata[1])."</td><td colspan='2'>Rs".$testdata[2]."/-</td></tr>";
      $testandprice =$testandprice."  ".$testdata[1]." : Rs ".$testdata[2];
}
//$updateappointment = $ad->updateAppointmentWithLabPrice($appointmentInfo,$totalPrice);
    $alertmessage = "Data Updated Successfully. ";
   // $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=newReport";


} catch (Exception $ex) {
    
    echo $ex->getMessage();
    echo $ex->getFile;
    echo $ex->getLine();
     $alertmessage = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=newReport";
}

if($discountToApply > 0){
    $discountPercent = $discountToApply;
    $finalAmount = ($totalPrice-(($totalPrice*$discountToApply)/100));
    $discountAmount = (($totalPrice*$discountToApply)/100);
}else{
    $discountPercent = "0";
    $finalAmount = $totalPrice;
    $discountAmount = "0";
}
$message = $message."<tr><td colspan='6'><hr/></td></tr>";
$message = $message."<tr><td colspan='2'><b>Test Amount</b></td><td colspan='4'>".$totalPrice."</td></tr>";
$message = $message."<tr><td colspan='2'><b>Discount </b></td><td colspan='4'>".$discountAmount." {Discount : ".$discountToApply."% }"
        . "<inptut type='hidden' class='textcss' name='hiddiscountAmount' id='hiddiscountAmount' value='".$discountAmount."'/>"
        . "<inptut type='hidden' class='textcss' name='hiddiscountToApply' id='hiddiscountToApply' value='".$discountToApply."'/></td></tr>";
$message = $message."<tr><td colspan='2'><b>Final Amount</b></td><td colspan='4'>Rs ".$finalAmount." /-<inptut type='hidden' class='textcss' name='hidfinalamount' id='hidfinalamount' value='".$finalAmount."'></td></tr>";
$message = $message."<tr><td colspan='2'><b>Paid Amount</b></td><td colspan='4' align='left'>Rs<span id='payingamount'></span>  /-</td></tr>";
$message = $message."<tr><td colspan='6'></td></tr>";
$message = $message."<tr><td colspan='6'><b>Report Time</b></td></tr>";
$message = $message."<tr><td colspan='6'></td></tr>";
$message = $message."<tr><td colspan='6'><hr/></td></tr>";
$message = $message."<tr><td colspan='6' align='right'><b>Lab Technician </b></td></tr>";
$message = $message."<tr><td colspan='6'><br/></td></tr>";
$message = $message."<tr><td colspan='6'><b>Test result refer to item tested </b></td></tr>";
$message = $message."</table>";
$message = $message." </div>";
	  
	  
$message = $message." </body>";
$message = $message."</html>";

print_r($message);
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Business/PrintLabSampleCollection.php?apid=".$appointmentInfo."&from=lab&price=";
?>
 </div>

<div class="col-md-13 sky-form" id="payment-options">
      <div class="row">
          <section class="col-md-2"></section>  
          <section class="col-md-9" >
    <?php 
     // print_r($data);
    include '../common/payment.php';
    
    ?>
          </section> <section class="col-md-2"></section>  
        </div>
</div>
</div>
 <script>
     function onvoucherselect(){
         console.log( $('#vouchercash').val()); // or $(this).val()
        
        vouchervalue = $('#vouchercash').val();
        
        voucherdata = vouchervalue.split("$");
         if(voucherdata[6] > 0){
            var cashstatus = confirm("Card and other discounts will not be applied when cash voucher is applied");
            console.log(cashstatus);
            console.log("Discount to amount..................."+$('#hiddiscountAmount').val());
             console.log("Discount to apply..................."+$('#hiddiscountToApply').val());
              console.log("final amount to apply..................."+$('#hidfinalamount').val());
         } 
        if(voucherdata[1] == "Fixed"){
            
            var vcash = parseInt(voucherdata[0].split("}")[1]);
        }else{
            console.log(voucherdata[4]);
            console.log(voucherdata[5]);
            console.log(('<?php echo $finalAmount; ?>' ));
            if(voucherdata[4] != '-'){
               
                if('<?php echo $finalAmount; ?>' < voucherdata[4]){
                     $('#vamount').val(0);
                    alert(" Sorry you cant apply this voucher,Minimum bill amount must be "+voucherdata[4]);
                    return false;
                }
            }
            if(voucherdata[5] != '-'){
                
                if('<?php echo $finalAmount; ?>' > voucherdata[5]){
                    $('#vamount').val(0);
                    alert(" Sorry you cant apply this voucher,Maximum bill amount must be "+voucherdata[5]);
                    return false;
                }
            }
            if(voucherdata[4] != '-' &&  voucherdata[5] != '-'){
                 console.log(('<?php echo $finalAmount; ?>' > voucherdata[4]));
                  console.log(('<?php echo $finalAmount; ?>' < voucherdata[5]));
                console.log(('<?php echo $finalAmount; ?>' > voucherdata[4] && '<?php echo $finalAmount; ?>' < voucherdata[5]));
                if(voucherdata[4] != "0" && ('<?php echo $finalAmount; ?>' > voucherdata[4] && '<?php echo $finalAmount; ?>' < voucherdata[5])){
                     $('#vamount').val(0);
                    alert(" Sorry you cant apply this voucher,As bill amount is not in range between "+voucherdata[5]);
                    return false;
                }
            }
            
             var vcash = parseInt('<?php echo $finalAmount; ?>')*parseInt(voucherdata[0].split("{")[0])/parseInt(100);
        }
        
       
        $('#vamount').val(vcash);
        
     }
       function updatepaidamount(){
        console.log($('#paidamount').val());
        $('#payingamount').html($('#paidamount').val());
         console.log($('#paidamount').val());
        $('#payingamount').html($('#paidamount').val());
        console.log("Hidden Value..."+$('#hidfinalamount').val());
        finalamount = $('#hidfinalamount').val();
        console.log("Final Amount"+parseInt(finalamount));
        console.log(parseInt($('#paidamount').val()));
        console.log((parseInt(finalamount)-parseInt($('#paidamount').val())));
        $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
    }
function myFunction() {
     $('#paidamount').val(0);
    paymenttype = $('#paymenttype').val();
    paidamount = $('#paidamount').val();
    creditcardnumber = $('#creditcardnumber').val();
    creditcardname = $('#creditcardname').val();
    
    cvv = $('#cvv').val();
    cardtype = $('#cardtype').val();
    wallet = $('#wallet').val();
    mycash = $('#mycash').val();
    // finalamount =  $('#finalcost').val();
    paidamount = $('#paidamount').val();
    onlycash = "0";
    //alert($('#cash').is(":checked"));alert($('#camount').val() != "");
      finalamount = '<?php echo $finalAmount; ?>';
  if ($('#cash').is(":checked") && $('#camount').val() != "")
    {
     // alert("Cash"+parseInt(paidamount)+"            "+parseInt($('#camount').val()));
     onlycash = $('#camount').val();
      paidamount = parseInt(paidamount)+parseInt($('#camount').val());
      $('#paidamount').val(paidamount);
      $('#payingamount').html($('#paidamount').val());
      $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
      
    }
    if ($('#creditcard').is(":checked") && $('#ccamount').val() != "")
    {
     // alert("Credit Card");
       paidamount = parseInt(paidamount)+parseInt($('#ccamount').val());
      $('#paidamount').val(paidamount);
      $('#payingamount').html($('#paidamount').val());
       $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
    }
 if ($('#debitcard').is(":checked") && $('#dcamount').val() != "")
    {
     // alert("Debit  Card");
       paidamount = parseInt(paidamount)+parseInt($('#dcamount').val());
      $('#paidamount').val(paidamount);
      $('#payingamount').html($('#paidamount').val());
       $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
    }
   if ($('#mycash').is(":checked") && $('#mccamount').val() != "")
    {
      //alert("mycash"+parseInt($('#mcamount').val()));
       paidamount = parseInt(paidamount)+parseInt($('#mccamount').val());
      $('#paidamount').val(paidamount);
      $('#payingamount').html($('#paidamount').val());
       $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
    }
    if ($('#voucher').is(":checked") && $('#vouchercash').val() != "")
    {
      /*  var percentamount = $('#vouchercash').val();
        console.log("percentamount : "+percentamount);
        amountpercentpaid = (parseInt(percentamount)*parseInt(finalamount))/100;
       */ 
        voucherdata = vouchervalue.split("$");

        if(voucherdata[1] == "Fixed"){
            
            var vcash = parseInt(voucherdata[0].split("}")[1]);
        }else{
             var vcash = parseInt('<?php echo $finalAmount; ?>')*parseInt(voucherdata[0].split("{")[0])/parseInt(100);
        }
        
        
        console.log("amountpercentpaid : "+vcash);
         paidamount = parseInt(paidamount)+parseInt(vcash);
         console.log("paidamount : "+paidamount);
         
          $('#paidamount').val(paidamount);
          $('#payingamount').html($('#paidamount').val());
           $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
           console.log("balance amount : "+parseInt(finalamount)-parseInt($('#paidamount').val()));
          
    }    
   if ($('#wallet').is(":checked") && $('#wcamount').val() != "")
    {
       var wamount = parseInt($('#wcamount').val());
       console.log("w amount"+wamount);
       console.log("paid amount * .25"+(parseInt(paidamount) * 0.25));
       console.log((wamount > (parseInt(paidamount) * 0.25)));
         if(wamount > (parseInt(paidamount) * 0.25)){
             alert("More the 25% amount cant be paid by wallet");
             return false;
         }
       paidamount = parseInt(paidamount)+parseInt($('#wcamount').val());
      $('#paidamount').val(paidamount);
      $('#payingamount').html($('#paidamount').val());
       $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
    }
   /* if ($('#voucher').is(":checked") && $('#vamount').val() != "")
    {
     // alert("Credit Card");
       paidamount = parseInt(paidamount)+parseInt($('#vamount').val());
      $('#paidamount').val(paidamount);
      $('#payingamount').html($('#paidamount').val());
       $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
    }*/
    console.log(finalamount);
    console.log(paidamount);
    if(paidamount == ""){
       
       alert("Please enter paying options");
       return false;
    }
    finalamount = parseInt(finalamount);
    
    if($('#specialdiscount').val() != "billwaver"){
    
     discgrantamount = $('#discgrantamount').val();
        if(discgrantamount == "" || discgrantamount < 1){
            
             alert("Please enter bill waver amount");
             return false;
        }
    }
    if($('#specialdiscount') != "billwaver"){
      discgrantamount = $('#discgrantamount').val();
      paidamount1 = parseInt(discgrantamount)+parseInt(paidamount);
       if(paidamount1 != finalamount){
        alert("Paying Amount cant be less then or greater  final payable amount");
        return false;
      }
     paidamount =  parseInt(discgrantamount)+parseInt(paidamount);
    }
   ccamount = 0;
   
   
   if($('#ccardtype').val() != "creditcard" && $('#ccamount').val() != "" || $('#ccamount').val() < "1"){
   
    ccard = $('#ccardtype').val();
    ccamount = $('#ccamount').val();
   }
   dcamount = 0;
    if($('#dcardtype').val() != "creditcard" && $('#dcamount').val() != "" || $('#dcamount').val() < "1"){
   
    dcard = $('#dcardtype').val();
    dcamount = $('#dcamount').val();
   }
   
   
    
       var receipt = '<?php echo $receiptId;?>';
     var  towhom = '<?php echo $flagType;?>';
       var mobile =  '<?php echo $mobile;?>';
         var discountType = '<?php echo $discounType; ?>';
       console.log(mobile);
     //  mobile = "7760059002";
    var shopname = '<?php echo $hosiptalName[0]->diagnosticsname;?> ';
    console.log(shopname);
    var testDetails = '<?php echo $testandprice;?>';
    console.log(testDetails);
    var message = shopname+" : Bill amount for your Tests is : "+'<?php echo $totalPrice;?>'+" Discount : "+<?php echo $discountToApply;?>+" (%) Final Amount : "+$('#paidamount').val()+" Test Conducting are : "+testDetails;
    var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="
                    				+mobile+"&text="+message+"&priority=ndnd&stype=normal";
                                      
                $.post(url, function(data){
                        //Need to show some message if we get response from the SMS api.
                        //Currently we are just sending Message after Signup
                });


    if(paymenttype == "wallet"){
        if(wallet == ""){
            alert("You have in sufficeant balance. Can't pay using wallet");
            return false;
        }
       
    }
    if(paymenttype == "mycash"){
        if(mycash == ""){
            alert("You have in sufficeant balance. Can't pay using My Cash");
            return false;
        }
        console.log(mycash);
         console.log(mycash < paidamount);
        if(mycash != "" && mycash < paidamount){
            alert("Insufficeant balance.Please lower the paying amount");
            return false;
        }
    }
    $('#printbutton').hide();
    $('#payment-options').hide();
    $('#header').hide();
    console.log($('#totalprice').val());
    $('#paymentoption').hide();
    window.print();
   /* 
    console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>);
    console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt);
    console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt+
           '&discamount='+<?php echo $discountToApply;?>);
    console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt+
           '&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom);
    console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt+
           '&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>);
    console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt+
           '&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+
   '&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash+'&wallet='+$('#wcamount').val());
    
    
    
    console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt+
           '&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+
   '&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash+'&wallet='+$('#wcamount').val()+'&mycash='+$('#mccamount').val()+'&voucher='+$('#vamount').val()+'&discountType='+discountType);
    */   window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt+
           '&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+
   '&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash+'&wallet='+$('#wcamount').val()+'&mycash='+$('#mccamount').val()+'&voucher='+$('#vouchercash').val()+'&discountType='+discountType+
           '&billwaver='+$('#specialdiscount').val()+'&waveramount='+$('#discgrantamount').val()+
           '&ccard='+ccard+'&ccamount='+ccamount+
           '&dcard='+dcard+'&dcamount='+dcamount; 
   
    
  /*//  window.location.href='<?php  echo $url; ?>'+$('#paidamount').val();
    if(paymenttype != "wallet"){
       window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&discamount='+<?php echo $_SESSION['discpercent'];?>+'&patientid='+<?php echo $patientid;?>;
    }else {
      window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&discamount='+<?php echo $_SESSION['discpercent'];?>+'&wallet=Y&patientid='+<?php echo $patientid;?>;
      
    }*/
}
</script>

<script>
setTimeout(function () {
   // alert("<?php echo $alertmessage ;?>");
 //   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 10000);

</script>
