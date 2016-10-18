<?php session_start(); ?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/schooldetails.js"></script> 
<?php
include_once '../../Business/SchoolData.php';

$sd = new SchoolData();
$teacherlist = $sd->fetchSchoolTeacherDetails($_SESSION['officeid']);

?>
<form method="post" action="../../Business/createschooldetails.php">
    
<fieldset>
    <section class="col-md-1"></section>
     <section>
<div class="col-md-12 sky-form" >
    
    <fieldset>
        
        <section class="col col-md-3">
                <label class="select">
                  <select id="classname" name="classname" class="form-control" class="valid">
                   <option value="nodata">-- Class --</option>
                  <option value="Nursery">Nursery</option>
                  <option value="LKG">LKG</option>
                  <option value="UKG">UKG</option> 
                  <option value="1">I</option> 
                   <option value="2">II</option> 
                    <option value="3">III</option> 
                     <option value="4">IV</option> 
                      <option value="5">V</option> 
                       <option value="6">VI</option> 
                        <option value="7">VII</option> 
                         <option value="8">VIII</option> 
                          <option value="9">IX</option> 
                           <option value="10">X</option> 

                  </select>
             </label>  
           </section>
        <section class="col-md-2">
            <label class="select">
                <select id="section" name="section" name="section" >
                      <option value="nodata">- Section -</option>

                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                      <option value="E">E</option>
                      <option value="F">F</option>
                      <option value="G">G</option>
                      

                 </select>
            </label>   
       </section>
        <section class="col-md-2">
          <label class="input">
              <input type="text" id="strength"  name="strength" placeholder="strength" size="4" />
            </label>
       
      </section>
        <section class="col-md-4">
            <label class="select">
             <select id="teacher" name="teacher" >
                   <option value="nodata">- Select Class Teacher -</option>
                    <?php  
                   
                            if(sizeof($teacherlist) > 0){
                                foreach($teacherlist as $teacher){
                        
                    ?>
                   <option value="<?php  echo $teacher->teacherid; ?>"><?php  echo $teacher->name; ?></option>
                   <?php
                                }
                            }
                   ?>
                        

              </select>
         </label>   
                  
        </section>
         
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="addSchoolDetailsToList" > Add Data </button>
        </section>
        <section class="col-md-3">
               <button type="submit" class="btn-u"  name="submit" id="createSchoolDetails" > Create School Details </button>
       
        </section>
    </fieldset>
    <fieldset>
        <section class="col-md-12">
        <table class="table table-striped" id="school_details_table">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    
                    <td><b>Class</b></td>
                     <td><b>Section</b></td>
                    <td><b>Strength</b></td>
                    <td><b>Teacher Id </b></td>
                    <td><b>Teacher Name </b></td>
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