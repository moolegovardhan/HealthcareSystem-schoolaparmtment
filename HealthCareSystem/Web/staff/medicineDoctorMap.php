<?php
//session_start();
include_once ('../../Business/MedicalData.php');

$md = new MedicalData();
try{
$testId = $_GET['testId'];
$start = 0;
$end = 2300;
if(isset($_GET['start']) && isset($_GET['end'])){
    
    $start = $_GET['start']; $end = $_GET['end'];
}
if( isset( $_SESSION['userid'] ) && !isset( $_GET['medicinename'] ) )
   {
    
     
      $medicineData = json_encode($md->getUnMapDoctorMedicinData($start,$end));
    }
   // print_r($labDataDetails);
   // echo  "Medicine Name...".$_GET['medicinename'];
  if(isset( $_GET['medicinename'] )){
     // echo "Hello in get";
      $medicineData = json_encode($md->getUnMapDoctorMedicinDataByMedicineName($_GET['medicinename'],$start,$end));
     // $error = json_last_error();
     // var_dump($json, $error === json_last_error_msg());
  } 
  //print_r($medicineData);
}  catch (Exception $e){
    echo "Message.................".$e->getMessage();
}   
?>

<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script-->
<!--script src="http://code.jquery.com/jquery-2.1.4.min.js"></script-->

<!--script src="../js/jqgrid/grid.locale-en.min.js"></script>
<script src="../js/jqgrid/jquery.jqGrid.min.js"></script-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 
<script>

function showMedicinesSearch(){
    doctorId = $('#doctorId').val();
    doctorName = $('#doctorname').val();
    medicineName = $('#medicinename').val();
    start = $('#start').val();
    end = $('#end').val();
    window.location.href = "staffindex.php?page=mapdoctormedicines&doctorId="+doctorId+"&name="+doctorName+"&medicinename="+medicineName+"&start="+start+"&end="+end;
}
</script>
<div class="col-md-12 "> 
    <form action="#" id="sky-form"  method="POST" >  
        
            <div class="row sky-form">
                <section class=" col-md-10"></section>
                 <section class=" col-md-1"></section>
                <section class="col-md-3">
                    <label class="input">
                        <input type="text" id="medicinename" name="medicinename" placeholder="Medicine Name" class="sky-form">
                    </label>
                    <i><font color="red"><span id="medicinename"></span></font></i>
                </section>
                <input type="hidden" name="doctorId" id="doctorId" value="<?php echo $_GET['doctorId'] ?>"/>
               <input type="hidden" name="doctorname" id="doctorname"  value="<?php echo $_GET['name'] ?>"/>
                 <input type="hidden" name="start" id="start" value="<?php echo $start; ?>"/>
               <input type="hidden" name="end" id="end"  value="<?php echo $end; ?>"/>
                <section class="col-md-3">
                    <input type="button" class="btn-u pull-right"  name="button" id="searchMedicineToDoctor" value="Search" onclick="showMedicinesSearch()"/>
                </section>
               <section class="col-md-3">
                    <input type="button" class="btn-u pull-right"  name="button" id="m1" value="Map Medicines" />
                </section>
            </div>
          
         </form><br/>
    <fieldset>
        <div class="row">
        <section class="col col-md-1"></section>
       <section class="col col-md-10">
            
          <table id="jqgrid"></table>
        <div id="pjqgrid"></div>
      </section>
        </div>
   </fieldset>  
    
    
    <div class="modal fade" id="myDoctorMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Medicines</h4>
                </div>
                <div class="modal-body">
                
                    
                        <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Company Name</th>
                                    <th>Medicine Name</th>
                                    <th> Technical Name</th>
                                </tr>
                             </thead>    

                                    <tr>

                                        <td>1</td>
                                        <td>DR Reddy</td>
                                        <td>Brufen </td>
                                        <td>Headace</td>
                                    </tr>

                            <tbody>

                            </tbody>
                        </table>
                </div>
                <div class="modal-footer">
                     <button data-dismiss="modal" class="btn-u btn-u-orange" type="button">Submit</button>
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
    
</div>
<div class="modal fade" id="medicinesMappedMessage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myLargeModalLabel" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h5><i><span id="leaveMessage">Medicines Mapped to Doctor Successfully</span></i></h5>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
<script>
    $(document).ready(function() {

                        jQuery("#jqgrid").jqGrid({
                             'data' : <?php print_r(($medicineData)); ?>,
                             'datatype' : "local",
                             'height' : 'auto',
                             'width': 'auto',
                             'colNames' : [ 'Medicine Id','Medicine Name',  'Medicine Type', 'Company', 'Units',  'Price'],
                             'colModel' : [{
                                     name : 'id',
                                     index : 'id',
                                     sortable : true, hidden: true
                             },
                            {
                                     name : 'medicinename',
                                     index : 'medicinename',
                                     sortable : true, search: true
                             }, {
                                     name : 'medicinetype',
                                     index : 'medicinetype'
                             }, {
                                     name : 'company',
                                     index : 'company'
                             }, {
                                     name : 'units',
                                     index : 'units'
                             }, {
                                     name : 'price',
                                     index : 'price',
                                     align : 'center'
                             }],
                             'rowNum' : 10,
                             'rowList' : [10, 20, 30],
                             'pager' : '#pjqgrid',
                             'sortname' : 'medicinename',
                             'toolbarfilter' : true,
                             'viewrecords' : true,
                             'sortorder' : "asc",
                                'multiselect' : true,
                                'autowidth' : true,


                     });

                            
				jQuery("#jqgrid").jqGrid('inlineNav', "#pjqgrid");
				/* Add tooltips */
				  count=0;
                               jQuery("#m1").click(function() {
					var s;
					s = jQuery("#jqgrid").jqGrid('getGridParam', 'selarrrow');
					console.log(s);
                                        console.log(s.length);
                                        doctorId = $('#doctorId').val();
                                      
                                        
                                        for(i=0;i<s.length;i++){
                                            console.log(rootURL + '/linkMedicineToDoctor/'+s[i]+"/"+doctorId);
                                            	$.ajax({
                                                        type: 'POST',
                                                        url: rootURL + '/linkMedicineToDoctor/'+s[i]+"/"+doctorId,
                                                        dataType: "json",
                                                        success: function(data){
                                                                //alert(data.responseMessageDetails.message);
                                                                //window.location.href=rootURL+"/Web/staff/staffindex.php?page=doctorMedicines";
                                                                console.log(count);
                                                                count = parseInt(count)+parseInt(1);
                                                        }
                                                  });
                                         }
                                        console.log(count);
                                        $('#medicinesMappedMessage').modal('show');
				});
				/*jQuery("#m1s").click(function() {
					jQuery("#jqgrid").jqGrid('setSelection', "13");
				});
   */
    

                     // remove classes
                    /* $(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
                     $(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
                     $(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
                     $(".ui-jqgrid-pager").removeClass("ui-state-default");
                     $(".ui-jqgrid").removeClass("ui-widget-content");
*/
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
         });

 </script>  

    <link rel="stylesheet" type="text/css" media="screen" href="../js/jqgrid/jquery-ui.min.css"> 