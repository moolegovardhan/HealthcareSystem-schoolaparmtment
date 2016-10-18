<?php
session_start();
?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<!-- link rel="stylesheet" type="text/css" href="../config/content/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../config/content/site.css" />
    <script src="../config/scripts/modernizr-2.6.2.js"></script -->

<!-- CSS Global Compulsory -->
<link rel="stylesheet"
      href="../Web/config/content/assets/plugins/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="../Web/config/content/assets/css/style.css" />
<!-- CSS Implementing Plugins -->
<link rel="stylesheet" type="text/css"
	href="../Web/config/content/assets/plugins/line-icons/line-icons.css" />
<link rel="stylesheet" type="text/css"
	href="../Web/config/content/assets/plugins/font-awesome/css/font-awesome.min.css" />
<!-- CSS Theme -->
<link rel="stylesheet" type="text/css"
	href="../Web/config/content/assets/css/themes/orange.css" id="style_color" />

<link rel="stylesheet" type="text/css"
	href="../Web/config/content/assets/css/plugins/brand-buttons/brand-buttons.css">
<link rel="stylesheet" type="text/css"
	href="../Web/config/content/assets/css/plugins/brand-buttons/brand-buttons-inversed.css">
<!-- CSS Customization -->
<link rel="stylesheet" type="text/css"
	href="../Web/config/content/assets/css/custom.css" />
<link rel="stylesheet"
	href="../Web/config/content/assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css">
