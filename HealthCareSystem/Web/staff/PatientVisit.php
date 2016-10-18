<?php
session_start();
include_once '../../Business/AppointmentData.php';

$ad = new AppointmentData();

$startDate = "";
$endDate = "";
if($_POST['start'] != "")
    $startDate = $_POST['start'];
else {
    $startDate = date("d.m.Y");
}
if($_POST['finish'] != "")
    $endDate = $_POST['finish'];
else {
    $endDate = date("d.m.Y");
}
if($startDate != "" && $endDate != ""){
    $startExplode = explode(".", $startDate);
    $start =   $startExplode[2].'-'.$startExplode[1].'-'.$startExplode[0]; 
    $endExplode = explode(".", $endDate);
    $end =   $endExplode[2].'-'.$endExplode[1].'-'.$endExplode[0]; 
    
   $patientList =  $ad->fetchPatientVisit($start, $end, $_SESSION['officeid']);
   //print_r($patientList);echo "Office ID".$_SESSION['officeid'];
}

?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $(document).ready(function(){ 
     $( "#finish" ).datepicker({  minDate: "-2M", maxDate: "+0", 
      // changeMonth: true,
      // changeYear: true,
       yearRange:'+0:+0',
       hideIfNoPrevNext: true,
       "dateFormat": 'dd.mm.yy',
       nextText:'<i class="fa fa-angle-right"></i>',
       prevText:'<i class="fa fa-angle-left"></i>',
        weekHeader: "W"});
    }); 
</script>

<div class="col-md-12 sky-form">
    <form action="staffindex.php?page=visiting" method="POST">
     <fieldset>
     <section class="col col-4">
        <label class="input"> 
              <i class="icon-append fa fa-calendar"></i>
              <input type="text" name="start" id="start" placeholder="Start Date" value="<?php  echo $startDate; ?>">
               <font color="red"><i><span id="endstarterrormsg"></span> </i></font>
          </label>
   </section>
      <section class="col col-4">
        <label class="input"> 
              <i class="icon-append fa fa-calendar"></i>
              <input type="text" name="finish" id="finish" placeholder="End Date" value="<?php  echo $endDate; ?>">
               <font color="red"><i><span id="endfinisherrormsg"></span> </i></font>
          </label>
   </section> 
   <section class="col col-4">
        <input type="submit" class="btn-u "  name="submit" id="" value="search"/> 
   </section>    
     <br/>  <br/>  <br/>
     
     <div class="row ">  
          <section class="col col-md-3"></section>
         <section class="col col-md-11">
             <div class="panel panel-orange margin-bottom-40">
           
            <div class="panel-heading">
                
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of Patient's
                </h5>
            </div>
            <table class="table table-striped" id="diagnosticsdetails">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Amount</th>
                        
                    </tr>
                 </thead>    
                  <?php if(count($patientList) > 0) { foreach($patientList as $patient){ ?>   
                        <tr>
                           
                            <td><?php echo $patient->patientname?></td>
                            <td><?php echo $patient->doctorname?></td>
                            <td><?php echo $patient->appointmentdt?></td>
                            <td><?php echo $patient->appointmenttime?></td>
                            <td><?php echo $patient->amount?></td>
                            
                        </tr>
                  <?php } }else { ?>
                        
                        <tr><td colspan="5" align="center"><h6><i><font color="blue"> Sorry No Consultation Records </font></i></h6></td></tr>
                  <?php } ?>    
                
            </table>
        </div> 
             
             
         </section>
         
     </div>
      </fieldset>     
    
       </form>
</div>
    
 