<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<?php 
 include_once '../../Business/SchoolData.php';

 $sd = new SchoolData();
 
$scoolsList = $sd->fetchCompleteSchools();
//echo "dddddddddddd".$_GET['classname'];
if($_GET['classname'] == "")
   $className = "nodata";
else
    $className = $_GET['classname'];


if($_GET['cardtype'] == "")
   $cardtype = "nodata";
else
    $cardtype = $_GET['cardtype'];

//echo "dddddddddddd".$_GET['$cardtype'];


$packageDetails = $sd->fetchCompleteSchoolsCardsCount($className,$cardtype);
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
function showSchoolData(){
   
    classname = $('#classname').val();
    cardtype = $('#cardtype').val();
    window.location.href = "adminindex.php?page=schoolpackages&classname="+classname+"&cardtype="+cardtype;
}
</script> 
    <fieldset>
    <div class="row">
        
       <section class="col col-md-3" >
                <label class="select">
                  <select id="classname" name="classname"  class="valid">
                            <option value="nodata">-- School Name --</option>
                            <?php  foreach($scoolsList as $school) {  ?>
                               <option value="<?php  echo $school->id;?>"><?php  echo $school->schoolname;?></option>
                            <?php } ?>        
                            

                  </select>
             </label>  
           </section>
      <section class="col col-md-3" >
                <label class="select">
                  <select id="cardtype" name="cardtype"  class="valid">
                            <option value="nodata">-- Package --</option>
                            
                               <option value="SHP-800">SHP-800</option>
                               <option value="SHP-1600">SHP-1600</option>
                               <option value="SHP-2400">SHP-2400</option>
                          
                  </select>
             </label>  
           </section>
     
        <section class="col-md-6">
         <div class="btn-group">
             <button type="button" class="btn-u btn-u-blue" onclick="showSchoolData()">
                            <i class="fa fa-list"></i>
                            Search Data
                        </button>
                      
                    </div>
        
        
        </section> 
     
              
     </div>     

  </fieldset>
   <fieldset>
        <div class="row" id="maintable">
            <section class="col-md-2"></section>
              <section class="col-md-9">
            <table class="table table-bordered table-hover">
              <thead>
                  <tr style="background-color: #F2CD00">
                     
                         <th>School Name</th>
                         <th>Package</th>
                         <th>Count</th>
                              </tr>
                      </thead>
                      <tbody id="labPatientTestDiscountConduct">
                          <?php 
                         $appointmentSum = 0;
                          $actualSum = 0;
                          if(sizeof($packageDetails) > 0){
                               foreach($packageDetails as $result){
                                   $onclick = "";
                                   
                                $actualSum = $actualSum+$result->count;
                           
                          ?>
                          
                          <tr <?php echo $onclick; ?>>
                               
                                   <td><?php  echo $result->schoolname; ?></td>
                                 
                                <td><?php echo $result->cardtype; ?></td>
                                 <td><?php echo $result->count; ?></td>
                                
                           </tr>
                          
                          <?php
                            
                             
                               }
                          }
                          ?>
                           <tr style="background-color: wheat">
                              
                               
                               <td colspan="2"><b>Total</b></td>
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
                       <th>Institution Name</th>
                       <th>Amount</th>
                      
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
    function calldrilldown(endid){
        start = $('#start').val();
    end = $('#finish').val();
     console.log("start"+start);
     if(endid == "Medical")
         endid = "Medical Shop";
     
    if(start == ""){
        start = "nodata";
    }
    if(end == ""){
        end = "nodata";
    }
        console.log(endid);
        if(endid != "Web"){
        var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
        console.log(endid);
        $('#maintable').hide();
         $('#subtable').show();
         console.log(rootURL + '/fetchInstitutionWiseRechargeData/'+endid+'/'+start+'/'+end);
          $("#patient_lab_test_sub_discount_table tbody").remove();
         $.ajax({
		type: 'GET',
		url: rootURL + '/fetchInstitutionWiseRechargeData/'+endid+'/'+start+'/'+end,
		dataType: "json",
		success: function(data){
                     console.log(data);
			
                        console.log(data.responseMessageDetails.data);
			$.each(data.responseMessageDetails.data,function(key, value){
                            console.log(value);
				$('#patient_lab_test_sub_discount_table').append('<tr> <td>'+value.name+'</td><td>'+value.amount+'</td></tr>');
			});
			//$('#myDoctorMedicinesModal').modal('show'); 
		}
            });
            }  
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