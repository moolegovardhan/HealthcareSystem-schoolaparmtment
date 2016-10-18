<div class="col-md-8" >
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/searchprescription.js"></script>
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
<div class="col-md-15"> 
<fieldset> 
    <section class="col-md-15">    
<?php include_once 'prescriptionsearch.php'; ?>
    </section>
</fieldset>
 <form action="../../Business/StaffPrescriptionUpload.php" method="POST" enctype="multipart/form-data">     
   
<fieldset>  
  
<section id="prescriptionpanel"> 
    <input type="submit" class="btn-u pull-right"  name="button" id="showPrescriptionSearch" value="Submit"/>     
    
    <input type="button" class="btn-u pull-right"  name="button" id="showPrescriptionSearchResult" value="Search Result"/> 
    
       
<div class="panel panel-orange  sky-form">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-tasks"></i>Prescription Details</h3>
     </div>
    
 
    <div class="col-md-12">  
    <div class="row"> 
    <div class="col-md-12">  

        <fieldset>
              <div class="row">
                  <section class="col col-6">
                    <label class="label"><b>Patient Name :   </b>
                        <span id="prespatientName"><i></i></span></label>
                        <input type="hidden" name="hiddenpatientName" id="hiddenpatientName"/>
                        <input type="hidden" name="hidappointmentId" id="hidappointmentId"/> 
                       <input type="hidden" name="hiddenpatientId" id="hiddenpatientId"/> 
                </section>
                <section class="col col-6">
                    <label class="label"><b>Hospital Name :   </b>
                        <span id="hospitalName"><i></i></span></label>
                         <input type="hidden" name="hidhospitalName" id="hidhospitalName"/>
                           <input type="hidden" name="hidhospitalId" id="hidhospitalId"/>
                </section> 
              </div>
             <div class="row">
                  <section class="col col-6">
                    <label class="label"><b>Doctor Name :  </b>
                        <span id="doctorName"><i></i></span>
                         <input type="hidden" name="hiddendoctorName" id="hiddendoctorName"/>
                          <input type="hidden" name="hiddendoctorId" id="hiddendoctorId"/> 
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label"><b>Appointment Date : </b>
                        <span id="appointmentDate"><i></i></span>
                         <input type="hidden" name="hidappointmentDate" id="hidappointmentDate"/>
                    </label>
                </section>    
                 </div>
             <div class="row">
                <section class="col col-6">
                     <label class="input"> 
                           <i class="icon-append fa fa-calendar"></i>
                           <input type="text" name="start" id="start" placeholder="Next Appointment date">
                            <font color="red"><i><span id="enderrormsg"></span> </i></font>
                       </label>
                </section>
               <section class="col-md-6">
                <label class="input"> 
                         <textarea cols="50" rows="5" name="complaints" id="complaints" placeholder="Complaints"></textarea>
                         
                         <font color="red"><i><span id="enderrormsg"></span> </i></font>
                       </label>
               </section> 
                
            </div>   
            <div class="row">
            <section class="col col-md-12">
              <table class="table table-striped" id="patient_records_table">
                     <tr>

                            <td><h6></h6></td>
                            <td><h6>Right Eye</h6></td>
                            <td><h6>Left Eye</h6></td>
                        </tr>
                    <tbody>
                       <tr>

                            <td>Diagnosis</td>
                            <td><input type="textbox" name="rightdiagnosis" id="rightdiagnosis" /></td>
                            <td><input type="textbox" name="leftdiagnosis" id="leftdiagnosis"/></td>
                        </tr>
                          <tr>

                            <td>Diagnosis Code #</td>
                            <td><input type="textbox" name="rightdiagnosiscode" id="rightdiagnosiscode" /></td>
                            <td><input type="textbox" name="leftdiagnosiscode" id="leftdiagnosiscode"/></td>
                        </tr>
                          <tr>

                            <td>Lids & Adnexae</td>
                            <td><input type="textbox" name="rightlids" id="rightlids" /></td>
                            <td><input type="textbox" name="leftlids" id="leftlids"/></td>
                        </tr>
                          <tr>

                            <td>Lacrimal Ducts</td>
                            <td><input type="textbox" name="rightducts" id="rightducts" /></td>
                            <td><input type="textbox" name="leftducts" id="leftducts"/></td>
                        </tr>
                          <tr>

                            <td>Conjunctiva</td>
                            <td><input type="textbox" name="rightconjuctiva" id=rightconjuctiva /></td>
                            <td><input type="textbox" name="leftconjuctiva" id="leftconjuctiva"/></td>
                        </tr>
                          <tr>

                            <td>Cornea</td>
                            <td><input type="textbox" name="rightcornea" id="rightcornea" /></td>
                            <td><input type="textbox" name="leftcornea" id="leftcornea"/></td>
                        </tr>
                          <tr>

                            <td>Anterior Chamber</td>
                            <td><input type="textbox" name="rightanterior" id="rightanterior" /></td>
                            <td><input type="textbox" name="leftanterior" id="leftanterior"/></td>
                        </tr>
                          <tr>

                            <td>Iris</td>
                            <td><input type="textbox" name="rightiris" id="rightiris" /></td>
                            <td><input type="textbox" name="leftiris" id="leftiris"/></td>
                        </tr>
                          <tr>

                            <td>Pupil</td>
                            <td><input type="textbox" name="rightpupil" id="rightpupil" /></td>
                            <td><input type="textbox" name="leftpupil" id="leftpupil"/></td>
                        </tr>
                          <tr>

                            <td>Lens</td>
                            <td><input type="textbox" name="rightlens" id="rightlens" /></td>
                            <td><input type="textbox" name="leftlens" id="leftlens"/></td>
                        </tr>
                          <tr>

                            <td>Ocular Movements</td>
                            <td><input type="textbox" name="rightocular" id="rightocular" /></td>
                            <td><input type="textbox" name="leftocular" id="leftocular"/></td>
                        </tr>
                    </tbody>
              </table>    
                
            </section>
        </div>
        </div>
            <!-- End -->
            </fieldset>




 </div>
