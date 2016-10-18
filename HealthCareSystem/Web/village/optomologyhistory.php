<?php session_start(); 
 include_once '../../Business/VillageData.php';
 
 $sd = new VillageData();
 
 
$villageAppointment = $sd->fetchSpecificVillageAppointmentDates($_SESSION['officeid']);


?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/villagehealthcheck.js"></script> 
<div class="col-md-12 sky-form" >
    <div>
    <fieldset>
        
        <section class="col-md-2">
            <label class="input">
                     <input type="text" id="housenumber"  name="housenumber" placeholder="House Number"/>
                
            </label>   
       </section>
        
       
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="searchVillageOptoConsultationDetails" > Search </button>
        </section>
    </fieldset>
        <div id="searchResultForHistory">  
    <fieldset>
        <section class="col-md-12">
            <table class="table table-striped" id="village_health_optocheckup_history_table">
                <thead>
                    <tr style="background-color: #F2CD00">


                        <td><b>House</b></td>
                         <td><b>No of Members</b></td>
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
        <div id="showDetailsforHouse">
            <fieldset>
                <section class="col-md-12">
                    <table class="table table-striped" id="village_health_checkup_history_opto_details_table">
                        <thead>
                            <tr style="background-color: #F2CD00">


                                <td><b>Member id</b></td>
                                 <td><b>Member Name</b></td>
                                <td><b>Observations</b></td>
                                 <th>Complaints</th>
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