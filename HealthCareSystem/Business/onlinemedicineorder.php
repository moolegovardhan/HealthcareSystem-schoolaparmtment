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
include_once 'MedicinesOrdered.php';
$mo = new MedicinesOrdered();

$ad = new AppointmentData();

$pp = new PatientPrescription();
$md = new MedicalData();
$pd = new PatientData();
$master = new MasterData();
$patientId = $_POST['patientoid'];

$patientdata = json_decode($pd->patientDetails($patientId));
$voucherDetails = ($pd->fetchPatientVoucherDetails($patientId,'Medical'));
$systemDiscount = $pd->fetchSystemDiscounts('medical');
$percent = $systemDiscount[0]->percent;
//print_r($patientId);
//print_r($voucherDetails);
$counter = $_POST['counter'];
//$totalCost = $_POST['medicinescost'];
$patientDetails = $pd->patientDetails($patientId);
$details = json_decode($patientDetails);
//print_r($details);
for($i = 1;$i<$counter+1;$i++){
    $data = $_POST['textbox'.$i];
    if(strlen($data) > 1){
        
    }
}
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
//echo "sddasddasda".$_SESSION['officeid'];
//print_r($discountDetails);
if(sizeof($discountDetails)< 1){
   // echo "Helo";
    $discountDetails = $master->getSpecificLabDiscountData($_SESSION['officeid'],'Medical Shop');
}
//print_r($discountDetails);
$quickregister = $discountDetails[0]->noncardholders;
$promotional = $discountDetails[0]->promotional;
$general = $discountDetails[0]->general;
$silver = $discountDetails[0]->silver;
$appuser = $discountDetails[0]->appusers;
$fromhome = $discountDetails[0]->fromhome;
$cgs =  $discountDetails[0]->cgsdiscount;
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

if($percent == 0){
if($address == "" || strlen($address) < 1 ){//echo "15";
 $discountToApply = 0;
 $cgsDiscount = $cgs;
 $flagType = "ToCGS";//
 $discounType = "Quick Register";
}else if($cardtype == "Promotional"){//echo "13";
    $discountToApply = $promotional;
    $cgsDiscount = $cgs - $promotional;
    $flagType = "ToBoth";
    $discounType = "Promotional";
}else if($cardtype == "General"){//echo "12";
    $discountToApply = $general;
    $cgsDiscount = $cgs - $general;
    $flagType = "ToBoth";
    $discounType = "General";
}else if($cardtype == "Silver"){//echo "11";
    $discountToApply = $silver;
    $cgsDiscount = $cgs - $silver;
    $flagType = "ToBoth";
    $discounType = "Silver";
}else if(strlen($udid) > 1 ){// echo "1";
    $discountToApply = $appuser;
    $cgsDiscount = $cgs - $appuser;
    $flagType = "ToBoth";
     $discounType = "Mobile";
}else {//echo "in ELse";
        $discountToApply = "0";
        $cgsDiscount = $quickregister;
        $flagType = "ToCGS";
         $discounType = "Non Card";
}
}else{
    $cgsDiscount = 0;
     $flagType = "ToInst";
     $discountToApply = $percent;
       $discounType = "System Discount";
}         
//echo "<br/>";
//echo $discountToApply;echo "<br/>";
//echo $cgsDiscount;echo "<br/>";
$date = (date('ymdHis'));//echo "<br/>";
$receiptId =  "HCM".$date."MEDICINE".mt_rand(0, 999);

?>
<br/>

