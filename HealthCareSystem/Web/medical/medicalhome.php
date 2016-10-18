<?php
session_start();

?>
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
         <button type="button" class="btn-u"  name="button" id="fetchMedicalShopPatientData" > Search </button>
        </section> 
     
              
     </div>     

  </fieldset>
    <fieldset>
        <table class="table table-striped" id="medicines_orders">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    <td><b>Patient Name</b></td>
                    <td><b>Patient ID</b></td>
                    <td><b>Doctor Name</b></td>
                    <td><b>Mobile</b></td>
                    <td><b>Address</b></td>
                    <td><b>Order Date</b></td>
                    <td><b>Assigned Date</b></td>
                    <td><b>Action</b></td>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
    </fieldset>
    
</div>


<div class="modal fade" id="orderedMedicines" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <!--form action="../../Business/DispatchMedicines.php" method="POST"-->
    <form action="../../Business/onlinemedicineorder.php" method="POST">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                   
                    <section class="col-md-3">
                        <input type="submit" class="btn-u"  name="submit" value="Dispatch">
                    </section> 
                </div><input type="hidden" id="patientoid" name="patientoid" /><input type="hidden" id="recordcount" name="recordcount" />
                <div class="modal-body">
                    <b>Patient Name : <i><span id="patientpname"></span></i></b><br>
                    <b>Patient Address : <i><span id="patientaddress"></span></i></b>
                    <br/><br/>
                    <table class="table table-striped" id="patient_medicines_order_table">
                        <thead>
                            <tr style="background-color: #F2CD00">
                               
                                 <td><b></b></td>
                                <td><b>Doctor Name</b></td>
                                <td><b>Medicine Name</b></td>
                                <td><b>Ordered</b></td>
                                 <td><b>Quantity</b></td>
                                 <td><b>Dispatched</b></td>
                                  <td><b>Batch</b></td>
                                 <td><b>Price</b></td>
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
        </form>  
    </div>