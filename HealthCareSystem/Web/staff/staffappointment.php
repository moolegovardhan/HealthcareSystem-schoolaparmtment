  
<div class="col-md-10">
     <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
     <script>
   $(document).ready(function(){ 
       
       var currentTime = new Date() 
var minDate = new Date(currentTime.getYear(), currentTime.getMonth() -1, +1); //one day next before month
var maxDate =  new Date(currentTime.getFullYear(), currentTime.getMonth() +2, -1);


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
     <fieldset>
         <div class="row">
         <section class="col col-md-4"></section>
    <section class="col col-md-10 pull-right">
    <div class="margin-bottom-40">
        
         <div class="panel panel-orange">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i> Create Appointment</h3>
             </div>
             <div class="panel-body"> 
              <form action="" id="sky-form" class="sky-form">
                 <div class="col-md-12">  
                    <fieldset>
                       <div class="row">
                           <section class="col col-4">
                            <label class="input">
                                  <input type="text" id="patientName"  placeholder="Patient Name">
                                <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                              </label>
                                <i><font color="red"><span id="staffapptpatientname"></span></font></i>
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
                                <label class="select">
                                    <select name="doctor" id="doctor">
                                        <option value="DOCTOR" selected >Doctor Name</option>
                                        <?php foreach ($doctorList as $value) { ?>
                                            <option value="<?php echo $value->ID ?>"><?php echo $value->name?></option>
                                        <?php } ?>
                                    </select>
                                     
                                </label>
                                <font color="red"><i><span id="staffdoctorerrormsg"></span> </i></font>
                            </section>
                            
                            <section class="col col-4">
                                <label class="input">
                                    <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="start" id="start" placeholder="Appointment date" readonly>
                                     
                                     <font color="red"><i><span id="starterrormsg"></span> </i></font>
                                </label>
                                <font color="red"><i><span id="staffapptpatientstartdt"></span> </i></font>
                            </section>
                             <label class="label col col-2">Slot Time</label>
                            <section class="col col-2">
                                <label class="select">
                                    <select name="slot" id="slot">
                                        <option value="0" selected>-----Slot-----</option>
                                        
                                    </select>
                                   
                                </label>
                       <font color="red"><i><span id="staffsloterrormsg"></span> </i></font>
                            </section>
                            
                            
                              <input type="button" class="btn-u pull-right"  name="button" id="bthSearchStaffAppointmentUsers" value="Search"/> 
                        </div>     
                        
                     </fieldset> 
                    <fieldset>
                      <div class="row">
                     
                     <section class="col-md-15">
                        <div class="col-md-15">
                          <div class="panel panel-orange margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit"></i>List of Patients</h3>
                            </div>
                            <table class="table table-striped" id="patient_records_table">
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
                    <fieldset>
                       <div class="row">
                           
                    <section class="col col-10">
                        <div class="col-md-12">
                          <div class="panel panel-orange margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit"></i>Booked Slots Time</h3>
                            </div>
                            <table class="table table-striped" id="records_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
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
                     </section>
                           
                        </div>     
                        
                     </fieldset> 
                   
                 </div>
                 </form>  
             </div>     
        </div>
     </div>
        </section>
         </div>
    </fieldset>
</div>    
    
 