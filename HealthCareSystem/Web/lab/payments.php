<?php
//session_start();
include_once ('../../Business/MedicalData.php');
include_once '../../Business/PatientData.php';
$pd = new PatientData();
try{
$testId = $_GET['testId'];
$start = 0;
$end = 15;
if(isset($_GET['start']) && isset($_GET['end'])){
    
    $start = $_GET['start']; $end = $_GET['end'];
}
if( isset( $_SESSION['userid'] ) && !isset( $_GET['patientname'] ) )
   {
     // echo "In no get";
       $patientData = ($pd->patientCompleteDetails($start,$end));
      $patientCountData = ($pd->patientCountCompleteDetails());
    }
   
  if(isset( $_GET['patientname'] )){
      //echo "Hello in get";
       $start = 0;
       $end = 15;
      $patientData = ($pd->patientNamePaymentsCompleteDetails($_GET['patientname'],$start,$end));
       $patientCountData = ($pd->patientNameCountCompleteDetails($_GET['patientname']));
    
  } 
  //print_r($medicineData);
}  catch (Exception $e){
    echo "Message.................".$e->getMessage();
}   
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!--script src="http://code.jquery.com/jquery-2.1.4.min.js"></script-->

<!--script src="../js/jqgrid/grid.locale-en.min.js"></script>
<script src="../js/jqgrid/jquery.jqGrid.min.js"></script>

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script-->
 
<script>

function showPatientSearch(){
    patientname = $('#patientname').val();
   
    start = $('#start').val();
    end = $('#end').val();
    window.location.href = "labindex.php?page=payments&patientname="+patientname+"&start="+start+"&end="+end;

}

function nextSetOfRecords(){
     start = $('#start').val();
    end = $('#end').val();
    start = parseInt(end)+1;
    end = parseInt(start)+15;
    window.location.href = "labindex.php?page=payments&start="+start+"&end="+end;

    
}
</script>


<div class="col-md-12 "> 
    <form action="#" id="sky-form"  method="POST" >  
        
            <div class="row sky-form ">
                <section class=" col-md-13"></section>
                 <section class=" col-md-1"></section>
                <section class="col-md-3">
                    <label class="input">
                        <input type="text" id="patientname" name="patientname" placeholder="Patient Name" class="sky-form" value="<?php  echo $_GET['patientname']; ?>">
                    </label>
                    <i><font color="red"><span id="patientname"></span></font></i>
                </section>
                 <input type="hidden" name="searchcount" id="start" value="<?php echo $searchcount; ?>"/>
                 <input type="hidden" name="start" id="start" value="<?php echo $start; ?>"/>
               <input type="hidden" name="end" id="end"  value="<?php echo $end; ?>"/>
               <input type="hidden" name="patientname" id="patientname"  value="<?php echo $_GET['patientname']; ?>"/>
                <section class="col-md-3">
                    <input type="button" class="btn-u pull-right"  name="button" id="searchPatientName" value="Search" onclick="showPatientSearch()"/>
                </section>
               <section class="col-md-3">
                   <input type="button" class="btn-u pull-right"  name="button" id="nextset" onclick="nextSetOfRecords()" value="{ Total Records : <?php echo ($patientCountData[0]->count); ?> } Next" />
                </section>
            </div>
          
         </form><br/>
    <fieldset>
        <div class="row">
        <section class="col col-md-1"></section>
       <section class="col col-md-10">
             <table class="table table-striped" id="patient_medicines_order_patient_table">
                <thead>
                    <tr style="background-color: #F2CD00">
                       
                        <td><b>Patient Name</b></td>
                        <td><b>Mobile</b></td>
                        <td><b>Email</b></td>
                        <td><b>Card Type</b></td>
                       <td><b>My Cash</b></td>
                        <td><b>Action</b></td>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                   
                    if(count($patientData) > 0){ foreach($patientData as $data){ ?>
                    <tr>

                        <td><?php echo $data->name; ?></td>
                        <td><?php echo $data->mobile; ?></td>
                        <td><?php echo $data->email; ?></td>
                        <td><?php echo $data->cardtype; ?></td>
                          <td><?php echo $data->totalamount; ?></td>
                        <td><button class="btn btn-warning btn-xs" onclick="editPaymentDetails('<?php echo $data->id;?>')"><i class="fa fa-trash-o"></i> Edit</button></td>
                    </tr>
                    <?php } }else{ 
                        
                       // echo $patientData;
                        ?>
                        <tr>

                            <td><?php echo $patientData->name; ?></td>
                            <td><?php echo $patientData->mobile; ?></td>
                            <td><?php echo $patientData->email; ?></td>
                            <td><?php echo $patientData->cardtype; ?></td>
                            <td><?php echo $patientData->cardamount; ?></td>
                            <td><?php echo $patientData->salesperson; ?></td>
                            <td><button class="btn btn-warning btn-xs" onclick="editPaymentDetails('<?php echo $data->id;?>')"><i class="fa fa-trash-o"></i> Edit</button></td>
                        </tr>
                    <?php }?>
                </tbody>

            </table>
          
      </section>
        </div>
   </fieldset>  
    
    
    <div class="modal fade" id="myPatientPaymentDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Patient Details</h4>
                </div>
                <div class="modal-body">
                
                    <div class="sky-form">
                        <br/>
                        <div class="row">
                            <section class="col-md-1"></section>
                                <section class="col-md-6">
                                <label class="select">
                                     <select id="pcardtype" name="pcardtype" class="form-control">
                                      <option value="">-- Select Payment Type --</option>
                                     <option value="Recharge">Recharge</option>
                                     </select>

                                 </label>
                                    </section>
                            </div>
                        <input type="hidden" id="ppatientid" name="ppatientid" />          
                        <div class="row">
                            <section class="col-md-1"></section>
                                <section class="col-md-6">
                                    <label class="input">
                                         <i class="icon-append fa fa-asterisk"></i>
                                         <input type="text" id="pcardamount" name="pcardamount" placeholder="Recharge Amount">
                                      </label>
                                </section>
                            </div>
                       
                    </div>
                        
                </div>
                <div class="modal-footer">
                     <button data-dismiss="modal" class="btn-u btn-u-orange" type="button" id="submitStaffPatientPaymentDetails">Submit</button>
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


    <link rel="stylesheet" type="text/css" media="screen" href="../js/jqgrid/jquery-ui.min.css"> 