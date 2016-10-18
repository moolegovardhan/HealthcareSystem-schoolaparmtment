<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<?php 
 include_once '../../Business/AppointmentData.php';

 $ad = new AppointmentData();
 $startDate = "CURDATE()";
$endDate = "CURDATE()";

if($_GET['start'] != ""){
   // echo $_GET['start'];echo "<br/>";
    $toChange = explode(".", $_GET['start']);
 // $startDate = "'".$toChange[2]."-".$toChange[1]."-".$toChange[0]."'";
 $startDate = "'".$_GET['start']."'";
 // echo $startDate;echo "<br/>";
} 
if($_GET['finish'] != ""){
    // echo $_GET['finish'];echo "<br/>";
    $toChange1 = explode(".", $_GET['finish']);
  //$endDate = "'".$toChange1[2]."-".$toChange1[1]."-".$toChange1[0]."'";
  $endDate =  "'".$_GET['finish']."'";
 // echo $endDate;echo "<br/>";
} 
   
 $data = ($ad->fetchMedicinesReceiptWise($_SESSION['officeid'],$startDate, $endDate));
 //print_r($discountData);//$discountData = ($discountData);echo "<br/>";
 // print_r($data);
?>
<div class="sky-form">
    <style>
        .ui-datepicker{ z-index: 9999 !important;}
        </style>
   <script>
 $(document).ready(function(){ 
     
     $( "#start" ).datepicker({    "dateFormat": 'yy-mm-dd'
        
    });
     $( "#finish" ).datepicker({   "dateFormat": 'yy-mm-dd'
        
    });
    }); 
function showDiscountData(){
   
    start = $('#start').val();
    finish = $('#finish').val();
    window.location.href = "medicalindex.php?page=dailycollection&start="+start+"&finish="+finish;
}
</script> 
<form action="#" method="POST">
    <fieldset>
    <div class="row">
        
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="start" placeholder="Start Date" value="<?php echo $_GET['start'];?>"/>
            </label>
       <font color="red"><i><span id="starterrormsg"></span></i></font>    
      </section>
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="finish" placeholder="End Date" value="<?php echo $_GET['finish'];?>"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section>
      
        <section class="col-md-3">
         <button type="button" class="btn-u"  name="button" id="searchfororders" onclick="showDiscountData()" > Search </button>
       
        </section> 
     
              
     </div>     

    </fieldset></form>
   <fieldset>
        <div class="row" id="maintable">
            <section class="col-md-2"></section>
              <section class="col-md-12">
            <table class="table table-bordered table-hover" id="patient_lab_test_discount_table" >
              <thead>
                  <tr style="background-color: #F2CD00">
                       <th>Receipt ID</th>
                       <th>Date</th>
                        <th>Bill Amount</th>
                       <th>Patient Id</th>
                      <th>Patient Name</th>
                      
                              </tr>
                      </thead>
                      <tbody id="labPatientTestDiscountConduct">
                          <?php 
                          $cgsDiscountSum = 0;
                          $labDiscountSum = 0;
                          $actualSum = 0;
                               foreach($data as $result){
                          ?>
                          
                          <tr onclick="fetchDetails('<?php echo $result->createddate ?>','<?php echo $result->receiptid ?>')">
                                <td><?php  echo $result->receiptid; ?></td>
                                 <td><?php  echo $result->createddate; ?></td>
                                <td><?php echo $result->cost; ?></td>
                                 <td><?php echo $result->patientid;?></td>
                               <td><?php echo ($result->name); ?></td>
                           </tr>
                          
                          <?php
                             $cgsDiscountSum = $cgsDiscountSum+($result->cost);
                               }
                          ?>
                           <tr style="background-color: wheat">
                               <td colspan="2" align="center"> <b>Total</b></td>
                               <td colspan="3"><b><?php echo $cgsDiscountSum;?></b></td>
                                
                           </tr> 
                      </tbody>
              </table></section>
             <section class="col-md-2"></section>
           
        </div>
       <div class="col-md-12" id="subtable">
           <section class="col-md-4 pull-right">
                <button type="button" class="btn-u"  name="button" onclick="maintable()" > Back </button>
        
               
           </section>
              <section class="col-md-14">
            <table class="table table-bordered table-hover" id="patient_mediicine_sub_discount_table" >
              <thead>
                  <tr style="background-color: #F2CD00">
                       <th>Patient Name</th>
                       <th>Medicine Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                   </tr>
             </thead>
                      <tbody id="patient_mediicine_sub_discount_table">
                      </tbody>
            </table> 
            </section>      
              <section class="col-md-2"></section>     
       </div>
   </fieldset>  
     
    
</div>

