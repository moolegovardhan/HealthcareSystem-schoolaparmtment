  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/pregnancymedical.js"></script>
 
<div class="col-md-12 sky-form">
 
    <!-- Tab Start -->
    <div class="tab-v1" id="pregnancydetails">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Existing Data</a></li>
            <li><a href="#profile" data-toggle="tab">New Data</a></li>
        </ul> 
        <!--  Start -->
        <div class="tab-content">
            <!-- Tab 1 Start -->
            <div class="tab-pane fade in active" id="home">
    
                <section class="col-md-15">
                    <div class="panel panel-orange margin-bottom-10" id="pregnancyparameters">
                       <div class="panel-heading">
                           <h3 class="panel-title"><i class="fa fa-edit"></i>List of Medicines</h3>
                       </div>
                       <div class="panel-body">   
                       <table class="table table-striped pull-left" id="pregnancy_medicine_existing_records_search_result_table">
                           <thead>
                               <tr>
                                   <td nowrap>Month</td>
                                   <td nowrap>Medicine Name</td>
                                   <td nowrap>Observations</td>
                                    <td nowrap></td>
                               </tr>
                           </thead>
                           <tbody>

                           </tbody>
                       </table>
                       </div>     
                </div>    
                </section>
    
           </div>
            <!-- Tab 1 ENd -->
            <!-- Tab 2 Start -->
            <div class="tab-pane fade in" id="profile">
                <fieldset> 
                   
                    <form name="generalinfo" action="../../Business/StaffPregnancyMedicalInfoSave.php" method="POST">  
                    <section class="col-md-15 sky-form" id="enternewdetails">

                         <div class="panel panel-orange" id="reportssearchpanel">
                             <input type="submit" class="btn-u btn-u-orange pull-right"  name="submit" id="submitPrgenancyMedicalParameters" value="Submit Medicine Info"/>     



                            <div class="panel-heading">
                                <h3 class="panel-title">Pregnancy : Medicines Details </h3>
                                  </div>
                             <div class="panel-body"> 
                                 <div class="row">
                                      <section class="col col-5">
                                            <label class="select">
                                              <select id="month" name="month" class="form-control">
                                               <option value="MONTH">- Month -</option>
                                               <option value="0">0</option>
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
                                               
                                              </select>
                                               <i><font color="red"><span id="paramnameerrormsg"></span></font></i>
                                           </label>
                                      </section> 
                                    <section class="col-md-5">
                                      <label class="input">
                                        <input type="text" id="medicinename" name="medicinename"  placeholder="Medicine Name">
                                      </label>
                                      <i><font color="red"><span id="pregnancymedicineerrormsg"></span></font></i>
                                  </section>
                                  
                                  <section class="col-md-6">
                                      <label class="input">
                                          <textarea rows="6" cols="35" id="observation" name="observation"></textarea>
                                      </label>
                                      <i><font color="red"><span id="observationerrormsg"></span></font></i>
                                  </section>
                                     <section class="col-md-4">
                                         <input type="button" class="btn-u btn-u-orange pull-right"  name="button" id="addPregnancyMedicalParameters" value="Add Medicines Info"/>     
                                     </section>    
                                 </div>
                                 <div class="row">
                                    <table class="table table-striped pull-left" id="pregnancy_medical_info_table">
                                        <thead>
                                            <tr class="bg-color-orange">

                                                <td nowrap>Month</td>
                                                <td nowrap>Medicine Name</td>
                                                <td nowrap>Purpose</td>
                                                <td nowrap></td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>  

                                     <div id="generaldiv">
                                          <input type="hidden"  name="counter" id="counter" />

                                     </div>
                                 </div>
                             </div>
                         </div>    

                    </section>
                        </form>
                </fieldset>
            </div> 
            <!-- Tab  2 end -->
       </div>
       <!-- End --> 
    </div>
   <!-- Tab End --> 
<div class="modal fade sky-form-modal-overlay" id="myParametersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Edit Data</h4>
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
                       
                        <div class="row">
                                      <section class="col col-3">
                                            <label class="select">
                                              <select id="umonth" name="umonth" class="form-control">
                                               <option value="MONTH">- Month -</option>
                                               <option value="0">0</option>
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
                                               
                                              </select>
                                               <i><font color="red"><span id="paramnameerrormsg"></span></font></i>
                                           </label>
                                      </section> 
                                    <section class="col-md-3">
                                      <label class="input">
                                        <input type="text" id="umedicinename" name="umedcinename"  placeholder="Medicine Name">
                                      </label>
                                      <i><font color="red"><span id="weighterrormsg"></span></font></i>
                                  </section>
                                  
                                  <section class="col-md-6">
                                      <label class="input">
                                          <textarea rows="6" cols="35" id="uobservation" name="uobservation"></textarea>
                                      </label>
                                      <i><font color="red"><span id="observationerrormsg"></span></font></i>
                                  </section>
                                         <input type="hidden" name="generalid" id="generalid"> 
                                 </div>
                        
                        </div>
                </div>
                
                </div>
                <div class="modal-footer">
                      <button data-dismiss="modal" class="btn-u btn-u-dark-blue" type="button" id="submitPregnancyMedicineDataEdit">Submit</button>
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>

    
</div>