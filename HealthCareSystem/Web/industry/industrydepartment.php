<?php session_start(); ?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/industrydepartment.js"></script> 
<?php
include_once '../../Business/IndustryData.php';

?>
<form method="post" action="../../Business/createindustrydepartments.php">
    
<fieldset>
    <section class="col-md-1"></section>
     <section>
<div class="col-md-12 sky-form" >
    
    <fieldset>
        
        
        <section class="col-md-4">
          <label class="input">
              <input type="text" id="departmentname"  name="departmentname" placeholder="Department Name"  />
            </label>
       
      </section>
         <section class="col-md-5">
            <label class="input">
                <textarea rows="5" cols="30" name="desc" id="desc"></textarea>
              </label>

        </section>
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="addIndustryDetailsToList" > Add Data </button>
        </section>
        <section class="col-md-3">
               <button type="submit" class="btn-u"  name="submit" id="createIndustryDetails" > Create Industry Department's </button>
       
        </section>
    </fieldset>
    <fieldset>
        <section class="col-md-12">
        <table class="table table-striped" id="industry_department_table">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    
                    <td><b>Department Name</b></td>
                     <td><b>Description</b></td>
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
    </section>
    
  </fieldset>  
</div>
</form>         