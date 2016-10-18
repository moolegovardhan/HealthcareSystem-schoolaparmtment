<form name="searchreport"  id="sky-form" class="sky-form" action="../../Business/SaveLabReports.php" method="POST"   enctype="multipart/form-data">
<div class="col-md-12" id="patientreportss">
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
   <script src="../js/searchLabReports.js"></script>
  <script src="../js/labmain.js"></script>
  
<fieldset> 
    <section class="col col-md-3">
        <div class="panel panel-orange" id="reportssearchpanel">
    <div class="panel-heading">
        <h3 class="panel-title">Reports : Search Patient</h3>
     </div>
     <div class="panel-body"> 
      
         <fieldset>
            <div class="row">
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientName"  placeholder="Patient Name">
                      <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="patientID"  placeholder="Patient ID">
                      <input type="hidden" id="hidpatientID"  >
                    </label>
                    <i><font color="red"><span id="staffapptpatientid"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="appointmentID"  placeholder="Appointment ID">
                      <input type="hidden" id="hidappointmentid" >
                    </label>
                    <i><font color="red"><span id="staffappointmentid"></span></font></i>
                </section>
                <section class="col">
                    <label class="input">
                      <input type="text" id="mobile"  placeholder="Mobile Number">
                      <input type="hidden" id="hidpatientName"  placeholder="Patient Name">
                    </label>
                    <i><font color="red"><span id="staffpatientmobile"></span></font></i>
                </section>
            </div>
         </fieldset> 
           <footer>
               <input type="button" class="btn-u pull-right"  name="button" id="searchReports" value="search"/>     
             </footer>  
          
        </div>
   </div> 
        
    </section>
     <section class="col col-md-9">
        <?php include_once 'reportssearch.php'; ?>
        <section id="reportspanel"> 
            <input type="submit" class="btn-u pull-right"  name="button" id="SubmitReports" value="Submit"/>     

            <input type="button" class="btn-u pull-right"  name="button" id="showReportsSearchResult" value="Search Result"/>  

        <div class="panel panel-orange  sky-form">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i>Reports Details</h3>
             </div>

        <div class="col-md-12">  
            <div class="row"> 
                <fieldset>
                    <section class="col col-4">
                        <label class="select">
                           <select id="reportname" class="form-control" onchange="updateParamsWithTest(this.value)" >
                               <option value="REPORT">-- Select Report --</option>
                            </select>
                         </label>
                        <font><i><span id="reporterrormsg"></span></i></font> 
                     </section> 
                    <!--section class="col col-6">
                         <label for="file" class="input input-file">
                                <div class="button"><input placeholder="Photo"  type="file" name="filepres"  id="filepres" onchange="this.parentNode.nextSibling.value = this.value" accept="image/*">Browse</div><input type="text" name="filepres"  readonly>
                            </label>
                         <input type="button" class="btn-u pull-right"  name="button" id="btnAddReportFile" value="Updaload Report"/>
                    </section-->

                        <section class="col col-4">
                             <div id="FileUploadDiv">
                                 <input type="file" />
                             </div>
                        </section>
                      <section class="col col-4">
                             <div id="FileUploadLinkDiv">

                             </div>
                        </section>
                </fieldset>
                <fieldset>
                    <section class="col col-4">
                        <label class="select">
                           <select id="parameterName" class="form-control" >
                               <option value="PARAMETER">-- Select Parameter --</option>
                            </select>
                         </label>
                        <font><i><span id="reporterrormsg"></span></i></font> 
                     </section> 
                     <section class="col col-4">
                        <label class="input">
                            <input type="text" id="reportResult"  placeholder="Result">
                        </label>
                    </section>
                   
                     <input type="button" class="btn-u pull-right"  name="button" id="btnAddReportSpecificData2" onclick="btnAddLabReportSpecificData()" value="Add Report Data"/>
                </fieldset>

            </div>
            <input type="hidden" id="tableValue">
            <div class="row">
                <div class="panel panel-primary margin-bottom-40" id="patient_records_repords_table">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-globe"></i>Reports Data</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-hover" id="patient_records_reports_table">
                                    <thead>
                                         <tr>
                                             <th>Report ID</th>
                                            <th>Report Name</th>
                                            <th>Parameter Name</th>
                                            <th>units</th>
                                            <th>Result</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>                      
                        </div>
            </div>
            <input type="hidden" id="appointmentid" name="appointmentid" />
             <input type="hidden" id="patientid" name="patientid" />
        </div> 
            <span id="showimage"><img id="reportimage" src="#" alt="Prescription" /></span>
        </div>    
        </section>
        </div>
              <div id="hiddendatagroup">
                <input type="hidden"  name="counter" id="counter" />


            </div>
    </section>     
</fieldset>    
</div>
</form>