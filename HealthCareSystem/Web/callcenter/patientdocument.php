<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>  
<script src="../js/patientdocument.js"></script>  
<div class="col-md-15 sky-form">
    <form action="../../Business/UpdateDocumentStatus.php" method="POST">
<fieldset>
    <div class="row">
        
      <section class="col-md-3">
          <label class="input">
               <input type="text" id="patientid" placeholder="Patient Id"/>
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
         <button type="button" class="btn-u"  name="button" id="searchdocuments" > Search </button>
        </section> 
      <section class="col-md-3">
          <input type="submit" class="btn-u "  name="submit" id="submitdata" value="Submit"/>  
        </section> 
              
     </div>     
 <input type="hidden" id="counter" name="counter"/>
  </fieldset>
    <fieldset>
        <table class="table table-striped" id="patient_document_upload_table">
            <thead>
                <tr style="background-color: #F2CD00">
                   <td><b></b></td>
                    <td><b>Patient Name</b></td>
                    <td><b>Patient ID</b></td>
                    <td><b>Document Name</b></td>
                    <td><b>Appointment Date</b></td>
                    <td><b>Action</b></td>
                    <td><b>Status</b></td>
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
    </form>
    </div>