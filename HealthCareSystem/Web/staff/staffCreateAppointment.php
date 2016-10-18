<?php
//echo $_GET['doctorid'];
//echo $_GET['appointmentdate'];
 $extraParam = "UPDATESESSION";
 $_SESSION['doctorid'] = $_GET['doctorid'];
 $doctorList = $dd->hospitalSpecificDoctorList($_SESSION['officeid'],$extraParam,$_SESSION['doctorid']);
   //echo "Sessin Value : ".$_SESSION['doctorid'];echo "<br/>";
    $appointmentSlots = $dd->appointmentStaffSlots($_SESSION['officeid']);
$_SESSION['doctorid'] = $_GET['doctorid'];
$doctorAppointments = $dd->doctorAppointmentDayList($_SESSION['doctorid'],$_GET['appointmentdate'],$_SESSION['officeid']);   
?>

<div class="col-md-8">
   <input type="hidden" id="doctorid" value="<?php echo $_SESSION['doctorid']?>"/>
    <input type="hidden" id="appointmentdate" value="<?php echo $_GET['appointmentdate']?>"/>
     <fieldset>
      <div class="row">
        <b> Appointment Date :  </b> <i><?php echo $_GET['appointmentdate']?></i>  &nbsp; &nbsp; &nbsp;
             <b> Doctor Name :  </b> <i><?php echo $_GET['doctorname']?></i>         
<section class="line-icon-page icon-page-fa margin-bottom-40">
    
  <?php 
  //print_r($doctorAppointments);
  $appointment = new DoctorData();
  $doctorid = $_SESSION['doctorid'];
  $status = "";$patientName = "";
 
  foreach($appointmentSlots as $slots){
     // print_r(($slots->slot));
    //  echo ("Compare : ".in_array($slots->slot, $doctorAppointments));echo "<br/>";
       $bookAppointment = "";  
      if(in_array($slots->slot, $doctorAppointments)){
         //   echo "In Array";echo "<br/>";
            $cssClass = "#90D2FB";
            $details = $appointment->fetchPatientNameandStatusforDoctorSlotForSpecifiedDate($slots->slot, $doctorid,$_GET['appointmentdate'],$_SESSION['officeid']);
 //echo ":: ".$details[0]->ID;
        // print_r($details);   
            $prescriptionDetails =  Array();
                    
// echo "<br/>";echo "Hello ";
            //print_r($prescriptionDetails);
            
            $patientName = $details[0]->PATIENTNAME;
            $status = $details[0]->STATUS;
            $appointmentid = $details[0]->ID;
            
            if($status == "Y"){
              $cssClass = "#F5A458";
              $prescriptionDetails = $ap->fetchPrescriptionDataByAppointmentId($details[0]->ID);  
            } 
           // echo ".....................".$details[0]->AMOUNT;
           //  echo ".....................".$details[0]->ID;
            //if(count($prescriptionDetails)){
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
                $bookAppointment = "onClick = bookAppointment('".$conco."')";
            }
        }
      //echo $bookAppointment;
             //$pos=stripos($patientName, ' ', 5);
        //echo "Hello";
        if(strlen($patientName) > 5)
                $name = substr($patientName,0,5).".....";
        else
                 $name = $patientName


           //    echo "Value : ". substr($patientName,0,$pos);

      ?>
    
    <span class="item-box" style="background-color: <?php echo $cssClass;?>" <?php echo $bookAppointment;?>>
        <span class="item" title="<?php  echo $patientName; ?>">
            <p> <?php echo $slots->slot;?></p>
            <p> <?php echo $name;?></p>
            <p>
                <?php //echo "Status :".$status; 
                   // echo "Compare ".((($status == "N")));
                if((($status == "N"))){ ?>
                    
                  <a href='#' onclick=confirmAppointment(<?php echo $appointmentid; ?>)><font color='blue'>Confirm</font>
                  </a>&nbsp;&nbsp;<a href='#'  onclick=cancelAppointment(<?php echo $appointmentid; ?>) ><font color='blue'>Cancel</font></a> 
                <?php }
                if((($status == "Y")) && $details[0]->AMOUNT != ''){ ?>
                    
                  <a href='#' onclick=finishAppointment(<?php echo $appointmentid; ?>)><font color='blue'>Prescription</font></a>&nbsp;&nbsp; 
                <?php }
                ?>
            </p>
            
        </span>
    </span>
  <?php $status = "";} ?>
  <?php  if(count($appointmentSlots) < 1) { ?>
    
            <br/>
            <br/><br/><br/>
           <section class="col-md-10 margin-bottom-45">
                <center>  
                    <h6><i><font color="blue"> -- Sorry Doctor Timings are not set. Please contact Hospital Administrator to set timings.Thanks ! --</font></i></h6>
                </center>    
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
                 <form action="" id="sky-form" class="sky-form">
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
                           
                            <section class="col col-4">
                                <label class="input">
                                    Appointment Date : 
                                </label><span id="currdate"><i></i></span>
                                <font color="red"><i><span id="staffapptpatientstartdt"></span> </i></font>
                            </section><input type="hidden" id="slot"/>
                           <section class="col col-4">
                                <label class="select">
                                  <select id="appointmenttype" name="appointmenttype" class="form-control">
                                   <option value="appointmentype">- Appointment Type -</option>
                                   <option value="Pregnancy">Pregnancy</option>
                                   <option value="Child">Child</option>
                                  </select>
                                   <i><font color="red"><span id="paramnameerrormsg"></span></font></i>
                               </label>
                            </section>
                             
                             <input type="hidden" id="start"  placeholder="Patient Name">
                             <section class="col col-2">
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
    
    
    <div class="modal fade" id="appointmentLeaveMessage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myLargeModalLabel" class="modal-title">Book Appointment : Doctor Name - <?php echo $_SESSION['doctorname'];?></h4>
                </div><input type="hidden" id="doctor" value="<?php echo $_SESSION['doctorid'];?>"/>
                <div class="modal-body">
                    <h5><i><span id="leaveMessage"></span></i></h5>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
</div>    