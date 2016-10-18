 <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
 <script src="../js/labpatienttestcreate.js"></script>
<div class="col-md-12 sky-form">
<fieldset>
    <div class="row">
   
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="mobilenumber" placeholder="Mobile Number"/>
            </label>
       <font color="red"><i><span id="mobileerror"></span></i></font>    
      </section>
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="patientname" placeholder="Patient Name"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section> 
        <section class="col-md-3">
         <button type="button" class="btn-u"  name="button" id="fetchPatientForReports" > Search </button>
        </section> 
     
              
     </div>     

  </fieldset>
    
    <fieldset>
        
        <table class="table table-striped" id="fetch_patient_list">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    <td><b>Patient Name</b></td>
                    <td><b>Patient ID</b></td>
                    <td><b>Mobile</b></td>
                    <td><b>Address</b></td>
                    <td><b>Action</b></td>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
    </fieldset>   
</div>


  
 <div class="modal fade" id="showTestDiagnostics" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Register</h4>
                </div>
                <div class="modal-body">
                    <section id="errormessages" class="col col-4 alert alert-info">
                        <font color="red"> <span id="errorDisplay"></span> </font>
                    </section>
                    <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                  <div class="sky-form">
                      <form action ="labindex.php?page=CreateNewNonAppointmentLabSamples" method="POST" >       
                        <fieldset>
                            <div class="row">
                                 
                                <section class="col-md-4">
                                   <label class="select">
                                         
                                         <select id="list" name="list">
                                               <option value="TESTNAME">Test Type</option>
                                                    <?php foreach($labData as $value) { ?>
                                                        <option value="<?php  echo $value->testid.'#'.$value->price; ?>"><?php  echo $value->testname; ?></option>
                                                    <?php } ?>

                                            </select>
                                    </label>   
                                 </section>
                                <section class="col-md-4">
                                     <label class="input">
                                        <input type="text" id="hospital" name="hospital" placeholder="Hospital Name" />
                                    </label>
                                    <!--label class="select">
                                        <select id="hospital" name="hospital">
                                            <option value="HOSPITAL">Hospital Name</option>
                                                 <?php foreach($hospitalName as $value) { ?>
                                                     <option value="<?php  echo $value->id; ?>"><?php  echo $value->hosiptalname; ?></option>
                                                 <?php } ?>

                                         </select>
                                        </label-->
                                </section>    
                                <section class="col-md-4">
                                     <label class="input">
                                        <input type="text" id="doctor" name="doctor" placeholder="Doctor Name" />
                                    </label>
                                    <!--label class="select">
                                         
                                         <select id="doctor" name="doctor">
                                               <option value="DOCTOR">Doctor Name</option>
                                                    <?php foreach($doctorList as $value) { ?>
                                                        <option value="<?php  echo $value->ID; ?>"><?php  echo $value->name; ?></option>
                                                    <?php } ?>

                                            </select>
                                    </label-->  
                                </section>
                                <section class="col-md-4">
                                    <label class="select">
                                         
                                         <select id="prescriptiontype" name="prescriptiontype">
                                              <option value="AppointmentType">Appointment Type</option>
                                               <option value="General">General</option>
                                             <option value="Pregnancy">Pregnancy</option>
                                              <option value="Child">Child</option>
                                         </select>
                                    </label>  
                                </section>
                                <section class="col-md-4">
                                    <label class="input">
                                        <input type="text" id="slottime" name="slottime" placeholder="Slot Time" />
                                    </label>
                                </section>
                                <section class="col-md-4">
                                   <label class="select">
                                         
                                         <select id="samplecollectedfrom" name="samplecollectedfrom">
                                               <option value="SAMPLECOLLECTEDFROM">Sample Collection Point</option>
                                               <option value="home">From Home</option>
                                                <option value="Lab">In Lab</option>
                                           </select>
                                    </label>   
                                 </section>
                                </div>
                           
                                <div class="row"> 
                              
                                <section class="col-md-4">
                                     <button type="button" class="btn-u"  name="button" id="addTestToPatient" > Add </button>
                                     <input type="submit" name="submit" value=" Create Test " class="btn-u"/>
                                </section>
                            </div>      <input type="hidden" name="testforpatient" id="testforpatient">
                        </fieldset>
                      <fieldset>
                          <div class="row">
                              <table class="table table-bordered table-hover" id="patient_lab_test_table">
			    	<thead>
                                    <tr style="background-color: #F2CD00">
                                         <th>Test ID</th>
			            	<th>Test Name</th>
			                <th>Price</th>
			                <th>Actions</th>
						</tr>
					</thead>
			        <tbody id="labPatientTestConduct"></tbody>
				</table>
                          </div>
                          <div>
                           <div id="labtabledata">
                           
                           </div>    
                          </div>  <input type="hidden"  name="counter" id="counter" />
                      </fieldset>
                          
                      </form>     
                      </div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>




