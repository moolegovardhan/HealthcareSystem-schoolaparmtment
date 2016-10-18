<?php session_start(); 
include_once '../../Business/ApartmentData.php';

$sd = new ApartmentData();
$flatlist = $sd->fetchApartmentDetails($_SESSION['officeid']);

?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/apartmenthealthcheckup.js"></script> 
<div class="col-md-12 sky-form" >
    <div>
    <fieldset>
        
        <section class="col col-md-3">
                <label class="select">
                    <select id="flatno" name="flatno" >
                        <option value="nodata">- Select Flat # -</option>
                         <?php  

                                 if(sizeof($flatlist) > 0){
                                     foreach($flatlist as $flat){

                         ?>
                        <option value="<?php  echo $flat->id; ?>"><?php  echo $flat->flatnumber; ?></option>
                        <?php
                                     }
                                 }
                        ?>


                    </select>
                 </label>   
               </section>
        
       
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="searchApartmentConsultationDetails" > Search </button>
        </section>
    </fieldset>
        <div id="searchResultForHistory">  
    <fieldset>
        <section class="col-md-12">
            <table class="table table-striped" id="apartment_health_checkup_history_table">
                <thead>
                    <tr style="background-color: #F2CD00">


                        <td><b>Flat Number</b></td>
                        <td><b>Still To Do</b></td>
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
        <div id="showstilltodoDetailsforFlat">
            <fieldset>
                <section class="col-md-12">
                    <table class="table table-striped" id="apartment_flatmember_still_to_do_details_table">
                        <thead>
                            <tr style="background-color: #F2CD00">


                               <td><b>Apartment Id</b></td>
                                <td><b>Flat Number</b></td>
                                 <td><b>Member Name</b></td>
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