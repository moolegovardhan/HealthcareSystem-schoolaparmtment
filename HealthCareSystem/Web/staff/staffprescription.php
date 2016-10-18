<?php 
//include_once 'patientfileupload.php';
?>
<div class="col-md-15" >
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
    <form action="../../Business/PatientFileUpload.php" id="sky-form" class="sky-form" method="POST" enctype="multipart/form-data">  

 <input type="submit" class="btn-u pull-right"  name="button" id="btnStaffPrescription" value="Submit"/>     
  
    <div class="tab-v1">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">General</a></li>
            <li><a href="#messages" data-toggle="tab">Reports</a></li>
            <li><a href="#profile" data-toggle="tab">Details</a></li>
            <li><a href="#settings" data-toggle="tab">Medicines</a></li>
            <li><a href="#" data-toggle="tab"> <span id="patientdetails"><b><i>    </i></b></span>  </a></li>
        </ul>             
        <div class="tab-content">
            <!-- 1st Tab content Start -->
            <div class="tab-pane fade in active" id="home">
                <div class="col-md-12">  
                <div class="row"> 
                         <div class="col-md-12">  

                             <fieldset>
                                   <div class="row">
                                        <label class="label col col-2">Patient Name</label>
                                        <section class="col col-4">
                                            <label class="input">
                                                <input type="text"  name="conspatient"  id="conspatient" list="prescriptionpatientlist">
                                                <datalist id="prescriptionpatientlist" name="datal"> 
                                                    <option value="" label="" />
                                                </datalist>
                                            </label>
                                            <input type="hidden" id="selectedpatient"  name="selectedpatient" />
                                             <input type="hidden" id="selectedpatientid"  name="selectedpatientid" />
                                             <input type="hidden" id="appointmentId"  name="appointmentId" />
                                            <b><font color="red"><i><span id="listerror"></span></i></font></b>
                                        </section>
                                       <label class="label col col-2">Hospital Name</label>
                                        <section class="col col-4">
                                            <label class="input">

                                                <input type="text"  id="preshosiptal" readonly/>
                                                <input type="hidden"  id="hidpreshosiptalid"  name="hidpreshosiptalid"/>
                                            </label>
                                            <font color="red"><i><span id="preshosiptalerrormsg"></span> </i></font>
                                        </section>
                                        <label class="label col col-2">Doctor Name</label>
                                        <section class="col col-4">
                                            <label class="input">
                                                <input type="text" id="presdoctor" readonly/>
                                                <input type="hidden"  id="hidpresdoctorid"  name="hidpresdoctorid"/>

                                            </label>
                                            <font color="red"><i><span id="doctorerrormsg"></span> </i></font>
                                        </section>

                                        <label class="label col col-2">Appointment Date</label>
                                        <section class="col col-4">
                                            <label class="input">
                                                <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="appointmentDate" id="appointmentDate"  readonly placeholder="Appointment date">
                                                  <input type="hidden" name="hidappointmentDate" id="hidappointmentDate"  readonly placeholder="Appointment date">
                                                 <font color="red"><i><span id="starterrormsg"></span> </i></font>
                                            </label>
                                        </section>
                                        <label class="label col col-2">Next Appointment Date</label>
                                        <section class="col col-4">
                                            <label class="input">
                                                <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="start" id="start" placeholder="Next Appointment date">
                                                 <font color="red"><i><span id="enderrormsg"></span> </i></font>
                                            </label>
                                        </section>
                                    </div>     

                                 </fieldset>
                      </div>
                </div>

                </div>

            </div>
            <!-- 1st tab content end -->
             <!-- 2nd tab content Start -->
            <div class="tab-pane fade in" id="profile">

                <div class="col-md-12">  

                        <div class="col-md-12"> 

                        <fieldset>                  
                             <div class="row">    
                                 <section class="col col-6"> 
                                    <label class="label">Description</label>
                                   <label class="textarea">
                                        <textarea rows="3" id="presdescription" name="presdescription"></textarea>
                                    </label>

                                    </section>

                                    <section class="col col-6">
                                      <label class="label">Medical Test</label>
                                      <label class="select select-multiple">
                                            <select multiple id="presmedicaltest" name="presmedicaltest[]">
                                                <option value="Blood Test">Blood Test</option>
                                                <option value="Sugar">Sugar</option>
                                                <option value="H1B1">H1B1</option>

                                            </select>
                                        </label>
                                    </section>
                                 </div>
                                 <div class="row"> 
                                  <section class="col col-6">
                                     <label class="label">Diagnosis Center</label>

                                       <label class="select select-multiple">
                                        <select multiple id="presdiagnosis" name="presdiagnosis[]">
                                            <option value="Sri Ram">Sri Ram</option>
                                            <option value="Vijaya">Vijaya</option>
                                            <option value="Doliphin">Doliphin</option>
                                            <option value="Fortis">Fortis</option>
                                        </select>
                                       </label>
                                    </section>
                                 <section class="col col-6">
                                  <label class="label">Disease </label>

                                     <label class="select select-multiple">
                                            <select multiple id="presdiseases" name="presdiseases[]">
                                                <option value="Hepitatis">Hepitatis</option>
                                                <option value="Stomach Pain">Stomach Pain</option>
                                                <option value="Skin">Skin</option>
                                                <option value="ENT">ENT</option>
                                            </select>
                                        </label>
                                </section> 

                            </div>         
                            </fieldset>


                        </div>
                </div>    




            </div>
             <!-- 2nd tab content end -->


           <!-- 3rd tab content start --> 
            <div class="tab-pane fade in" id="messages">


                <div class="col-md-12">  

                        <div class="col-md-12"> 

                        <fieldset>                  
                             <div class="row">    
                               <section class="col col-6"> 
                                   <label class="label">Prescription</label>
                                    <label for="file" class="input input-file">
                                        <div class="button"><input type="file" name="filepres"  id="filepres" onchange="this.parentNode.nextSibling.value = this.value" accept="image/*">Browse</div><input type="text" name="filepres"  readonly>
                                    </label>
                                 </section>
                            </div>
                            <div class="row">   

                               <section class="col col-6"> 
                                   <label class="label">Reports</label>
                                    <label for="file" class="input input-file">

                                        <input  class="btn-u btn-u-default" type="file" id="files[]" name="files[]" multiple="multiple" accept="image/*"> 

                                   </label>
                                 </section>

                            </div>  


                            </fieldset>


                        </div>
                </div>    

            </div>
            <!-- 4th tab content start -->
            <div class="tab-pane fade in" id="settings">

                 <table class="table table-striped" id="patient_records_table">
                    <thead>
                        <tr>

                            <th>Medicine Name</th>
                            <th># Days</th>
                            <th>Morning Before Meal</th>
                            <th>Morning After Meal</th>
                            <th>Afternoon Before Meal</th>
                            <th>Afternoon After Meal</th>
                            <th>Evening Before Meal</th>
                            <th>Evening After Meal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>

                            <th><input type="text" name="mname1" placehoder="Medicine Name"/></th>
                            <th><input type="text" name="days1" placehoder="# Days" size="3"/></th>
                            <th><input type="checkbox" name="mbm1" /></th>
                            <th><input type="checkbox" name="mam1" /></th>
                            <th><input type="checkbox" name="abm1" /></th>
                            <th><input type="checkbox" name="afm1" /></th>
                            <th><input type="checkbox" name="ebm1" /></th>
                            <th><input type="checkbox" name="eam1" /></th>
                            <th></th>
                        </tr>
                        <tr>

                            <th><input type="text" name="mname2" placehoder="Medicine Name"/></th>
                            <th><input type="text" name="days2" placehoder="# Days" size="3"/></th>
                            <th><input type="checkbox" name="mbm2" /></th>
                            <th><input type="checkbox" name="mam2" /></th>
                            <th><input type="checkbox" name="abm2" /></th>
                            <th><input type="checkbox" name="afm2" /></th>
                            <th><input type="checkbox" name="ebm2" /></th>
                            <th><input type="checkbox" name="eam2" /></th>
                            <th></th>
                        </tr>
                       <tr>

                            <th><input type="text" name="mname3" placehoder="Medicine Name"/></th>
                            <th><input type="text" name="days3" placehoder="# Days" size="3"/></th>
                            <th><input type="checkbox" name="mbm3" /></th>
                            <th><input type="checkbox" name="mam3" /></th>
                            <th><input type="checkbox" name="abm3" /></th>
                            <th><input type="checkbox" name="afm3" /></th>
                            <th><input type="checkbox" name="ebm3" /></th>
                            <th><input type="checkbox" name="eam3" /></th>
                            <th></th>
                        </tr>
                        <tr>

                            <th><input type="text" name="mname4" placehoder="Medicine Name"/></th>
                            <th><input type="text" name="days4" placehoder="# Days" size="3"/></th>
                            <th><input type="checkbox" name="mbm4" /></th>
                            <th><input type="checkbox" name="mam4" /></th>
                            <th><input type="checkbox" name="abm4" /></th>
                            <th><input type="checkbox" name="afm4" /></th>
                            <th><input type="checkbox" name="ebm4" /></th>
                            <th><input type="checkbox" name="eam4" /></th>
                            <th></th>
                        </tr>
                       <tr>

                            <th><input type="text" name="mname5" placehoder="Medicine Name"/></th>
                            <th><input type="text" name="days5" placehoder="# Days" size="3"/></th>
                            <th><input type="checkbox" name="mbm5" /></th>
                            <th><input type="checkbox" name="mam5" /></th>
                            <th><input type="checkbox" name="abm5" /></th>
                            <th><input type="checkbox" name="afm5" /></th>
                            <th><input type="checkbox" name="ebm5" /></th>
                            <th><input type="checkbox" name="eam5" /></th>
                            <th></th>
                        </tr>
                       <tr>

                            <th><input type="text" name="mname6" placehoder="Medicine Name"/></th>
                            <th><input type="text" name="days6" placehoder="# Days" size="3"/></th>
                            <th><input type="checkbox" name="mbm6" /></th>
                            <th><input type="checkbox" name="mam6" /></th>
                            <th><input type="checkbox" name="abm6" /></th>
                            <th><input type="checkbox" name="afm6" /></th>
                            <th><input type="checkbox" name="ebm6" /></th>
                            <th><input type="checkbox" name="eam6" /></th>
                            <th></th>
                        </tr>
                       <tr>

                            <th><input type="text" name="mname7" placehoder="Medicine Name"/></th>
                            <th><input type="text" name="days7" placehoder="# Days" size="3"/></th>
                            <th><input type="checkbox" name="mbm7" /></th>
                            <th><input type="checkbox" name="mam7" /></th>
                            <th><input type="checkbox" name="abm7" /></th>
                            <th><input type="checkbox" name="afm7" /></th>
                            <th><input type="checkbox" name="ebm7" /></th>
                            <th><input type="checkbox" name="eam7" /></th>
                            <th></th>
                        </tr>
                        <tr>

                            <th><input type="text" name="mname8" placehoder="Medicine Name"/></th>
                            <th><input type="text" name="days8" placehoder="# Days" size="3"/></th>
                            <th><input type="checkbox" name="mbm8" /></th>
                            <th><input type="checkbox" name="mam8" /></th>
                            <th><input type="checkbox" name="abm8" /></th>
                            <th><input type="checkbox" name="afm8" /></th>
                            <th><input type="checkbox" name="ebm8" /></th>
                            <th><input type="checkbox" name="eam8" /></th>
                            <th></th>
                        </tr>
                      <tr>

                            <th><input type="text" name="mname9" placehoder="Medicine Name"/></th>
                            <th><input type="text" name="days9" placehoder="# Days" size="3"/></th>
                            <th><input type="checkbox" name="mbm9" /></th>
                            <th><input type="checkbox" name="mam9" /></th>
                            <th><input type="checkbox" name="abm9" /></th>
                            <th><input type="checkbox" name="afm9" /></th>
                            <th><input type="checkbox" name="ebm9" /></th>
                            <th><input type="checkbox" name="eam9" /></th>
                            <th></th>
                        </tr>
                       <tr>

                            <th><input type="text" name="mname10" placehoder="Medicine Name"/></th>
                            <th><input type="text" name="days10" placehoder="# Days" size="3"/></th>
                            <th><input type="checkbox" name="mbm10" /></th>
                            <th><input type="checkbox" name="mam10" /></th>
                            <th><input type="checkbox" name="abm10" /></th>
                            <th><input type="checkbox" name="afm10" /></th>
                            <th><input type="checkbox" name="ebm10" /></th>
                            <th><input type="checkbox" name="eam10" /></th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>



            </div>
            <!-- 4th tab content end -->
        </div>
    </div>
 <hr/>
 <div class="col-md-6 alert alert-info" style="overflow:scroll;width:800px;height:500px">
     <center>  
     
         <img id="blah" src="#" alt="Prescription" />
          </center>  

 </div>
     
 </form>
</div>