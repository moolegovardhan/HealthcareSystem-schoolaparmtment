<?php 
ini_set('display_errors', false);?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

<div class="col-md-12">
<?php 
try{
include_once '../../Business/PatientData.php'; 
include_once '../../Business/PatientPrescription.php';
include_once '../../Business/AppointmentData.php';
include_once '../../Business/MasterData.php';
include_once '../../Business/DiscountData.php';


$ad = new AppointmentData();
$pd = new PatientData();
$master = new MasterData();
$pp = new PatientPrescription();
$discountData = new DiscountData();

$userId = $_SESSION['userid'];
$recordCount = $_POST['recordcount'];
$patientid = $_POST["hidpatientid"];        
$appointmentId = $_POST['appointmentidhid'];
$samplecollectiontype = $_POST['samplecollectiontype'];
$totalPrice = 0;
$appData = $ad->getAppointmentPatientList("nodata",$patientid,"nodata");
$patientdata = json_decode($pd->patientDetails($patientid));

$primaryMemberId = $patientdata[0]->primarymemberid;
        
if($primaryMemberId == "")        
        $voucherDetails = ($pd->fetchPatientVoucherDetails($patientid,'Lab'));
    else {
         $voucherDetails = ($pd->fetchPatientVoucherDetails($primaryMemberId,'Lab'));
}


$billDicount = $master->fetchBillPayDiscount("Lab");


$overAllDiscount = $discountData->fetchInstitution($_SESSION['officeid'],'Lab');



$systemDiscount = $pd->fetchSystemDiscounts('lab');
$percent = $systemDiscount[0]->percent;
//print_r($patientdata);
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
    
    $patientSpecificMobileDiscount = $discountData->fetchCardInstitutionNameSearchDetails('Medical', 'Mobile' , $cardId);
}

     $patientSpecificNonCardDiscount = "0";
   
    $patientSpecificNonCardDiscount = $discountData->fetchCardInstitutionNameSearchDetails('Medical', 'Non Card' , $cardId);
 //  echo " patientSpecificNonCardDiscount : ";print_r($patientSpecificNonCardDiscount);echo "<br/>";
  // echo "Size of ";print_r(sizeof($patientSpecificNonCardDiscount));echo "<br/>";
   $nonCardMobileAppUserDiscount = "0";
  if(sizeof($patientSpecificNonCardDiscount) > 0){
      
      $nonCardMobileAppUserDiscount = $patientSpecificNonCardDiscount[0]->discount;
  }  
  
   $discountToApply ="0";
 $cgsDiscount = "0";


 
 
 $fromhome = "0";
$date = (date('ymdHis'));//echo "<br/>";
$receiptId =  "HCM".$date."TEST".mt_rand(0, 999);

$date1 = new DateTime("now");
//var_dump($date1);echo "Card Expiry : ";echo "<br/>";
//echo $patientdata[0]->cardexpiry;
$date2 = new DateTime($patientdata[0]->cardexpiry);
/*var_dump($date2);echo "<br/>";
var_dump($date2 > $date1);echo "<br/>";
var_dump($date2 < $date1);echo "<br/>";
var_dump($date2 == $date1);echo "<br/>";
*/
$discounType = "";
if($date2 < $date1){
    $cardtype = "";
}

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
    $flagType = "ToCGS";
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
 //echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

}
    
}else{
    
     $cgsDiscount = 0;
     $flagType = "ToInst";
     $discountToApply = $percent;
     $discounType = "System Discount";
    
}

/*
if($percent == 0){
if($address == "" || strlen($address) < 1 ){
 $discountToApply = 0;
 $cgsDiscount = $cgs;
 $flagType = "ToBoth";//
 $discounType = "Quick Register";
}else if($samplecollectiontype == "home"){ //echo "collect";echo "<br/>";
    $discountToApply = $fromhome;
    $cgsDiscount = $cgs - $discountToApply;
    $flagType = "ToBoth";
    $discounType = "Sample from home";
}else if($cardtype == "Promotional"){ //echo "Promotional";echo "<br/>";
    $discountToApply = $promotional;
    $cgsDiscount = $cgs - $discountToApply;
    $flagType = "ToBoth";
    $discounType = "Promotional";
}else if($cardtype == "SilverFamily"){ //echo "General";echo "<br/>";
    $discountToApply = $general;
    $cgsDiscount = $cgs - $discountToApply;
    $flagType = "ToBoth";
    $discounType = "SilverFamily";
}else if($cardtype == "SilverIndividual"){ //echo "SILVER";echo "<br/>";
    $discountToApply = $silver;
    $cgsDiscount = $cgs - $discountToApply;
    $flagType = "ToBoth";
    $discounType = "SilverIndividual";
}else if(strlen($udid) >1 ){ //echo "APP USER";echo "<br/>";
    $discountToApply = $appuser;
    $cgsDiscount = $cgs - $discountToApply;
    $flagType = "ToBoth";
    $discounType = "Mobile";
}else { //echo " final SMS";echo "<br/>";
        $discountToApply = "0";
        $cgsDiscount = $quickregister;
        $flagType = "ToBoth";
        $discounType = "Non Card";
}         
}else{
    $cgsDiscount = 0;
     $flagType = "TOINST";
     $discountToApply = $percent;
     $discounType = "System Discount";
}

/*echo "<br/>";
echo "Disocunt apply".$discountToApply;
echo "<br/>";
echo "cgs discount ".$cgsDiscount;
echo "<br/>";
*/


