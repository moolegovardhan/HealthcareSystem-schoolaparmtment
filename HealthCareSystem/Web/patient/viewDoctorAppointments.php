<?php
session_start();
include_once  '../../Business/DoctorData.php';
include_once '../../Business/AppointmentData.php';
$dd = new DoctorData();
$ap = new AppointmentData();
 $extraParam = "UPDATESESSION";
 $_SESSION['doctorid'] = $_GET['doctorid'];
 //$doctorList = $dd->hospitalSpecificDoctorList($_SESSION['officeid'],$extraParam,$_SESSION['doctorid']);
//   echo "Sessin Value : ".$_SESSION['doctorid'];echo "<br/>";
    $appointmentSlots = $dd->patientAppointmentStaffSlots($_GET['doctorid'],$_GET['hospital']);
$_SESSION['doctorid'] = $_GET['doctorid'];
$doctorAppointments = $dd->doctorPatientAppointmentDayList($_SESSION['doctorid'],$_GET['appointmentdate'],$_GET['hospital']);   
?>

<div class="col-md-12">
   <input type="hidden" id="doctorid" value="<?php echo $_SESSION['doctorid']?>"/>
    <input type="hidden" id="appointmentdate" value="<?php echo $_GET['appointmentdate']?>"/>
     <input type="hidden" id="hospital" value="<?php echo $_GET['hospital']?>"/>
     <fieldset>
      <div class="row">
          
          <b> Appointment Date :  </b> <i><?php echo $_GET['appointmentdate']?></i>  &nbsp; &nbsp; &nbsp;
            <b> Hospital Name :  </b> <i><?php echo $_GET['hospitalname']?></i>   &nbsp; &nbsp; &nbsp;
              <b> Doctor Name :  </b> <i><?php echo $_GET['doctorname']?></i>  
              
              <section class="col-md-2"></section>  
              <section class="col-md-12">            
<section class="line-icon-page icon-page-fa margin-bottom-40 pull-right">
    
  <?php 
  //print_r($doctorAppointments);
  $appointment = new DoctorData();
  $doctorid = $_SESSION['doctorid'];
  $status = "";$patientName = "";
 
  foreach($appointmentSlots as $slots){
      //print_r(($slots->slot));
  //    echo ("Compare : ".in_array($slots->slot, $doctorAppointments));echo "<br/>";
       $bookAppointment = ""; 
        $cssClass  ="";
      if(in_array($slots->slot, $doctorAppointments)){
          //  echo "In Array";echo "<br/>";
            $cssClass = "#90D2FB";
            $details = $appointment->fetchPatientNameandStatusforDoctorSlotForSpecifiedDate($slots->slot, $doctorid,$_GET['appointmentdate'],$_GET['hospital']);
           
           //echo "<br/>";echo "Hello ";
          // print_r($details);
            
            $patientName = $details[0]->PATIENTNAME;
            $status = $details[0]->STATUS;
            $appointmentid = $details[0]->ID;
           // echo $appointmentid;
            if($status == "Y"){
                $cssClass = "#F5A458";
                 $prescriptionDetails = $ap->fetchPrescriptionDataByAppointmentId($details[0]->ID);
            }
            if(count($prescriptionDetails)){
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
        $pos=stripos($patientName, ' ', 0);
        $name = substr($patientName,0,$pos);
      ?>
    
    <span class="item-box" style="background-color: <?php echo $cssClass;?>">
        <span class="item" title="<?php echo $patientName;  ?>">
            <p> <?php echo $slots->slot;?></p>
            <p> <?php echo $name;?></p>
            
            
        </span>
    </span>
  <?php $status = "";} ?>  
   
  
</section>
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
                    <div class="panel-orange">   
                        <span id="confirmmessage" class="warning pull-right"><font color="blue"><i><b></b></i></font></span>
                      <fieldset>
                       <div class="row">
                           <section class="col col-4">
                            <label class="input">
                                Patient Name : <?php echo $_SESSION['logeduser'];?>
                                  <input type="hidden" id="hidpatientName"  placeholder="Patient Name" value="<?php echo $_SESSION['logeduser'];?>">
                              </label>
                               
                            </section>
                           <section class="col col-4">
                            <label class="input">
                                 Patient ID : <?php echo $_SESSION['userid'];?>
                                  
                                <input type="hidden" id="hidpatientid"  placeholder="Patient ID" value="<?php echo $_SESSION['userid'];?>">
                              </label>
                                <i><font color="red"><span id="staffapptpatientid"></span></font></i>
                            </section>
                           <section class="col col-4">
                                <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                               
                               
                           </section>
                            <input type="hidden"  value="<?php echo $_GET['hospital']?>" id="hosiptal"/>
                           
                            <section class="col col-6">
                                <label class="input">
                                    Appointment Date : 
                                </label><span id="currdate"><i></i></span>
                                <font color="red"><i><span id="staffapptpatientstartdt"></span> </i></font>
                            </section><input type="hidden" id="slot"/>
                             <input type="hidden" id="start"  placeholder="Patient Name">
                                 
                       </div>     
                          <input type="hidden" id="appointmentdate"  value="<?php echo $_GET['appointmentdate']?>"/>
                         
                     </fieldset> 
                        
                        
                        
                     </div>
                 </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-brown" type="button" onclick="staffHomeBookAppointment(<?php echo $_SESSION['userid'];?>)">Create Appointment</button>
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