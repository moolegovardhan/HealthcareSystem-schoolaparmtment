<?php session_start(); 
 include_once '../../Business/SchoolData.php';
 
 $sd = new SchoolData();
 
 
$schoolAppointment = $sd->fetchSpecificSchoolAppointmentDates($_SESSION['officeid']);


?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/schoolhealthcheck.js"></script> 
<div class="col-md-12 sky-form" >
    <div>
    <fieldset>
        
        <section class="col col-md-3">
                <label class="select">
                  <select id="classname" name="classname" class="form-control" class="valid">
                   <option value="nodata">-- Class --</option>
                  <option value="Nursery">Nursery</option>
                  <option value="LKG">LKG</option>
                  <option value="UKG">UKG</option> 
                  <option value="1">I</option> 
                   <option value="2">II</option> 
                    <option value="3">III</option> 
                     <option value="4">IV</option> 
                      <option value="5">V</option> 
                       <option value="6">VI</option> 
                        <option value="7">VII</option> 
                         <option value="8">VIII</option> 
                          <option value="9">IX</option> 
                           <option value="10">X</option> 

                  </select>
             </label>  
           </section>
        
       
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="searchSchoolConsultationDetails"> Search </button>
        </section>
    </fieldset>
        <div id="searchResultForHistory" >  
    <fieldset>
        <section class="col-md-12">
            <table class="table table-striped" id="school_health_checkup_history_table">
                <thead>
                    <tr style="background-color: #F2CD00">


                        <td><b>Class</b></td>
                        <td><b>Still To Do</b></td>
                         <td><b>No of Students</b></td>
                        <td><b>Appointment Date</b></td>
                         <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
            <div id="labtabledata">

            </div>    
          <input type="hidden"  name="counter" id="counter" />
        </section>  
        
    </fieldset>
            </div>   
        <div id="showDetailsforClass">
            <fieldset>
                <section class="col-md-12">
                    <table class="table table-striped" id="school_health_checkup_history_details_table">
                        <thead>
                            <tr style="background-color: #F2CD00">


                                <td><b>Student id</b></td>
                                 <td><b>Student Name</b></td>
                                <td><b>BP</b></td>
                                 <th>Sugar</th>
                                  <th>Cholesterol</th>
                                   <th>Cholesterol</th>
                                    <th>Cholesterol</th>
                                     <th>Cholesterol</th>
                                      <th>Cholesterol</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                    <div id="labtabledata">

                    </div>    
                  <input type="hidden"  name="counter" id="counter" />
                </section>  

            </fieldset>
            
        </div> 
        <div id="showstilltodoDetailsforClass">
            <fieldset>
                <section class="col-md-12">
                    <table class="table table-striped" id="school_student_still_to_do_details_table">
                        <thead>
                            <tr style="background-color: #F2CD00">

                                 <td><b>Class</b></td>
                                <td><b>Student id</b></td>
                                 <td><b>Student Name</b></td>
                                <td><b>mobile</b></td>
                                                           
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                    <div id="labtabledata">

                    </div>    
                  <input type="hidden"  name="counter" id="counter" />
                </section>  

            </fieldset>
            
        </div>    

   </div> 
    
</div>   