$message = "";
$message = $message."<html>";
$message = $message."<head>";
$message = $message."<meta charset='UTF-8'>";
?>
 <style> 
  .textbox { 
    height: 25px; 
    width: 45px; 
    background-color: transparent;  
    border-style: solid;  
    border-width: 0px 0px 1px 0px;  
    border-color: darkred; 
    outline:0; 
  } 
 </style> 

 <!--div id="printbutton">
     <button class="btn-u btn-u-orange pull-right" onclick="myFunction()" type="button" value="button"><i class="fa fa-print"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>
 </div><br/-->
<input type="hidden" name="appointmentid" id="appointmentid" value="<?php  echo $appointmentId; ?>"/>
<div class="col-md-12">
    <?php
$message = $message."<title></title>";
$message = $message." </head>";
$message = $message."<body>";
      
$message = $message."<div class='tg-wrap'>";
$message = $message."<table width='100%' align='center'>";
$message = $message." <tr style='background-color:#6B92FA;color:#FFFFFF;'><td colspan='6' align='center'> Lab Name : ". $hosiptalName[0]->diagnosticsname."</td></tr>";
$message = $message." <tr><td colspan='6'><hr/></td></tr>";
$message = $message." <tr><td nowrap><b>Receipt #v</td><td nowrap>".$receiptId."</td><td nowrap><b>Date</b></td><td nowrap>".date("d-m-Y")."</td><td nowrap><b>Lab ID</b></td><td nowrap>".$hosiptalName[0]->labuniqueid."</td></tr>";
$message = $message." <tr><td nowrap><b>Patient ID</b></td><td>".$patientid."</td><td nowrap><b>Age/Sex</td><td>".$patientdata[0]->age."/".$patientdata[0]->gender."</td><td colspan='2' rowspan='3'></td></tr>";
$message = $message." <tr><td nowrap><b>Patient Name</b></td><td>".$patientdata[0]->name."</td><td></td><td></td></tr>";
$message = $message."<tr><td nowrap><b>Ref Doctor</b></td><td>".$appData[0]->DoctorName."</td><td></td><td></td></tr>";
$message = $message." <tr><td colspan='6'><hr/></td></tr>";
$message = $message."<tr ><td><b>Tests</b></td><td colspan='5'><b>Amount</b></td></tr>";
$message = $message." <tr><td colspan='6'><hr/></td></tr>";
try{
$testandprice = "";
for($i=0;$i<$recordCount;$i++){
  //  echo "Helloooo1  in record count.....";echo "<br/>";
    //echo $_POST[$i];
   // echo $_POST['text'.$i];
    $datatoSplit = explode ("$",$_POST[$i]);
    if(sizeof($datatoSplit)>1){
    //  print_r($datatoSplit);
      $finalPrice = $_POST['text'.$i];
      $totalPrice = $totalPrice+$datatoSplit[2];//($appointmentId,$patientid,$testId,$consultationdiagnosticsId,$userId,$amount)
  //  $result = $pp->collectPatientLabSamples($appointmentId, $patientid, $datatoSplit[1], $datatoSplit[0], $userId, $finalPrice);
     $result = $pp->updateConsultationDiagnosisDetailsForSampleCollected($datatoSplit[0],$datatoSplit[2],$receiptId);
      $message = $message."<tr><td>".$datatoSplit[3]."</td><td colspan='5'>".$datatoSplit[2]."<inptut type='hidden' name='appointmentid' id='appointmentid' value='".$datatoSplit[0]."'></td></tr>";
      $testandprice =$testandprice."  ".$datatoSplit[3]." :  Rs ".$datatoSplit[2];
          $testandprice =$testandprice.'\r\n';
      $patientappointmentid = $datatoSplit[0];
    }
}
//print_r($testandprice);
}  catch (Exception $e){
    echo $e->getMessage();
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
$message = $message."<tr><td colspan='2'><b>Test Amount</b></td><td colspan='4'>Rs ".$totalPrice."/-<inptut type='hidden' name='totalprice' id='totalprice' value='".$totalPrice."'></td></tr>";
$message = $message."<tr><td colspan='2'><b>Discount</b></td><td colspan='4'>".$discountAmount." {Discount : ".$discountToApply."% } </td></tr>";
$message = $message."<tr><td colspan='2'><b>Final Amount</b></td><td colspan='4'>Rs ".$finalAmount." /-<inptut type='hidden' name='hidfinalamount' id='hidfinalamount' value='".$finalAmount."'></td></tr>";
$message = $message."<tr><td colspan='2'><b>Paid Amount</b></td><td colspan='4' align='left'>Rs<span id='payingamount'></span>  /-</td></tr>";
$message = $message."<tr><td colspan='2'><b>Balance Amount</b></td><td colspan='4' align='left'>Rs<span id='balanceamount'></span>  /-</td></tr>";
$message = $message."<tr><td colspan='6'></td></tr>";
$message = $message."<tr><td colspan='6'>Report Time</td></tr>";
$message = $message."<tr><td colspan='6'></td></tr>";
$message = $message."<tr><td colspan='6'><hr/></td></tr>";
$message = $message."<tr><td colspan='6' align='right'>Lab Technician </td></tr>";
$message = $message."<tr><td colspan='6'><br/></td></tr>";
$message = $message."<tr><td colspan='6'>Test result refer to item tested </td></tr>";
$message = $message."</table>";
$message = $message." </div>";
	  
	  
$message = $message." </body>";
$message = $message."</html>";

print_r($message);
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Business/PrintLabSampleCollection.php?apid=".$appointmentId."&from=lab&price=";
} catch(Exception $ex) {
    echo $ex->getMessage();
} 
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
 <script>
      function onvoucherselect(){
         console.log( $('#vouchercash').val()); // or $(this).val()
        
        vouchervalue = $('#vouchercash').val();
        
        voucherdata = vouchervalue.split("$");

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
     //$('#hidfinalamount').val(0);
    function updatepaidamount(){
        console.log($('#paidamount').val());
        $('#payingamount').html($('#paidamount').val());
        console.log("Hidden Value..."+$('#hidfinalamount').val());
        finalamount = $('#hidfinalamount').val();
        console.log("Final Amount"+parseInt(finalamount));
        console.log(parseInt($('#paidamount').val()));
        console.log((parseInt(finalamount)-parseInt($('#paidamount').val())));
        $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
        //finalamount = $('#hidfinalamount').val();
    }//
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
     // alert(finalamount);
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
    if ($('#voucher').is(":checked") && $('#vouchercash').val() != "")
    {
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
      paidamount = parseInt(discgrantamount)+parseInt(paidamount);
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
      // mobile = "7760059002";
    var shopname = '<?php echo $hosiptalName[0]->diagnosticsname;?> ';
    console.log(shopname);
    var testDetails = "<?php echo $testandprice;?>";
    console.log(testDetails);
    var message = shopname+" : Bill amount for your Tests is : Rs "+'<?php echo $totalPrice;?>'+" Discount : "+<?php echo $discountToApply;?>+" (%) Final Amount : Rs "+$('#paidamount').val()+" Test Conducting are : "+testDetails;
    console.log(message);
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
    
       window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt+
           '&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+
   '&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash+'&wallet='+$('#wcamount').val()+'&mycash='+$('#mccamount').val()+'&voucher='+$('#vouchercash').val()+'&discountType='+discountType+
           '&billwaver='+$('#specialdiscount').val()+'&waveramount='+$('#discgrantamount').val()+
           '&ccard='+ccard+'&ccamount='+ccamount+
           '&dcard='+dcard+'&dcamount='+dcamount; 
       
   /* console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>);//
     if(paymenttype != "wallet"){
       window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt+'&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+'&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
    }else  if(paymenttype == "wallet"){
      window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt+'&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+'&wallet=Y&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
      
    }else  if(paymenttype == "mycash"){
          window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&receiptid='+receipt+'&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+'&wallet=N&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
    
     }  */
}
</script>
</div>