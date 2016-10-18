  
<div class="col-md-12 sky-form">
     <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
     <script>
   $(document).ready(function(){ 
       
       var currentTime = new Date() 
var minDate = new Date(currentTime.getYear(), currentTime.getMonth() -1, +1); //one day next before month
var maxDate =  new Date(currentTime.getFullYear(), currentTime.getMonth() +2, -1);


      $( "#start" ).datepicker({  maxDate: "0", 
        changeMonth: true,
        changeYear: true,
        yearRange:'-90:+0',
        hideIfNoPrevNext: true,
        "dateFormat": 'dd.mm.yy',
        nextText:'<i class="fa fa-angle-right"></i>',
        prevText:'<i class="fa fa-angle-left"></i>',
         weekHeader: "W"});
    });     
     
     </script>
      
     <fieldset>
         <div class="row">
            
             <section class="col col-3">
                <label class="input">
                  <input type="text" name="patientName" id="patientName" placeholder="Patient Name"> 

                </label>
               
            </section>
            
             <section class="col col-3">
                <label class="input">
                  <input type="text" name="patientID" id="patientID" placeholder="Patient ID"> 

                </label>
               
            </section>
              <section class="col col-3">
                <label class="input">
                  <input type="text" name="mobile" id="mobile" placeholder="Mobile Number"> 

                </label>
               
            </section>
            
 <section class="col col-3">
            <input type="button" class="btn-u pull-right"  name="button" id="bthIDCardSearchStaffAppointmentUsers" value="Search"/> 
 </section>
         </div>
         <br/>
         <div>
          <section class="col-md-15">
             <div class="panel panel-orange margin-bottom-10" id="listofpatients">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i>List of Patients</h3>
                </div>
                <div class="panel-body">   
                <table class="table table-striped pull-left" id="patient_idcard_records_search_result_table">
                    <thead>
                        <tr>

                            <td nowrap>Patient Id</td>
                            <td nowrap>Patient Name</td>
                            <td nowrap>Mobile Number</td>
                            <td nowrap>Date of Birth</td>
                            <td nowrap>Gender</td>
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
     </fieldset>
</div>     