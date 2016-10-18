<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<?php 
 include_once '../../Business/AppointmentData.php';

 $ad = new AppointmentData();
 

     $start = $_GET['start'];
     $end = $_GET['end'];
     $data = $_GET['data'];
 $appointmentData = ($ad->fetchAdminAppointmentData($start, $end,$data));
 //print_r($discountData);//$discountData = ($discountData);echo "<br/>";
 // print_r($appointmentData);
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
function showAppointmentData(data){
   
    start = $('#start').val();
    end = $('#finish').val();
    window.location.href = "adminindex.php?page=appointmentreport&start="+start+"&end="+end+"&data="+data;
}
</script> 
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
               <input type="text" id="finish" placeholder="End Date" value="<?php echo $_GET['end'];?>"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section>
      
        <section class="col-md-6">
         <div class="btn-group">
                        <button type="button" class="btn-u btn-u-blue">
                            <i class="fa fa-list"></i>
                            Search Data
                        </button>
                        <button type="button" class="btn-u btn-u-blue btn-u-split-blue dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-angle-down"></i>
                            <span class="sr-only">Toggle Dropdown</span>                            
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>&nbsp;&nbsp;&nbsp;<i class="fa fa-group"></i>Group By </li>
                            <li class="divider"></li>
                            <li><a href="#"  onclick="showAppointmentData('appointmentdate')"><i class="fa fa-ambulance"></i> Appointment Date</a></li>
                            <li><a href="#" onclick="showAppointmentData('hospital')"><i class="fa fa-ambulance"></i> Hospital </a></li>
                          
                        </ul>
                    </div>
        
        
        </section> 
     
              
     </div>     

  </fieldset>
   <fieldset>
        <div class="row" id="maintable">
            <section class="col-md-2"></section>
              <section class="col-md-9">
            <table class="table table-bordered table-hover" id="patient_lab_test_discount_table" >
              <thead>
                  <tr style="background-color: #F2CD00">
                       <th>Hospital Name</th>
                       <?php if($_GET['data'] != "" && $_GET['data'] != "hospital") {?>
                         <th>Appointment Date</th>
                       <?php } ?>  
                       <th>Appointment Count</th>
                        <th>Amount</th>
                      
                              </tr>
                      </thead>
                      <tbody id="labPatientTestDiscountConduct">
                          <?php 
                         $appointmentSum = 0;
                          $actualSum = 0;
                               foreach($appointmentData as $result){
                          ?>
                          
                          <tr>
                                <td><?php  echo $result->hospitalname; ?></td>
                                <?php if($_GET['data'] != "" && $_GET['data'] != "hospital") {?>
                                   <td><?php  echo $result->appointementdate; ?></td>
                                 <?php } ?>     
                                 <td><?php  echo $result->appointmentcount; ?></td>
                                <td><?php echo $result->amount; ?></td>
                                
                           </tr>
                          
                          <?php
                            $appointmentSum = $appointmentSum+$result->appointmentcount;
                             $actualSum = $actualSum+$result->amount;
                               }
                          ?>
                           <tr style="background-color: wheat">
                              
                                <?php if($_GET['data'] != "" && $_GET['data'] != "hospital") {?>
                               <td colspan="2" align="center"> <b>Total</b></td>
                                <?php }else { ?>
                                   <td  align="center"> <b>Total</b></td>
                                <?php } ?>
                                <td><b><?php echo $appointmentSum;?></b></td>
                                  <td><b><?php echo $actualSum;?></b></td>
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
            <table class="table table-bordered table-hover" id="patient_lab_test_sub_discount_table" >
              <thead>
                  <tr style="background-color: #F2CD00">
                       <th>Patient Name</th>
                        <th>Bill Amount</th>
                       <th>Bill Paid Amount</th>
                      <th>CGS Discount</th>
                      
                   </tr>
             </thead>
                      <tbody id="patient_lab_test_sub_discount_table">
                      </tbody>
            </table> 
            </section>      
              <section class="col-md-2"></section>     
       </div>
   </fieldset>  
     
    
</div>

<script>
    function fetchDetails(endid,dat){
        var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
        console.log(endid);
        console.log(dat);
        $('#maintable').hide();
         $('#subtable').show();
         console.log(rootURL + '/fetchDiscountDetailsData/'+dat+'/'+endid);
          $("#patient_lab_test_sub_discount_table tbody").remove();
         $.ajax({
		type: 'GET',
		url: rootURL + '/fetchDiscountDetailsData/'+dat+'/'+endid,
		dataType: "json",
		success: function(data){
			$('#medicinDoctor').html('');
			var newData = Array();
                        console.log(data.responseMessageDetails);
			$.each(data.responseMessageDetails.data,function(key, value){
                            console.log(value);
				$('#patient_lab_test_sub_discount_table').append('<tr> <td>'+value.patientname+'</td><td>'+value.actualamount+'</td><td>'+value.paidamount+'</td><td>'+value.discountamount+'</td></tr>');
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