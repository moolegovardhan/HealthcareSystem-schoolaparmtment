<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>  
<script src="../js/medicinesinward.js"></script>  
<div class="col-md-15 sky-form">
<fieldset>
    <div class="row">
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="orderid" placeholder="Order ID"/>
              </label>
         <font color="red"><i><span id="orderiderrormsg"></span></i></font>    
        </section>
         <section class="col-md-3">
            <button type="button" class="btn-u"  name="button" id="fetchMedicalforOrder" > Search </button>
        </section> 
         <section class="col-md-3">
            <button type="button" class="btn-u"  name="button" id="addMedicalforOrder" > Add Order </button>
        </section> 
    </div>
    <div class="row">
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="medicinename" placeholder="Medicine Name"/>
              </label>
         <font color="red"><i><span id="mnameerrormsg"></span></i></font>    
        </section>
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="start" placeholder="Dispatch Date"/>
              </label>
         <font color="red"><i><span id="starterrormsg"></span></i></font>    
        </section>
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="end" placeholder="Received Date"/>
              </label>
         <font color="red"><i><span id="enderrormsg"></span></i></font>    
        </section>
    </div>
     <div class="row">
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="companyname" placeholder="Company Name"/>
              </label>
         <font color="red"><i><span id="mnameerrormsg"></span></i></font>    
        </section>
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="distname" placeholder="Distributor Name"/>
              </label>
         <font color="red"><i><span id="starterrormsg"></span></i></font>    
        </section>
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="batchnumber" placeholder="Batch Number"/>
              </label>
         <font color="red"><i><span id="enderrormsg"></span></i></font>    
        </section>
    </div>
     <div class="row">
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="finish" placeholder="Expiry Date"/>
              </label>
         <font color="red"><i><span id="mnameerrormsg"></span></i></font>    
        </section>
        <section class="col-md-3">
            <label class="select">
                  <select id="packagingtype" class="form-control"  >
                      <option value="packagingtype">-- Select Packaging Type --</option>
                      <option value="Bottles">Bottles</option>
                      <option value="Tablets">Strips </option>
                      <option value="Others">Others </option>
                   </select>
                </label>
       </section>
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="noofunits" placeholder="No Of Units"/>
              </label>
         <font color="red"><i><span id="enderrormsg"></span></i></font>    
        </section>
         
    </div>
     <div class="row">
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="unitsperpack" placeholder="# of prices per package"/>
              </label>
         <font color="red"><i><span id="mnameerrormsg"></span></i></font>    
        </section>
         <section class="col-md-3">
            <label class="input">
                 <input type="text" id="cosrperpiece" placeholder="Units per pack"/>
              </label>
         <font color="red"><i><span id="mnameerrormsg"></span></i></font>    
        </section>
       <section class="col-md-3">
            <label class="input">
                 <input type="text" id="totalbatchcost" placeholder="Total Cost"/>
              </label>
         <font color="red"><i><span id="mnameerrormsg"></span></i></font>    
        </section>
        <section class="col-md-3">
            <label class="input">
                 <input type="text" id="perunitcost" placeholder="Per Unit Cost"/>
              </label>
         <font color="red"><i><span id="enderrormsg"></span></i></font>    
        </section>
         </div>
</fieldset> 
  </div>   