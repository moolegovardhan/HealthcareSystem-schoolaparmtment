<?php session_start(); ?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/apartmentdetails.js"></script> 
<?php
include_once '../../Business/ApartmentData.php';

$sd = new ApartmentData();
//$flatownerlist = array();
//$flatownerlist = $sd->fetchFlatOwnerDetails($_SESSION['officeid']);

?>
<form method="post" action="../../Business/createapartmentdetails.php">
    
<fieldset>
    <section class="col-md-1"></section>
     <section>
<div class="col-md-12 sky-form" >
    
    <fieldset>
        
        <section class="col col-md-3">
                <label class="select">
                  <select id="floornumber" name="floornumber" class="form-control" class="valid">
                   <option value="nodata">-- Floor No --</option>
                  <option value="1">1</option>
                  <option value="2">2</option> 
                  <option value="3">3</option> 
                   <option value="4">4</option> 
                    <option value="5">5</option> 
                     <option value="6">6</option> 
                      <option value="7">7</option> 
                      <option value="8">8</option> 
                        <option value="9">9</option> 
                         <option value="10">10</option> 
                          <option value="11">11</option> 
                           <option value="12">12</option>
                           <option value="13">13</option> 
                           <option value="14">14</option> 
                           <option value="15">15</option> 

                  </select>
             </label>  
           </section>
        <section class="col-md-2">
            <label class="input">
                     <input type="text" id="flatnumber"  name="flatnumber" placeholder="Flat No"/>
                
            </label>   
       </section>
         <section class="col-md-2">
          <label class="input">
              <input type="text" id="block"  name="block" placeholder="block" size="4" />    
            </label>
       
      </section>
        <section class="col-md-2">
          <label class="input">
              <input type="text" id="familycount"  name="familycount" placeholder="Family Size" size="4" />    
              <input type="hidden" id="dbrowid"  name="dbrowid"  size="4" />  
              
            </label>
      </section>
         
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="addApartmentDetailsToList" > Add Data </button>
        </section>
        <section class="col-md-3">
               <button type="submit" class="btn-u"  name="submit" id="createApartmentDetails" > Create Apartment Details </button>
       
        </section>
    </fieldset>
    <fieldset>
        <section class="col-md-12">
        <table class="table table-striped" id="apartment_details_table">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                     <td><b>Apartment ID</b></td>
                    <td><b>Floor No</b></td>
                    <td><b>Flat No</b></td>
                    <td><b>Block</b></td>
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