<?php 
if(count($_POST['recordcount'])>0){
    $dataSplit = explode("#",urldecode($_POST["0selected"]));
        $mbileNumber = $dataSplit[2];
        $shpname = urlencode($dataSplit[3]);
    
}
//echo "Record Count : ".$hidcount; echo "<br/>";
try{
?>
<!--div id="printbutton">
 <button class="btnExample" onclick="myFunction()" type="button" value="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>
 </div--><br/>
<table width="80%" cellspacing="0" cellpadding="0" border="0" align="center">
    <tr> <td><b>Shop Name </b></td><td colspan="2"><?php echo $shpname;?></td></tr>
    <tr> <td><b>Receipt </b></td><td colspan="2"><?php echo $receiptId;?></td></tr>
    <tr> <td ><b>Patient Name</b></td><td colspan="2"><?php echo $details[0]->name;?></td></tr>
    <tr> <td ><b>Mobile</b></td><td colspan="2"><?php echo $mbileNumber;?></td></tr>
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
$totalCost = "0";
for($i=0;$i<$_POST['recordcount'];$i++){
$mobileNumber = "";$shopname = "";
//for($i = 1;$i<$counter+1;$i++){
    $data = $_POST['textbox'.$i];
     if($_POST[$i."selected"] != ""){
       // echo "selected  .... ".urldecode($_POST[$i."selected"])."<br/>";
        $splitdata = explode("#",urldecode($_POST[$i."selected"]));
        $mobileNumber = $splitdata[2];
        $shopname = urlencode($splitdata[3]);
        $medicineName = urldecode($_POST[$i."med"]);
        $distributeMedicineCount = $_POST[$i."dis"];
        $cost = $_POST[$i."price"];
        /*echo "Shop Name ".$shopname;echo "<br/>";
        echo "Mobile Number  ".$mobileNumber;echo "<br/>";
        echo "Price ".$_POST[$i."price"];echo "<br/>";
        echo "Medicine Name ".urldecode($_POST[$i."med"]);echo "<br/>";
         echo "Medicine Name ".$splitdata[0];echo "<br/>";
          echo "Medicine Name ".$splitdata[1];echo "<br/>";
        echo "dispatch count ".$_POST[$i."dis"];echo "<br/>";
         echo "batch count ".$_POST[$i."bat"];echo "<br/>";
         * */
         $appointmentid =   "0";     
        $result = $mo->updateMedicineDispatchStatus($splitdata[0],$_POST[$i."price"],"D",$receiptId);
   $totalCost = $totalCost+$cost;
   $patientid = $patientId;
    /*if(strlen($data) > 1){
   
    $passonvalue = explode("#", $data);
    
    $distribute = $passonvalue[1];
    $original = $passonvalue[1];
    $cost = $passonvalue[2];
    $medicineindex = "0";   
    
    $appointmentid =   "0";     
    $medicinename =   $passonvalue[0];  */
    //if($cost != "" && $distribute != ""){
     
      //  $md->insertMedicineDistributionDetails($medicineindex, $cost, $distribute, $original, $patientid, $appointmentid, $medicinename,$receiptId);
    
      //$totalCost = $_POST['medicinescost'];  
  ?>
   
     <tr>
        <td width="60%"><?php echo $medicineName; ?></td>
         <td width="20%"><?php echo $distributeMedicineCount; ?></td>
          <td width="20%"><?php echo $cost; ?>/-</td>
    </tr>
    
  <?php  
  //}
   // }
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
    finalamount = parseInt(finalamount);
    if(paidamount != finalamount){
        alert("Paying Amount cant be less then or greater  final payable amount");
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
   '&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash+'&wallet='+$('#wcamount').val()+'&mycash='+$('#mccamount').val()+'&voucher='+$('#vamount').val()+'&discountType='+discountType; 
   
   /*   if(paymenttype != "wallet"){
      // window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid='+receipt+'&discamount='+<?php echo $discountToApply;?>+'&flagType='+towhom+'&cgsdiscount='+<?php echo $cgsDiscount;?>+'&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
    }else  if(paymenttype == "wallet"){
     // window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid="+receipt+"&discamount='+<?php echo $discountToApply;?>+'&flagType="+towhom+"&cgsdiscount='+<?php echo $cgsDiscount;?>+'&wallet=Y&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
      
    }else  if(paymenttype == "mycash"){
       //   window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid="+receipt+"&discamount='+<?php echo $discountToApply;?>+'&flagType="+towhom+"&cgsdiscount='+<?php echo $cgsDiscount;?>+'&wallet=N&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash;
    
     } 
   // console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalCost;?>+'&receiptid="+receipt+"&discamount='+<?php echo $discountToApply;?>+'&flagType="+towhom+"&cgsdiscount='+<?php echo $cgsDiscount;?>+'&patientid='+<?php echo $patientid;?>+'&onlycash='+onlycash); 
}
*/
setTimeout(function () {
    alert("<?php echo $message ;?>");
    window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 10000);

   
   } 
</script>