<style>
    td, th {
  width: 4rem;
  height: 2rem;
  border: 1px solid #FFFFFF;
  text-align: justify;
}
th {
  background: lightblue;
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
include_once 'MedicalData.php';
include_once 'MasterData.php';
include_once 'PatientData.php';
include_once 'PatientPrescription.php';
include_once 'AppointmentData.php';
include_once 'DiscountData.php';

$ad = new AppointmentData();

$pp = new PatientPrescription();
$md = new MedicalData();
$pd = new PatientData();
$master = new MasterData();
$discountData = new DiscountData();

$overAllDiscount = $discountData->fetchInstitution($_SESSION['officeid'],'Medical');

//fetchCardInstitutionNameSearchDetails($endtype,$cardName,$cardId)
$patientId = $_POST['medicinesforPatient'];

$patientdata = json_decode($pd->patientDetails($patientId));

$primaryMemberId = $patientdata[0]->primarymemberid;
        
if($primaryMemberId == "")        
        $voucherDetails = ($pd->fetchPatientVoucherDetails($patientId,'Medical'));
    else {
         $voucherDetails = ($pd->fetchPatientVoucherDetails($primaryMemberId,'Medical'));
}
$systemDiscount = $pd->fetchSystemDiscounts('medical');
$percent = $systemDiscount[0]->percent;
//print_r($primaryMemberId);
//print_r($voucherDetails);
$counter = $_POST['counter'];
$totalCost = $_POST['medicinescost'];
$patientDetails = $pd->patientDetails($patientId);
$details = json_decode($patientDetails);
//print_r($details);echo "<br/>";
for($i = 1;$i<$counter+1;$i++){
    $data = $_POST['textbox'.$i];
    if(strlen($data) > 1){
        
    }
}
$discountToApply = "";
$flagType = "";
$cgsDiscount = "";
//print_r($patientdata);echo "<br/>";
$address = $patientdata[0]->address;
$udid = $patientdata[0]->udid;
$cardtype = $patientdata[0]->cardtype;
$totalamount = $patientdata[0]->totalamount;
$wallet = $patientdata[0]->wallet;
$voucher = $patientdata[0]->voucher;
$mobile = $patientdata[0]->mobile;
//echo "sddasddasda".$_SESSION['officeid'];
$patientSpecificCardDiscount = Array();
if($cardtype != ""){
if(is_int($cardtype)){
    $cardName = "NA";
    $cardId = $cardtype;
}else{
     $cardName = $cardtype;
    $cardId = "NA";
}

$patientSpecificCardDiscount = $discountData->fetchCardInstitutionNameSearchDetails('Medical', $cardName, $cardId);
}echo "<br/>";
$OverAllDiscountForCGS = "0";
if(sizeof($overAllDiscount)> 0){
    $OverAllDiscountForCGS = $overAllDiscount[0]->discount;
}


if(sizeof($discountDetails)< 1){
   // echo "Helo";
    $discountDetails = $master->getSpecificLabDiscountData($_SESSION['officeid'],'Medical Shop');
}echo "<br/>";
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
   echo " patientSpecificNonCardDiscount : ";print_r($patientSpecificNonCardDiscount);echo "<br/>";
   echo "Size of ";print_r(sizeof($patientSpecificNonCardDiscount));echo "<br/>";
   $nonCardMobileAppUserDiscount = "0";
  if(sizeof($patientSpecificNonCardDiscount) > 0){
      
      $nonCardMobileAppUserDiscount = $patientSpecificNonCardDiscount[0]->discount;
  }  

  /*
//print_r($discountDetails);echo "discount";echo "<br/>";
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
   * 
   */
  $fromhome = "0";
//echo "<br/>";echo $cgs;
//echo "<br/>";
$date1 = new DateTime("now");
//var_dump($date1);echo "Card Expiry : ";echo "<br/>";
//echo $patientdata[0]->cardexpiry;
$date2 = new DateTime($patientdata[0]->cardexpiry);

$discounType = "";
if($date2 < $date1){
    $cardtype = "";
}
 $discountToApply ="0";
 $cgsDiscount = "0";

if($percent == 0){

if($address == "" || strlen($address) < 1 ){
    $discountToApply = 0;
    $cgsDiscount = $OverAllDiscountForCGS;
    $flagType = "ToCGS";//
    $discounType = "Quick Register";
    echo " Address Discoutn to Apply : ";print_r($discountToApply);echo "<br/>";
 echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

}else if($cardtype != "" ){
     $discountToApply = $cardDiscountToApply;
    $cgsDiscount = $OverAllDiscountForCGS- $cardDiscountToApply;
    $flagType = "ToBoth";//
    $discounType = "Quick Register";
     echo "Quick Discoutn to Apply : ";print_r($discountToApply);echo "<br/>";
 echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

}else if($udid != "" && $mobile != ""){
        $discountToApply = $patientSpecificMobileDiscount;
        $cgsDiscount = $OverAllDiscountForCGS- $patientSpecificMobileDiscount;
        $flagType = "ToBoth";//
        $discounType = "Mobile App";
         echo "Mobile Discoutn to Apply : ";print_r($discountToApply);echo "<br/>";
 echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

}else{
     $discountToApply = $nonCardMobileAppUserDiscount;
    $cgsDiscount = $OverAllDiscountForCGS-$nonCardMobileAppUserDiscount;
    $flagType = "ToCGS";//
    $discounType = "Non Card or Mobile User";
     echo "Non Card Discoutn to Apply : ";print_r($discountToApply);echo "<br/>";
 echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

}
    
}else{
    
     $cgsDiscount = 0;
     $flagType = "ToInst";
     $discountToApply = $percent;
     $discounType = "System Discount";
    
}
 echo "Discoutn to Apply : ";print_r($discountToApply);echo "<br/>";
 echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

/*
if($percent == 0){
if($address == "" || strlen($address) < 1 ){echo "15";echo "<br/>";
 $discountToApply = 0;
 $cgsDiscount = $cgs;
 $flagType = "ToCGS";//
 $discounType = "Quick Register";
}else if($cardtype == "Promotional"){echo "13";echo "<br/>";
    $discountToApply = $promotional;
    $cgsDiscount = $cgs - $promotional;
    $flagType = "ToBoth";
    $discounType = "Promotional";
}else if($cardtype == "SilverFamily"){echo "12";echo "<br/>";
    $discountToApply = $general;
    $cgsDiscount = $cgs - $general;
    $flagType = "ToBoth";
    $discounType = "SilverFamily";
}else if($cardtype == "SilverIndividual"){echo "11";echo "<br/>";
    $discountToApply = $silver;
    $cgsDiscount = $cgs - $silver;
    $flagType = "ToBoth";
    $discounType = "SilverIndividual";
}else if(strlen($udid) > 1 ){ echo "1";echo "<br/>";
    $discountToApply = $appuser;
    $cgsDiscount = $cgs - $appuser;
    $flagType = "ToBoth";
     $discounType = "Mobile";
}else {echo "in ELse";
        $discountToApply = "0";
        $cgsDiscount = $quickregister;
        $flagType = "ToCGS";
         $discounType = "Non Card";
}
}else{echo "In final else";echo "<br/>";
    $cgsDiscount = 0;
     $flagType = "ToInst";
     $discountToApply = $percent;
       $discounType = "System Discount";
} 
 * 
 * 
 * 
 */        
//echo "<br/>";
//echo $discountToApply;echo "<br/>";
//echo $cgsDiscount;echo "<br/>";
$date = (date('ymdHis'));//echo "<br/>";
$receiptId =  "HCM".$date."MEDICINE".mt_rand(0, 999);

?>
<br/>

<?php 

//echo "Record Count : ".$hidcount; echo "<br/>";
try{
?>
<!--div id="printbutton">
 <button class="btnExample" onclick="myFunction()" type="button" value="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>
 </div--><br/>
<table width="80%" cellspacing="0" cellpadding="0" border="0" align="center">
    <tr> <td><b>Receipt </b></td><td colspan="2"><?php echo $receiptId;?></td></tr>
    <tr> <td ><b>Patient Name</b></td><td colspan="2"><?php echo $details[0]->name;?></td></tr>
     <tr> <td><b>Date </b></td><td colspan="2"><?php echo date("d.m.Y");?></td></tr>
      <tr>
       <td colspan="3" style="height: 5px;"><hr/></td>
    </tr>
    <tr bgcolor="#81F7BE">
        <th style="color: #990000;" width="60%"><b>Medicine Name</b></th>
         <th style="color: #990000;" width="20%"><b>Medicine Distributed</b></th>
          <th style="color: #990000;" width="20%"><b>Cost (Rs)</b></th>
    </tr>
    
<?php  

for($i = 1;$i<$counter+1;$i++){
    $data = $_POST['textbox'.$i];
    if(strlen($data) > 1){
   
    $passonvalue = explode("#", $data);
    
    $distribute = $passonvalue[1];
    $original = $passonvalue[1];
    $cost = $passonvalue[2];
    $medicineindex = "0";   
    $patientid = $patientId;
    $appointmentid =   "0";     
    $medicinename =   $passonvalue[0]; 
    if($cost != "" && $distribute != ""){
     
        $md->insertMedicineDistributionDetails($medicineindex, $cost, $distribute, $original, $patientid, $appointmentid, $medicinename,$receiptId);
    
        
  ?>
   
     <tr>
        <td width="60%"><?php echo $medicinename; ?></td>
         <td width="20%"><?php echo $distribute; ?></td>
          <td width="20%"><?php echo $cost; ?>/-</td>
    </tr>
    
  <?php  
  }
    }
 }
 ?>
    <tr>
       <td colspan="3" style="height: 5px;"><hr/></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: end;">Total Cost :&nbsp;&nbsp;</td>
        <td  align="right">  <b>Rs. <?php echo $totalCost;?>/-</b></td>
    </tr> 
    <tr>
        <td colspan="2" style="text-align: end;">Discount :&nbsp;&nbsp;</td>
        <td  align="right">  <b> <?php echo $discountToApply;?> %</b>
          <input type="hidden" id="discounttoapply" name="discounttoapply"  value="<?php echo $discountToApply; ?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: end;">Final Amount :&nbsp;&nbsp;</td>
        <td  align="right">  <b>Rs. <?php 
        
               $amount =  ($totalCost-(($totalCost*$discountToApply)/100));
               echo $amount;
        ?>/-</b>
        <input type="hidden" id="finalcost" name="finalcost"  value="<?php echo $amount; ?>"/>
        
        </td>
    </tr>
    <tr>
        <td colspan="3" class="sky-form">
            
             <?php 
                // print_r($data);
               include '../Web/common/payment.php';

               ?>
        </td>
    </tr>
</table> 
 <?php   
//$medicineId,$cost,$distributed,$original,$patientid,$appointmentid)
//userDetails.id+"$"+userDetails.totalcount+"$"+userDetails.patientid+"$"+userDetails.appointmentid+"$"+userDetails.medicinename  
    $message = "Data Updated Successfully. ";
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/medical/medicalindex.php?page=distribution";
}catch(Exception $ex){
    $message = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/medical/medicalindex.php?page=distribution";
}
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Business/PrintLabSampleCollection.php?apid=".$appointmentid."&from=medicine&price=";

?>
 <?php   
//$medicineId,$cost,$distributed,$original,$patientid,$appointmentid)
//userDetails.id+"$"+userDetails.totalcount+"$"+userDetails.patientid+"$"+userDetails.appointmentid+"$"+userDetails.medicinename  
  /*  $message = "Data Updated Successfully. ";
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/medical/medicalindex.php?page=nonprescription";
}catch(Exception $ex){
    $message = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/medical/medicalindex.php?page=nonprescription";
} */
 //$receiptId = "Pavan";
?>
 
<script type="text/javascript"
src="../Web/config/content/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- JS Implementing Plugins -->
	<script type="text/javascript"
		src="../Web/config/content/assets/plugins/back-to-top.js"></script>
	<!-- JS Page Level -->
	<script type="text/javascript" src="../Web/config/content/assets/js/app.js"></script>
	<script type="text/javascript"
		src="../Web/config/content/assets/js/plugins/datepicker.js"></script>
<script>
      function onvoucherselect(){
            console.log( $('#vouchercash').val()); // or $(this).val()
            $('#vamount').val($('#vouchercash').val());

         }
    function updatepaidamount (){
        console.log("Hello");
    }
    function myFunction() {
        paidamount = 0;
    paymenttype = $('#paymenttype').val();
    creditcardnumber = $('#creditcardnumber').val();
    creditcardname = $('#creditcardname').val();
    cvv = $('#cvv').val();
    cardtype = $('#cardtype').val();
    wallet = $('#wallet').val();
    mycash = $('#mycash').val();
    finalamount =  $('#finalcost').val();
    paidamount = "0";
    onlycash = "0";
    //alert($('#cash').is(":checked"));alert($('#camount').val() != "");
    if ($('#cash').is(":checked") && $('#camount').val() != "")
    {
     // alert("Cash"+parseInt(paidamount)+"            "+parseInt($('#camount').val()));
     onlycash = $('#camount').val();
      paidamount = parseInt(paidamount)+parseInt($('#camount').val());
      $('#paidamount').val(paidamount);
    }
    if ($('#creditcard').is(":checked") && $('#ccamount').val() != "")
    {
     // alert("Credit Card");
       paidamount = parseInt(paidamount)+parseInt($('#ccamount').val());
      $('#paidamount').val(paidamount);
    }
 if ($('#debitcard').is(":checked") && $('#dcamount').val() != "")
    {
     // alert("Debit  Card");
       paidamount = parseInt(paidamount)+parseInt($('#dcamount').val());
      $('#paidamount').val(paidamount);
    }
     if ($('#mycash').is(":checked") && $('#mccamount').val() != "")
    {
      //alert("mycash"+parseInt($('#mcamount').val()));
       paidamount = parseInt(paidamount)+parseInt($('#mccamount').val());
      $('#paidamount').val(paidamount);
    }
      if ($('#wallet').is(":checked") && $('#wcamount').val() != "")
    {
       var wamount = parseInt($('#wcamount').val());
         if(wamount > (parseInt(paidamount) * 0.25)){
             alert("More the 25% amount cant be paid by wallet");
             return false;
         }
       paidamount = parseInt(paidamount)+parseInt($('#wcamount').val());
      $('#paidamount').val(paidamount);
    }
     if ($('#voucher').is(":checked") && $('#vamount').val() != "")
    {
        var percentamount = $('#vamount').val();
        console.log("percentamount : "+percentamount);
        amountpercentpaid = (parseInt(percentamount)*parseInt(finalamount))/100;
        console.log("amountpercentpaid : "+amountpercentpaid);
         paidamount = parseInt(paidamount)+parseInt(amountpercentpaid);
         console.log("paidamount : "+paidamount);
          $('#paidamount').val(paidamount);
         //  $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
        //   console.log("balance amount : "+parseInt(finalamount)-parseInt($('#paidamount').val()));
          
    }
    
    if(paidamount == ""){
       
       alert("Please enter paying options");
       return false;
    }
    
    if(paymenttype == "wallet"){
        if(wallet == ""){
            alert("You have in sufficeant balance. Can't pay using wallet");
            return false;
        }
        console.log(wallet);
         console.log(wallet < paidamount);
        /*if(wallet != "" && wallet < paidamount){
            alert("Insufficeant balance.Please lower the paying amount");
            return false;
        }*/
    }
    if(paymenttype == "mycash"){
        if(mycash == ""){
            alert("You have in sufficeant balance. Can't pay using My Cash");
            return false;
        }
       
        if(mycash != "" && mycash < paidamount){
            alert("Insufficeant balance.Please lower the paying amount");
            return false;
        }
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
       paidamount=   parseInt(discgrantamount)+parseInt(paidamount);
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
    
    
    
    
    //alert(paidamount);
    var receipt = '<?php echo $receiptId;?>';
    var  towhom = '<?php echo $flagType;?>';
     var mobile =  '<?php echo $mobile;?>';
       var discountType = '<?php echo $discounType; ?>';
       
    var shopname = '<?php echo $_SESSION['shoppingname'];?> ';
    var message = shopname+" : Bill amount for your medicines is :  Rs "+'<?php echo $totalCost;?>'+" Discount : "+<?php echo $discountToApply;?>+" (%) Final Amount :  Rs "+$('#paidamount').val();
    var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="
                    				+mobile+"&text="+message+"&priority=ndnd&stype=normal";
                                      
                    	$.post(url, function(data){
                    		//Need to show some message if we get response from the SMS api.
                    		//Currently we are just sending Message after Signup
                    	});
    
   /* console.log(receipt);
    console.log('<?php  echo $url; ?>'+$('#paidamount').val());
    
    console.log('<?php  echo $url; ?>'+$('#paidamount').val());
    console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&receiptid='+receipt);
    console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&receiptid='+receipt+'&totalamount='+<?php echo $totalCost;?>);
    
    */
    $('#paymentoption').hide();
    window.print();
        window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid='+receipt+
           '&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+
   '&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash+'&wallet='+$('#wcamount').val()+'&mycash='+$('#mccamount').val()+'&voucher='+$('#vamount').val()+'&discountType='+discountType+
           '&billwaver='+$('#specialdiscount').val()+'&waveramount='+$('#discgrantamount').val()+
           '&ccard='+ccard+'&ccamount='+ccamount+
           '&dcard='+dcard+'&dcamount='+dcamount; 
         
   
   /*   if(paymenttype != "wallet"){
      // window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid='+receipt+'&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+'&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
    }else  if(paymenttype == "wallet"){
     // window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid="+receipt+"&discamount='+<?php echo $discountToApply;?>+'&flagType="+towhom+"&cgsdiscount='+<?php echo $cgsDiscount;?>+'&wallet=Y&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
      
    }else  if(paymenttype == "mycash"){
       //   window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid="+receipt+"&discamount='+<?php echo $discountToApply;?>+'&flagType="+towhom+"&cgsdiscount='+<?php echo $cgsDiscount;?>+'&wallet=N&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
    
     } 
   // console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid="+receipt+"&discamount='+<?php echo $discountToApply;?>+'&flagType="+towhom+"&cgsdiscount='+<?php echo $cgsDiscount;?>+'&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash); 
}
/*
setTimeout(function () {
    alert("<?php echo $message ;?>");
    window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 10000);
*/
   
   } 
</script>


