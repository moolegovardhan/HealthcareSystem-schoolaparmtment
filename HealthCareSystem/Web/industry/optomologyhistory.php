<?php session_start(); 
 include_once '../../Business/IndustryData.php';
 
 $sd = new IndustryData();
 
 
$department = $sd->fetchIndustryDepartmentDetails($_SESSION['officeid']);

//print_r($department);
?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/industryhealthcheckup.js"></script> 
<div class="col-md-12 sky-form" >
    <div>
    <fieldset>
        
        <section class="col col-md-3">
                <label class="select">
                  <select id="departmentname" name="departmentname" class="form-control" class="valid">
                   <option value="nodata">-- Department --</option>
                   <?php  foreach($department as $dept ){?>
                  <option value="<?php echo $dept->id; ?>"><?php echo $dept->departmentname; ?></option>
                   <?php } ?>

                  </select>
             </label>  
           </section>
        
       
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="searchIndustryOptoConsultationDetails" > Search </button>
        </section>
    </fieldset>
        <div id="searchResultForHistory">  
    <fieldset>
        <section class="col-md-12">
            <table class="table table-striped" id="school_health_optocheckup_history_table">
                <thead>
                    <tr style="background-color: #F2CD00">


                        <td><b>Department</b></td>
                         <td><b>No of Employees</b></td>
                        <td><b>Appointment Date</b></td>
                         <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
            <div id="labtabledata">

            </div>    
          <input type="hidden"  name="counter" id="counter" />
        </section>  
        
    </fieldset>
            </div>   
        <div id="showDetailsforClass">
            <fieldset>
                <section class="col-md-12">
                    <table class="table table-striped" id="school_health_checkup_history_opto_details_table">
                        <thead>
                            <tr style="background-color: #F2CD00">


                                <td><b>Employee id</b></td>
                                 <td><b>Employee Name</b></td>
                                <td><b>Observations</b></td>
                                 <th>Complaints</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                    <div id="labtabledata">

                    </div>    
                  <input type="hidden"  name="counter" id="counter" />
                </section>  

            </fieldset>
            
        </div>    
   </div> 
    
</div>   