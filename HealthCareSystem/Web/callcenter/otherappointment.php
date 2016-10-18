<div class="col-md-12 sky-form">
    <fieldset>
    <div class="row">
        <section class="col">
            
        </section>  
      <section class="col col-4">
          <label class="input">
               <input type="text" id="userId" placeholder="Patient Id"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section>
      <button type="button" class="btn-u"  name="button" id="fetchData" > Search </button>
                 
     </div>     

  </fieldset> 
                     <fieldset>
                       <div class="row">
                         <section>
                        <div class="col-md-5 sky-form">
                              <fieldset>

                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                             <input type="text" id="name"  placeholder="Name" readonly>
                                             <input type="hidden" id="userid" />
                                        </label>
                                         <font color="red"><i><span id="weighterr"></span></i></font> 
                                    </section>

                                    <section>
                                       <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="mobile" id="email"  placeholder="Email" readonly>
                                        </label>
                                          <font color="red"><i><span id="heighterr"></span></i></font> 
                                    </section>

                                   <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="mobile" id="Mobile"  placeholder="Mobile" readonly>
                                        </label>
                                        <font color="red"><i><span id="bmierr"></span></i></font> 
                                    </section>

                                 </fieldset>

                          </div>     
                           <div class="col-md-6 sky-form">
                                <fieldset>
                                     <section>
                                      <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="email" id="bday" placeholder="Birthday" readonly>

                                        </label>
                                         <font color="red"><i><span id="bperr"></span></i></font> 
                                    </section>

                                     <section>
                                              <label class="input">
                                                   <i class="icon-append fa fa-user"></i>
                                                    <input type="text" id="City"  placeholder="City" readonly>
                                               </label>
                                          <font color="red"><i><span id="heloglobinerr"></span></i></font> 
                                           </section>
                               <section>
                                   <label class="input">
                                       <i class="icon-append fa fa-user"></i>
                                       <input type="text" id="address1"  placeholder="Address1" readonly>
                                   </label>
                                    <font color="red"><i><span id="sugarerr"></span></i></font> 
                               </section>

                           </fieldset>

                          </div> 
    
                         </section>
                       </div>
                     </fieldset> 
     <fieldset>
        <div class="row">
             <section class="col col-4">
                <label class="select">
                    <select name="hospital" id="hospital">
                        <option value="HOSPITAL" selected >Hospital Name</option>
                        <?php foreach ($hosiptal as $value) { ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->hosiptalname?></option>
                        <?php } ?>
                    </select>

                </label>
                <font color="red"><i><span id="staffhospitalerrormsg"></span> </i></font>
            </section>
            <section class="col col-4">
                <label class="select">
                    <select name="doctor" id="doctor">
                        <option value="DOCTOR" selected >Doctor Name</option>
                        
                    </select>

                </label>
                <font color="red"><i><span id="staffdoctorerrormsg"></span> </i></font>
            </section>
           <section class="col col-4">
                <label class="input">
                    
                    <input type="text" readonly="true" id="start" name="start" placeholder="Appointment Date">
                </label>
                <font color="red"><i><span id="staffdoctorerrormsg"></span> </i></font>
            </section>
         
            <section class="col-md-4">
                <label class="input">
                     <input type="text" id="doctorname" placeholder="Doctor Name"/>
                  </label>
             <font color="red"><i><span id="mobileerror"></span></i></font>    
            </section>
            <section class="col-md-4">
                <label class="input">
                     <input type="text" id="hospitalname" placeholder="Hospital Name"/>
                  </label>
             <font color="red"><i><span id="mobileerror"></span></i></font>    
            </section>
            <section class="col col-4">
                <label class="select">
                    <select name="appointmenttype" id="appointmenttype">
                        <option value="nodata" selected >Appointment Type</option>
                        <option value="General"  >General</option>
                        <option value="Pregnancy"  >Pergnancy</option>
                         <option value="Child"  >Child</option>
                    </select>

                </label>
                <font color="red"><i><span id="staffdoctorerrormsg"></span> </i></font>
            </section>
            <input type="button" class="btn-u pull-right"  name="button" id="nonHCSCreateAppointment" value="Create Appointment"/> 

         </div>
     </fieldset>
    <!--fieldset>
        <section class="col-md-12">
            <table class="table table-striped" id="doctor_timings">
                <thead>
                    <tr  style="background-color: #e67e22">
                       
                        <th><font color="#FFFFFF">Doctor Id</font></th>
                        <th><font color="#FFFFFF">Doctor Name</font></th>
                        <th><font color="#FFFFFF">Start Time</font></th>
                        <th><font color="#FFFFFF">End Time</font></th>
                        
                    </tr>
                 </thead>    
                   
               
                <tbody>

                </tbody>
            </table>
        </section>
    </fieldset-->
</div>