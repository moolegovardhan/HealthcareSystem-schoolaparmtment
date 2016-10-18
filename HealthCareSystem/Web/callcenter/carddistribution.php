<?php
//session_start();
include_once ('../../Business/MedicalData.php');
include_once '../../Business/PackageInfo.php';

$package = new PackageInfo();
$pd = new PatientData();
$cards = $package->fetchCards();
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
    //  echo "Hello in get";
       $start = 0;
       $end = 15;
      $patientData = ($pd->patientNameCardCompleteDetails($_GET['patientname'],$start,$end));
       $patientCountData = ($pd->patientNameCountCompleteDetails($_GET['patientname']));
  //  print_r($patientData);
    
  } 
  
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
    window.location.href = "callcenterindex.php?page=carddistribution&patientname="+patientname+"&start="+start+"&end="+end;

}

function nextSetOfRecords(){
     start = $('#start').val();
    end = $('#end').val();
    start = parseInt(end)+1;
    end = parseInt(start)+15;
    window.location.href = "callcenterindex.php?page=carddistribution&start="+start+"&end="+end;

    
}
</script>


<div class="col-md-12 "> 
    <form action="#" id="sky-form"  method="POST" >  
        
            <div class="row sky-form ">
                <section class=" col-md-13"></section>
                 <section class=" col-md-1"></section>
                <section class="col-md-3">
                    <label class="input">
                        <input type="text" id="patientname" name="patientname" placeholder="Patient Name" class="sky-form">
                    </label>
                    <i><font color="red"><span id="patientname"></span></font></i>
                </section>
                 <input type="hidden" name="searchcount" id="start" value="<?php echo $searchcount; ?>"/>
                 <input type="hidden" name="start" id="start" value="<?php echo $start; ?>"/>
               <input type="hidden" name="end" id="end"  value="<?php echo $end; ?>"/>
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
                        <td><b>Card Amount</b></td>
                        <td><b>Sales Person</b></td>
                        <td><b>Action</b></td>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                   
                    if(sizeof($patientData) > 0){ foreach($patientData as $data){ ?>
                    <tr>

                        <td><?php echo $data->name; ?></td>
                        <td><?php echo $data->mobile; ?></td>
                        <td><?php echo $data->email; ?></td>
                        <td><?php echo $data->cardname; ?></td>
                        <td><?php echo $data->cardamount; ?></td>
                        <td><?php echo $data->salesperson; ?></td>
                        <td><button class="btn btn-warning btn-xs" onclick="editDetails('<?php echo $data->id;?>','<?php echo $data->cardtype;?>','<?php echo $data->cardtype;?>','<?php echo $data->salesperson;?>')"><i class="fa fa-trash-o"></i> Edit</button></td>
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
                            <td><button class="btn btn-warning btn-xs" onclick="editDetails('<?php echo $data->id;?>','<?php echo $data->cardtype;?>','<?php echo $data->cardtype;?>','<?php echo $data->salesperson;?>')"><i class="fa fa-trash-o"></i> Edit</button></td>
                        </tr>
                    <?php }?>
                </tbody>

            </table>
          
      </section>
        </div>
   </fieldset>  
    
    
    <div class="modal fade" id="myPatientCardDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="../../Business/CardDistribution.php" method="post">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Patient Details
                    
                        <input  class="btn-u btn-u-orange" type="submit"  value="Submit">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
               </h4>
                </div>
                <div class="modal-body">
                  
                    <div class="sky-form">
                        <br/>
                        <div class="row">
                            <section class="col col-1"></section>
                             <section class="col-md-3">
                                 <label class="label"> Card Type</label>
                                <label class="select">
                                     <select id="pcardtype" name="pcardtype" class="form-control">
                                      <option value="">-- Select Card Type --</option>
                                      <?php foreach ($cards as $card){ ?>
                                      
                                        <option value="<?php echo $card->id; ?>"><?php echo $card->cardname; ?></option>
                                      
                                      <?php }  ?>
                                   
                                     </select>

                                 </label>
                            </section>
                             
                                <section class="col-md-3">
                                    <label class="label"> Card Amount</label>
                                    <label class="input">
                                         <i class="icon-append fa fa-asterisk"></i>
                                         <input type="text" id="pcardamount" name="pcardamount" placeholder="Card Amount">
                                      </label>
                                </section>
                            
                          <input type="hidden" id="ppatientid" name="ppatientid" />        
                                <section class="col-md-3">
                                    <label class="label">Sales Person</label>
                                    <label class="input">
                                         <i class="icon-append fa fa-asterisk"></i>
                                         <input type="text" id="psalesperson" name="psalesperson" placeholder="Sales Person">
                                      </label>
                                </section>
                            </div>
                       <section class="col col-md-4" id="showfamily"> <br/>
                            <table class="table table-striped" id="patient_medicines_order_patient_table">
                               <thead>
                                   <tr style="background-color: #F2CD00">

                                       <td><b>Member Name</b></td>
                                       <td><b>Mobile</b></td>
                                       <td><b>Email</b></td>
                                       <td><b>Age</b></td>
                                       <td><b>Relation</b></td>
                                       <td><b>User ID</b></td>
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr>

                                       <td><input type="text" id="memberName1"  name="memberName1"></td>
                                       <td><input type="text" id="mobile1"  name="mobile1" size="10"></td>
                                       <td><input type="text" id="email1"  name="email1" ></td>
                                       <td><input type="text" id="age1"  name="age1" size="3"></td>
                                       <td><input type="text" id="relation1"  name="relation1"></td>
                                       <td><input type="text" id="userid1"  name="userid1" size="6"></td>
                                   </tr>
                                   <tr>

                                       <td><input type="text" id="memberName2"  name="memberName2"></td>
                                       <td><input type="text" id="mobile2"  name="mobile2" size="10"></td>
                                       <td><input type="text" id="email2"  name="email2"></td>
                                       <td><input type="text" id="age2"  name="age2" size="3"></td>
                                       <td><input type="text" id="relation2"  name="relation2"></td>
                                       <td><input type="text" id="userid2"  name="userid2" size="6"></td>
                                   </tr>
                                   <tr>

                                       <td><input type="text" id="memberName3"  name="memberName3"></td>
                                       <td><input type="text" id="mobile3"  name="mobile3" size="10"></td>
                                       <td><input type="text" id="email3"  name="email3"></td>
                                       <td><input type="text" id="age3"  name="age3" size="3"></td>
                                       <td><input type="text" id="relation3"  name="relation3"></td>
                                       <td><input type="text" id="userid3"  name="userid3" size="6"></td>
                                   </tr>
                                   <tr>

                                       <td><input type="text" id="memberName4"  name="memberName4"></td>
                                       <td><input type="text" id="mobile4"  name="mobile4" size="10"></td>
                                       <td><input type="text" id="email4"  name="email4"></td>
                                       <td><input type="text" id="age4"  name="age4" size="3"></td>
                                       <td><input type="text" id="relation4"  name="relation4"></td>
                                       <td><input type="text" id="userid4"  name="userid4" size="6"></td>
                                   </tr>
                               </tbody>
                            </table>
                       </section>               
                    </div>
                    
                </div>
                <br/> <br/> <br/> <br/> <br/> <br/> <br/><br/> <br/> <br/> <br/><br/> <br/> <br/>
              </div>
        </div>
            </form>  
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