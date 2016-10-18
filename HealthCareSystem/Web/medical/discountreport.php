<?php
include_once ('../../Business/DiagnosticData.php');

$dd = new DiagnosticData();
//$labTests = $dd->getLabTests($_SESSION['officeid']);
//$objLength = count($labTests);
//echo "<pre>"; print_r($_SESSION); echo "</pre>";
$startDate = "CURDATE() - 7";
$endDate = "CURDATE()";
//print_r($_GET);echo "<br/>";
if($_GET['start'] != ""){
 //   echo $_GET['start'];echo "<br/>";
    $toChange = explode(".", $_GET['start']);
  $startDate = "'".$toChange[2]."-".$toChange[1]."-".$toChange[0]."'";
 // echo $startDate;echo "<br/>";
} 
if($_GET['finish'] != ""){
    // echo $_GET['finish'];echo "<br/>";
    $toChange1 = explode(".", $_GET['finish']);
  $endDate = "'".$toChange1[2]."-".$toChange1[1]."-".$toChange1[0]."'";
  echo $endDate;echo "<br/>";
} 
       

$result = $dd->getMedicalDiscountTests($_SESSION['officeid'],$startDate,$endDate);

//print_r($result);
?>
<script>

function showDiscountData(){
   
    start = $('#start').val();
    finish = $('#finish').val();
    window.location.href = "medicalindex.php?page=discounts&start="+start+"&finish="+finish;
}
</script>
<div class="col-md-13 sky-form">
   <fieldset>
       <form action="#" method="POST">
    <div class="row">
   
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="start" name="start" placeholder="Start Date"/>
            </label>
       <font color="red"><i><span id="mobileerror"></span></i></font>    
      </section>
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="finish" name="finish" placeholder="End Date"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section> 
        <section class="col-md-3">
            <input type="button" class="btn-u"  name="button" id="fetchPatientForReports" onclick="showDiscountData()" value=" Search "/>
        </section> 
     
              
     </div>     
</form>
  </fieldset>
   <div class="row">
             <section class="col-md-2"></section>
              <section class="col-md-12">
            <table class="table table-bordered table-hover" id="patient_lab_test_discount_table" >
              <thead>
                  <tr style="background-color: #F2CD00">
                       <th>Dispatch Date</th>
                        <th>Appointment Id</th>
                       <th>Receipt</th>
                      <th>CGS Discount (Rs)</th>
                      <th>Patient Discount(Rs)</th>
                      <th>Actual Amount(Rs)</th>
                      
                              </tr>
                      </thead>
                      <tbody id="labPatientTestDiscountConduct">
                          <?php 
                          $cgsDiscountSum = 0;
                          $labDiscountSum = 0;
                          $actualSum = 0;
                               foreach($result as $value){
                                   $color = "";
                                    if($value->giveto == "ToInst"){
                                        
                                       $color = "#D0F5A9";
                                       $cgsdiscount = ($value->paidamount*10)/100;
                                        
                                   }else{
                                       $cgsdiscount = ($value->actuallamount - $value->paidamount);
                                            $cgsdiscount = "-".$cgsdiscount; 
                                       
                                   }
                          ?>
                          
                          <tr style="background-color: <?php echo $color; ?>">
                                <td><?php  echo $value->createddate; ?></td>
                                <td><?php echo $value->appointmentid; ?></td>
                                 <td><?php echo $value->receiptid;?></td>
                               <td><?php echo $cgsdiscount ?></td>
                               <td><?php echo $value->paidamount;?></td>
                               <td><?php echo $value->actuallamount;?></td>
                                
                           </tr>
                          
                          <?php
                             $cgsDiscountSum = $cgsDiscountSum+($cgsdiscount);
                             $labDiscountSum = $labDiscountSum+$value->paidamount;
                             $actualSum = $actualSum+$value->actuallamount;
                               }
                          ?>
                           <tr style="background-color: wheat">
                               <td colspan="3" align="center"> <b>Total</b></td>
                               <td><b><?php echo $cgsDiscountSum;?></b></td>
                                 <td><b><?php echo $labDiscountSum;?></b></td>
                                  <td><b><?php echo $actualSum;?></b></td>
                           </tr> 
                      </tbody>
              </table></section>
             <section class="col-md-2"></section>
        </div>     
       
</div>
