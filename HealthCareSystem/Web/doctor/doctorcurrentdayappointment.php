<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/doctorPrescription.js"></script>
 

<div class="col-md-12">
   
    <fieldset>
      <div class="row">
      
             
             <section class="col col-md-1"></section>             
<section class="line-icon-page icon-page-fa margin-bottom-45 col-md-10 pull-right">
    
  <?php 
  //echo "Helloooo00"+ $_SESSION['officeid'];
 // print_r($doctorAppointments);
  $appointment = new DoctorData();
  $doctorid = $_SESSION['doctorid'];
  $status = "";$patientName = "";
 // echo "Helloooo00"+ $doctorid;
  foreach($appointmentSlots as $slots){
     // print_r(($slots->slot));
    // echo ("Compare : ".in_array($slots->slot, $doctorAppointments));echo "<br/>";
       $bookAppointment = "";  
     
      if(in_array($slots->slot, $doctorAppointments)){
         //   echo "In Array";echo "<br/>";
            $cssClass = "#90D2FB";
            $details = $appointment->fetchPatientNameandStatusforDoctorSlot($slots->slot, $doctorid);
           // echo "<br/>";echo "Hello ";
           // print_r($details);
            
            $patientName = $details[0]->PATIENTNAME;
            $status = $details[0]->STATUS;
            $appointmentid = $details[0]->ID;
            if($status == "Y"){
                $cssClass = "#F5A458";
                 $prescriptionDetails = $ap->fetchPrescriptionDataByAppointmentId($details[0]->ID);  
            }   
             // if(count($prescriptionDetails)){
            if($details[0]->AMOUNT != ''){
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
        <span class="item" title="<?php  echo $patientName; ?>">
            <p> <?php echo $slots->slot;?></p>
            <p> <?php 
             $toNavidate = 'navigateToPrescription('.$appointmentid.')';
            if(strlen($patientName) >= 10){
                
            	$result = substr($patientName, 0, 10);
            	//echo '<a href="#" onclick="'.$toNavidate.'"><font color="blue">'.$result.' ...</font></a>';
                echo $result;
            }else{
            	//echo '<a href="#" onclick="'.$toNavidate.'"><font color="blue">'.$patientName.' ...</font></a>';
                echo $patientName;
            }
            
          //  echo "Status".$status;?></p>
             <?php if($status == "N"){ ?>
            <?php echo $appointmentid; ?>
                  <!--a href="#" onclick="navigateToPrescription(<?php echo $appointmentid; ?>)"><font color='blue'>Prescription</font></a></a--> 
                 <?php }
                if((($status == "Y")) && $details[0]->AMOUNT != ''){ ?>
                    
                  <a href='#' onclick="navigateToPrescriptionPagesFromHomePageOfDoctor(<?php echo $appointmentid; ?>)"><font color='blue'>Prescription</font></a>&nbsp;&nbsp; 
                <?php }
                ?>
        </span>
    </span>
  <?php $status = "";} ?>  
   <?php  if(count($appointmentSlots) < 1) { ?>
    
            <br/>
            <br/><br/><br/>
            <section class="col-md-12 margin-bottom-45">
                <h4><i><font color="blue"> -- Sorry Doctor Timings are not set. Please contact Hospital Administrator to set timings.Thanks ! --</font></i></h4>
            </section>
                <br/><br/>
   <?php  } ?> 
  
</section>
        </div>     

     </fieldset>  
    
   
   <div class="modal fade" id="enterAppointmentData" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myLargeModalLabel" class="modal-title">Book Appointment : Doctor Name - <?php echo $_SESSION['doctorname'];?></h4>
                </div><input type="hidden" id="doctor" value="<?php echo $_SESSION['doctorid'];?>"/>
                <div class="modal-body">
                 <form action="" id="sky-form" class="sky-form" id="viewappointment">
                    <div class="panel panel-orange margin-bottom-40">   
                        <span id="confirmmessage" class="warning pull-right"><font color="blue"><i><b></b></i></font></span>
                      <fieldset>
                       <div class="row">
                           <section class="col col-4">
                            <label class="input">
                                  <input type="text" id="patientName"  placeholder="Patient Name">
                                <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                              </label>
                               
                            </section>
                           <section class="col col-4">
                            <label class="input">
                                  <input type="text" id="patientid"  placeholder="Patient ID">
                                <input type="hidden" id="hidpatientid"  placeholder="Patient ID">
                              </label>
                                <i><font color="red"><span id="staffapptpatientid"></span></font></i>
                            </section>
                           <section class="col col-4">
                                <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                               
                               
                           </section>
                            <input type="hidden" value="<?php echo $hosiptalName[0]->id?>" id="hosiptal"/>
                           
                            <section class="col col-6">
                                <label class="input">
                                    Appointment Date : 
                                </label><span id="currdate"><i></i></span>
                                <font color="red"><i><span id="staffapptpatientstartdt"></span> </i></font>
                            </section><input type="hidden" id="slot"/>
                             <input type="hidden" id="start"  placeholder="Patient Name">
                             <section class="col col-3">
                                <input type="button" class="btn-u pull-right"  name="button" id="bthCheckStaffHomeConsultationUsers" value="Search"/> 
                             </section>        
                       </div>     
                          <input type="hidden" id="appointmentdate" />
                          <div class="row">
                               <section class="col col-md-15">
                                <div class="col-md-15">
                                  <div class="panel panel-orange margin-bottom-40">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="fa fa-edit"></i>List of Patients</h3>
                                    </div>
                                    <table class="table table-striped" id="patient_home_staff_records_table">
                                        <thead>
                                            <tr>

                                                <th>Patient Id</th>
                                                <th>Patient Name</th>
                                                <th>Email</th>
                                                <th>Phone #</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>

                             </div> 

                             </section>
                              
                              
                          </div>  
                     </fieldset> 
                        
                        
                        
                     </div>
                 </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
 
    
    <div class="modal fade" id="appointmentGeneralMessage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myLargeModalLabel" class="modal-title">Book Appointment : Doctor Name - <?php echo $_SESSION['doctorname'];?></h4>
                </div><input type="hidden" id="doctor" value="<?php echo $_SESSION['doctorid'];?>"/>
                <div class="modal-body">
                    <h5><i><span id="generalMessage"></span></i></h5>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
</div>    



<!--div class="col-md-8">
    <fieldset>
      <div class="row">
         <section class="col-md-10 pull-right">
        <div class="panel panel-sea margin-bottom-40">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-edit"></i>Today Appointment List</h3>
            </div>
            <table class="table table-striped" id="current_appointment_records_table">
                <thead>
                    <tr>
                        <th>PID</th>
                        <th>Patient Name</th>
                        <th>Slot Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php /* $count = 1; foreach ($appointmentList as $value) { ?>
                        <tr>
                           
                            <td><?php echo $value->PatientId; ?></td>
                            <td><?php echo $value->PatientName; ?></td>
                            <td><?php echo $value->AppointmentTime; ?></td>
                            <td><?php if($value->status == "Y"){
                                          echo "Confirmed";
                                      } else if($value->status == "N"){
                                          echo "Cancelled";
                                      }  else {
                                          echo "Not Confirmed";
                                      }
?></td>
                        </tr>
                    <?php  $count++;} */?> 
                </tbody>
            </table>
        </div>  
              </section>
             <!--section class="col-md-5">
        <div class="panel panel-sea margin-bottom-40">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-edit"></i>List of Doctors</h3>
            </div>
            <table class="table table-striped" id="">
                <thead>
                    <tr>
                       
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                    </tr>
                 </thead>    
                    
               
                <tbody>

                </tbody>
            </table>
        </div>
         </section-->

        <!--/div>     

     </fieldset>     
</div-->    