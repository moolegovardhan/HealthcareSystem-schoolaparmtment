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
 // echo $endDate;echo "<br/>";
} 
     //   echo   $_SESSION['officeid'];
//getMedicalRechargeDetails($officeId,$startDate,$endDate,$insttype)
$result = $dd->getMedicalRechargeDetails($_SESSION['officeid'],$startDate,$endDate,'Medical Shop');

//print_r($result);
?>
<script>

function showDiscountData(){
   
    start = $('#start').val();
    finish = $('#finish').val();
    window.location.href = "medicalindex.php?page=cardrecharge&start="+start+"&finish="+finish;
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
                       <th>Receipt Id</th>
                       <th>Patient Id</th>
                        <th>Patient Name</th>
                         <th>Mobile Number</th>
                       <th>Amount</th>
                              </tr>
                      </thead>
                      <tbody id="labPatientTestDiscountConduct">
                          <?php 
                         
                          $actualSum = 0;
                               foreach($result as $value){
                          ?>
                          
                          <tr>
                                <td><?php  echo $value->receiptid; ?></td>
                                <td><?php echo $value->id; ?></td>
                                 <td><?php echo $value->name;?></td>
                               <td><?php echo $value->mobile;?></td>
                               <td><?php echo $value->amount;?></td>
                                
                           </tr>
                          
                          <?php
                             
                             $actualSum = $actualSum+$value->amount;
                               }
                          ?>
                           <tr style="background-color: wheat">
                               <td colspan="4" align="center"> <b>Total</b></td>
                                  <td><b><?php echo $actualSum;?></b></td>
                           </tr> 
                      </tbody>
              </table></section>
             <section class="col-md-2"></section>
        </div>     
       
</div>
