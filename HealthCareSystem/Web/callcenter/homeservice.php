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
          <label class="input">
               <input type="text" id="receiptid" placeholder="Receipt Id"/>
            </label>
       <font color="red"><i><span id="receipterr"></span></i></font>    
      </section>
        <section class="col-md-3">
         <button type="button" class="btn-u"  name="button" id="fetchAllHomeServiceOrdered" > Search </button>
        </section> 
     
              
     </div>     

  </fieldset>
    <fieldset>
        <table class="table table-striped" id="patient_home_service_order_table">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    <td><b>Request Id</b></td>
                    <td><b>Patient Name</b></td>
                    <td><b>Mobile</b></td>
                    <td><b>Service Name</b></td>
                    <th>Request Date</th>
                    <th>Receipt</th>
                     <th>Status</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
    </fieldset>
    
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<div class="modal fade" id="homeServices" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                   <section class="col-md-5">
                       <label class=""> Select Attender Name</label>
                   </section><br/>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="serviceid" />
                    <section class="col-md-3">
                        <label class="">Attender Name </label>
                    </section>    
                    <section class="col-md-5">
                        <label class="select">
                          <select id="serviceperson" name="serviceperson" class="form-control">
                           <option value="nodata">- Select Attender -</option>
                          
                           <option value="Rajiv">Rajiv</option>
                           <option value="Ravi">Ravi</option>
                           <option value="Kishor">Kishor</option>
                            
                          </select>
                           <i><font color="red"><span id="paramnameerrormsg"></span></font></i>
                       </label>
                    </section>
                    <section class="col-md-3">
                        <button type="button" class="btn-u"  name="button" id="assigntoattender" > Assign </button>
                    </section> <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
