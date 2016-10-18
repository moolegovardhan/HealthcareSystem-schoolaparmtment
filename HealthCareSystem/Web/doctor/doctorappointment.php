<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/doctorPrescription.js"></script>
 
<?php 
$currentDate = date("Y-m-d");
if($_POST['start'] != ""){
  $currentDate = $_POST['start']; 
}
//echo "Current Date : ".$currentDate;
?>
<div class="col-md-12 sky-form">
    <form action="doctorindex.php?page=appointment" method="POST" id="viewappointment">
    <fieldset>
      <div class="row">
          <section class="col-md-1"></section>
          <section class="col-md-3">
              <label class="input"> 
                    <i class="icon-append fa fa-calendar"></i>
                    <input type="text" value="<?php echo $currentDate; ?>" name="start" id="start" placeholder="Appointment date">
                     <font color="red"><i><span id="enderrormsg"></span> </i></font>
              </label>
             
              
          </section>    <input type="submit" value="Fetch Appointment" class="btn-u btn-u-primary" name="appointmentDateButton" />
                        
<section class="line-icon-page icon-page-fa margin-bottom-40 col-md-11 pull-right">
    
  <?php 
  //print_r($doctorAppointments);
  $appointment = new DoctorData();
  $doctorid = $_SESSION['doctorid'];
  $status = "";$patientName = "";$daydate ="";
     if(isset($_POST['start'])){
         $da = $_POST['start'];
         if(strpos($da,"-") > 0){
             $daydate = $da;
         } else{
            $dateexplode = explode(".", $da);
            $daydate = $dateexplode[2]."-". $dateexplode[1]."-". $dateexplode[0];
         }
     }else
         $daydate = date("Y-m-d");  
     
    // echo "Day date".$daydate;
     
    $doctorDayAppointments = $appointment->doctorAppointmentDayList($doctorid, $daydate,$_SESSION['officeid']);
  foreach($appointmentSlots as $slots){
     // print_r(($slots->slot));
     // echo ("Compare : ".in_array($slots->slot, $doctorDayAppointments));echo "<br/>";
       $bookAppointment = ""; 
    
      if(in_array($slots->slot, $doctorDayAppointments)){
        //    echo "In Array";echo "<br/>";
            $cssClass = "#90D2FB";
            $details = $appointment->fetchPatientNameandStatusforDoctorDaySlot($slots->slot, $doctorid,$daydate,$_SESSION['officeid']);
           // echo "<br/>";echo "Hello ";
          // print_r($details);
          
            $patientName = $details[0]->PATIENTNAME;
          
            $status = $details[0]->STATUS;
            $appointmentid = $details[0]->ID;
            
             //echo "Status ".$status.".........Staus";
             $prescriptionDetails = array();
            if($status == "Y"){
              $cssClass = "#F5A458";
              $prescriptionDetails = $ap->fetchPrescriptionDataByAppointmentId($details[0]->ID);  
            }    
              if(count($prescriptionDetails)){
                  echo "Hello     ";
                $cssClass = "#C8FE2E";
              }  
            
        }else{
            $cssClass = "#FFFFFF"; 
            $patientName ="";
          // $conco = "('".$slots->slot."')";
            $conco = rawurlencode($slots->slot);
           //echo $conco;
            if($patientName == ""){
                //$bookAppointment = "onClick = bookAppointment('".$conco."')";
                $bookAppointment = "";
            }
        }
      //echo $bookAppointment;
      ?>
    
    <span class="item-box" style="background-color: <?php echo $cssClass;?>" <?php echo $bookAppointment;?>>
        <span class="item">
            <p> <?php echo $slots->slot;?></p>
            <p> <?php echo $patientName;?>
<!--a href="#" onclick="navigateToPrescription(<?php echo $appointmentid; ?>)"><?php echo $patientName;?></a--></p>
             <?php if((($status == "N"))){ ?>
                    
                <a href='#' onclick=confirmAppointment(<?php echo $appointmentid; ?>)><font color='blue'>Confirm</font></a>&nbsp;&nbsp; 
              <?php }
              ?>
            <?php if((($status == "Y")) && count($prescriptionDetails) < 1){ ?>
                    
                  <!--a href='#' onclick=finishAppointment(<?php echo $appointmentid; ?>)><font color='blue'>Finish</font></a-->&nbsp;&nbsp; 
                <?php }
                ?>
        </span>
    </span>
  <?php $status = ""; $cssClass = "";} ?>  
   
  
</section>
        </div>     

     </fieldset>  
    
   
   
</form>      
</div>    

    