<script>
    function fetchDetails(dat,receiptid){
        var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
        console.log(receiptid);
        console.log(dat);
        $('#maintable').hide();
         $('#subtable').show();
         console.log(rootURL + '/fetchMedicinesDetailsReceiptWise/'+dat+'/'+receiptid);
          $("#patient_mediicine_sub_discount_table tbody").remove();
         $.ajax({
		type: 'GET',
		url: rootURL + '/fetchMedicinesDetailsReceiptWise/'+dat+'/'+receiptid,
		dataType: "json",
		success: function(data){
			$('#medicinDoctor').html('');
			var newData = Array();
                        console.log(data.responseMessageDetails);
			$.each(data.responseMessageDetails.data,function(key, value){
                            console.log(value);
				$('#patient_mediicine_sub_discount_table').append('<tr> <td>'+value.name+'</td><td>'+value.medicinename+'</td><td>'+value.distributed+'</td><td>'+value.cost+'</td></tr>');
			});
			//$('#myDoctorMedicinesModal').modal('show'); 
		}
            });
    }
    $(document).ready(function() {
         $('#maintable').show();
         $('#subtable').hide();
    });
    
   function maintable(){
       $('#maintable').show();
         $('#subtable').hide();
         //fetchDiscountDetailsData/start/diag
   } 
   /* $(document).ready(function() {

                        jQuery("#jqgrid").jqGrid({
                             'data' : 
                             'datatype' : "local",
                             'height' : 'auto',
                             'width': 'auto',
                             'colNames' : [ 'Diagnostic Name','Bill Amount',  'Bill Paid Amount', 'CGS Discount Amount'],
                             'colModel' : [
                            {
                                     name : 'diagnosticsname',
                                     index : 'diagnosticsname',
                                     sortable : true, search: true
                             }, {
                                     name : 'actualamount',
                                     index : 'actualamount'
                             }, {
                                     name : 'paidamount',
                                     index : 'paidamount'
                             }, {
                                     name : 'discountamount',
                                     index : 'discountamount'
                             }],
                             'rowNum' : 10,
                             'rowList' : [10, 20, 30],
                             'pager' : '#pjqgrid',
                             'sortname' : 'diagnosticsname',
                            
                             'viewrecords' : true,
                             'sortorder' : "asc",
                                'autowidth' : true,


                     });

                            
				jQuery("#jqgrid").jqGrid('inlineNav', "#pjqgrid");
				
				  count=0;
                               
                               jQuery("#jqgrid").click( function(){
                                   
                               });
                     // add classes
                     $(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
                     $(".ui-jqgrid-btable").addClass("table table-bordered table-striped");

                     $(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
                     $(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
                     $(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
                     $(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
                     $(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
                     $(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
                     $(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
                     $(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");

                     $(".ui-icon.ui-icon-seek-prev").wrap("<div class='btn btn-sm btn-default'></div>");
                     $(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

                     $(".ui-icon.ui-icon-seek-first").wrap("<div class='btn btn-sm btn-default'></div>");
                     $(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");

                     $(".ui-icon.ui-icon-seek-next").wrap("<div class='btn btn-sm btn-default'></div>");
                     $(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

                     $(".ui-icon.ui-icon-seek-end").wrap("<div class='btn btn-sm btn-default'></div>");
                     $(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");
         }); */

 </script>  

   






















<!--div class="col-md-12">
       <div class="row">
           <section class="col-md-1"></section>   
        <section class="col-md-7">
            <div class="panel panel-orange margin-bottom-40">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i>Hospitals List</h3>
                </div>
                <table class="table table-striped" id="registered_hospitals_table">
                    <thead>
                        <tr>
                            <th>HID</th>
                            <th>Hospital Name</th>
                            <th>City</th>
                            <th>Contact Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; foreach ($hosiptal as $value) { ?>
                        <tr>
                           
                            <td><?php echo $value->id;  ?></td>
                            <td><?php echo $value->hosiptalname; ?></td>
                            <td><?php echo $value->city; ?></td>
                            <td><?php echo $value->mobile; ?></td>
                        </tr>
                    <?php  $count++;} ?>
                    </tbody>
                </table>
            </div>  
        </section>
           <section class="col-md-3">
            <div class="panel panel-orange margin-bottom-40">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i>Requests </h3>
                </div>
                <table class="table table-striped" id="current_Requests_table">
                    <thead>
                        <tr>
                            <th>RID</th>
                            <th>Request Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1; foreach ($requests as $value) { ?>
                        <tr>
                           
                            <td><?php echo $value->Id;  ?></td>
                            <td><a href="#" onclick=requestText(<?php echo $value->Id; ?>)><?php echo $value->fk_RequestType; ?></a></td>
                           <td><?php echo $value->RequestStatus; ?></td>
                        </tr>
                    <?php  $count++;} ?>
                    </tbody>
                </table>
            </div>  
        </section>
        </div>
        
    </body>
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Request Message</h4>
                </div>
                <div class="modal-body">
                
                    <div class="panel margin-bottom-40"> 
                        <span id="requestMessage"><font color="blue"><i></i></font></span>
                                              
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
  </div-->  