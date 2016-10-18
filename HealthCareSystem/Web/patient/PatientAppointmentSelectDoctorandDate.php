 <?php 
 include_once ('../../Business/DiagnosticData.php');

$dd = new DiagnosticData();
$departments = $dd->getdepartments();
 
 ?>
<div class="col-md-12 sky-form">
     <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
     <script src="../js/patientCreateAppointmentSearch.js"></script>
     <script src="../js/state.js"></script>
     <script>
   $(document).ready(function(){ 
       
       var currentTime = new Date() 
var minDate = new Date(currentTime.getYear(), currentTime.getMonth() -1, +1); //one day next before month
var maxDate =  new Date(currentTime.getFullYear(), currentTime.getMonth() +2, -1);


      $( "#start" ).datepicker({  minDate: 0, maxDate: "+2M", 
       // changeMonth: true,
       // changeYear: true,
        yearRange:'+0:+0',
        hideIfNoPrevNext: true,
        "dateFormat": 'dd.mm.yy',
        nextText:'<i class="fa fa-angle-right"></i>',
        prevText:'<i class="fa fa-angle-left"></i>',
         weekHeader: "W"});
    });     
     
     </script>
     <fieldset>
         
         <div class="row">
          <section class="col col-4">
                <label class="input">
                    <i class="icon-append fa fa-calendar"></i>
                    <input type="text" name="start" id="start" placeholder="Appointment date" readonly>

                     <font color="red"><i><span id="starterrormsg"></span> </i></font>
                </label>
                <font color="red"><i><span id="staffapptpatientstartdt"></span> </i></font>
            </section>
            <section class="col col-4" id="doctoriddiv">
                <label class="select">
                   <select id="department" class="form-control" class="valid">
                    <option value="">Select Department</option>
                   <?php foreach($departments as $value){ ?>
                    <option value="<?php echo $value->id?>" ><?php echo $value->departmentname ?></option> 
                   <?php } ?>
                   </select>

               </label>  
            </section>
         </div>
     </fieldset>
     <fieldset>
       
         
         <div class="row">
              <legend>Search By Hospital:</legend>
             <section class="col col-4">
                <label class="select">
                    <select name="hospital" id="hospital">
                        <option value="HOSPITAL" selected >Hospital Name</option>
                        <?php foreach ($hosiptal as $value) { ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->hosiptalname?></option>
                        <?php } ?>
                    </select>

                </label>
                <font color="red"><i><span id="staffdoctorerrormsg"></span> </i></font>
            </section>
            <section class="col col-4">
                    <label class="input">
                       <i class="icon-append fa fa-asterisk"></i>
                       <input type="text" id="doctor" name="doctor"  placeholder="Doctor Name">

                   </label>
               </section>
            
              
             <legend>Search By Location:</legend>
              <section class="col col-4">
                    <label class="input">
                       <i class="icon-append fa fa-asterisk"></i>
                       <input type="text" id="address" name="address"  placeholder="Locality">

                   </label>
               </section>
             <section class="col col-4">
                 <label class="select">
                  <select id="state" class="form-control">
                   <option value="">-- Select State --</option>
                  <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                  <option value="Andhra Pradesh">Andhra Pradesh</option>
                  <option value="Arunachal Pradesh">Arunachal Pradesh</option> 
                  <option value="Assam">Assam</option> 
                  <option value="Bihar">Bihar</option>
                  <option value="Chandigarh">Chandigarh </option>
                  <option value="Chhattisgarh">Chhattisgarh</option>
                  <option value="Dadra and Nagar Haveli ">Dadra and Nagar Haveli </option>
                  <option value="Daman and Diu">Daman and Diu</option>
                  <option value="New Delhi">New Delhi</option>
                  <option value="Goa">Goa</option>
                  <option value="Gujarat">Gujarat</option>
                  <option value="Haryana">Haryana</option>
                  <option value="Himachal Pradesh">Himachal Pradesh</option>
                  <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                  <option value="Jharkhand">Jharkhand</option>
                  <option value="Karnataka">Karnataka</option>
                  <option value="Kerala">Kerala</option>
                  <option value="Lakshadweep">Lakshadweep</option>
                  <option value="Madhya Pradesh">Madhya Pradesh</option>
                  <option value="Maharashtra">Maharashtra</option>
                  <option value="Manipur">Manipur</option>
                  <option value="Meghalaya">Meghalaya</option>
                  <option value="Mizoram">Mizoram</option>
                  <option value="Nagaland">Nagaland</option>
                  <option value="Odisha">Odisha</option>
                  <option value="Puducherry">Puducherry</option>
                  <option value="Punjab">Punjab</option>
                  <option value="Rajasthan">Rajasthan</option>
                  <option value="Sikkim">Sikkim</option>
                  <option value="Tamil Nadu">Tamil Nadu</option>
                  <option value="Telangana">Telangana</option>
                  <option value="Tripura">Tripura</option>
                  <option value="Uttar Pradesh">Uttar Pradesh</option>
                  <option value="Uttarakhand">Uttarakhand</option>
                  <option value="West Bengal">West Bengal</option>
                  </select>
                    <font><i><span id="stateerrormsg"></span></i></font>       
               </label>
          </section> 
              <section class="col col-4">
                    <label class="input">
                       <i class="icon-append fa fa-asterisk"></i>
                       <input type="text" id="city" name="city"  placeholder="City" value="<?php  echo $_SESSION['city']; ?>">

                   </label>
               </section>
              <section class="col col-4">
                    <label class="select">
                    <select id="district" class="form-control" >
                       <option value="DISTRICT">- District -</option>
                    </select> 

                   </label>
               </section>
             <section class="col col-4">
                    <label class="input">
                       <i class="icon-append fa fa-asterisk"></i>
                       <input type="text" id="zipcode" name="zipcode"  placeholder="Zip Code" maxlength="6">

                   </label>
               </section>
             
            <input type="button" class="btn-u pull-right"  name="button" id="bthSearchStaffAppointmentUsers" value="Search"/> 

         </div>
     </fieldset>
</div>  



<div class="modal fade" id="mySearchResult" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Search Result</h4>
                </div>
                <div class="modal-body">
                
                    <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="tg-wrap">
                             
                       <table class="tg" id="doctor_search_result_data" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr">Doctor Name</th>
                            <th class="tg-uhkr">Hospital Name</th>
                            <th class="tg-uhkr">From Time</th>
                            <th class="tg-uhkr">To Time</th>
                            <th class="tg-uhkr"></th>
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>    
                        </table>
                        </div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>

