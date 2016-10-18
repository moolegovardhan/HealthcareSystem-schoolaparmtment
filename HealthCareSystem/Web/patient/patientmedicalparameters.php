<?php 
include_once '../../Business/PatientData.php';
$pd = new PatientData();
$data = $pd->fetchPatientMedicalInfo($_SESSION['userid']);
?>
<div class="col-md-12 ">
   
    <!-- Tab Start -->
    <div class="tab-v1" id="enterhealthdetails">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Existing Data</a></li>
            <li><a href="#profile" data-toggle="tab">New Data</a></li>
        </ul> 
        <!--  Start -->
        <div class="tab-content">
            <!-- Tab 1 Start -->
            <div class="tab-pane fade in active" id="home">
    
                <section class="col col-md-15">
                    <div class="panel panel-orange margin-bottom-10" id="listofpatients">
                       <div class="panel-heading">
                           <h3 class="panel-title"><i class="fa fa-edit"></i>List of Medical Parameters</h3>
                       </div>
                       <div class="panel-body">   
                       <table class="table table-striped pull-left" id="patient_existing_medical_records_search_result_table">
                           <thead>
                               <tr>
                                   <th nowrap>ID </th>
                                   <th nowrap>Parameter Name</th>
                                   <th nowrap>Parameter Value</th>
                                   <th nowrap>Observation</th>
                                   <th nowrap></th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php  foreach($data as $value){ ?>
                                        <tr>
                                           <td nowrap><?php echo $value->id ;?> </td>
                                           <td nowrap><?php echo $value->paramname ;?></td>
                                           <td nowrap><?php echo $value->paramvalue ;?></td>
                                           <td nowrap><?php echo $value->observation ;?></td>
                                         
                                       </tr>
                               <?php } ?>
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
                   
                    <form name="generalinfo" action="../../Business/PatientHealthParametersSave.php" method="POST">  
                  
                         <input type="hidden"  name="frommodule" value="patient"/>
                        <input type="hidden"  name="patientid" value="<?php echo $_SESSION['userid'];  ?>"/>
                        <section class="col-md-15  sky-form" id="">

                         <div class="panel panel-orange" id="reportssearchpanel">
                             <input type="submit" class="btn-u btn-u-dark-blue pull-right"  name="submit" id="submitPatientGeneralParameters" value="Submit Medical Info"/>     



                            <div class="panel-heading">
                                <h3 class="panel-title">Patient : Health Details </h3>
                                  </div>
                             <div class="panel-body"> 
                                 <div class="row">
                                       <section class="col col-4">
                                            <label class="select">
                                              <select id="paramname" name="paramname" class="form-control" required="true">
                                               <option value="PARAMNAME">- Param Name -</option>
                                               <option value="Temparature">Temparature</option>
                                               <option value="Weight">Weight</option>
                                               <option value="Height">Height</option>
                                               <option value="Pulse">Pulse</option>
                                               <option value="Body Fat">Body Fat</option>
                                               <option value="BMI">BMI</option>
                                               <option value="MAP">MAP</option>
                                               <option value="Blood Group">Blood Group</option>
                                               <option value="BMR">BMR</option>
                                               <option value="Oxygen Saturation">Oxygen Saturation</option>
                                               <option value="Hemoglobin">Hemoglobin</option>
                                               <option value="Blood Pressure">Blood Pressure</option>
                                               
                                              </select>
                                               <i><font color="red"><span id="paramnameerrormsg"></span></font></i>
                                           </label>
                                      </section> 
                                     
                                    <section class="col-md-5">
                                      <label class="input">
                                        <input type="text" id="paramvalue" name="paramvalue"  placeholder="Parameter Value">
                                      </label>
                                      <i><font color="red"><span id="paramvalueerrormsg"></span></font></i>
                                  </section>
                                  <section class="col-md-6">
                                      <label class="input">
                                          <textarea rows="6" cols="35" id="observation" name="observation"></textarea>
                                      </label>
                                      <i><font color="red"><span id="paramvalueerrormsg"></span></font></i>
                                  </section>
                                     <section class="col-md-4">
                                         <input type="button" class="btn-u btn-u-dark-blue pull-right"  name="button" id="addPatientGeneralParameters" value="Add General Info"/>     
                                     </section>    
                                 </div>
                                 <div class="row">
                                    <table class="table table-striped pull-left" id="patient_general_info_table">
                                        <thead>
                                            <tr class="bg-color-orange">
                                            <tr class="bg-color-dark-orange">

                                                <th nowrap>Parameter Name</th>
                                                <th nowrap>Parameter Value</th>
                                                <th nowrap>General Info</th>
                                                <th nowrap></th>
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
<div class="modal fade sky-form-modal-overlay" id="myMedicalParametersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                       <table class="tg" id="PatientReportsTable" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr">Parameter Name</th>
                            <th class="tg-uhkr">Parameter Value</th>
                            <th class="tg-uhkr">Observation</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <section class="col-md-4">
                                            <label class="input">
                                              <input type="text" id="paramnameedit"  placeholder="Parameter Name">
                                              <input type="hidden" id="paramidedit"  placeholder="Patient Name">
                                            </label>
                                            <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                                        </section>
                                      </td>
                                    <td>
                                         <section class="col-md-4">
                                            <label class="input">
                                              <input type="text" id="paramvalueedit"  placeholder="Parameter Value">
                                            </label>
                                            <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                                        </section>
                                      </td>
                                    <td>
                                        <section class="col-md-4">
                                          <label class="input">
                                             <textarea id="observationedit" rows="3" cols="45"></textarea>
                                          </label>
                                          <i><font color="red"><span id="staffapptpatientname"></span></font></i>
                                      </section>
                                     </td>

                                  </tr>
                            </tbody>    
                        </table></div>
                </div>
                
                </div>
                <div class="modal-footer">
                      <button data-dismiss="modal" class="btn-u btn-u-dark-blue" type="button" id="submitMedicalDataEdit">Submit</button>
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>

    
</div>