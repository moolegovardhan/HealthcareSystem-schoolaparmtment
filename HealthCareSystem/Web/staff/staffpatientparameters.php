  
<div class="col-md-8">
    <div class="row margin-bottom-40">
         <div class="panel panel-orange">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i>Patient Health Profile</h3>
             </div>
             <div class="panel-body"> 
              <form action="" id="sky-form" class="sky-form">
                 <div class="col-md-12">  
                    <fieldset>
                       <div class="row">
                            <section class="col col-4">
                                <label class="input">
                                     <input type="text" id="spatientname" placeholder="Patient Name"/>
                                  </label>
                             <font color="red"><i><span id="spatientnameerr"></span></i></font>    
                            </section>
                            <button type="button" class="btn-u"  name="button" id="getRegPatient" > Search </button>
                   <button type="button" class="btn-u pull-right"  name="button" id="btnRegSubmitPatient">Save Data</button>
                         
                        </div>     
                         
                     </fieldset> 
                    <!--fieldset>
                       <div class="row">
                         <button type="button" class="btn-u"  name="button" id="blockAppointment" > Block Slot </button>                             <button type="button" class="btn-u pull-right"  name="button" id="bthCheckAppointment" > Check </button>
                        </div>     
                        
                     </fieldset-->  
                    <fieldset>
                       <div class="row">
                           <section class="col col-4">
                           <div class="panel panel-orange margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit"></i>Patient List</h3>
                            </div>
                            <table class="table table-striped" id="reg_patient_data_param">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                            </table>
                         </div>
                           </section>       
                    <section class="col col-8">
                        <div class="col-md-15" id="patientdata">
                          <div class="panel panel-orange margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit"></i>Patient Data     {<span id="selectedpatient"></span>}</h3>
                               
                            </div>
                            
     <form  id="profile-form" action="." method="post">
<input type="hidden" id="regpatientid" />
          <div class="col-md-6 sky-form">
                <fieldset>

                          <section>
                              <label class="input">
                                  <i class="icon-append fa fa-user"></i>
                                   <input type="text" id="weight"  placeholder="Weight">
                              </label>
                               <font color="red"><i><span id="weighterr"></span></i></font> 
                          </section>

                          <section>
                             <label class="input">
                                  <i class="icon-append fa fa-user"></i>
                                  <input type="mobile" id="height"  placeholder="Height">
                              </label>
                                <font color="red"><i><span id="heighterr"></span></i></font> 
                          </section>
                        
                         <section>
                              <label class="input">
                                  <i class="icon-append fa fa-user"></i>
                                  <input type="mobile" id="bmi"  placeholder="BMI">
                              </label>
                              <font color="red"><i><span id="bmierr"></span></i></font> 
                          </section>


                           

                  </fieldset>

          </div>     

                        <!-- end of Personal Form -->
                             
                        <!-- Health Form -->
                                 
     <div class="col-md-6 sky-form">
               <fieldset>
                   
                   
                          <section>
                            <label class="input">
                                  <i class="icon-append fa fa-user"></i>
                                  <input type="email" id="bp" placeholder="Blood Pressure">
                               
                              </label>
                               <font color="red"><i><span id="bperr"></span></i></font> 
                          </section>
                   
                    <section>
                             <label class="input">
                                  <i class="icon-append fa fa-user"></i>
                                   <input type="text" id="hemoglobin"  placeholder="Hemoglobin">
                              </label>
                         <font color="red"><i><span id="heloglobinerr"></span></i></font> 
                          </section>
              <section>
                  <label class="input">
                      <i class="icon-append fa fa-user"></i>
                      <input type="text" id="sugar"  placeholder="Sugar">
                  </label>
                   <font color="red"><i><span id="sugarerr"></span></i></font> 
              </section>

             


      </fieldset>
                


     </div> 

               
                        
                </form> 
                              
                              
                                
                              
                              
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