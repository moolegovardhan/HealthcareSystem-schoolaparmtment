  
<div class="col-md-8">
      <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script>
      $(document).ready(function(){ 
         $( "#start" ).datepicker({  minDate: 0, maxDate: "+2M", 
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
    <div class="row margin-bottom-40">
         <div class="panel panel-orange">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i> Create Consultation</h3>
             </div>
             <div class="panel-body"> 
              <form action="" id="sky-form" class="sky-form">
                 <div class="col-md-12">  
                    <fieldset>
                       <div class="row">
                            <section class="col col-4">
                                <label class="input">
                                      <input type="text" id="cpatientName"  placeholder="Patient Name">
                                  </label>
                                 <font color="red"><i><span id="patienterrormsg"></span> </i></font>
                            </section>
                            <section class="col col-4">
                            <label class="input">
                                  <input type="text" id="hidpatientid"  placeholder="Patient ID">
                                <input type="hidden" id="patientid"  placeholder="Patient ID">
                              </label>
                                <i><font color="red"><span id="staffapptpatientid"></span></font></i>
                            </section>
                            <input type="hidden" value="<?php echo $hosiptalName[0]->id?>" id="hosiptal"/>
                             
                           <section class="col col-4">
                                <label class="input">
                                    <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="start" id="start" placeholder="Appointment date">
                                     <font color="red"><i><span id="starterrormsg"></span> </i></font>
                                </label>
                            </section>
                        </div>     
                        
                     </fieldset> 
                    <fieldset>
                       <div class="row">
                           <font color="red"><i><span id="appointmentemsg"></span></i></font>
                         <!--button type="button" class="btn-u"  name="button" id="staffBlockAppointment" > Block Slot </button-->        
                           <button type="button" class="btn-u pull-right"  name="button" id="bthCheckStaffConsultationUsers" > Search </button>
                        </div>     
                        
                     </fieldset> 
                    <fieldset>
                      <div class="row">
                     
                     <section class="col col-12">
                        <div class="col-md-15">
                          <div class="panel panel-orange margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit"></i>List of Patients</h3>
                            </div>
                            <table class="table table-striped" id="patient_consultation_records_table">
                                <thead>
                                    <tr>
                                       
                                        <th>AID</th>
                                        <th>Patient Name</th>
                                        <th>Hospital</th>
                                        <th>Doctor Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
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
        </div>
     </div>
</div>    
    
    
</div>