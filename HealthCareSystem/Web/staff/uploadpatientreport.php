<div class="col-md-8" id="patientreportss">
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/searchreports.js"></script>
 
  <form name="searchreport" action="../../Business/SaveReports.php" method="POST"   enctype="multipart/form-data">
  
<div class="col-md-12"> 
<fieldset> 
    <section class="col-md-12">    
<?php include_once 'reportssearch.php'; ?>
    </section>
</fieldset>
<fieldset>  
  
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
                   <select id="reportname" class="form-control" required>
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
            <section class="col col-6">
                <label class="input">
                    <input type="text" id="parameterName"  placeholder="Parameter Name">
                </label>
            </section>
             <section class="col col-6">
                <label class="input">
                    <input type="text" id="parameterValue1"  placeholder="Parameter Value 1">
                </label>
            </section>
             <section class="col col-6">
                <label class="input">
                    <input type="text" id="parameterValue2"  placeholder="Parameter Value 2">
                </label>
            </section>
             <section class="col col-6">
                <label class="input">
                    <input type="text" id="parameterValue3"  placeholder="Parameter Value 3">
                </label>
            </section>
             <input type="button" class="btn-u pull-right"  name="button" id="btnAddReportSpecificData" value="Add Report Data"/>
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
                                    <th>Value 1</th>
                                    <th>Value 2</th>
                                    <th>Value 3</th>
                                    <th>Action</th>
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
    <span id="showimage">
        
         <img id="reportimage" src="#" alt="Prescription" />
        
    </span>
<ul class="nav nav-tabs" id="tabheading">
  <!--li class="active"><a data-toggle="pill" href="#home">Home</a></li>
  <li><a data-toggle="pill" href="#menu1">Menu 1</a></li-->
  <li><a data-toggle="pill" href="#reports">REPORTS</a></li>
</ul>

<div class="tab-content" id="displayreportcontent">
  <!--div id="home" class="tab-pane fade in active">
    <h3>HOME</h3>
    <p>Some content.</p>
  </div>
  <div id="menu1" class="tab-pane fade">
    <h3>Menu 1</h3>
    <p>Some content in menu 1.</p>
  </div-->
  <div id="reports" class="tab-pane fade">
   
    <p>Upload a report to preview</p>
  </div>
</div>    
    
    
    
    
    
</div>
</section>
</fieldset>
</div>
      <div id="hiddendatagroup">
        <input type="hidden"  name="counter" id="counter" />


    </div>
</form>
</div>