<?php
include_once ('../../Business/DiagnosticData.php');

$dd = new DiagnosticData();
//$labTests = $dd->getLabTests($_SESSION['officeid']);
//$objLength = count($labTests);
//echo "<pre>"; print_r($_SESSION); echo "</pre>";
$startDate = "CURDATE() - 30";
$endDate = "CURDATE()";
//print_r($_GET);echo "<br/>";
if($_GET['start'] != ""){
   // echo $_GET['start'];echo "<br/>";
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
          

$result = $dd->getTransactionDetailsforPatient($_SESSION['userid'],$startDate,$endDate);

//print_r($result);
?>

<div class="col-md-12 sky-form">
   <fieldset>
       <form action="#">
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
            <input type="submit" class="btn-u"  name="submit" id="fetchPatientForReports" value=" Search "/>
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
                       <th>Receipt ID</th>
                        <th>Payment For</th>
                       <th>Payment Date</th>
                      <th>Amount</th>
                      <th>Payment Type</th>
                   </tr>
                      </thead>
                      <tbody id="labPatientTestDiscountConduct">
                          <?php 
                          $cgsDiscountSum = 0;
                          $labDiscountSum = 0;
                          $actualSum = 0;
                               foreach($result as $value){
                          ?>
                          
                          <tr>
                                <td><?php  echo $value->receiptid; ?></td>
                                <td><?php echo $value->paymentfor; ?></td>
                                 <td><?php echo $value->paymentdate;?></td>
                               <td><?php echo $value->amount; ?></td>
                               <td><?php echo $value->transactiontype;?></td>
                               
                           </tr>
                          
                          <?php
                             $labDiscountSum = $labDiscountSum+$value->amount;
                            }
                          ?>
                           <tr style="background-color: wheat">
                               <td colspan="3" align="center"> <b>Total</b></td>
                               <td colspan="2"><b><?php echo $labDiscountSum;?></b></td>
                           </tr> 
                      </tbody>
              </table></section>
             <section class="col-md-2"></section>
        </div>
        <div>
         <div id="labtabledata">

         </div>    
        </div>  <input type="hidden"  name="counter" id="counter" />
   
</div>
<!--div class="col-md-12">
	<section class="col col-md-4">
		<div class="panel panel-orange" id="reportssearchpanel">
			<div class="panel-heading">
				<h3 class="panel-title">Lab Tests</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					  
					<table class="table table-striped" id="lab_test_results_table">
		                 <tbody></tbody> 
            		</table>
            <div class="paging-container" id="tablePaging"></div>
					      		
				</div>
			</div>
	   </div> 
	</section>
	    
	<section class="col col-md-8">
		    <div class="panel panel-orange  sky-form">
				<div class="panel-heading">
		        	<h3 class="panel-title"><i class="fa fa-tasks"></i>Patients List</h3>
				</div>
			    <table class="table table-bordered table-hover" id="patient_records_reports_table">
			    	<thead>
			        	<tr>
			            	<th>AID</th>
			                <th>Patient Name</th>
			                <th>Doctor Name</th>
			                <th>Date</th>
			                <th>Time</th>
			                <th>Actions</th>
						</tr>
					</thead>
			        <tbody id="labtestPatientList"></tbody>
				</table>
			</div>
	 </section>
 </div>
 
 <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	$(function () {
		var objLength = "<?php echo $objLength ?>";
		var labDataObj = <?php echo json_encode($labTests) ?>;
		var officeId = <?php echo $_SESSION['officeid'];?>;
			for (var i = 0; i < objLength; i++) {
				$('#lab_test_results_table tbody').append('<tr class="data"><td id="doctorName_'+labDataObj[i].id+'"><a href="javascript:showLabTestsPateients('+labDataObj[i].id+','+officeId+')">'+labDataObj[i].testname+'</a></td></tr>');
			}
			
			load = function() {
				window.tp = new Pagination('#tablePaging', {
					itemsCount: objLength,
					onPageSizeChange: function (ps) {
						console.log('changed to ' + ps);
					},
					onPageChange: function (paging) {
						//custom paging logic here
						console.log(paging);
						var start = paging.pageSize * (paging.currentPage - 1),
							end = start + paging.pageSize,
							$rows = $('#lab_test_results_table tbody').find('.data');

						$rows.hide();

						for (var i = start; i < end; i++) {
							$rows.eq(i).show();
						}
					}
				});
			}

		load();
	});
</script-->