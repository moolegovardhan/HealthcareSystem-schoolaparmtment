 <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
 <script src="../js/labpatienttestcreate.js"></script>
 <script src="../js/medicalmedicinesdistribute.js"></script>
<div class="col-md-14 sky-form">
<fieldset>
    <div class="row">
   
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
         <button type="button" class="btn-u"  name="button" id="fetchPatientForMedicines" > Search </button>
        </section> 
     
              
     </div>     

  </fieldset>
    
    <fieldset>
        
        <table class="table table-striped" id="fetch_patient_list">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    <td><b>Patient Name</b></td>
                    <td><b>Patient ID</b></td>
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

  
 <div class="modal fade" id="showMedicineDistribution" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                  <form action="../../Business/SellNonPrescriptionMedicines.php" method="post">   
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Distribute Medicines
                    <section class="col-md-3 pull-right">
                        <button type="submit" class="btn-u"  name="submit" id="sell" > Sell Medicines </button>
                    </section> 
                    </h4>
                </div>
                <div class="modal-body  sky-form">
                    
                    <fieldset>
                        <div class="row">  
                        <section class="col-md-4">
                           <label class="input">
                                <input type="text"  name="medicinename"  id="medicinename" readonly>
                               
                            </label>
                         <font color="red"><i><span id="medicinenameerr"></span></i></font>    
                        </section>
                             <section class="col-md-1">
                                  <span class="glyphicon  glyphicon-search" id="showMedicineSerachPop"></span>
                             </section>    
                        <section class="col-md-2">
                            <label class="input">
                                 <input type="text" id="medicinecount" placeholder="Count"/>
                              </label>
                         <font color="red"><i><span id="counterr"></span></i></font>    
                        </section> 
                         <section class="col-md-2">
                            <label class="input">
                                 <input type="text" id="batch" placeholder="Batch" onblur="fetchnonpresccost(this)"/>
                              </label>
                         <font color="red"><i><span id="counterr"></span></i></font>    
                        </section>    
                        <section class="col-md-2">
                            <label class="input">
                                 <input type="text" id="cost" placeholder="Cost"/>
                              </label>
                         <font color="red"><i><span id="costerr"></span></i></font>    
                        </section> 
                        
                      </div>
                        <div class="row">
                            
                            <section class="col-md-4"><footer>
                             <button type="button" class="btn-u"  name="button" id="addMedicine" > Add to Cart : Total Cost {<span id="totalcost"></span>}</button>
                                </footer>
                            </section>
                            <section><footer>
                                <b><font color="red"><span id="errornonpresmsg"></span></font></b> </footer>
                            </section>    
                        </div>  
                    </fieldset>
                     <fieldset>
                            <table class="table table-striped" id="patient_medicines_distribute_patient_table">
                                <thead>
                                    <tr style="background-color: #F2CD00">
                                        <td><b>Medicine Name</b></td>
                                        <td><b>Count</b></td>
                                        <td><b>Cost</b></td>
                                        <td><b>Action</b></td>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                 
                            </table>
                        </fieldset>
                     
                  
                    <div id="medicinestabledata">
                            <input type="hidden"  name="counter" id="counter" />
                       </div>
                    <input type="hidden" name="medicinesforPatient" id="medicinesforPatient" />
                     <input type="hidden" name="medicinescost" id="medicinescost" />
                </form>  
                </div>
            </div>
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