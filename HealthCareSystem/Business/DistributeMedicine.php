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
<script>
function myFunction() {
    $('#printbutton').hide();
    window.print();
}
</script>

<?php 
session_start();
?>
<?php 
require 'MedicalData.php';
include_once 'PatientData.php'; 
include_once 'MasterData.php';
include_once 'PatientPrescription.php';
include_once 'AppointmentData.php';
include_once 'DiscountData.php';


$ad = new AppointmentData();
$master = new MasterData();
$pd = new PatientData();
$discountData = new DiscountData();
$pp = new PatientPrescription();
$md = new MedicalData();


$hidcount = $_POST['hidcount'];
$userId = $_SESSION['userid'];
//echo "Record Count : ".$hidcount; echo "<br/>";
$patientid = $_POST['hiddenpatientid'];
$appData = $ad->getAppointmentPatientList("nodata",$patientid,"nodata");
$patientdata = json_decode($pd->patientDetails($patientid));
$voucherDetails = ($pd->fetchPatientVoucherDetails($patientid,'Medical'));
$systemDiscount = $pd->fetchSystemDiscounts('medical');
$percent = $systemDiscount[0]->percent;


$overAllDiscount = $discountData->fetchInstitution($_SESSION['officeid'],'Medical');


//print_r($patientdata);
$discountToApply = "0";
$flagType = "0";
$cgsDiscount = "0";

$billDicount = $master->fetchBillPayDiscount("Medical");


$address = $patientdata[0]->address;
$udid = $patientdata[0]->udid;
$cardtype = $patientdata[0]->cardtype;
$totalamount = $patientdata[0]->totalamount;
$wallet = $patientdata[0]->wallet;
$voucher = $patientdata[0]->voucher;
$mobile = $patientdata[0]->mobile;

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
}//echo "<br/>";
$OverAllDiscountForCGS = "0";
if(sizeof($overAllDiscount)> 0){
    $OverAllDiscountForCGS = $overAllDiscount[0]->discount;
}


