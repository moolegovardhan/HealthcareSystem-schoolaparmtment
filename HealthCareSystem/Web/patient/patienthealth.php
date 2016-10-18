 <b><i><font color="red"><span id="patienthealthprofileerrormessage"></span></font></i></b>
<br/>
<div class="col-md-8">
        <div class="row margin-bottom-40">
             <div class="panel panel-orange">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Health Details
                                   </h3>
                                 
                            </div>
<div class="panel-body"> 
<form  id="profile-form" action="." method="post">

                            
     <div class="col-md-6 sky-form">
          

               <fieldset>

              <section>
                  <label class="label">Weight :
                  
                     <b><i><span id="weight"></span></i></b>
                      
                  </label>
              </section>

              <section>
                  <label class="label">Height : 
                     <b><i><span id="height"></span></i></b>
                       
                  </label>

              </section>



              <section>
                  <label class="label">BMI : 
                     <b><i><span id="bmi"></span></i></b>
                    
                  </label>
              </section>
             
      </fieldset>



     </div>       
              <div class="col-md-6 sky-form">       
             <fieldset>       
               <section>
                  <label class="label">Blood Pressure : 
                      <b><i><span id="bp"></span></i></b>
                     
                  </label>
              </section>
             <section>
                  <label class="label">Hemoglobin :
                     <b><i><span id="hemoglobin"></span></i></b>
                     
                  </label>
              </section>
          <section>
                  <label class="label">Sugar :
                     <b><i><span id="sugar"></span></i></b>
                    
                  </label>
              </section>

      </fieldset>



     </div> 
                        <!-- end of Helath Form -->
                        
                  
               <input type="button" value="Show History" class="btn-u btn-u-primary pull-right" id="patientParametersHistory"/>    
                                
                        
                </form> 
   
    
          </div>
        </div>
            
     <div class="panel panel-orange" id="patient_health_parameters">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-tasks"></i> Health Details History
               </h3>
           
        </div>
        <div class="panel-body">   
            
            
            <table class="table table-striped" id="patient_health_parameters_history_data">
                <thead>
                    <tr>
                         <th>Weight</th>
                        <th>Height</th>
                        <th>BMI</th>
                        <th>Blood Pressure </th>
                        <th>Hemoglobin</th>
                        <th>Sugar</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            
            
        </div>
   </div>   
           
            
  </div>	    