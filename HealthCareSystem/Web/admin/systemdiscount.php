<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 

 <?php 
    include_once '../../Business/OfficeSettings.php';
    
    $od = new OfficeSettings();
    $results = $od->fetchSystemDiscounts();
    
 ?>   
    
    
<fieldset>
    <section class="col-md-1"></section>
     <section>
<div class="col-md-12">
    
     <table class="table table-striped form-table" >
            <thead>
                <tr><td colspan="9" style="background-color: rgba(153, 153, 153, 0.47);color:#ffffff;">
                    
                        <footer>
                            <button type="button" class="btn-u" onclick="addsystemDiscount()" name="button" id="addsystemDiscount" > Create Discount </button>
       
                        </footer>
                        
                    </td>
                </tr>
                <tr style="background-color: #4765a0;color:#FFFFFF;">
                    <th>Discount Name</th>
                    <th>Discount {%}</th>
                    <th>Lab</th>
                    <th>Medical Shop</th>
                    <th>Hospital</th>
                    <th>Mobile</th>
                     <th>Start Date</th>
                      <th>End Date</th>
                       <th>Action</th>
                </tr>
            </thead><tbody>
                
                <?php if(sizeof($results) > 0) {
                    foreach($results as $data){
                     //  print_r($data);
                       $labchecked = "";
                       $medicalchecked = "";
                       $hospitalchecked = "";
                       $mobilechecked = "";
                       if($data->lab == "true")
                           $labchecked = "checked";
                       if($data->medical == "true")
                           $medicalchecked = "checked";
                       if($data->hospital == "true")
                           $hospitalchecked = "checked";
                       if($data->mobile == "true")
                           $mobilechecked = "checked";
                 ?>
                 <tr>
                    <td><?php echo $data->discountname;  ?></td>
                    <td><?php echo $data->percent;  ?></td>
                    <td>
                        <input type="checkbox" name="lab[]" id="lab[]" <?php echo $labchecked; ?> >
                        </td>
                    <td><input type="checkbox" name="medical[]" id="medical[]"  <?php echo $medicalchecked; ?> ></td>
                    <td><input type="checkbox" name="hospital[]" id="hospaital[]" <?php echo $hospitalchecked; ?> ></td>
                    <td><input type="checkbox" name="mobile[]" id="mobile[]"  <?php echo $mobilechecked; ?>></td>
                    <td><?php  echo $data->startdate; ?></td>
                       <td><?php  echo $data->enddate; ?></td>
                       <td><button class="btn btn-warning btn-xs" onclick="editSystemDiscountDetails('<?php echo $data->discountname;  ?>',
                       <?php echo $data->percent;  ?>,<?php echo $data->lab;  ?>,<?php echo $data->medical;  ?>,<?php echo $data->hospital;  ?>,
                       <?php echo $data->mobile;  ?>,'<?php echo $data->startdate;  ?>','<?php echo $data->enddate;  ?>',<?php echo $data->id;  ?>)"><i class="fa fa-trash-o"></i> Edit</button></td>
                </tr>       
                <?php  } 
                 }else{
                ?>      
                <tr><td colspan="9" style="background-color: rgba(153, 153, 153, 0.47);color:#ffffff;">No Records Found</td></tr>    
                 <?php } ?>       
                
            </tbody>
            
        </table>
</div>    
    </section>
    
  </fieldset>  

<div class="modal fade" id="systemDiscountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Discount Details</h4>
                </div>
                <div class="modal-body">
                
                    <div class="sky-form">
                        <br/>
                        <div class="row">
                             <section class="col-md-4">
                                    <label class="input">
                                         <i class="icon-append fa fa-asterisk"></i>
                                         <input type="text" id="pdiscountname" name="pdiscountname" placeholder="Disscount Name">
                                      </label>
                                </section>
                            <section class="col-md-4">
                                <label class="input">
                                     <i class="icon-append fa fa-asterisk"></i>
                                     <input type="text" id="ppercent" name="ppercent" placeholder="Disscount Percent">
                                  </label>
                            </section>
                           
                          </div>
                        <div class="row">
                             
                            <section class="col-md-3">
                                <label class="checkbox">
                                    <input type="checkbox" id="lab"><i></i>Lab
                                </label>
                            </section>
                             
                            <section class="col-md-3">
                                <label class="checkbox">
                                    <input type="checkbox" id="medical"><i></i>Medical Shop
                                </label>
                            </section>
                             
                            <section class="col-md-3">
                                <label class="checkbox">
                                    <input type="checkbox" id="hospital"><i></i>Hospital
                                </label>
                            </section>
                             
                            <section class="col-md-3">
                                <label class="checkbox">
                                    <input type="checkbox" id="mobile"><i></i>Mobile
                                </label>
                            </section>
                        </div>
                        <div class="row">
                            <section class="col-md-4">
                                <label class="input">
                                     <i class="icon-append fa fa-asterisk"></i>
                                     <input type="text" id="start" name="start" placeholder="Start Dtae">
                                  </label>
                            </section>
                            <section class="col-md-4">
                                <label class="input">
                                     <i class="icon-append fa fa-asterisk"></i>
                                     <input type="text" id="finish" name="finish" placeholder="End Date">
                                  </label>
                            </section>
                        </div>
                        <input type="hidden" id="pid" name="pid" />          
                        
                    </div>
                        
                </div>
                <div class="modal-footer">
                     <button data-dismiss="modal" class="btn-u btn-u-orange" type="button" id="updateSystemDiscount">Update</button>
                     <button data-dismiss="modal" class="btn-u btn-u-orange" type="button" id="submitSystemDiscount">Submit</button>
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>