</div>

    </div> 
    
    
  
</div>
</section>
</fieldset>
</form>    
</div>

</div>

<!-- Select Medicine Popup Start -->
<div class="modal fade" id="searchMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Search and Select Medicine</h4>
            </div>
            <div class="modal-body sky-form ">
            	<div class="row">
            		<section class="col col-md-6">
            			<label class="input"><input type="text" value="" placeholder="Enter Medicine Name" id="searchMedicine" /></label>
            		</section>
            		<section class="col col-md-6"><button class="btn-u btn-u-orange" type="button" onclick="searchGenericMedicine()" id="saveData">Search</button></section>
            	</div>
            	<table class="table table-striped" id="searchMedicinesResults">
            		<thead>
            			<tr>
            				<th>SNo#</th>
            				<th>Medicine Name</th>
            			</tr>
            		</thead>
            		<tbody></tbody>
            	</table>
            	<div class="paging-container" id="tablePaging"></div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
            </div>
          </div>
    </div>
</div>
<!-- Select Medicine Popup End -->

<!-- Select Doctor Medicine Popup Start -->
<div class="modal fade" id="searchDoctorMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Search and Select Medicine</h4>
            </div>
            <div class="modal-body sky-form ">
            	<div class="row">
            		<section class="col col-md-6">
            			<label class="input"><input type="text" value="" placeholder="Enter Medicine Name" id="searchDoctorMedicine" /></label>
            		</section>
            		<section class="col col-md-6"><button class="btn-u btn-u-orange" type="button" onclick="searchDoctorMedicine()" id="saveData">Search</button></section>
            	</div>
            	<table class="table table-striped" id="searchDoctorMedicinesResults">
            		<thead>
            			<tr>
            				<th>SNo#</th>
            				<th>Medicine Name</th>
            			</tr>
            		</thead>
            		<tbody></tbody>
            	</table>
            	<div class="paging-container" id="tablePaging"></div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
            </div>
          </div>
    </div>
</div>
<!-- Select Doctor Medicine Popup End -->
