<div class="col-md-15">
     <div class="row margin-bottom-10">
         <div class="col-md-3">
             <table border="0" width="50%" height="70%" style="margin-left: 25px;">
                 <tr><td>
                 <center> 
                     <?php if($photoDetails[0]->filename != "") {?>
                             <img src="<?php echo "../".$photoDetails[0]->path."/".$photoDetails[0]->filename;?>" />  
                     <?php }else { ?>
                         
                             <img src="../noimages.jpeg" />  
                     <?php } ?>      
                 </center>  
  
                 </td></tr> 
                 
             </table>
            <!--img class="img-responsive" src="../config/content/assets/img/job/high-rated-job-3.1.jpg" alt=""--> 
           
           
        </div>
        <?php
             //   echo "First Name : ".$result[0]->firstname;
            if($result[0]->firstname == ""){
               $strBackGroundColor = "bg-color-blue"; 
            }
         //   echo "Color : ".$strBackGroundColor;
        ?> 
         

         <div class="col-md-4">
            <div class="bg-light <?php echo $strBackGroundColor;  ?>" ><!-- You can delete "bg-light" class. It is just to make background color -->  
                <table width ="100%" height="100%">
                    <tr><td align="left"><b>Name : </b> </td><td align="left"><?php echo $result[0]->firstname; ?></td></tr>
                    <tr><td align="left"><b>Patient Id : </b> </td><td align="left"><?php echo "P".$result[0]->ID; ?></td></tr>
                    <tr><td align="left"><b>Mobile : </b> </td><td align="left"><?php echo $result[0]->mobile; ?></td></tr>
                    <tr><td align="left"><b>Email : </b> </td><td align="left"><?php echo $result[0]->email; ?></td></tr>
                     <tr><td align="left"><b>Last Visit : </b> </td><td align="left"><?php echo $appointmentData[0]->appointementdate; ?></td></tr>
                     <tr><td align="left"><b>Credits : </b> </td><td align="left">0</td></tr>
                </table>
                
            </div>
        </div> 
         
         </div> 
      
     </div>
    <?php if($result[0]->firstname != "" || $result[0]->credits < 0) { ?>  
    <div class="col-md-15">  
                        
            <div class="panel panel-orange margin-bottom-40">
            <div class="panel-heading">
                <h5 class="panel-title"><i class="fa fa-edit"></i>Consultations History
                
                    <a href="#" onclick="showNonPrescriptionMedicines()" class="pull-right">Non Prescription Medicines</a>
                </h5>
            </div>
            <table class="table table-striped" id="">
                <thead>
                    <tr>
                       
                        <th>Appointment Date</th>
                        <th>Time</th>
                        <th>Doctor Name</th>
                        <th>Hospital Name</th>
                         
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        
                    </tr>
                 </thead>    
                     <?php foreach ($consultations as $value) { ?>
                        <tr>
                           
                            <td nowrap><?php echo $value->dispdate;  ?></td>
                            <td nowrap><?php echo $value->AppointmentTime;  ?></td>
                            <td nowrap><?php echo $value->DoctorName; ?></td>
                            <td nowrap><?php echo $value->HospitalName; ?></td>
                            <td nowrap><?php if($value->datediff <= 0) { ?><a href="#" onclick="showPrescription('<?php echo $value->id; ?>')">Prescription</a><?php } ?></td>
                            <td nowrap><?php if($value->datediff <= 0) { ?><a href="#" onclick="showReports('<?php echo $value->id; ?>')">Report</a><?php } ?></td>
                            <td nowrap><?php if($value->datediff <= 0) { ?><a href="#" onclick="showMedicines('<?php echo $value->id; ?>')">Medicine</a><?php } ?></td>
                            <td nowrap><?php if($value->datediff <= 0) { ?><a href="#" onclick="generatePDF('<?php echo $value->id; ?>')">Download</a><?php } ?></td>
                        </tr>
                    <?php } ?> 
               
                <tbody>

                </tbody>
            </table>
        </div>         
         
         </div>
    <?php }else { ?>
    
         <?php if($result[0]->credits < 0) { ?>  
            <div class="col-md-12">
                <div class="bg-color-orange">     
                    <h4 style="color: #FFFFFF"><i class="icon-custom icon-sm icon-bg-u rounded-x icon-color-red icon-line fa fa-exclamation-triangle"></i>Warning</h4>
                    <p style="color: #FFFFFF">Please refill your credits</p>
                </div>
            </div>
         <?php } ?>

    
        <?php if($result[0]->firstname == "") { ?>  
            <div class="col-md-12 bg-color-blue">
            <div class="col-md-12 bg-color-orange">
                <div class="bg-color-orange">     
                    <p><h4 style="color: #FFFFFF"><i class="icon-custom icon-sm icon-bg-u rounded-x icon-color-red icon-line fa fa-exclamation-triangle"></i>Warning
                   &nbsp;&nbsp;&nbsp;&nbsp;
                   <button onclick="navigateToProfile()"class="btn-u btn-u-xs btn-u-blue grow-rotate ladda-button" data-style="expand-down">Update Profile</button>
                    </h4></p>
                    
                    <p style="color: #FFFFFF"><h7>Please update your profile to start using all the features of the application</h7></p>
                </div>
            </div>
         
         <?php } ?> 
    <?php }?>
</div>  



 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Prescription</h4>
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
                       <table class="tg" id="PatientPrescriptionTable" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr" nowrap>Description</th>
                            <th class="tg-uhkr">Doctor Observation</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>
                            <input type="hidden" id="hidmymodalappointmentid" />
                        </table></div>
                   <div class="tg-wrap">
                       <table class="tg" id="PatientDiseasesTable" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr" nowrap>Diseases Name</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>
                        </table></div>
                  
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>

<div class="modal fade" id="myReportsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Reports</h4>
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
                            <th class="tg-uhkr">Report Name</th>
                            <th class="tg-uhkr">Parameter Name</th>
                            <th class="tg-uhkr">Value</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>    
                        </table></div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>



<div class="modal fade" id="myMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Medicines</h4>
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
                        <div class="tg-wrap"><table class="tg" id="PatientMedicineTable">
                         <thead>
                          <tr>
                            <th class="tg-uhkr">Medicine Name</th>
                            <th class="tg-uhkr">Usage</th>
                            <th class="tg-uhkr" colspan="2">Morning {Breakfast}</th>
                            <th class="tg-uhkr" colspan="2">Afternoon {Meal}</th>
                            <th class="tg-uhkr" colspan="2">Night {Meal}</th>
                            <th class="tg-uhkr">Days #</th>
                          </tr>
                          <tr>
                            <td class="tg-031e"></td>
                            <td class="tg-031e"></td>
                            <td class="tg-5y5n">Before</td>
                            <td class="tg-5y5n">After</td>
                            <td class="tg-5y5n">Before</td>
                            <td class="tg-5y5n">After</td>
                            <td class="tg-5y5n">Before</td>
                            <td class="tg-5y5n">After</td>
                            <td class="tg-031e"></td>
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>    
                        </table></div>
                </div>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
            </div>
          </div>
    </div>
</div>


<div class="modal fade" id="myNonPrescriptionMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Medicines</h4>
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
                       <table class="tg" id="PatientNonPrescriptionMedicines" width="100%">
                         <thead>
                          <tr>
                            <th class="tg-uhkr">Medicine Name</th>
                            <th class="tg-uhkr">Quantity Name</th>
                            <th class="tg-uhkr">Price</th>
                            
                          </tr>
                         </thead>
                            <tbody>
                            </tbody>    
                        </table></div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>


       