if(sizeof($discountDetails)< 1){
   // echo "Helo";
    $discountDetails = $master->getSpecificLabDiscountData($_SESSION['officeid'],'Medical Shop');
}
//print_r($discountDetails);
/*
$quickregister = $discountDetails[0]->noncardholders;
$promotional = $discountDetails[0]->promotional;
$general = $discountDetails[0]->general;
$silver = $discountDetails[0]->silver;
$appuser = $discountDetails[0]->appusers;
$fromhome = $discountDetails[0]->fromhome;
$cgs =  $discountDetails[0]->cgsdiscount;
*/

  $fromhome = "0";
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
//echo "OverAllDiscountForCGS : "; print_r($OverAllDiscountForCGS);
 if($percent == 0){

if($address == "" || strlen($address) < 1 ){
    $discountToApply = 0;
    $cgsDiscount = $OverAllDiscountForCGS;
    $flagType = "ToCGS";//
    $discounType = "Quick Register";
  //  echo " Address Discoutn to Apply : ";print_r($discountToApply);echo "<br/>";
// echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

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
// echo "Discoutn to Apply : ";print_r($discountToApply);echo "<br/>";
// echo "CGS Discount to Apply : ";print_r($cgsDiscount);echo "<br/>";

 
/*
if($percent == 0){
if($address == "" || strlen($address) < 1 ){
 $discountToApply = 0;
 $cgsDiscount = $cgs;
 $flagType = "ToBoth";//
 $discounType = "Quick Register";
}else if($cardtype == "Promotional"){
    $discountToApply = $promotional;
    $cgsDiscount = $cgs - $discountToApply;
    $flagType = "ToBoth";
    $discounType = "Promotional";
}else if($cardtype == "General"){
    $discountToApply = $general;
    $cgsDiscount = $cgs - $discountToApply;
    $flagType = "ToBoth";
    $discounType = "General";
}else if($cardtype == "Silver"){
    $discountToApply = $silver;
    $cgsDiscount = $cgs - $discountToApply;
    $flagType = "ToBoth";
    $discounType = "Silver";
}else if(strlen($udid) > 1 ){//echo "App USer";
    $discountToApply = $appuser;
    $cgsDiscount = $cgs - $discountToApply;
    $flagType = "ToBoth";
     $discounType = "Mobile";
}else {
        $discountToApply = "0";
        $cgsDiscount = $quickregister;
        $flagType = "ToBoth";
         $discounType = "Non Card";
}         
}else{
    $cgsDiscount = 0;
     $flagType = "ToInst";
     $discountToApply = $percent;
       $discounType = "System Discount";
}
*/
$date = (date('ymdHis'));//echo "<br/>";
$receiptId =  "HCM".$date."MEDICINE".mt_rand(0, 999);
//echo "Discount to applu.............";
//print_r($discountToApply);

if($discountToApply == "" || $discountToApply == null || $discountToApply == "null"){
    $discountToApply = "0";
}

if($cgsDiscount == "" || $cgsDiscount == null || $cgsDiscount == "null"){
    $cgsDiscount = "0";
}
 
try{
?>
<!--div id="printbutton">
 <button class="btnExample" onclick="myFunction()" type="button" value="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>
 </div--><br/>
<table width="80%" cellspacing="0" cellpadding="0" border="0" align="center">
    <tr style="background-color: #00bfff">
        <td colspan="3" style="height: 5px;text-align: left;"><?php  echo  $_SESSION['shoppingname'] ;?></td>
    </tr>
    <tr>
        <td colspan="3" style="height: 5px;"><br/></td>
    </tr>
    <tr> <td><b>Receipt </b></td><td colspan="2"><?php echo $receiptId;?></td></tr>
    <tr> <td><b>Patient Name</b></td><td colspan="2"><?php echo $_POST['hiddenpatientname'];?></td></tr>
     <tr> <td><b>Date </b></td><td colspan="2"><?php echo date("d.m.Y");?></td></tr>
     <tr>
        <td colspan="3" style="height: 5px;"><hr/></td>
    </tr>
    <tr>
        <th style="color: #990000;"><b>Medicine Name</b></th>
         <th style="color: #990000;"><b>Medicine Distributed</b></th>
          <th style="color: #990000;"><b>Cost (Rs)</b></th>
    </tr>
<?php  
$totalCost = 0;
for($i = 0;$i<$hidcount+1;$i++){
   /* echo'medicinedist'.$i;echo "<br/>";
    echo "Distribute Count : ".$_POST['medicinedist'.$i];echo "<br/>";
    echo "Medicine Index : ".$_POST['medicine'.$i];echo "<br/>";
    echo "Price : ".$_POST['medicineprice'.$i];echo "<br/>";
    */
    $passonvalue = explode("$", $_POST['medicine'.$i]);
    
    $distribute = $_POST['medicinedist'.$i];
    $original = $passonvalue[1];
    $cost = $_POST['medicineprice'.$i];
    $medicineindex = $passonvalue[0];   
    $patientid = $passonvalue[2];
    $appointmentid =   $passonvalue[3];     
    $medicinename =   urldecode($passonvalue[4]); 
    if($cost != "" && $distribute != ""){
     
        $md->insertMedicineDistributionDetails($medicineindex, $cost, $distribute, $original, $patientid, $appointmentid, $medicinename,$receiptId);
    
        
    
    $totalCost = $totalCost+$cost;
  ?>
     <tr>
        <td><b><?php echo $medicinename; ?></b></td>
         <td><?php echo $distribute; ?></td>
          <td>Rs <?php echo $cost; ?>/-</td>
    </tr>
    
  <?php  
  }
 }
 ?>
   <tr>
       <td colspan="3" style="height: 5px;"><hr/></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: end;"><b>Total Cost :</b>&nbsp;&nbsp;</td>
        <td  align="right">  <b>Rs. <?php echo $totalCost;?>/-</b>
         <input type="hidden" id="originalcost" name="originalcost" value="<?php echo $totalCost; ?>"/>
        </td>
    </tr> 
    <tr>
        <td colspan="2" style="text-align: end;"><b>Discount :</b>&nbsp;&nbsp;</td>
        <td  align="right">  <b> <?php echo $discountToApply;?> %</b>
          <input type="hidden" id="discounttoapply" name="discounttoapply"  value="<?php echo $discountToApply; ?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: end;"><b>Final Amount :</b>&nbsp;&nbsp;</td>
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
            var vcash = parseInt($('#finalcost').val())*parseInt($('#vouchercash').val())/parseInt(100);
            $('#vamount').val(vcash);

         }
    function updatepaidamount (){
        
    }
    function myFunction() {
        $('#paidamount').val(0);
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
             alert("More then 25% amount cant be paid by wallet");
             return false;
         }
       paidamount = parseInt(paidamount)+parseInt($('#wcamount').val());
      $('#paidamount').val(paidamount);
    }
    if ($('#voucher').is(":checked") && $('#vouchercash').val() != "")
    {
        var percentamount = $('#vouchercash').val();
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
    
    
    
    
    $('#paymentoption').hide();
    window.print();
     window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid='+receipt+
           '&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+
   '&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash+'&wallet='+$('#wcamount').val()+'&mycash='+$('#mccamount').val()+'&voucher='+$('#vouchercash').val()+'&discountType='+discountType+
           '&billwaver='+$('#specialdiscount').val()+'&waveramount='+$('#discgrantamount').val()+
           '&ccard='+ccard+'&ccamount='+ccamount+
           '&dcard='+dcard+'&dcamount='+dcamount; 
        
   
    
    /*
      if(paymenttype != "wallet"){
       window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid='+receipt+'&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+'&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
    }else  if(paymenttype == "wallet"){
      window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid="+receipt+"&discamount='+<?php echo $discountToApply;?>+'&flagType="+towhom+"&cgsdiscount='+<?php echo $cgsDiscount;?>+'&wallet=Y&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
      
    }else  if(paymenttype == "mycash"){
          window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid="+receipt+"&discamount='+<?php echo $discountToApply;?>+'&flagType="+towhom+"&cgsdiscount='+<?php echo $cgsDiscount;?>+'&wallet=N&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
    
     } */
}
/*
setTimeout(function () {
  //  alert("<?php echo $message ;?>");
  //  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 10000);
*/
</script>