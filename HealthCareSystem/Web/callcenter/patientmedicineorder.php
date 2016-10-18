<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>  
<script src="../js/patientmedicineorder.js"></script>  
<div class="col-md-15 sky-form">
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
         <button type="button" class="btn-u"  name="button" id="searchfororders" > Search </button>
        </section> 
     
              
     </div>     

  </fieldset>
    <fieldset>
        <table class="table table-striped" id="patient_medicines_order_patient_table">
            <thead>
                <tr style="background-color: #F2CD00">
                    
                    <td><b>Patient Name</b></td>
                    <td><b>Patient ID</b></td>
                    <td><b>Doctor Name</b></td>
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


<div class="modal fade" id="orderedMedicines" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <section class="col-md-5">
                        <label class="select">
                          <select id="medicalShop" name="medicalShop" class="form-control">
                           <option value="SHOPNAME">- Medical Shop Name -</option>
                           <?php 
                                foreach ($medicalShopList as $value){
                            ?>
                           <option value="<?php echo $value->id?>"><?php echo $value->shopname?></option>
                            <?php  } ?>
                          </select>
                           <i><font color="red"><span id="paramnameerrormsg"></span></font></i>
                       </label>
                    </section>
                    <section class="col-md-3">
                        <button type="button" class="btn-u"  name="button" id="assigntomedicalshop" > Assign to Medical Shop </button>
                    </section> 
                </div><input type="hidden" id="patientoid" />
                <input type="hidden" id="poporderdate" />
                <div class="modal-body">
                    <br/><br/>
                    <table class="table table-striped" id="patient_medicines_order_table">
                        <thead>
                            <tr style="background-color: #F2CD00">
                                <!--th>Doctor Name</th>
                                <th>Hospital Name</th>
                                <th>Medicine Name</th>
                                <th>Dosage</th>
                                <th>Quantity</th>
                                <th>Medical Shop</th-->
                                <td><b>Patient Name</b></td>
                                <td><b>Patient ID</b></td>
                                <td><b>Doctor Name</b></td>
                                <td><b>Medicine Name</b></td>
                                <td><b>Required Quantity</b></td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>