<?php session_start(); ?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/villagedetails.js"></script> 
<?php
include_once '../../Business/VillageData.php';

$sd = new VillageData();
//$flatownerlist = array();
//$flatownerlist = $sd->fetchFlatOwnerDetails($_SESSION['officeid']);

?>
<form method="post" action="../../Business/createvillagedetails.php" class="sky-form">
    <div class="col-md-13">   
<fieldset>
    <section class="col-md-1"></section>
     <section> 
         <div class="col-md-12 sky-form" >
    <fieldset>
        
        <section class="col col-md-3">
                <label class="input">
                     <input type="text" id="streetname"  name="streetname" placeholder="Street Name"/>
             </label>  
           </section>
        <section class="col-md-3">
            <label class="input">
                     <input type="text" id="housenumber"  name="housenumber" placeholder="House Number"/>               
            </label>   
       </section>
        <section class="col-md-3">
          <label class="input">
              <input type="text" id="familycount"  name="familycount" placeholder="Family Size" size="4" />    
              <input type="hidden" id="dbrowid"  name="dbrowid"  size="4" />  
              
            </label>
      </section>
         
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="addVillageDetailsToList" > Add Data </button>
        </section>
        <section class="col-md-3">
               <button type="submit" class="btn-u"  name="submit" id="createVillageDetails" > CreateVillage Details </button>
       
        </section>
    </fieldset>

    <fieldset>
        <section class="col-md-12">
        <table class="table table-striped" id="village_details_table">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                     <td><b>Village ID</b></td>
                    <td><b>Street Name</b></td>
                    <td><b>House Number</b></td>
                    <td><b>Total Family</b></td>
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
    </section>
    
  </fieldset>  
</div>
</form>         