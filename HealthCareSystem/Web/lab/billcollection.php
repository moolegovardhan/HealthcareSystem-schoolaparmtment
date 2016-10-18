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
               <input type="button" class="btn-u pull-right"  name="button" id="searchNonPrescriptionPatient" value="search"/>     
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
                           <select id="reportname" class="form-control" onchange="updateParamsWithTest(this.value)" required>
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
                           <select id="parameterName" class="form-control" required>
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


  
 <div class="modal fade" id="showListOfTest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Register
                    
                    
                    </h4>
                </div>
                <div class="modal-body">
                    <section id="errormessages" class="col col-4 alert alert-info">
                        <font color="red"> <span id="errorDisplay"></span> </font>
                    </section>
                    <div class="margin-bottom-40 ">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="sky-form">
                            <form action="../../Business/CollectLabSamples.php" method="post">
                             <input type="submit" class="btn-u pull-right"  name="button" id="generateBill" value="Generate Bill"/>
                             <br/>
                        <fieldset>
                           
               
                            <table width="70%" border="1"  class="table table-striped" style="border-collapse: collapse;" id="appointment_test_prescribed">
                                <thead>
                                <tr align="center" style="background-color: #ffce93;font-weight: 15px;">
                                    <td></td>
                                    <td><b>Test Name</b></td>
                                    <td><b>Test Price</b></td>
                                    <td><b>Final Price</b></td>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                               
                            </table> 
                                 <input type="hidden" name="recordcount" id="recordcount"/>
                                  <input type="hidden" name="hidpatientid" id="hidpatientid"/>
                                 <input type="hidden" name="appointmentidhid" id="appointmentidhid"/>
                        </fieldset>
                       </form>     
                      </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>


<div class="modal fade" id="noLabTestMessage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myLargeModalLabel" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h5><i><span id="errorMessage"></span></i></h5>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>
