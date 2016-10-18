<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>  
<script src="../js/patientmedicineorder.js"></script>  
<div class="col-md-12 sky-form">
  <?php
  /* $md = new MasterData();
   $hospitalList = $md->completeHospitalList();
   $labData = $md->getLabData();
   $labTestData = $md->diagnosticsTestDataById($_SESSION['forllabofficeid']);
   * 
   */
  ?>  
<fieldset>
    <div class="row">
        
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="start" placeholder="Start Date"/>
            </label>
       <font color="red"><i><span id="starterrormsg"></span></i></font>    
      </section>
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="finish" placeholder="End Date"/>
            </label>
       <font color="red"><i><span id="userIderr"></span></i></font>    
      </section>
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
          <label class="input">
               <input type="text" id="receiptid" placeholder="Receipt Id"/>
            </label>
       <font color="red"><i><span id="receipterr"></span></i></font>    
      </section>
        <section class="col-md-3">
         <button type="button" class="btn-u"  name="button" id="fetchAllAssignedHomeServiceOrdered" > Search </button>
        </section> 
     
              
     </div>     

  </fieldset>
    <fieldset>
        <table class="table table-striped" id="patient_home_service_assigned_order_table">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    
                    <td><b>Patient Name</b></td>
                    <td><b>Mobile</b></td>
                    <td><b>Service Name</b></td>
                    <th>Request Date</th>
                    <th>Assigned Date</th>
                    <th>Attender</th>
                    <th>Receipt</th>
                     <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
    </fieldset>
    
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<div class="modal fade" id="hospitalServices" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                   <section class="col-md-5">
                       <label class=""> Select Attender Name</label>
                   </section><br/>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="serviceid" />
                    <section class="col-md-3">
                        <label class="">Attender Name </label>
                    </section>    
                    <section class="col-md-5">
                        <label class="select">
                          <select id="hospitalname" name="hospitalname" class="form-control">
                           <option value="nodata">- Select Hospital -</option>
                          <?php 
                                foreach ($hospitalList as $value){
                            ?>
                           <option value="<?php echo $value->id?>"><?php echo $value->hosiptalname?></option>
                            <?php  } ?>
                          </select>
                           <i><font color="red"><span id="paramnameerrormsg"></span></font></i>
                       </label>
                    </section>
                    <section class="col-md-3">
                        <label class="">Comments </label>
                    </section>    
                    <section class="col-md-7">
                        <label class="textarea">
                            <textarea id="hospitalcomment" rows="5" cols="75"></textarea>
                           <i><font color="red"><span id="paramnameerrormsg"></span></font></i>
                       </label>
                    </section>
                    <section class="col-md-3">
                        <button type="button" class="btn-u"  name="button" id="hospitalassign" > Assign </button>
                    </section> <br/><br/><br/><br/><br/><br/><br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>


<div class="modal fade" id="commentsmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                   <section class="col-md-5">
                       <label class=""> Please enter comments.</label>
                   </section><br/>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hserviceid" />
                    <section class="col-md-2">
                        <label class="">Comments </label>
                    </section>    
                    <section class="col-md-7">
                        <label class="textarea">
                            <textarea id="comment" rows="5" cols="75"></textarea>
                           <i><font color="red"><span id="paramnameerrormsg"></span></font></i>
                       </label>
                    </section>
                    <section class="col-md-3">
                        <button type="button" class="btn-u"  name="button" id="commentstoclose" > Update  </button>
                    </section> <br/><br/><br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>

<div class="modal fade" id="showTestDiagnostics" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Lab test's</h4>
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
                      <form action ="callcenterindex.php?page=CreateNewNonAppointmentLabSamples" method="POST" >       
                        <fieldset><input type="hidden" id="lserviceid" name="lserviceid" />
                            <div class="row">
                                 <section class="col-md-4">
                                   <label class="select">
                                         
                                        <select id="list" name="list">
                                              <option value="LABNAME">LAB NAME</option>
                                                   <?php foreach($labData as $value) { ?>
                                                       <option value="<?php  echo $value->id; ?>"><?php  echo $value->diagnosticsname; ?></option>
                                                   <?php } ?>

                                           </select>
                                    </label>   
                                 </section><input type="hidden" id="labName" name="labName" />
                                <section class="col-md-4">
                                   <label class="select">
                                         
                                         <select id="listtest" name="listtest">
                                          
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