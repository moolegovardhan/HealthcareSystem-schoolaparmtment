 <div class="col-md-3">
     
    <?php if($_GET['page'] == "") { ?> 
        <?php  //if($_GET['page'] == "appointment"){ ?>
     <!--div class="sky-form">
         
     <label class="input">
        <i class="icon-append fa fa-calendar"></i>
        <input type="text" name="start" id="start"  readonly placeholder="Appointment date">
         
    </label>
     </div-->
        <?php  //} ?> 
    <ul class="list-group sidebar-nav-v1 fa-fixed" id="sidebar-nav">
        <!-- Typography -->
        <li class="list-group-item list-toggle"> 
         <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-typography">Doctor List</a>
            <ul id="collapse-typography" >
                <?php  if(count($doctorList) > 0) { foreach($doctorList as $doctor){
                       // echo $_SESSION['doctorid'];echo "<br/>";
                       // echo $doctor->ID;echo "<br/>";
                       // echo ($_SESSION['doctorid'] == $doctor->ID);echo "<br/>";
                        if($_SESSION['doctorid'] == $doctor->ID){
                           // $selectedDoctor = '<i class="fa  fa-hand-o-right"></i>';
                             $selectedDoctor = '<span class="badge badge-u">Selected</span>';
                             $active = 'class = "active"';
                           // $hrefcolor = 
                        }else{
                           $selectedDoctor = ''; 
                           $active = '';
                        }  
                        
                        ?>
                <li <?php echo $active;?> >
                    
                        <a href="#" onclick="showDoctorAppointments(<?php echo $doctor->ID?>)"> <?php echo $doctor->name;?> &nbsp; &nbsp; &nbsp; <?php echo $selectedDoctor; ?></a>
                   
                </li>
                 <?php }
                    
                            }
                     ?>
           </ul>
        </li>    
     
    <?php } else if(($_GET['page'] == "patientprescription")){?>
     <div class="panel panel-orange" id="prescriptionsearchpanel">
    <div class="panel-heading">
        <h3 class="panel-title"> Search Consultation</h3>
     </div>
     <div class="panel-body"> 
       <form action="#" id="sky-form" class="sky-form" method="POST" enctype="multipart/form-data">  
         <fieldset>
            <div class="row">
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientName"  placeholder="Patient Name">
                      <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientID"  placeholder="Patient ID">
                      <input type="hidden" id="hidpatientID"  >
                    </label>
                    <i><font color="red"><span id="staffapptpatientid"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="appointmentID"  placeholder="Appointment ID">
                      <input type="hidden" id="hidappointmentid" >
                    </label>
                    <i><font color="red"><span id="staffappointmentid"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="mobile"  placeholder="Mobile Number">
                      <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="staffpatientmobile"></span></font></i>
                </section>
            </div>
         </fieldset> 
           <footer>
               <input type="button" class="btn-u pull-right"  name="button" id="searchPrescription" value="search"/>     
             </footer>  
          
         
           
           
         </form>
     </div>
</div> 
    
    <?php }  else if(($_GET['page'] == "patientreport") ){?>
     <div class="panel panel-orange" id="reportssearchpanel">
    <div class="panel-heading">
        <h3 class="panel-title">Reports : Search Consultation</h3>
     </div>
     <div class="panel-body"> 
       <form action="#" id="sky-form" class="sky-form" method="POST" enctype="multipart/form-data">  
         <fieldset>
            <div class="row">
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientName"  placeholder="Patient Name">
                      <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientID"  placeholder="Patient ID">
                      <input type="hidden" id="hidpatientID"  >
                    </label>
                    <i><font color="red"><span id="staffapptpatientid"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="appointmentID"  placeholder="Appointment ID">
                      <input type="hidden" id="hidappointmentid" >
                    </label>
                    <i><font color="red"><span id="staffappointmentid"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="mobile"  placeholder="Mobile Number">
                      <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="staffpatientmobile"></span></font></i>
                </section>
            </div>
         </fieldset> 
           <footer>
               <input type="button" class="btn-u pull-right"  name="button" id="searchReports" value="search"/>     
             </footer>  
          
         
           
           
         </form>
     </div>
</div> 
    
    <?php }  else if(($_GET['page'] == "patientgeneral") || ($_GET['page'] == "patienthealth") ){?>
     <div class="panel panel-orange" id="reportssearchpanel">
    <div class="panel-heading">
        <h3 class="panel-title">Search Patient</h3>
     </div>
     <div class="panel-body"> 
       <form action="#" id="sky-form" class="sky-form" method="POST">  
         <fieldset>
            <div class="row">
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientName"  placeholder="Patient Name">
                      <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientID"  placeholder="Patient ID">
                      <input type="hidden" id="hidpatientID"  >
                    </label>
                    <i><font color="red"><span id="staffapptpatientid"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="mobile"  placeholder="Mobile Number">
                      <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="staffpatientmobile"></span></font></i>
                </section>
            </div>
         </fieldset> 
           <footer>
               <input type="button" class="btn-u pull-right"  name="button" id="searchPatients" value="search"/>     
             </footer>  
          
         
           
           
         </form>
     </div>
</div> 
    
    <?php } else if(($_GET['page'] == "patientmedicines")){?>
     Hello
    <?php }?>
   <!-- 
     <hr/>
     <b>Total Appointments :</b>&nbsp;&nbsp;&nbsp;&nbsp;<i>50</i>
     <hr/>
      <b>Doctor's Available :</b>
        <div>
            <justify> 
               <?php //foreach($doctorPresent as $present){?> 
                <li><i><a href="#" onclick="showDoctorAppointment('<?php// echo $present; ?>')"><?php //echo $present; ?></a></i></li>
               <?php// }?>
            
             </justify>
            <hr/>
        </div>
      <b>Doctor's Absent :</b>
        <div>
            <justify>  
              <?php foreach($doctorLeave as $absent){?> 
            <li><i><?php echo $absent; ?></i></li>
               <?php }?>
            
             </justify>
            <hr/>
        </div>
       <!--ul class="list-group sidebar-nav-v1" id="sidebar-nav">
                 
            <li class="list-group-item list-toggle">                   
                <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-typography">Disease</a>
                <ul id="collapse-typography" class="collapse">
                    <li><a href="#">Symptoms</a></li>
                    <li>
                        <a href="#">Precautions</a>
                    </li>
                    <li>                           
                        <a href="#"> Dividers</a>
                    </li>

                    <li>                           
                        <a href="#">Food taken</a>
                    </li>
                    <li><a href="#"> Food avoids</a></li>                            
                </ul>
            </li> 

            <li class="list-group-item"><a href="#">Pregnancy care</a></li> 

            <li class="list-group-item"><a href="#">Child care</a></li> 

            <li class="list-group-item"><a href="#"> Old age care</a></li> 

            <li class="list-group-item"><a href="#">Nutrition</a></li> 

            <li class="list-group-item"><a href="#">Yoga</a></li> 

            <li class="list-group-item"><a href="#">Meditation</a></li> 
             <li class="list-group-item"><a href="#">Side effects </a></li>

            <li class="list-group-item"><a href="#">Rejected Medicine list</a></li> 
        </ul-->
        
        
        <!--ul class="list-group sidebar-nav-v1" id="sidebar-nav">
           
            <li class="list-group-item list-toggle">                   
                <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-typography">Profile</a>
                <ul id="collapse-typography" class="collapse">
                    <li><a href="patientindex.php?page=personal">Personal</a></li>
                    <li>
                        <a href="patientindex.php?page=health">Health</a>
                    </li>
                                            
                </ul>
            </li> 

            <li class="list-group-item"><a href="patientindex.php?page=consultation">Consultation</a></li> 

            <li class="list-group-item"><a href="#">Medicine</a></li> 

            <li class="list-group-item"><a href="patientindex.php?page=reports">Reports</a></li> 

        </ul-->
        
        
        
         <!--div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Appointments</h4>
                </div>
                <div class="modal-body">
                
                    <div class="panel panel-orange margin-bottom-40">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-edit"></i>Booked Slots Time</h3>
                        </div>
                        <table class="table table-striped" id="current_doctor_appointment_records_table">
                            <thead>
                                <tr>
                                    <th>PID</th>
                                    <th>Patient Name</th>
                                    <th>Slot Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div> -->
</div>